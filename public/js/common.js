const params = new URLSearchParams(window.location.search);
const queryParams = {};

for (const [key, value] of params.entries()) {
    queryParams[key] = value;
}

if (queryParams?.event === "logout") {
    onClickLogout()
}

$(document).ready(function () {
    fetchProductCategories()

    let htmlNavbarAuthOptionsContainer = `<a href="#" class="signup-button" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</a>
    <a href="#" class="login-button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>`

    if (localStorage.getItem("jwtTokenUser")) {
        const token = localStorage.getItem('jwtTokenUser');
        const userDashboardLink = `${BASE_URL_USER_DASHBOARD}?token=${token}`;

        htmlNavbarAuthOptionsContainer = `<a style="cursor: pointer;" href="${userDashboardLink}" class="profile-icon" title="Profile">
            <i class="fi fi-rs-user-gear"></i>
        </a>
        <a style="cursor: pointer;" onclick="onClickLogout()" class="logout-icon" title="Logout" onclick="logout()">
            <i class="fi fi-rr-sign-out-alt"></i>
        </a>`
    }

    document.getElementById("navbarAuthOptionsContainer").innerHTML = htmlNavbarAuthOptionsContainer

    document.querySelectorAll('input[name="roleId"]').forEach(radio =>
        radio.addEventListener('change', () => {
            const selectedValue = document.querySelector('input[name="roleId"]:checked').value;
            console.log("Selected Role ID:", selectedValue);
            if (parseInt(selectedValue) === 3) {
                document.getElementById("businessDetailsContainer").style.display = "block"
            } else {
                document.getElementById("businessDetailsContainer").style.display = "none"
            }
        })
    );

    showUpdatedCartItemCount()

    $('#signupModal').on('hidden.bs.modal', function () {
        document.getElementById("firstName").value = "";
        document.getElementById("lastName").value = "";
        document.getElementById("email").value = "";
        document.getElementById("mobile").value = "";
        document.getElementById("roleId").value = "";
        document.getElementById("businessName").value = "";
        document.getElementById("otp").value = "";
        document.getElementById("password").value = "";
        document.getElementById("confirmPassword").value = "";
    });

    $('#loginModal').on('hidden.bs.modal', function () {
        document.getElementById("loginEmail").value = "";
        document.getElementById("loginPassword").value = "";

        document.getElementById("registerFormContainer").style.display = "block"
        document.getElementById("verifyAndSetPasswordContainer").style.display = "none"
    });

    $('#forgotPasswordModal').on('hidden.bs.modal', function () {
        document.getElementById("forgotEmail").value = "";
        document.getElementById("forgotOTP").value = "";
        document.getElementById("newPassword").value = "";
        document.getElementById("confirmNewPassword").value = "";

        document.getElementById("forgotPasswordRequestContainer").style.display = "block"
        document.getElementById("forgotPasswordVerifyContainer").style.display = "none"
    });
});

function onClickOpenModalSignUp() {
    $("#loginModal").modal("hide");
    $("#forgotPasswordModal").modal("hide");
    $("#signupModal").modal("show");
}

function onClickOpenModalLogin() {
    $("#signupModal").modal("hide");
    $("#forgotPasswordModal").modal("hide");
    $("#loginModal").modal("show");
}

function onClickOpenModalForgotPassword() {
    $("#signupModal").modal("hide");
    $("#loginModal").modal("hide");
    $("#forgotPasswordModal").modal("show");
}

let customSelect
let selected
let options
let optionItems
if (document.getElementById('customSelect')) {
    customSelect = document.getElementById('customSelect');
    selected = customSelect.querySelector('.selected');
    options = customSelect.querySelector('.options');
    optionItems = customSelect.querySelectorAll('.option');
}

selected?.addEventListener('click', () => {
    options.style.display = options.style.display === 'block' ? 'none' : 'block';
});

optionItems?.forEach(option => {
    option.addEventListener('click', () => {
        // Set the selected text
        selected.textContent = option.textContent;

        // Close the dropdown
        options.style.display = 'none';

        // Optional: store selected value
        const selectedValue = option.getAttribute('data-value');
        console.log('Selected value:', selectedValue);
    });
});

// Click outside to close dropdown
document.addEventListener('click', function (e) {
    if (!customSelect?.contains(e.target) && options) {
        options.style.display = 'none';
    }
});

