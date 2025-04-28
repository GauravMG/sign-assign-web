$(document).ready(function () {
    var owl = $(".container-slide-area .owl-carousel").owlCarousel({
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
                items: 3,
                nav: false
            },
            1000: {
                items: 4,
                nav: false,
            },
            1200: {
                items: 5,
                nav: false,
            }
        }
    });

    $(".owl-prev").click(function () {
        owl.trigger("prev.owl.carousel");
    });

    $(".owl-next").click(function () {
        owl.trigger("next.owl.carousel");
    });

    function updateNavButtons(event) {
        var current = event.item.index;
        var total = event.item.count;

        // First slide
        if (current === 0) {
            $(".owl-prev").attr("disabled", true);
        } else {
            $(".owl-prev").removeAttr("disabled");
        }

        // Last slide
        if (current === total - 1) {
            $(".owl-next").attr("disabled", true);
        } else {
            $(".owl-next").removeAttr("disabled");
        }
    }

    var owl = $('.off-slider-area .owl-carousel').owlCarousel({
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
                items: 3,
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

    var owl = $(".testimonial-area .owl-carousel").owlCarousel({
        loop: false,
        margin: 15,
        responsiveClass: true,
        nav: true,
        navText: ["<img src='./assets/images/arrow-left-long-solid (1).svg' />", "<img src='./assets/images/arrow-right-long-solid (1).svg' />"],
        dots: false,
        items: 1,
    });

    var owl = $(".blog-area .owl-carousel").owlCarousel({
        loop: false,
        margin: 15,
        responsiveClass: true,
        navText: ["<img src='./assets/images/arrow-left-long-solid (1).svg' />", "<img src='./assets/images/arrow-right-long-solid (1).svg' />"],
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

    var owl = $(".detail-page-area .owl-carousel").owlCarousel({
        loop: false,
        margin: 15,
        responsiveClass: true,
        navText: ["<img src='./assets/images/arrow-left-long-solid (1).svg' />", "<img src='./assets/images/arrow-right-long-solid (1).svg' />"],
        dots: false,
        nav: true,
        items: 4,
    });
});


const customSelect = document.getElementById('customSelect');
const selected = customSelect.querySelector('.selected');
const options = customSelect.querySelector('.options');
const optionItems = customSelect.querySelectorAll('.option');

selected.addEventListener('click', () => {
    options.style.display = options.style.display === 'block' ? 'none' : 'block';
});

optionItems.forEach(option => {
    option.addEventListener('click', () => {
        // Set the selected text
        selected.textContent = option.textContent;

        // Remove tick from all, then add to selected
        // optionItems.forEach(opt => opt.classList.remove('selected-option'));
        // option.classList.add('selected-option');

        // Close the dropdown
        options.style.display = 'none';

        // Optional: store selected value
        const selectedValue = option.getAttribute('data-value');
        console.log('Selected value:', selectedValue);
    });
});

// Click outside to close dropdown
document.addEventListener('click', function (e) {
    if (!customSelect.contains(e.target)) {
        options.style.display = 'none';
    }
});