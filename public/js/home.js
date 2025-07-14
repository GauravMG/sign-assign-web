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

    Promise.all([
        fetchBanners(),
        fetchBlogs(),
        fetchCuratedBestsellers(),
        // fetchProducts(),
        fetchAllCategories(),
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

function reloadOwlCarouselBlog($carousel, items) {
    $carousel.trigger('destroy.owl.carousel').html('');

    items.forEach(item => {
        $carousel.append(item);
    });

    $carousel.owlCarousel({
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
            filter: {},
            range: {
                all: true
            },
            sort: [{
                orderBy: "sequenceNumber",
                orderDir: "asc"
            }]
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, data } = response;

            if (success) {
                let html = "";

                for (let i = 0; i < data?.length; i++) {
                    const mediaUrl = data[i].mediaUrl;
                    const isVideo = /\.(mp4|webm|ogg)$/i.test(mediaUrl); // Simple extension check

                    html += `<div class="carousel-item${i === 0 ? " active" : ""}">`;

                    if (isVideo) {
                        html += `
                            <video class="d-block w-100" muted loop playsinline autoplay>
                                <source src="${mediaUrl}" type="video/mp4">
                            </video>
                        `;
                    }
                    else {
                        html += `<img src="${mediaUrl}" class="d-block w-100" alt="${data[i].name}">`;
                    }

                    html += `</div>`;
                }

                document.getElementById("coverBannerContainer").innerHTML = html;
            }
        }
    });
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
                        <a href="/subcategory/${getLinkFromName(data[i].name)}?subcatid=${data[i].productSubCategoryId}">
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

// async function fetchProducts() {
//     await postAPICall({
//         endPoint: "/product/list",
//         payload: JSON.stringify({
//             "filter": {},
//             "range": {
//                 "page": 1,
//                 pageSize: 10
//             },
//             "sort": [{
//                 "orderBy": "name",
//                 "orderDir": "asc"
//             }],
//             linkedEntities: true
//         }),
//         callbackComplete: () => { },
//         callbackSuccess: (response) => {
//             const { success, message, data } = response

//             if (success) {
//                 let htmlSection1 = []
//                 let htmlSection2 = []
//                 let htmlSection3 = []
//                 let htmlSection4 = []
//                 let htmlSection5 = []

//                 for (let i = 0; i < data?.length; i++) {
//                     let coverImage = null
//                     let price = data[i].price ?? 0

//                     for (let k = 0; k < data[i]?.productMedias?.length; k++) {
//                         if (data[i].productMedias[k].mediaType.indexOf("image") >= 0 && (data[i].productMedias[k].mediaUrl ?? "").trim() !== "") {
//                             coverImage = data[i].productMedias[k].mediaUrl
//                             break
//                         }
//                     }

//                     if ((coverImage ?? "").trim() === "") {
//                         coverImage = `${BASE_URL}images/no-preview-available.jpg`
//                     }

//                     htmlSection1.push(`<div class="inner-card">
//                         <a href="/product/${getLinkFromName(data[i].name)}?pid=${data[i].productId}">
//                             <div class="p-3 m-0">
//                                 <img src="${coverImage}" alt="${data[i].name}">
//                             </div>
//                             <div class="px-3 mt-0">
//                                 <h5>${data[i].name}</h5>
//                                 <div class="rating-area">
//                                     <span class="fa fa-star checked"></span>
//                                     <span class="fa fa-star checked"></span>
//                                     <span class="fa fa-star checked"></span>
//                                     <span class="fa fa-star checked"></span>
//                                     <span class="fa fa-star checked"></span>
//                                 </div>
//                                 <h6>Starts at: <span class="text-green">$ ${price}</span></h6>
//                             </div>
//                             <a href="/product/${getLinkFromName(data[i].name)}?pid=${data[i].productId}" class="customized-button">${data[i].isEditorEnabled ? "Customize" : "Order Now"}</a>
//                         </a>
//                     </div>`)

//                     htmlSection2.push(`<div class="inner-card">
//                         <a href="/product/${getLinkFromName(data[i].name)}?pid=${data[i].productId}">
//                             <div class="p-3 m-0">
//                                 <img src="${coverImage}" alt="${data[i].name}">
//                             </div>
//                             <div class="px-3 mt-0">
//                                 <h5>${data[i].name}</h5>
//                             </div>
//                             <a href="/product/${getLinkFromName(data[i].name)}?pid=${data[i].productId}" class="customized-button">${data[i].isEditorEnabled ? "Customize" : "Order Now"}</a>
//                         </a>
//                     </div>`)

//                     htmlSection3.push(`<div class="inner-card">
//                         <div class="main-div">
//                             <img src="${coverImage}" alt="${data[i].name}">
//                             <div class="second-div">
//                                 <h6>${data[i].name}</h6>
//                                 <p>$ ${price}</p>
//                             </div>
//                         </div>
//                     </div>`)

//                     htmlSection4.push(`<div class="business-card">
//                         <img src="${coverImage}" alt="${data[i].name}">
//                         <h5>${data[i].name}</h5>
//                         <h6>$ ${price}</h6>
//                         <a href="/product/vinyl-banners">Details</a>
//                     </div>`)

//                     htmlSection5.push(`<div class="inner-card">
//                         <a href="/product/${getLinkFromName(data[i].name)}?pid=${data[i].productId}">
//                             <div class="p-3 m-0">
//                                 <img src="${coverImage}" alt="${data[i].name}">
//                             </div>
//                             <div class="px-3 mt-0">
//                                 <h5>${data[i].name}</h5>
//                                 <h4>$ ${price}</h4>
//                             </div>
//                             <a href="/product/${getLinkFromName(data[i].name)}?pid=${data[i].productId}" class="customized-button">${data[i].isEditorEnabled ? "Customize" : "Order Now"}</a>
//                         </a>
//                     </div>`)
//                 }

//                 reloadOwlCarousel($("#owlSection1"), htmlSection1)
//                 reloadOwlCarousel($("#owlSection2"), htmlSection2)
//                 reloadOwlCarousel($("#owlSection3"), htmlSection3)
//                 reloadOwlCarousel($("#owlSection4"), htmlSection4)
//                 reloadOwlCarousel($("#owlSection5"), htmlSection5)
//             }
//         }
//     })
// }

async function fetchAllCategories() {
    await postAPICall({
        endPoint: "/product-category/list",
        payload: JSON.stringify({
            "range": {
                all: true
            },
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data } = response

            if (success) {
                fetchCategoryProducts($("#owlSectionCatBanner"), data.find((el) => el.name.toLowerCase() === "banners").productCategoryId)
                fetchCategoryProducts($("#owlSectionCatWindow"), data.find((el) => el.name.toLowerCase() === "window products").productCategoryId)
                fetchCategoryProducts($("#owlSectionCatVehicle"), data.find((el) => el.name.toLowerCase() === "vehicle products").productCategoryId)
                fetchCategoryProducts($("#owlSectionCatEvent"), data.find((el) => el.name.toLowerCase() === "event signs").productCategoryId)
                fetchCategoryProducts($("#owlSectionCatMarketingTool"), data.find((el) => el.name.toLowerCase() === "marketing tools").productCategoryId)

                fetchCategoryProductsRegulatorySign(data.find((el) => el.name.toLowerCase() === "regulatory signs").productCategoryId)
            }
        }
    })
}

async function fetchCategoryProducts(owlCarouselEl, productCategoryId) {
    await postAPICall({
        endPoint: "/product/list",
        payload: JSON.stringify({
            "filter": {
                productCategoryId: Number(productCategoryId)
            },
            "range": {
                "page": 1,
                pageSize: 10
            },
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data } = response

            if (success) {
                let htmlSection = []

                for (let i = 0; i < data?.length; i++) {
                    let coverImage = null

                    for (let k = 0; k < data[i]?.productMedias?.length; k++) {
                        if (data[i].productMedias[k].mediaType.indexOf("image") >= 0 && (data[i].productMedias[k].mediaUrl ?? "").trim() !== "") {
                            coverImage = data[i].productMedias[k].mediaUrl
                            break
                        }
                    }

                    if ((coverImage ?? "").trim() === "") {
                        coverImage = `${BASE_URL}images/no-preview-available.jpg`
                    }

                    const productRegularPrice = Number(data[i].price ?? 0)
                    const productOfferPrice = Number(data[i].offerPrice ?? 0)
                    let price = productRegularPrice
                    if (productOfferPrice >= 0 && productOfferPrice !== productRegularPrice) {
                        price = productOfferPrice
                    }

                    htmlSection.push(`<div class="inner-card">
                        <a href="/product/${getLinkFromName(data[i].name)}?pid=${data[i].productId}">
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
                                <h6>Starts at: <span class="text-green">$ ${price}</span></h6>
                            </div>
                            <a href="/product/${getLinkFromName(data[i].name)}?pid=${data[i].productId}" class="customized-button">${data[i].isEditorEnabled ? "Customize" : "Order Now"}</a>
                        </a>
                    </div>`)
                }

                reloadOwlCarousel(owlCarouselEl, htmlSection)
            }
        }
    })
}

async function fetchCategoryProductsRegulatorySign(productCategoryId) {
    await postAPICall({
        endPoint: "/product/list",
        payload: JSON.stringify({
            "filter": {
                productCategoryId: Number(productCategoryId)
            },
            "range": {
                "page": 1,
                pageSize: 4
            },
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data } = response

            if (success) {
                let htmlSection = []

                for (let i = 0; i < data?.length; i++) {
                    let coverImage = null

                    for (let k = 0; k < data[i]?.productMedias?.length; k++) {
                        if (data[i].productMedias[k].mediaType.indexOf("image") >= 0 && (data[i].productMedias[k].mediaUrl ?? "").trim() !== "") {
                            coverImage = data[i].productMedias[k].mediaUrl
                            break
                        }
                    }

                    if ((coverImage ?? "").trim() === "") {
                        coverImage = `${BASE_URL}images/no-preview-available.jpg`
                    }

                    const productRegularPrice = Number(data.price ?? 0)
                    const productOfferPrice = Number(data.offerPrice ?? 0)
                    let price = productRegularPrice
                    if (productOfferPrice >= 0 && productOfferPrice !== productRegularPrice) {
                        price = productOfferPrice
                    }

                    htmlSection.push(`<div class="card-area">
                        <img src="${coverImage}" alt="${data[i].name}">
                        <h5>${data[i].name}</h5>
                        <a href="/product/${getLinkFromName(data[i].name)}?pid=${data[i].productId}">Order Now</a>
                    </div>`)
                }

                document.getElementById("catRegulatorySign").innerHTML = htmlSection.join("")
            }
        }
    })
}

async function fetchBlogs() {
    await postAPICall({
        endPoint: "/blog/list",
        payload: JSON.stringify({
            filter: {},
            range: {
                page: 1,
                pageSize: 10
            },
            sort: [{
                orderBy: "createdAt",
                orderDir: "desc"
            }],
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, data } = response;

            if (success) {
                let html = [];

                for (let i = 0; i < data?.length; i++) {
                    let mediaUrl = "";
                    let isVideo = false;

                    for (let k = 0; k < data[i]?.blogMedias?.length; k++) {
                        const media = data[i].blogMedias[k];
                        const mediaUrlClean = (media.mediaUrl ?? "").trim();

                        if (mediaUrlClean === "") continue;

                        if (media.mediaType?.indexOf("image") >= 0) {
                            mediaUrl = mediaUrlClean;
                            isVideo = false;
                            break;
                        } else if (media.mediaType?.indexOf("video") >= 0 && mediaUrl === "") {
                            mediaUrl = mediaUrlClean;
                            isVideo = true;
                            break
                        }
                    }

                    if (mediaUrl === "") {
                        mediaUrl = `${BASE_URL}images/no-preview-available.jpg`;
                        isVideo = false;
                    }

                    html.push(`<div class="inner-card">
                        <div class="p-3 m-0">` +
                        (isVideo
                            ? `<video class="w-100 rounded" muted loop playsinline>
                                     <source src="${mediaUrl}" type="video/mp4">
                                     Your browser does not support the video tag.
                                   </video>`
                            : `<img src="${mediaUrl}" alt="${data[i].title}" class="w-100 rounded">`) +
                        `</div>
                        <div class="px-3 mt-0">
                            <h6>by signassi | ${formatDateWithoutTime(data[i].createdAt)} | Signage</h6>
                            <h5>${data[i].title}</h5>
                            <p>${getTextFromHTML(data[i].description, null)}</p>
                            <a href="/learning-center/${getLinkFromName(data[i].title)}?lcid=${data[i].blogId}">Read More <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
                        </div>
                    </div>`);
                }

                reloadOwlCarouselBlog($("#owlLearningCenter"), html);
            }
        }
    });
}
