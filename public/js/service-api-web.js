const BASE_API_PATH = "http://3.109.198.252/api/v1"
// const BASE_API_PATH = "http://10.10.10.17:9101/v1"

function getJWTToken() {
    return localStorage.getItem("jwtTokenUser") ?? null
}

async function postAPICall({ endPoint, payload, callbackBeforeSend, callbackComplete, callbackSuccess }) {
    const isFormData = payload instanceof FormData;

    const jwtToken = getJWTToken()

    let headers = {}
    if (jwtToken) {
        headers = {
            ...headers,
            "Authorization": `Bearer ${jwtToken}`
        }
    }

    $.ajax({
        url: `${BASE_API_PATH}${endPoint}`,
        method: 'POST',
        data: payload ?? {},
        contentType: isFormData ? false : 'application/json',
        processData: !isFormData,
        headers,
        beforeSend: callbackBeforeSend ?? function () {
        },
        complete: callbackComplete ?? function () {
        },
        success: callbackSuccess,
        error: async function (xhr, status, error, message) {
            let errorMessage = "Something went wrong";

            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            } else if (xhr.responseText) {
                try {
                    let parsedResponse = JSON.parse(xhr.responseText);
                    errorMessage = parsedResponse.message || errorMessage;
                } catch (e) {
                    errorMessage = xhr.responseText;
                }
            }

            if (['jwt expired'].includes(errorMessage)) {
                try {
                    await refreshToken(); // Wait for the token refresh before retrying the API call

                    postAPICall({ endPoint, payload, callbackBeforeSend, callbackComplete, callbackSuccess });
                } catch (refreshError) {
                    toastr.error("Session expired! Please login again.");

                    localStorage.removeItem("jwtTokenUser")
                    localStorage.removeItem("userDataUser")

                    setTimeout(() => window.location.href = "/", 1500)
                    return
                }

                return;
            }

            if (xhr.responseJSON.status === 401) {
                toastr.error(errorMessage);
                // setTimeout(() => window.location.href = "/", 1500)
                return
            }

            toastr.error(errorMessage);
        }
    });
}

async function refreshToken() {
    return new Promise(async (resolve, reject) => {
        await postAPICall({
            endPoint: "/auth/refresh-token",
            callbackBeforeSend: () => { },
            callbackComplete: () => { },
            callbackSuccess: (response) => {
                if (response.success) {
                    const jwtToken = response.data.jwtToken;
                    localStorage.setItem("jwtTokenUser", jwtToken);
                    resolve(jwtToken);
                } else {
                    reject("Token refresh failed");
                }
            }
        })
    });
}

function onClickLogout() {
    console.log(`called onClickLogout`)
    if ((localStorage.getItem("jwtTokenUser") ?? "").trim() !== "") {
        postAPICall({
            endPoint: "/auth/logout",
            callbackSuccess: (response) => {
                if (response.success) {
                    localStorage.removeItem("jwtTokenUser")
                    localStorage.removeItem("userDataUser")
    
                    window.location.href = "/"
                }
            }
        })
    }
}
