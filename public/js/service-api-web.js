function getJWTToken() {
    return localStorage.getItem("jwtTokenUser") ?? null
}

async function postAPICall({
    endPoint,
    payload,
    additionalHeaders,
    callbackBeforeSend,
    callbackComplete,
    callbackSuccess,
    callbackError
}) {
    const isFormData = payload instanceof FormData;
    const jwtToken = getJWTToken();

    let headers = {};
    if (jwtToken) {
        headers["Authorization"] = `Bearer ${jwtToken}`;
    }
    if (additionalHeaders && Object.keys(additionalHeaders).length) {
        headers = {
            ...headers,
            ...additionalHeaders
        }
    }

    $.ajax({
        url: `${BASE_URL_API}/v1${endPoint}`,
        method: 'POST',
        data: payload ?? {},
        contentType: isFormData ? false : 'application/json',
        processData: !isFormData,
        headers,
        beforeSend: callbackBeforeSend ?? (() => { }),
        complete: callbackComplete ?? (() => { }),
        success: callbackSuccess,
        error: async function (xhr, status, error, message) {
            let errorMessage = "Something went wrong";

            if (xhr.responseJSON?.message) {
                errorMessage = xhr.responseJSON.message;
            } else if (xhr.responseText) {
                try {
                    const parsedResponse = JSON.parse(xhr.responseText);
                    errorMessage = parsedResponse.message || errorMessage;
                } catch {
                    errorMessage = xhr.responseText;
                }
            }

            // Handle JWT Expired
            if (errorMessage === 'jwt expired') {
                try {
                    await refreshToken();
                    return postAPICall({
                        endPoint,
                        payload,
                        callbackBeforeSend,
                        callbackComplete,
                        callbackSuccess,
                        callbackError
                    });
                } catch {
                    localStorage.removeItem("jwtTokenUser");
                    localStorage.removeItem("userDataUser");

                    showAlert({
                        type: "error",
                        title: "Session Expired",
                        text: "Please login again.",
                        timer: 1500,
                        showConfirmButton: false
                    });

                    setTimeout(() => window.location.href = "/", 1600);
                    return;
                }
            }

            // Handle 401
            if (xhr.responseJSON?.status === 401) {
                showAlert({
                    type: 'error',
                    title: 'Unauthorized',
                    text: errorMessage,
                });
                return;
            }

            // Default Error Callback Handling
            if (typeof callbackError === 'function') {
                callbackError(errorMessage);
            } else {
                showAlert({
                    type: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            }
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
                if (response.success) {
                    resolve(response.data)
                } else {
                    reject("")
                }
            }
        })
    })
}

async function uploadArtwork(file, keyName = "file") {
    const formData = new FormData();
    formData.append(keyName, file);

    return await new Promise((resolve, reject) => {
        postAPICall({
            endPoint: "/upload/artwork",
            payload: formData,
            callbackSuccess: (response) => {
                if (response.success) {
                    resolve(response.data)
                } else {
                    reject(null)
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
    if ((localStorage.getItem("jwtTokenUser") ?? "").trim() !== "") {
        postAPICall({
            endPoint: "/auth/logout",
            callbackSuccess: (response) => {
                if (response.success) {
                    localStorage.removeItem("jwtTokenUser")
                    localStorage.removeItem("userDataUser")

                    window.history.replaceState({}, document.title, window.location.pathname);
                    window.location.href = "/"
                }
            }
        })
    }
}

function getMe() {
    return new Promise(async (resolve, reject) => {
        await postAPICall({
            endPoint: "/auth/get-me",
            callbackBeforeSend: () => { },
            callbackComplete: () => { },
            callbackSuccess: (response) => {
                const { success, message, data } = response

                if (success) {
                    resolve(data);
                } else {
                    reject(message);
                }
            }
        })
    });
}