async function fetchProductCategories() {
    await postAPICall({
        endPoint: "/product-category/list",
        payload: JSON.stringify({
            "filter": {
                status: true
            },
            "range": {
                "all": true
            },
            "sort": [{
                "orderBy": "name",
                "orderDir": "asc"
            }],
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data } = response

            if (success) {
                let htmlNavbar = ""
                let htmlFooter = ""

                for (let i = 0; i < data?.length; i++) {
                    htmlNavbar += `
                    <li class="dropdown">
                        <a href="/category/${getLinkFromName(data[i].name)}">${data[i].name}</a>`

                    if (data[i].productSubCategories?.length) {
                        htmlNavbarSubcategory = `<ul class="dropdown-content">`
                        for (let j = 0; j < data[i].productSubCategories?.length; j++) {
                            htmlNavbarSubcategory += `<li class="dropdown-lists"><a href="/subcategory/${getLinkFromName(data[i].productSubCategories[j].name)}">${data[i].productSubCategories[j].name}</a></li>`
                        }
                        htmlNavbarSubcategory += `</ul>`

                        htmlNavbar += htmlNavbarSubcategory
                    }

                    htmlNavbar += `</li>`

                    htmlFooter += `<li>
                        <a href="/category/${getLinkFromName(data[i].name)}">
                            <i class="fa-solid fa-arrow-right-long"></i><span>${data[i].name}</span>
                        </a>
                    </li>`
                }

                document.getElementById("navbarCategoryMenuListContainer").innerHTML = htmlNavbar
                document.getElementById("footerCategoryMenuListContainer").innerHTML = htmlFooter
            }
        }
    })
}

async function login() {
    const emailInput = document.getElementById('loginEmail');
    const passwordInput = document.getElementById('loginPassword');

    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Check if email is empty
    if (!email) {
        showAlert({
            type: 'error',
            title: 'Missing Email',
            text: 'Please enter your email address!',
            onConfirm: () => emailInput.focus()
        });
        return;
    }

    // Validate email format
    if (!emailRegex.test(email)) {
        showAlert({
            type: 'error',
            title: 'Invalid Email',
            text: 'Please enter a valid email address!',
            onConfirm: () => emailInput.focus()
        });
        return;
    }

    // Check if password is empty
    if (!password) {
        showAlert({
            type: 'error',
            title: 'Missing Password',
            text: 'Please enter your password!',
            onConfirm: () => passwordInput.focus()
        });
        return;
    }

    await postAPICall({
        endPoint: "/auth/sign-in",
        payload: JSON.stringify({ email, password }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data, jwtToken } = response;

            if (success) {
                localStorage.setItem("jwtTokenUser", jwtToken);
                localStorage.setItem("userDataUser", JSON.stringify(data));

                showAlert({
                    type: 'success',
                    title: 'Login Successful',
                    text: message || 'You have been logged in successfully!',
                    timer: 1500
                });

                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showAlert({
                    type: 'error',
                    title: 'Login Failed',
                    text: message || 'Something went wrong. Please try again.'
                });
            }
        }
    });
}

let userEmail = null

async function register() {
    const verificationType = "registration";
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    const firstName = document.getElementById("firstName").value.trim();
    const lastName = document.getElementById("lastName").value.trim();

    const emailInput = document.getElementById('email');
    const email = emailInput.value.trim();

    let roleId = parseInt(document.querySelector('input[name="roleId"]:checked').value);

    if (!firstName) {
        showAlert({
            type: 'error',
            title: 'Invalid First Name',
            text: 'Please enter a valid first name!'
        });
        return;
    }

    if (!lastName) {
        showAlert({
            type: 'error',
            title: 'Invalid Last Name',
            text: 'Please enter a valid last name!'
        });
        return;
    }

    if (!email) {
        showAlert({
            type: 'error',
            title: 'Missing Email',
            text: 'Please enter your email address!',
            onConfirm: () => emailInput.focus()
        });
        return;
    }

    if (!emailRegex.test(email)) {
        showAlert({
            type: 'error',
            title: 'Invalid Email Format',
            text: 'Please enter a valid email address!',
            onConfirm: () => emailInput.focus()
        });
        return;
    }

    let business = {};
    if (roleId === 3) {
        const businessName = document.getElementById("businessName").value.trim();

        if (!businessName) {
            showAlert({
                type: 'error',
                title: 'Missing Business Name',
                text: 'Please enter a valid business name!'
            });
            return;
        }

        business.name = businessName;
    }

    await postAPICall({
        endPoint: "/auth/register",
        payload: JSON.stringify({
            verificationType,
            firstName,
            lastName,
            email,
            roleId,
            business
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message } = response;

            if (success) {
                document.getElementById("registerFormContainer").style.display = "none";
                document.getElementById("verifyAndSetPasswordContainer").style.display = "block";
                userEmail = email;

                showAlert({
                    type: 'success',
                    title: 'Registration Successful',
                    text: message || 'Verification sent. Please check your email.'
                });
            } else {
                showAlert({
                    type: 'error',
                    title: 'Registration Failed',
                    text: message || 'An error occurred. Please try again.'
                });
            }
        }
    });
}

