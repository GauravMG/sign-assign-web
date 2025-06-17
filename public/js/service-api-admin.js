var userData = localStorage.getItem("userData") ?? null
if (userData) {
    userData = JSON.parse(userData)
}

function getJWTToken() {
    const jwtToken = localStorage.getItem("jwtToken") ?? null;

    if ((jwtToken ?? "").trim() === "") {
        showAlert({
            type: "error",
            title: "Session Expired",
            text: "Your session has expired. Please log in again.",
            timer: 1500,
            showConfirmButton: false
        });

        setTimeout(() => {
            window.location.href = "/admin/login";
        }, 1600); // Slightly more than timer for smooth UX
        return;
    }

    return jwtToken;
}

async function postAPICall({ endPoint, payload, callbackBeforeSend, callbackComplete, callbackSuccess }) {
    const isFormData = payload instanceof FormData;

    $.ajax({
        url: `${BASE_URL_API}/v1${endPoint}`,
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

            const handleLogout = (msg) => {
                showAlert({
                    type: "error",
                    title: "Authentication Error",
                    text: msg,
                    timer: 1500,
                    showConfirmButton: false
                });

                localStorage.removeItem("jwtToken");
                localStorage.removeItem("userData");

                setTimeout(() => window.location.href = "/admin/login", 1600);
            };

            if (errorMessage === 'Unauthorized: Your account is in-active. Please contact admin.') {
                return handleLogout(errorMessage);
            }

            if (errorMessage === 'jwt malformed') {
                return handleLogout("Session expired! Please login again.");
            }

            if (errorMessage === 'jwt expired') {
                try {
                    await refreshToken();
                    return postAPICall({ endPoint, payload, callbackBeforeSend, callbackComplete, callbackSuccess });
                } catch (refreshError) {
                    return handleLogout("Session expired! Please login again.");
                }
            }

            if (xhr.responseJSON?.status === 401) {
                return handleLogout(errorMessage);
            }

            loader.hide();

            showAlert({
                type: "error",
                title: "Error",
                text: errorMessage
            });
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

                window.location.href = "/admin/login"
            }
        }
    })
}