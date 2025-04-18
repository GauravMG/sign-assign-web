const BASE_API_PATH = "http://3.109.198.252/api/v1"
const userData = localStorage.getItem("userData") ?? null

function getJWTToken() {
    const jwtToken = localStorage.getItem("jwtToken") ?? null

    if ((jwtToken ?? "").trim() === "") {
        toastr.error("Session expired! Please login again.");

        setTimeout(() => window.location.href = "/login", 1500)
        return
    }

    return jwtToken
}

async function postAPICall({ endPoint, payload, callbackBeforeSend, callbackComplete, callbackSuccess }) {
    const isFormData = payload instanceof FormData;

    $.ajax({
        url: `${BASE_API_PATH}${endPoint}`,
        method: 'POST',
        data: payload ?? {},
        contentType: isFormData ? false : 'application/json',
        processData: !isFormData,
        headers: {
            'Authorization': `Bearer ${getJWTToken()}`
        },
        beforeSend: callbackBeforeSend ?? function () {
            loader.show();
        },
        complete: callbackComplete ?? function () {
            loader.hide();
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

            if (['Unauthorized: Your account is in-active. Please contact admin.'].indexOf(errorMessage) >= 0) {
                toastr.error(errorMessage);

                localStorage.removeItem("jwtToken")
                localStorage.removeItem("userData")

                setTimeout(() => window.location.href = "/login", 1500)
                return
            }

            if (['jwt malformed'].includes(errorMessage)) {
                toastr.error("Session expired! Please login again.");

                localStorage.removeItem("jwtToken")
                localStorage.removeItem("userData")

                setTimeout(() => window.location.href = "/login", 1500)
                return
            }

            if (['jwt expired'].includes(errorMessage)) {
                try {
                    await refreshToken(); // Wait for the token refresh before retrying the API call

                    postAPICall({ endPoint, payload, callbackBeforeSend, callbackComplete, callbackSuccess });
                } catch (refreshError) {
                    toastr.error("Session expired! Please login again.");

                    localStorage.removeItem("jwtToken")
                    localStorage.removeItem("userData")

                    setTimeout(() => window.location.href = "/login", 1500)
                    return
                }

                return;
            }

            if (xhr.responseJSON.status === 401) {
                toastr.error(errorMessage);

                localStorage.removeItem("jwtToken")
                localStorage.removeItem("userData")

                setTimeout(() => window.location.href = "/login", 1500)
                return
            }

            loader.hide();
            toastr.error(errorMessage);
        }
    });
}

async function uploadImage(file, keyName = "file") {
    const formData = new FormData();
    formData.append(keyName, file);

    return await new Promise((resolve, reject) => {
        postAPICall({
            endPoint: "/upload/single",
            payload: formData,
            callbackSuccess: (response) => {
                console.log(`response`, response)
                if (response.success) {
                    resolve(response.data.url)
                } else {
                    reject("")
                }
            }
        })
    })
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
                    localStorage.setItem("jwtToken", jwtToken);
                    resolve(jwtToken);
                } else {
                    reject("Token refresh failed");
                }
            }
        })
    });
}

function onClickLogout() {
    postAPICall({
        endPoint: "/auth/logout",
        callbackSuccess: (response) => {
            if (response.success) {
                localStorage.removeItem("jwtToken")
                localStorage.removeItem("userData")

                window.location.href = "/login"
            }
        }
    })
}