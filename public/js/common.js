const params = new URLSearchParams(window.location.search);
const queryParams = {};
let navbarProductCategories = []

for (const [key, value] of params.entries()) {
    queryParams[key] = value;
}

if (queryParams?.event === "logout") {
    onClickLogout()
}

function redirectToUserDashboard() {
    const token = localStorage.getItem('jwtTokenUser');

    let totalCartItems = 0
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.forEach(item => totalCartItems = Math.round((totalCartItems + item.quantity) * 100) / 100);
    if (totalCartItems === 0) {
        totalCartItems = "-"
    }

    const userDashboardLink = `${BASE_URL_USER_DASHBOARD}?token=${token}&cart-item-count=${totalCartItems}`;

    window.location.href = userDashboardLink
}

$(document).ready(function () {
    const searchInput = document.getElementById('navbar-search');
    const searchButton = document.getElementById('search-button');

    function performSearch() {
        const searchValue = searchInput.value.trim();
        if (searchValue) {
            window.location.href = `/search?q=${encodeURIComponent(searchValue)}`;
        }
    }

    // Click on search icon
    searchButton.addEventListener('click', performSearch);

    // Pressing Enter in input field
    searchInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });

    fetchProductCategories()

    let htmlNavbarAuthOptionsContainer = `<a href="#" class="signup-button" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</a>
    <a href="#" class="login-button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>`

    if (localStorage.getItem("jwtTokenUser")) {
        htmlNavbarAuthOptionsContainer = `<a style="cursor: pointer;" onclick="redirectToUserDashboard()" class="profile-icon" title="Profile">
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

    // Rerender on resize (throttled)
    window.addEventListener('resize', () => {
        clearTimeout(window._resizeTimer);
        window._resizeTimer = setTimeout(renderCategories, 100);
    });
});

function createCategoryItem(category) {
    const li = document.createElement('li');
    li.classList.add('nav-item', 'dropdown');

    const catId = `cat-${category.productCategoryId}`;

    if (category.productSubCategories && category.productSubCategories.length > 0) {
        li.innerHTML = `
            <a class="nav-link dropdown-toggle" href="/category/${getLinkFromName(category.name)}" id="cat-${catId}" role="button" aria-expanded="false">
                ${category.name}
            </a>
            <ul class="dropdown-menu" aria-labelledby="cat-${catId}">
                ${category.productSubCategories.map(sub =>
            `<li><a class="dropdown-item" href="/subcategory/${getLinkFromName(sub.name)}">${sub.name}</a></li>`
        ).join('')}
            </ul>
        `;
    } else {
        li.innerHTML = `
            <a class="nav-link" href="/category/${getLinkFromName(category.name)}">${category.name}</a>
        `;
    }

    return li;
}

function initializeDropdowns() {
    // For top-level and More > category > subcategory hover behavior
    const allDropdowns = document.querySelectorAll('.nav-item.dropdown');

    allDropdowns.forEach(item => {
        const dropdownToggle = item.querySelector('.dropdown-toggle');
        const dropdownMenu = item.querySelector('.dropdown-menu');

        item.addEventListener('mouseenter', () => {
            dropdownMenu?.classList.add('show');
            dropdownToggle?.setAttribute('aria-expanded', 'true');
        });

        item.addEventListener('mouseleave', () => {
            dropdownMenu?.classList.remove('show');
            dropdownToggle?.setAttribute('aria-expanded', 'false');
        });

        // For inner categories inside "More" dropdown
        const innerDropdownItems = item.querySelectorAll('.dropdown-item.dropdown-toggle');

        innerDropdownItems.forEach(innerToggle => {
            const subMenu = innerToggle.nextElementSibling;
            const parentItem = innerToggle.closest('.dropdown');

            if (subMenu) {
                parentItem?.addEventListener('mouseenter', () => {
                    subMenu.classList.add('show');
                });
                parentItem?.addEventListener('mouseleave', () => {
                    subMenu.classList.remove('show');
                });
            }
        });
    });

    // Also apply to the #moreDropdown itself
    const moreDropdown = document.getElementById('moreDropdown');
    const moreMenu = document.getElementById('moreDropdownMenu');
    const moreToggle = document.getElementById('moreDropdownLink');

    if (moreDropdown && moreMenu && moreToggle) {
        moreDropdown.addEventListener('mouseenter', () => {
            moreMenu.classList.add('show');
            moreToggle.setAttribute('aria-expanded', 'true');
        });

        moreDropdown.addEventListener('mouseleave', () => {
            moreMenu.classList.remove('show');
            moreToggle.setAttribute('aria-expanded', 'false');
        });
    }

    document.querySelectorAll('#moreDropdown .dropdown').forEach((item) => {
        item.addEventListener('mouseenter', () => {
            const menu = item.querySelector('.dropdown-menu');
            if (!menu) return;

            // Default: open to the right
            menu.style.left = '100%';
            menu.style.right = 'auto';

            // Flip if overflowing screen
            const rect = menu.getBoundingClientRect();
            if (rect.right > window.innerWidth) {
                menu.style.left = 'auto';
                menu.style.right = '100%';
            }
        });
    });
}

function renderCategories() {
    const container = document.getElementById('categoryMenu');
    const moreDropdown = document.getElementById('moreDropdown');
    const moreMenu = document.getElementById('moreDropdownMenu');

    // Clean existing items except "More"
    Array.from(container.children).forEach(el => {
        if (el.id !== 'moreDropdown') {
            container.removeChild(el);
        }
    });

    moreMenu.innerHTML = '';
    moreDropdown.classList.add('d-none');

    const tempItems = navbarProductCategories.map(createCategoryItem);

    // Temporarily make "More" visible to measure its width
    moreDropdown.classList.remove('d-none');
    moreDropdown.style.visibility = 'hidden';

    requestAnimationFrame(() => {
        const containerWidth = container.offsetWidth;
        const moreWidth = moreDropdown.offsetWidth;

        let usedWidth = 0;
        let lastFitIndex = -1;

        // Clean container again (in case items were inserted)
        Array.from(container.children).forEach(el => {
            if (el.id !== 'moreDropdown') container.removeChild(el);
        });

        // Insert items one-by-one, measure their width
        for (let i = 0; i < tempItems.length; i++) {
            const item = tempItems[i];
            item.style.visibility = 'hidden';
            container.insertBefore(item, moreDropdown);

            const itemWidth = item.offsetWidth;
            usedWidth += itemWidth;

            if (usedWidth + moreWidth < containerWidth) {
                lastFitIndex = i;
            } else {
                container.removeChild(item); // remove from main if won't fit
                break;
            }
        }

        // Final re-render
        tempItems.forEach((item, index) => {
            item.style.visibility = 'visible';

            if (index <= lastFitIndex) {
                container.insertBefore(item, moreDropdown);
            } else {
                moreDropdown.classList.remove('d-none');
                moreMenu.appendChild(item);
            }
        });

        // Restore visibility of "More"
        moreDropdown.style.visibility = 'visible';

        initializeDropdowns();
    });
}

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
                let htmlNavbarMobile = ""
                let htmlFooter = ""

                for (let i = 0; i < data?.length; i++) {
                    htmlNavbar += `
                    <li class="dropdown">
                        <a href="/category/${getLinkFromName(data[i].name)}">${data[i].name}</a>`

                    htmlNavbarMobile += `<li>
                        <input id="sub-group-1" type="checkbox" hidden />
                        <label for="sub-group-1" onclick="window.location.href='/category/${getLinkFromName(data[i].name)}'"> ${data[i].name}</label>
                    </li>`

                    if (data[i].productSubCategories?.length) {
                        htmlNavbarSubcategory = `<ul class="dropdown-content">`
                        for (let j = 0; j < data[i].productSubCategories?.length; j++) {
                            htmlNavbarSubcategory += `<li class="dropdown-lists"><a href="/subcategory/${getLinkFromName(data[i].productSubCategories[j].name)}">${data[i].productSubCategories[j].name}</a></li>`
                        }
                        htmlNavbarSubcategory += `</ul>`

                        htmlNavbar += htmlNavbarSubcategory
                    }

                    htmlNavbar += `</li>`

                    htmlFooter += `<li class="footer-item mb-2">
                        <a href="/category/${getLinkFromName(data[i].name)}" class="d-flex align-items-center">
                            <i class="fa-solid fa-arrow-right-long"></i><span class="ms-2">${data[i].name}</span>
                        </a>
                    </li>`
                }

                // document.getElementById("navbarCategoryMenuListContainer").innerHTML = htmlNavbar
                document.getElementById("navbarCategoryMenuListContainerMobile").innerHTML = htmlNavbarMobile
                document.getElementById("footerCategoryMenuListContainer").innerHTML = htmlFooter

                navbarProductCategories = data
                renderCategories()
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

async function fetchUserAddresses() {
    return await new Promise((resolve, reject) => {
        postAPICall({
            endPoint: "/user-address/list",
            payload: JSON.stringify({
                "range": {
                    "all": true
                }
            }),
            callbackComplete: () => { },
            callbackSuccess: (response) => {
                const { success, message, data } = response

                if (success) {
                    resolve(data)
                } else {
                    reject(new Error(message))
                }
            }
        })
    })
}

async function fetchBusinessClients() {
    return await new Promise((resolve, reject) => {
        postAPICall({
            endPoint: "/business-client/list",
            payload: JSON.stringify({
                "range": {
                    "all": true
                }
            }),
            callbackComplete: () => { },
            callbackSuccess: (response) => {
                const { success, message, data } = response

                if (success) {
                    resolve(data)
                } else {
                    reject(new Error(message))
                }
            }
        })
    })
}

/**
 * chatbot
 */
// let sessionId = localStorage.getItem('chat_session_id');
// if (!sessionId) {
// let sessionId = (window.crypto?.randomUUID?.() || generateUUID());
let sessionId = generateUUID();
localStorage.setItem('chat_session_id', sessionId);
// }
const userDataUser = JSON.parse(localStorage.getItem("userDataUser") || "{}");

document.getElementById('chat-icon').onclick = () => {
    const box = document.getElementById('chat-box');
    box.style.display = box.style.display === 'none' ? 'flex' : 'none';
    if (box.style.display === 'flex') initChat();
};

const chatContent = document.getElementById('chat-content');
const chatInput = document.getElementById('chat-input');
let ongoingChatType = ""
let aiChatRestartTimeout = null

const appendMessage = (text, sender = 'bot') => {
    const msg = document.createElement('div');
    msg.className = sender;
    msg.textContent = text;
    chatContent.appendChild(msg);
    chatContent.scrollTop = chatContent.scrollHeight;
};

const appendOptions = (options) => {
    const wrapper = document.createElement('div');
    wrapper.className = 'chat-options';

    options.forEach(opt => {
        const btn = document.createElement('button');
        btn.textContent = opt.label;
        btn.onclick = () => {
            appendMessage(opt.label, 'user');
            wrapper.remove();
            handleUserInput(opt.value);
        };
        wrapper.appendChild(btn);
    });

    chatContent.appendChild(wrapper);
    chatContent.scrollTop = chatContent.scrollHeight;
};

const appendProductLinks = (products) => {
    products.forEach(p => {
        const link = document.createElement('a');
        link.className = 'chat-link';
        link.href = p.link;
        link.target = '_blank';
        link.innerText = p.name;
        chatContent.appendChild(link);
    });
    chatContent.scrollTop = chatContent.scrollHeight;
};

// const initChat = async () => {
//     chatContent.innerHTML = '';
//     appendMessage("Hi there! What would you like to do today?");
//     appendOptions([
//         { label: "Look for Products", value: "look_products" },
//         // { label: "Check my Order", value: "check_order" }
//     ]);
// };
const initChat = async (resetChat = true) => {
    ongoingChatType = ""
    if (resetChat) {
        chatContent.innerHTML = '';
    }
    document.getElementById('grievance-form').style.display = 'none';
    document.getElementById("grievance-form-name").value = ""
    document.getElementById("grievance-form-email").value = ""
    document.getElementById("grievance-form-mobile").value = ""
    document.getElementById("grievance-form-subject").value = ""
    document.getElementById("grievance-form-message").value = ""
    chatInput.style.display = 'none';

    setTimeout(() => {
        appendMessage(resetChat ? "Hi there! What would you like to do today?" : "Anything else I can help with?");
        appendOptions([
            { label: "Look for Products", value: "look_products" },
            { label: "Ask me anything", value: "ask_anything" },
            { label: "Grievance", value: "grievance" }
        ]);
    }, resetChat ? 0 : 2000)
};

// const handleUserInput = async (input) => {
//     await postAPICall({
//         endPoint: "/chatbot/chat",
//         payload: JSON.stringify({ input }),
//         additionalHeaders: {
//             chatsessionid: sessionId,
//             chatuserid: userDataUser?.userId
//         },
//         callbackComplete: () => { },
//         callbackSuccess: (response) => {
//             const { success, message, data } = response;

//             if (success) {
//                 if (data.message) appendMessage(data.message);
//                 if (data.options) appendOptions(data.options);
//                 if (data.products) appendProductLinks(data.products)
//             } else {
//                 showAlert({
//                     type: 'error',
//                     title: 'Failed',
//                     text: message || 'Something went wrong. Please try again.'
//                 });
//             }
//         }
//     });
// };
const handleUserInput = async (input) => {
    clearTimeout(aiChatRestartTimeout)
    // Special handling
    if (input === "grievance") {
        ongoingChatType = "grievance"
        document.getElementById('grievance-form').style.display = 'block';
        chatInput.style.display = 'none';
        document.getElementById("grievance-form-name").value = userDataUser ? createFullName(userDataUser) : ""
        document.getElementById("grievance-form-email").value = userDataUser?.email ?? ""
        document.getElementById("grievance-form-mobile").value = userDataUser?.mobile ?? ""
        return;
    } else if (input === "ask_anything") {
        ongoingChatType = "ask_anything"
        chatInput.style.display = 'block';
        document.getElementById('grievance-form').style.display = 'none';
        appendMessage("You can ask me anything!");
        return;
    } else if (input === "look_products") {
        ongoingChatType = "look_products"
    } else {
        document.getElementById('grievance-form').style.display = 'none';
        chatInput.style.display = 'none';

        if (ongoingChatType === "look_products") {
        } else if (ongoingChatType === "ask_anything") {
            chatInput.style.display = 'block';
            appendMessage(input, 'user');

            aiChatRestartTimeout = setTimeout(() => {
                initChat(false)
            }, 20000)
        }
    }

    await postAPICall({
        endPoint: "/chatbot/chat",
        payload: JSON.stringify({ input }),
        additionalHeaders: {
            chatsessionid: sessionId,
            chatuserid: userDataUser?.userId
        },
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data } = response;

            if (success) {
                if (data.message) appendMessage(data.message);
                if (data.options) appendOptions(data.options);
                if (data.products) {
                    appendProductLinks(data.products)

                    initChat(false)
                }
            } else {
                showAlert({
                    type: 'error',
                    title: 'Failed',
                    text: message || 'Something went wrong. Please try again.'
                });
            }
        }
    });
};

chatInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        handleUserInput(chatInput.value);
        chatInput.value = '';
    }
});

document.getElementById('grievance-form').addEventListener('submit', async function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    const input = {
        name: formData.get('grievance-form-name'),
        email: formData.get('grievance-form-email'),
        mobile: formData.get('grievance-form-mobile'),
        subject: formData.get('grievance-form-subject'),
        message: formData.get('grievance-form-message'),
        type: 'grievance'
    };

    await postAPICall({
        endPoint: "/chatbot/chat",
        payload: JSON.stringify({ input }),
        additionalHeaders: {
            chatsessionid: sessionId,
            chatuserid: userDataUser?.userId
        },
        callbackSuccess: (response) => {
            const { success, message, data } = response;
            if (success && data.message) {
                appendMessage(data.message);
                initChat(false)
            } else {
                appendMessage("Grievance submission failed.");
            }
        }
    });
});
/** chatbot */