async function verifyAndSetPassword(verificationType) {
    const otpInputId = verificationType === "forgot_password" ? "forgotOTP" : "otp";
    const passwordInputId = verificationType === "forgot_password" ? "newPassword" : "password";
    const confirmPasswordInputId = verificationType === "forgot_password" ? "confirmNewPassword" : "confirmPassword";

    const otp = document.getElementById(otpInputId).value.trim();
    const password = document.getElementById(passwordInputId).value.trim();
    const confirmPassword = document.getElementById(confirmPasswordInputId).value.trim();

    if (!otp) {
        showAlert({
            type: 'error',
            title: 'Missing OTP',
            text: 'Please enter a valid OTP!'
        });
        return;
    }

    if (!password) {
        showAlert({
            type: 'error',
            title: 'Missing Password',
            text: 'Please enter a valid password!'
        });
        return;
    }

    if (!confirmPassword) {
        showAlert({
            type: 'error',
            title: 'Missing Confirm Password',
            text: 'Please enter the confirm password!'
        });
        return;
    }

    if (password !== confirmPassword) {
        showAlert({
            type: 'error',
            title: 'Password Mismatch',
            text: 'Password and retyped password do not match!'
        });
        return;
    }

    await postAPICall({
        endPoint: "/auth/reset-password",
        payload: JSON.stringify({
            verificationType,
            email: userEmail,
            hash: otp,
            newPassword: password
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data, jwtToken } = response;

            if (success) {
                localStorage.setItem("jwtTokenUser", jwtToken);
                localStorage.setItem("userDataUser", JSON.stringify(data));

                showAlert({
                    type: 'success',
                    title: 'Password Updated',
                    text: message || 'Your password has been updated successfully.'
                });

                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                showAlert({
                    type: 'error',
                    title: 'Error',
                    text: message || 'Something went wrong. Please try again.'
                });
            }
        }
    });
}

async function resendOTP(verificationType) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    const emailInputElement = document.getElementById('forgotEmail');
    const email = (userEmail ?? "").trim() === "" && verificationType === "forgot_password"
        ? emailInputElement.value.trim()
        : userEmail.trim();

    // Check if email is empty
    if (!email) {
        showAlert({
            type: 'error',
            title: 'Missing Email',
            text: 'Please enter your email address!'
        });
        if (emailInputElement) emailInputElement.focus();
        return;
    }

    // Validate email format
    if (!emailRegex.test(email)) {
        showAlert({
            type: 'error',
            title: 'Invalid Email',
            text: 'Please enter a valid email address!'
        });
        if (emailInputElement) emailInputElement.focus();
        return;
    }

    await postAPICall({
        endPoint: "/auth/send-otp",
        payload: JSON.stringify({
            verificationType,
            email
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message } = response;

            if (success) {
                if (verificationType === "forgot_password" && (userEmail ?? "").trim() === "") {
                    document.getElementById("forgotPasswordRequestContainer").style.display = "none";
                    document.getElementById("forgotPasswordVerifyContainer").style.display = "block";
                    userEmail = email;
                }

                showAlert({
                    type: 'success',
                    title: 'OTP Sent',
                    text: message || 'OTP has been sent to your email.'
                });
            } else {
                showAlert({
                    type: 'error',
                    title: 'Failed',
                    text: message || 'Something went wrong. Please try again.'
                });
            }
        }
    });
}

function showUpdatedCartItemCount() {
    let totalCartItems = 0
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    cart.forEach(item => totalCartItems = Math.round((totalCartItems + item.quantity) * 100) / 100);

    if (totalCartItems > 0) {
        document.getElementById("cartProductCount").innerText = totalCartItems
        document.getElementById("cartProductCount").classList.remove("d-none")
    } else {
        document.getElementById("cartProductCount").innerText = ""
        document.getElementById("cartProductCount").classList.add("d-none")
    }
}

function checkIfUserLoggedIn() {
    return !!localStorage.getItem("jwtTokenUser")
}
