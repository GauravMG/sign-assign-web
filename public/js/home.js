$(document).ready(function () {
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

    Promise.all([
        fetchBanners(),
        fetchCuratedBestsellers(),
        fetchProducts()
    ])
})

function reloadOwlCarousel($carousel, items) {
    $carousel.trigger('destroy.owl.carousel').html('');

    items.forEach(item => {
        $carousel.append(item);
    });

    $carousel.owlCarousel({
        loop: false,
        margin: 15,
        responsiveClass: true,
        nav: false,
        dots: false,
        onInitialized: updateNavButtons,
        onChanged: updateNavButtons,
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 4 },
            1200: { items: 5 }
        }
    });

    const $container = $carousel.closest('.container-fluid');
    $container.find('.owl-prev').off().click(() => $carousel.trigger('prev.owl.carousel'));
    $container.find('.owl-next').off().click(() => $carousel.trigger('next.owl.carousel'));
}

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

async function fetchBanners() {
    await postAPICall({
        endPoint: "/banner/list",
        payload: JSON.stringify({
            "filter": {},
            "range": {
                all: true
            },
            "sort": [{
                "orderBy": "sequenceNumber",
                "orderDir": "asc"
            }]
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data } = response

            if (success) {
                let html = ""

                for (let i = 0; i < data?.length; i++) {
                    html += `<div class="carousel-item${i === 0 ? " active" : ""}">
                        <img src="${data[i].mediaUrl}" class="d-block w-100" alt="${data[i].name}">
                    </div>`
                }

                document.getElementById("coverBannerContainer").innerHTML = html
            }
        }
    })
}

async function fetchCuratedBestsellers() {
    await postAPICall({
        endPoint: "/product-subcategory/list",
        payload: JSON.stringify({
            "filter": {},
            "range": {
                "page": 1,
                pageSize: 10
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
                let html = ""

                for (let i = 0; i < data?.length; i++) {
                    html += `<div class="product-card">
                        <a href="/subcategory/${getLinkFromName(data[i].name)}">
                            <img src="${data[i].image}" alt="${data[i].name}">
                            <h5>${data[i].name}</h5>
                        </a>
                    </div>`
                }

                document.getElementById("curatedBestSellersContainer").innerHTML = html
            }
        }
    })
}

async function fetchProducts() {
    await postAPICall({
        endPoint: "/product/list",
        payload: JSON.stringify({
            "filter": {},
            "range": {
                "page": 1,
                pageSize: 10
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
                let htmlSection1 = []
                let htmlSection2 = []
                let htmlSection3 = []
                let htmlSection4 = []
                let htmlSection5 = []

                for (let i = 0; i < data?.length; i++) {
                    let coverImage = null
                    let price = null
                    for (let j = 0; j < data[i].variants?.length; j++) {
                        if ((data[i].variants[j].price ?? "").toString() !== "") {
                            price = data[i].variants[j].price
                        }

                        for (let k = 0; k < data[i].variants[j]?.variantMedias.length; k++) {
                            if (data[i].variants[j].variantMedias[k].mediaType.indexOf("image") >= 0 && (data[i].variants[j].variantMedias[k].mediaUrl ?? "").trim() !== "") {
                                coverImage = data[i].variants[j].variantMedias[k].mediaUrl
                                break
                            }
                        }

                        if ((coverImage ?? "").trim() !== "") {
                            break
                        }
                    }

                    if ((coverImage ?? "").trim() === "") {
                        coverImage = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGMAAQAABQABDQottAAAAABJRU5ErkJggg=="
                    }

                    htmlSection1.push(`<div class="inner-card">
                        <a href="#">
                            <div class="p-3 m-0">
                                <img src="${coverImage}" alt="${data[i].name}">
                            </div>
                            <div class="px-3 mt-0">
                                <h5>${data[i].name}</h5>
                                <div class="rating-area">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h6>Starts at: <span class="text-green">${price ? `$${price}` : "-"}</span></h6>
                            </div>
                            <a href="http://3.109.198.252/editor" target="_blank" class="customized-button">Customize</a>
                        </a>
                    </div>`)

                    htmlSection2.push(`<div class="inner-card">
                        <a href="#">
                            <div class="p-3 m-0">
                                <img src="${coverImage}" alt="${data[i].name}">
                            </div>
                            <div class="px-3 mt-0">
                                <h5>${data[i].name}</h5>
                            </div>
                            <a href="http://3.109.198.252/editor" target="_blank" class="customized-button">Customize</a>
                        </a>
                    </div>`)

                    htmlSection3.push(`<div class="inner-card">
                        <div class="main-div">
                            <img src="${coverImage}" alt="${data[i].name}">
                            <div class="second-div">
                                <h6>${data[i].name}</h6>
                                <p><!-- span>${price ? `$${price}` : "-"}</span> -->${price ? `$${price}` : "-"}</p>
                            </div>
                        </div>
                    </div>`)

                    htmlSection4.push(`<div class="business-card">
                        <img src="${coverImage}" alt="${data[i].name}">
                        <h5>${data[i].name}</h5>
                        <h6>${price ? `$${price}` : "-"}</h6>
                        <a href="/product/vinyl-banners">Details</a>
                    </div>`)

                    htmlSection5.push(`<div class="inner-card">
                        <a href="#">
                            <div class="p-3 m-0">
                                <img src="${coverImage}" alt="${data[i].name}">
                            </div>
                            <div class="px-3 mt-0">
                                <h5>${data[i].name}</h5>
                                <h4>${price ? `$${price}` : "-"}</h4>
                            </div>
                            <a href="http://3.109.198.252/editor" target="_blank" class="customized-button">Customize</a>
                        </a>
                    </div>`)
                }

                reloadOwlCarousel($("#owlSection1"), htmlSection1)
                reloadOwlCarousel($("#owlSection2"), htmlSection2)
                reloadOwlCarousel($("#owlSection3"), htmlSection3)
                reloadOwlCarousel($("#owlSection4"), htmlSection4)
                reloadOwlCarousel($("#owlSection5"), htmlSection5)
            }
        }
    })
}
