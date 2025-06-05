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
        const userDashboardLink = `${baseUrlUserDashboard}user-dashboard?token=${token}`;

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
});

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
        toastr.error('Please enter your email address!');
        emailInput.focus();
        return;
    }

    // Validate email format
    if (!emailRegex.test(email)) {
        toastr.error('Please enter a valid email address!');
        emailInput.focus();
        return;
    }

    // Check if password is empty
    if (!password) {
        toastr.error('Please enter your password!');
        passwordInput.focus();
        return;
    }

    await postAPICall({
        endPoint: "/auth/sign-in",
        payload: JSON.stringify({
            email,
            password
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data, jwtToken } = response

            if (success) {
                localStorage.setItem("jwtTokenUser", jwtToken)
                localStorage.setItem("userDataUser", JSON.stringify(data))

                toastr.success(message);

                setTimeout(() => {
                    location.reload();
                }, [1000])
            }
        }
    })
}

let userEmail = null

async function register() {
    const verificationType = "registration"
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    const firstName = document.getElementById("firstName").value
    const lastName = document.getElementById("lastName").value

    const emailInput = document.getElementById('email');
    const email = emailInput.value.trim();

    let roleId = document.querySelector('input[name="roleId"]:checked').value;
    roleId = parseInt(roleId)

    if ((firstName ?? "").trim() === "") {
        toastr.error('Please enter a valid first name!');
        return
    }

    if ((lastName ?? "").trim() === "") {
        toastr.error('Please enter a valid last name!');
        return
    }

    // Check if email is empty
    if (!email) {
        toastr.error('Please enter your email address!');
        emailInput.focus();
        return;
    }

    // Validate email format
    if (!emailRegex.test(email)) {
        toastr.error('Please enter a valid email address!');
        emailInput.focus();
        return;
    }

    let business = {}
    if (roleId === 3) {
        const businessName = document.getElementById("businessName").value

        if ((businessName ?? "").trim() === "") {
            toastr.error('Please enter a valid business name!');
            return
        }

        business = {
            ...business,
            name: businessName
        }
    }

    await postAPICall({
        endPoint: "/auth/register",
        payload: JSON.stringify({
            verificationType,
            firstName,
            lastName,
            email,
            roleId: parseInt(roleId),
            business
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data, jwtToken } = response

            if (success) {
                document.getElementById("registerFormContainer").style.display = "none"
                document.getElementById("verifyAndSetPasswordContainer").style.display = "block"
                userEmail = email

                toastr.success(response.message);
            }
        }
    })
}

async function verifyAndSetPassword() {
    const verificationType = "registration"

    const otp = document.getElementById("otp").value
    const password = document.getElementById("password").value
    const confirmPassword = document.getElementById("confirmPassword").value

    if ((otp ?? "").trim() === "") {
        toastr.error('Please enter a valid OTP!');
        return
    }

    if ((password ?? "").trim() === "") {
        toastr.error('Please enter a valid password!');
        return
    }

    if ((confirmPassword ?? "").trim() === "") {
        toastr.error('Please enter a valid confirm password!');
        return
    }

    if (password !== confirmPassword) {
        toastr.error('Password and Retyped password does not match!');
        return
    }

    await postAPICall({
        endPoint: "/auth/reset-password",
        payload: JSON.stringify({
            verificationType,
            email: userEmail,
            hash: otp.toString(),
            newPassword: password
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data, jwtToken } = response

            if (success) {
                localStorage.setItem("jwtTokenUser", jwtToken)
                localStorage.setItem("userDataUser", JSON.stringify(data))

                toastr.success(message);

                setTimeout(() => {
                    location.reload();
                }, [1000])
            }
        }
    })
}

async function resendOTP() {
    const verificationType = "registration"

    await postAPICall({
        endPoint: "/auth/send-otp",
        payload: JSON.stringify({
            verificationType,
            email: userEmail
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message } = response

            if (success) {
                toastr.success(message);
            }
        }
    })
}
