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