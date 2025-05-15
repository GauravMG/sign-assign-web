$(document).ready(function () {
    $('.container-fluid').each(function () {
        var $container = $(this);
        var $carousel = $container.find('.owl-carousel');

        // Initialize Owl Carousel
        $carousel.owlCarousel({
            loop: false,
            margin: 15,
            responsiveClass: true,
            nav: false,
            dots: false,
            onInitialized: updateNavButtons,
            onChanged: updateNavButtons,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: false
                },
                1200: {
                    items: 5,
                    nav: false
                }
            }
        });

        // Bind custom navigation buttons
        $container.find('.owl-prev').click(function () {
            $carousel.trigger('prev.owl.carousel');
        });

        $container.find('.owl-next').click(function () {
            $carousel.trigger('next.owl.carousel');
        });
    });

    function updateNavButtons(event) {
        var $carousel = $(event.target);
        var $container = $carousel.closest('.container-fluid');
        var $prevButton = $container.find('.owl-prev');
        var $nextButton = $container.find('.owl-next');

        var current = event.item.index; // first visible item index
        var total = event.item.count;   // total number of items
        var itemsPerPage = event.page.size; // number of items visible at once

        // Disable prev button if first item is visible
        if (current === 0) {
            $prevButton.attr("disabled", true);
        } else {
            $prevButton.removeAttr("disabled");
        }

        // Disable next button if last visible item is at or beyond the last item
        if (current + itemsPerPage >= total) {
            $nextButton.attr("disabled", true);
        } else {
            $nextButton.removeAttr("disabled");
        }
    }

    fetchProductCategories()

    let htmlNavbarAuthOptionsContainer = `<a href="#" class="signup-button" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</a>
    <a href="#" class="login-button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>`

    if (localStorage.getItem("jwtTokenUser")) {
        htmlNavbarAuthOptionsContainer = `<a style="cursor: pointer;" href="/profile" class="profile-icon" title="Profile">
            <i class="fas fa-user"></i>
        </a>
        <a style="cursor: pointer;" onclick="onClickLogout()" class="logout-icon" title="Logout" onclick="logout()">
            <i class="fas fa-sign-out-alt"></i>
        </a>`
    }

    document.getElementById("navbarAuthOptionsContainer").innerHTML = htmlNavbarAuthOptionsContainer
});


$('.off-slider-area .owl-carousel').owlCarousel({
    loop: false,
    margin: 15,
    autoplay: true,
    autoplayTimeout: 3000,
    responsiveClass: true,
    dots: false,
    stagePadding: 100,
    responsive: {
        0: {
            items: 1,
            nav: false
        },
        600: {
            items: 2,
            nav: false
        },
        1000: {
            items: 3.5,
            nav: false,
        },
        1200: {
            items: 4.5,
            nav: false,
        }
    }
})

$(".testimonial-area .owl-carousel").owlCarousel({
    loop: false,
    margin: 15,
    responsiveClass: true,
    nav: true,
    navText: ["<img src='../images/arrow-left-long-solid (1).svg' />", "<img src='../images/arrow-right-long-solid (1).svg' />"],
    dots: false,
    items: 1,
});

$(".blog-area .owl-carousel").owlCarousel({
    loop: false,
    margin: 15,
    responsiveClass: true,
    navText: ["<img src='../images/arrow-left-long-solid (1).svg' />", "<img src='../images/arrow-right-long-solid (1).svg' />"],
    dots: false,
    responsive: {
        0: {
            items: 1,
            nav: false
        },
        600: {
            items: 2,
            nav: false
        },
        1000: {
            items: 3,
            nav: true,
        }
    }
});

$(".detail-page-area .owl-carousel").owlCarousel({
    loop: false,
    margin: 15,
    responsiveClass: true,
    navText: ["<img src='../images/arrow-left-long-solid (1).svg' />", "<img src='../images/arrow-right-long-solid (1).svg' />"],
    dots: false,
    nav: true,
    items: 4,
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
    if (!customSelect?.contains(e.target)) {
        options.style.display = 'none';
    }
});

async function fetchProductCategories() {
    await postAPICall({
        endPoint: "/product-category/list",
        payload: JSON.stringify({
            "filter": {},
            "range": {
                "all": true
            },
            "sort": [{
                "orderBy": "name",
                "orderDir": "asc"
            }]
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data } = response

            if (success) {
                let htmlNavbar = ""
                let htmlFooter = ""

                for (let i = 0; i < data?.length; i++) {
                    // htmlNavbar += `<li><a href="/category/${getLinkFromName(data[i].name)}">${data[i].name}</a></li>`
                    htmlNavbar += `
                    <li class="dropdown">
                        <a href="/category/${getLinkFromName(data[i].name)}">${data[i].name}</a>
                        <ul class="dropdown-content">
                            <li class="dropdown-lists"><a href="#">Sign Installation</a></li>
                            <li class="dropdown-lists"><a href="#">Sign Installation</a></li>
                            <li class="dropdown-lists"><a href="#">Sign Installation</a></li>
                            <li class="dropdown-lists"><a href="#">Sign Installation</a></li>
                            <li class="dropdown-lists"><a href="#">Sign Installation</a></li>
                        </ul>
                    </li>
                    `

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
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Check if email is empty
    if (!email) {
        alert('Please enter your email address!');
        emailInput.focus();
        return;
    }

    // Validate email format
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address!');
        emailInput.focus();
        return;
    }

    // Check if password is empty
    if (!password) {
        alert('Please enter your password!');
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

async function register() {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Check if email is empty
    if (!email) {
        alert('Please enter your email address!');
        emailInput.focus();
        return;
    }

    // Validate email format
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address!');
        emailInput.focus();
        return;
    }

    // Check if password is empty
    if (!password) {
        alert('Please enter your password!');
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
