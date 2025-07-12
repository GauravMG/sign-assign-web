let selectedAttributes = []
let productPrice = 0
let totalSelectedAttributePrice = 0
let totalDiscount = 0
let payablePrice = 0
let cartQuantity = 1;
let product = null
let selectedSize = null
let isDesignUploaded = false

$(document).ready(function () {
    const params = new URLSearchParams(window.location.search);
    const encoded = params.get("data");

    if (encoded) {
        const decodedStr = atob(encoded);
        const decodedParams = new URLSearchParams(decodedStr);

        const selectedTemplateId = decodedParams.get("selectedTemplateId");
        let dataObject = decodedParams.get("dataObject");
        dataObject = typeof dataObject === "string" ? JSON.parse(dataObject) : dataObject

        if (dataObject && Object.keys(dataObject).length) {
            document.getElementById("select-design-method").classList.add("d-none")
            isDesignUploaded = true

            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            let cartItem = cart.find(item => item.productId === productId);
            cartItem = {
                ...cartItem,
                templateId: selectedTemplateId,
                design: { ...dataObject }
            }

            cart = cart.filter(item => item.productId !== productId);

            cart.push(cartItem);
            localStorage.setItem('cart', JSON.stringify(cart));
        }
    }

    $(".detail-page-area .owl-carousel").owlCarousel({
        loop: false,
        margin: 15,
        responsiveClass: true,
        navText: ["<img src='../images/arrow-left-long-solid (1).svg' />", "<img src='../images/arrow-right-long-solid (1).svg' />"],
        dots: false,
        nav: true,
        items: 4,
    });

    fetchProducts()

    const uploadModal = document.getElementById('uploadArtworkModal');

    uploadModal.addEventListener('hidden.bs.modal', function () {
        // Clear file input
        const fileInput = document.getElementById('artworkFile');
        if (fileInput) {
            fileInput.value = '';
        }

        // Hide preview wrapper
        const previewWrapper = document.getElementById('templatePreviewWrapper');
        if (previewWrapper) {
            previewWrapper.classList.add('d-none');
        }

        // Clear preview image
        const previewImage = document.getElementById('templatePreviewImage');
        if (previewImage) {
            previewImage.src = '';
        }

        // Hide "Add to cart" button
        const addToCartBtn = document.getElementById('uploadArtworkStartEditing');
        if (addToCartBtn) {
            addToCartBtn.classList.add('d-none');
        }
    });

    const selectTemplateModal = document.getElementById('selectEditorTemplateModal');

    selectTemplateModal.addEventListener('hidden.bs.modal', function () {
        // Clear preview image
        const previewImage = document.getElementById('selectedTemplatePreview');
        if (previewImage) {
            previewImage.src = '';
        }

        // Hide Start Editing button
        const startEditingBtn = document.getElementById('startEditingBtn');
        if (startEditingBtn) {
            startEditingBtn.classList.add('d-none');
        }

        // Optionally clear the template list
        const templateList = document.getElementById('templateCardList');
        if (templateList) {
            templateList.innerHTML = '';
        }
    });
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
        navText: ["<img src='../images/arrow-left-long-solid (1).svg' />", "<img src='../images/arrow-right-long-solid (1).svg' />"],
        dots: false,
        nav: true,
        items: 4,
    });

    $carousel.find('.inner-card img').off('click').on('click', function () {
        const src = $(this).attr('src');
        $("#coverImageLink").attr("href", src);
        $("#productCoverImage").attr('src', src);
    });
}

function reloadOwlCarouselRelatedProducts($carousel, items) {
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

function calculatePayablePrice() {
    // Convert all values to cents for precise arithmetic
    const productPriceCents = Math.round(Number(productPrice) * 100);
    const attributesPriceCents = Math.round(Number(totalSelectedAttributePrice) * 100);
    const discountCents = Math.round(Number(totalDiscount) * 100);

    // Calculate in cents
    let payablePriceCents = productPriceCents + attributesPriceCents - discountCents;

    // Convert back to dollars
    payablePrice = payablePriceCents / 100;

    // Display with exactly 2 decimal places
    document.getElementById("payablePrice").innerText = payablePrice.toFixed(2);

    let existingCart = JSON.parse(localStorage.getItem('cart')) || [];
    existingCart = existingCart.find(item => item.productId === productId);
    if (existingCart) {
        cartQuantity = Number(existingCart.quantity)
        updateCartUI()
    }
}

async function fetchProducts() {
    await postAPICall({
        endPoint: "/product/list",
        payload: JSON.stringify({
            "filter": {
                productId: Number(productId)
            },
            "range": {
                all: true
            },
            "sort": [{
                "orderBy": "name",
                "orderDir": "asc"
            }],
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data: allData } = response

            if (success) {
                const data = allData[0]
                product = data

                productPrice = Number(data.price ?? 0)
                calculatePayablePrice()

                document.getElementById("productName").innerText = data.name
                document.getElementById("productSku").innerText = data.sku ?? "-"
                document.getElementById("productPrice").innerText = data.price ?? 0

                document.getElementById("shortDescription").innerHTML = data.shortDescription

                // if ((data.section1Title ?? "").trim() !== "") {
                //     document.getElementById("section1Title").innerText = data.section1Title
                //     document.getElementById("section1Description").innerHTML = data.section1Description
                //     document.getElementById("accordionSection1Container").classList.remove("d-none")
                // }
                // if ((data.section2Title ?? "").trim() !== "") {
                //     document.getElementById("section2Title").innerText = data.section2Title
                //     document.getElementById("section2Description").innerHTML = data.section2Description
                //     document.getElementById("accordionSection2Container").classList.remove("d-none")
                // }
                // if ((data.section3Title ?? "").trim() !== "") {
                //     document.getElementById("section3Title").innerText = data.section3Title
                //     document.getElementById("section3Description").innerHTML = data.section3Description
                //     document.getElementById("accordionSection3Container").classList.remove("d-none")
                // }

                document.getElementById("nav-features").innerHTML = data.features
                document.getElementById("nav-home").innerHTML = data.description
                document.getElementById("nav-profile").innerHTML = data.specification

                let htmlImagesSlider = []
                let firstImage = null

                for (let media of data.productMedias) {
                    if (!firstImage) {
                        firstImage = media
                    }

                    htmlImagesSlider.push(`<div class="inner-card">
                        <img src="${media.mediaUrl}" alt="${data.name}">
                    </div>`)
                }

                $("#coverImageLink").attr("href", firstImage?.mediaUrl ?? `${BASE_URL}images/no-preview-available.jpg`);
                $("#productCoverImage").attr("src", firstImage?.mediaUrl ?? `${BASE_URL}images/no-preview-available.jpg`)

                reloadOwlCarousel($("#owl-example"), htmlImagesSlider)

                // Group attributes by attribute name
                const groupedAttributes = {};

                data.productAttributes.sort((a, b) => {
                    const priceA = parseFloat(a.additionalPrice) || 0;
                    const priceB = parseFloat(b.additionalPrice) || 0;

                    return priceA - priceB; // ascending order
                });

                data.productAttributes.forEach((item) => {
                    const attrName = item.attribute?.name;
                    if (attrName) {
                        if (!groupedAttributes[attrName]) {
                            groupedAttributes[attrName] = [];
                        }
                        groupedAttributes[attrName].push(item);
                    }
                });

                // Create and inject HTML
                const mainDesc = document.querySelector('.main-desc');

                // Create container to insert after .main-desc
                const container = document.createElement('div');
                container.classList.add('attribute-options');

                Object.entries(groupedAttributes).forEach(([groupName, items]) => {
                    const groupDiv = document.createElement('div');
                    groupDiv.classList.add('attribute-group', 'main-desc', 'mt-2');

                    // Header
                    const header = document.createElement('h5');
                    header.textContent = groupName;
                    groupDiv.appendChild(header);

                    // Create scroll container div
                    const scrollContainer = document.createElement('div');
                    scrollContainer.classList.add('option-scroll-container');
                    scrollContainer.style.display = 'flex';
                    scrollContainer.style.alignItems = 'center';
                    scrollContainer.style.overflow = 'hidden';
                    scrollContainer.style.width = '100%';

                    // Create left arrow button
                    const leftBtn = document.createElement('button');
                    leftBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
                    leftBtn.classList.add('scroll-btn', 'left-btn');
                    leftBtn.style.display = 'none';
                    leftBtn.style.background = 'rgba(0,0,0,0.5)';
                    leftBtn.style.border = 'none';
                    leftBtn.style.color = '#fff';
                    leftBtn.style.fontSize = '16px';
                    leftBtn.style.cursor = 'pointer';
                    leftBtn.style.width = '32px';
                    leftBtn.style.height = '32px';
                    leftBtn.style.borderRadius = '50%';
                    leftBtn.style.marginRight = '8px';

                    // Create right arrow button
                    const rightBtn = document.createElement('button');
                    rightBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
                    rightBtn.classList.add('scroll-btn', 'right-btn');
                    rightBtn.style.display = 'none';
                    rightBtn.style.background = 'rgba(0,0,0,0.5)';
                    rightBtn.style.border = 'none';
                    rightBtn.style.color = '#fff';
                    rightBtn.style.fontSize = '16px';
                    rightBtn.style.cursor = 'pointer';
                    rightBtn.style.width = '32px';
                    rightBtn.style.height = '32px';
                    rightBtn.style.borderRadius = '50%';
                    rightBtn.style.marginLeft = '8px';

                    // Create the option wrapper (scrollable div)
                    const optionWrapper = document.createElement('div');
                    optionWrapper.classList.add('option-wrapper');
                    optionWrapper.style.display = 'flex';
                    optionWrapper.style.overflowX = 'auto';
                    optionWrapper.style.scrollBehavior = 'smooth';
                    optionWrapper.style.flex = '1';  // Take remaining space

                    items.forEach((item) => {
                        const card = document.createElement('div');
                        card.classList.add('option-card');

                        if (groupName.toLowerCase() === "color") {
                            card.classList.add('option-card-attribute-color');

                            const swatch = document.createElement('div');
                            swatch.classList.add('color-swatch');
                            swatch.style.backgroundColor = item.value;
                            card.appendChild(swatch);

                            card.appendChild(swatch);

                            // Color name as label under swatch
                            const label = document.createElement('div');
                            label.textContent = item.value;
                            label.style.fontSize = '12px';
                            label.style.color = '#333';
                            card.appendChild(label);

                        } else {
                            card.classList.add('option-card-attribute');

                            // Value
                            const valueEl = document.createElement('div');

                            let displayValue = item.value;
                            try {
                                const parsedValue = JSON.parse(item.value);
                                if (typeof parsedValue === 'object' && parsedValue !== null) {
                                    const parts = [];
                                    if (parsedValue.width) parts.push(`Width: ${parsedValue.width}`);
                                    if (parsedValue.height) parts.push(`Height: ${parsedValue.height}`);
                                    displayValue = parts.join(', ');
                                }
                            } catch (e) {
                                displayValue = item.value;
                            }
                            valueEl.textContent = displayValue;
                            valueEl.style.fontWeight = 'bold';
                            card.appendChild(valueEl);
                        }

                        // Additional price (applies to all attributes)
                        const priceEl = document.createElement('div');
                        priceEl.textContent = item.additionalPrice && item.additionalPrice !== "0" ? `+ $${item.additionalPrice}` : '';
                        priceEl.style.fontSize = '12px';
                        priceEl.style.color = '#777';

                        card.appendChild(priceEl);

                        card.addEventListener('click', () => {
                            optionWrapper.querySelectorAll('.option-card').forEach(el => el.classList.remove('selected'));
                            card.classList.add('selected');

                            selectedAttributes = selectedAttributes.filter(attr => attr.productAttributeId !== item.productAttributeId);
                            selectedAttributes.push(item);

                            if (item.attribute?.name?.toLowerCase() === "size") {
                                selectedSize = parseSize(item.value)
                            }

                            totalSelectedAttributePrice = selectedAttributes.reduce((sum, attr) => {
                                const price = parseFloat(attr.additionalPrice) || 0;
                                return sum + Math.round(price * 100);
                            }, 0) / 100;
                            calculatePayablePrice()
                        });

                        optionWrapper.appendChild(card);
                    });

                    scrollContainer.appendChild(leftBtn);
                    scrollContainer.appendChild(optionWrapper);
                    scrollContainer.appendChild(rightBtn);

                    // groupDiv.appendChild(optionWrapper);
                    groupDiv.appendChild(scrollContainer);
                    container.appendChild(groupDiv);
                });

                // Insert container after .main-desc
                // mainDesc.parentNode.insertBefore(container, mainDesc.nextSibling);
                document.getElementById("attributesContainer").innerHTML = ""
                document.getElementById("attributesContainer").append(container)

                // fetchProductVariants()
                fetchProductFAQs()
                fetchProductBulkDiscount()

                fetchRelatedProducts(data.productId, data.productCategoryId, data.productSubCategoryId)
            }
        }
    })
}

// Add scroll button logic
// function updateScrollButtons() {
//     if (optionWrapper.scrollWidth > optionWrapper.clientWidth) {
//         leftBtn.style.display = optionWrapper.scrollLeft > 0 ? 'flex' : 'none';
//         rightBtn.style.display = (optionWrapper.scrollLeft + optionWrapper.clientWidth < optionWrapper.scrollWidth) ? 'flex' : 'none';
//     } else {
//         leftBtn.style.display = 'none';
//         rightBtn.style.display = 'none';
//     }
// }

// leftBtn.addEventListener('click', () => {
//     optionWrapper.scrollBy({ left: -150, behavior: 'smooth' });
// });

// rightBtn.addEventListener('click', () => {
//     optionWrapper.scrollBy({ left: 150, behavior: 'smooth' });
// });

// optionWrapper.addEventListener('scroll', updateScrollButtons);
// window.addEventListener('resize', updateScrollButtons);

// Run initially after inserting options
// setTimeout(updateScrollButtons, 100);

async function fetchRelatedProducts(productId, productCategoryId, productSubCategoryId) {
    let payloadFilter = {
        productCategoryId: Number(productCategoryId)
    }
    // if (productSubCategoryId) {
    //     payloadFilter = {
    //         ...payloadFilter,
    //         productSubCategoryId: Number(productSubCategoryId)
    //     }
    // }

    await postAPICall({
        endPoint: "/product/list",
        payload: JSON.stringify({
            "filter": {
                ...payloadFilter
            },
            "range": {
                page: 1,
                pageSize: 10
            },
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            let { success, message, data } = response

            if (success) {
                data = data.filter((el) => Number(el.productId) !== Number(productId))

                let html = []

                for (let i = 0; i < data?.length; i++) {
                    let coverImage = null
                    let price = data[i].price ?? 0

                    for (let k = 0; k < data[i]?.productMedias?.length; k++) {
                        if (data[i].productMedias[k].mediaType.indexOf("image") >= 0 && (data[i].productMedias[k].mediaUrl ?? "").trim() !== "") {
                            coverImage = data[i].productMedias[k].mediaUrl
                            break
                        }
                    }

                    if ((coverImage ?? "").trim() === "") {
                        coverImage = `${BASE_URL}images/no-preview-available.jpg`
                    }

                    html.push(`<div class="inner-card">
                        <a href="/product/${getLinkFromName(data[i].name)}?pid=${data[i].productId}">
                            <div class="p-3 m-0">
                                <img src="${coverImage}" alt="${data[i].name}">
                            </div>
                            <div class="px-3 mt-0">
                                    <h5>${data[i].name}</h5>
                                <!-- <h6>Size (W X H): 34” x 84”)</h6> -->
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

                reloadOwlCarouselRelatedProducts($("#owlRelatedProducts"), html)
            }
        }
    })
}

// async function fetchProductVariants() {
//     await postAPICall({
//         endPoint: "/variant/list",
//         payload: JSON.stringify({
//             "filter": {
//                 productId: Number(productId)
//             },
//             "range": {
//                 all: true
//             },
//             "sort": [{
//                 "orderBy": "price",
//                 "orderDir": "asc"
//             }],
//             linkedEntities: true
//         }),
//         callbackComplete: () => { },
//         callbackSuccess: (response) => {
//             const { success, message, data } = response

//             if (success) {
//                 variants = data ?? []
//                 let html = ``
//                 let firstVariantId = null

//                 for (let variant of data) {
//                     if (!firstVariantId) {
//                         firstVariantId = variant.variantId
//                     }

//                     let coverImage = null
//                     let price = null

//                     if ((variant.price ?? "").toString() !== "") {
//                         price = variant.price
//                     }

//                     for (let k = 0; k < variant.variantMedias?.length; k++) {
//                         if (variant.variantMedias[k].mediaType.indexOf("image") >= 0 && (variant.variantMedias[k].mediaUrl ?? "").trim() !== "") {
//                             coverImage = variant.variantMedias[k].mediaUrl
//                             break
//                         }
//                     }

//                     if ((coverImage ?? "").trim() === "") {
//                         coverImage = `${BASE_URL}images/no-preview-available.jpg`
//                     }

//                     html += `<div class="card variant-card" id="variantSelection_${variant.variantId}">
//                         <img src="${coverImage}" class="card-img-top variant-image" alt="${variant.name}">
//                         <div class="mt-2">
//                             <h6 class="card-title mb-1">${variant.name}</h6>
//                             <p class="card-text text-muted mb-2">${price ? `$${price}` : "-"}</p>
//                             <button class="btn btn-outline-primary btn-sm w-100" onclick="onSelectProductVariant(${variant.variantId})">Select</button>
//                         </div>
//                     </div>`
//                 }

//                 if (data?.length > 1) {
//                     document.getElementById("selectionVariantsContainer").classList.remove("d-none")
//                 }

//                 document.getElementById("selectionVariants").innerHTML = html

//                 onSelectProductVariant(firstVariantId)
//             }
//         }
//     })
// }

// function onSelectProductVariant(variantId) {
//     let selectedVariant = variants.find((variant) => Number(variant.variantId) === Number(variantId))

//     if (!selectedVariant) {
//         return false
//     }

//     let htmlImagesSlider = []
//     let firstImage = null

//     for (let media of selectedVariant.variantMedias) {
//         if (!firstImage) {
//             firstImage = media
//         }

//         htmlImagesSlider.push(`<div class="inner-card">
//             <img src="${media.mediaUrl}" alt="${selectedVariant.name}">
//         </div>`)
//     }

//     $("#productCoverImage").attr("src", firstImage?.mediaUrl ?? `${BASE_URL}images/no-preview-available.jpg`)

//     reloadOwlCarousel($("#owl-example"), htmlImagesSlider)

//     // Group attributes by attribute name
//     const groupedAttributes = {};

//     selectedVariant.variantAttributes.sort((a, b) => {
//         const priceA = parseFloat(a.additionalPrice) || 0;
//         const priceB = parseFloat(b.additionalPrice) || 0;

//         return priceA - priceB; // ascending order
//     });

//     selectedVariant.variantAttributes.forEach((item) => {
//         const attrName = item.attribute?.name;
//         if (attrName) {
//             if (!groupedAttributes[attrName]) {
//                 groupedAttributes[attrName] = [];
//             }
//             groupedAttributes[attrName].push(item);
//         }
//     });

//     // Create and inject HTML
//     const mainDesc = document.querySelector('.main-desc');

//     // Create container to insert after .main-desc
//     const container = document.createElement('div');
//     container.classList.add('attribute-options');

//     Object.entries(groupedAttributes).forEach(([groupName, items]) => {
//         const groupDiv = document.createElement('div');
//         groupDiv.classList.add('attribute-group');
//         groupDiv.classList.add('main-desc');
//         groupDiv.classList.add('mt-2');
//         groupDiv.classList.add('p-4');

//         // Header
//         const header = document.createElement('h5');
//         header.textContent = groupName;
//         groupDiv.appendChild(header);

//         // Option cards
//         const optionWrapper = document.createElement('div');
//         optionWrapper.classList.add('option-wrapper');
//         optionWrapper.style.display = 'flex';
//         optionWrapper.style.flexWrap = 'wrap';
//         optionWrapper.style.gap = '10px';

//         items.forEach((item) => {
//             const card = document.createElement('div');
//             card.classList.add('option-card');
//             card.style.border = '1px solid #ccc';
//             card.style.borderRadius = '6px';
//             card.style.padding = '8px 12px';
//             card.style.cursor = 'pointer';
//             card.style.userSelect = 'none';
//             card.style.transition = 'all 0.3s';
//             card.style.marginRight = '10px';
//             card.style.minWidth = '100px';
//             card.style.textAlign = 'center';

//             // Value
//             const valueEl = document.createElement('div');
//             valueEl.textContent = item.value;
//             valueEl.style.fontWeight = 'bold';

//             // Additional price
//             const priceEl = document.createElement('div');
//             priceEl.textContent = item.additionalPrice && item.additionalPrice !== "0" ? `+ $${item.additionalPrice}` : '';
//             priceEl.style.fontSize = '12px';
//             priceEl.style.color = '#777';

//             card.appendChild(valueEl);
//             card.appendChild(priceEl);

//             card.addEventListener('click', () => {
//                 optionWrapper.querySelectorAll('.option-card').forEach(el => el.classList.remove('selected'));
//                 card.classList.add('selected');
//             });

//             optionWrapper.appendChild(card);
//         });

//         groupDiv.appendChild(optionWrapper);
//         container.appendChild(groupDiv);
//     });

//     // Insert container after .main-desc
//     // mainDesc.parentNode.insertBefore(container, mainDesc.nextSibling);
//     document.getElementById("attributesContainer").innerHTML = ""
//     document.getElementById("attributesContainer").append(container)
// }

async function fetchProductFAQs() {
    await postAPICall({
        endPoint: "/product-faq/list",
        payload: JSON.stringify({
            "filter": {
                productId: Number(productId)
            },
            "range": {
                all: true
            },
            "sort": [{
                "orderBy": "createdAt",
                "orderDir": "asc"
            }],
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data } = response

            if (success) {
                let html = ``

                for (const [index, faq] of data.entries()) {
                    html += `<div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-${index}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-${index}" aria-expanded="false" aria-controls="faq-collapse-${index}">
                                ${faq.question}
                            </button>
                        </h2>
                        <div id="faq-collapse-${index}" class="accordion-collapse collapse" aria-labelledby="faq-heading-${index}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                ${faq.answer}
                            </div>
                        </div>
                    </div>`
                }

                document.getElementById("faqAccordion").innerHTML = html
            }
        }
    })
}

async function fetchProductBulkDiscount() {
    await postAPICall({
        endPoint: "/product-bulk-discount/list",
        payload: JSON.stringify({
            "filter": {
                productId: Number(productId)
            },
            "range": {
                all: true
            },
            "sort": [{
                "orderBy": "createdAt",
                "orderDir": "asc"
            }],
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data } = response

            if (success) {
                let html = ``

                if (data[0]?.dataJson) {
                    let dataJson = typeof data[0].dataJson === "string" ? JSON.parse(data[0].dataJson) : data[0].dataJson

                    if (dataJson?.length) {
                        document.getElementById("accordionBulkDiscountContainer").classList.remove("d-none")

                        for (let el of dataJson) {
                            html += `<tr>
                                <td>${el.minQty} - ${el.maxQty} units</td>
                                <td><span class="badge bg-secondary">${el.discount}%</span></td>
                                <!-- <td>No discount</td> -->
                            </tr>`
                        }

                        document.getElementById("dtBulkDiscountList").innerHTML = html
                    }
                }
            }
        }
    })
}

function addToCart() {
    cartQuantity = 1
    const payablePriceByQuantity = Math.round(payablePrice * cartQuantity * 100) / 100
    const payablePriceByQuantityAfterDiscount = Math.round((payablePriceByQuantity - totalDiscount) * 100) / 100

    const cartItem = {
        productId: productId,
        selectedAttributes: selectedAttributes,
        productPrice: productPrice,
        totalSelectedAttributePrice: totalSelectedAttributePrice,
        totalDiscount,
        quantity: cartQuantity,
        payablePrice,
        payablePriceByQuantity,
        payablePriceByQuantityAfterDiscount,
        rushHourDelivery: false,
        rushHourDeliveryAmount: 0
    };

    // Optional: fetch existing cart or create new
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Optional: avoid duplicates by productId — remove old one
    cart = cart.filter(item => item.productId !== productId);

    // Add new item
    cart.push(cartItem);

    // Save back to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));

    updateCartUI();
    showUpdatedCartItemCount()
}

function updateQuantity(change) {
    cartQuantity += change;
    if (cartQuantity < 1) {
        removeFromCart();
        return;
    }

    const payablePriceByQuantity = Math.round(payablePrice * cartQuantity * 100) / 100
    const payablePriceByQuantityAfterDiscount = Math.round((payablePriceByQuantity - totalDiscount) * 100) / 100

    const cartItem = {
        productId,
        selectedAttributes,
        productPrice,
        totalSelectedAttributePrice,
        totalDiscount,
        quantity: cartQuantity,
        payablePrice,
        payablePriceByQuantity,
        payablePriceByQuantityAfterDiscount,
        rushHourDelivery: false,
        rushHourDeliveryAmount: 0,
        selectedTemplateId: null,
        design: null
    };

    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(item => item.productId !== productId);
    cart.push(cartItem);
    localStorage.setItem('cart', JSON.stringify(cart));

    updateCartUI();
    showUpdatedCartItemCount();
}

function removeFromCart() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart = cart.filter(item => item.productId !== productId);
    localStorage.setItem('cart', JSON.stringify(cart));

    cartQuantity = 0;
    updateCartUI();
    showUpdatedCartItemCount();
}

function updateCartUI() {
    const addBtn = document.getElementById('add-to-cart-button');
    const quantityControls = document.getElementById('quantity-controls');
    const quantityDisplay = document.getElementById('cart-quantity');
    const priceDisplay = document.getElementById('payablePriceSmall');
    const selectDesignMethod = document.getElementById('select-design-method');

    if (cartQuantity > 0) {
        addBtn.classList.add("d-none")
        quantityControls.style.display = 'flex';
        quantityDisplay.textContent = cartQuantity;
        priceDisplay.textContent = (payablePrice * cartQuantity).toFixed(2);
        if (product.isEditorEnabled && !isDesignUploaded) {
            selectDesignMethod.classList.remove("d-none")
            selectDesignMethod.classList.add("d-flex")
        }
    } else {
        addBtn.classList.remove("d-none")
        quantityControls.style.display = 'none';
        selectDesignMethod.classList.remove("d-flex")
        selectDesignMethod.classList.add("d-none")
    }
}

function handleDesignOption(optionType) {
    if (optionType === "skip") {
        $("#designMethodModal").modal("hide")

        return
    }

    if (optionType === "upload") {
        $("#designMethodModal").modal("hide")
        $("#uploadArtworkModal").modal("show")

        return
    }

    if (optionType === "online") {
        $("#designMethodModal").modal("hide")
        $("#selectEditorTemplateModal").modal("show")
        fetchAndRenderTemplates()

        return
    }
}

let selectedTemplate = null;

function fetchAndRenderTemplates() {
    // Call your backend to fetch templates
    postAPICall({
        endPoint: "/template/list",
        payload: JSON.stringify({ filter: {}, range: { all: true } }),
        callbackSuccess: (response) => {
            if (response.success && Array.isArray(response.data)) {
                renderTemplateCards(response.data);
            } else {
                document.getElementById('templateCardList').innerHTML = '<p class="text-muted">No templates found.</p>';
            }
        }
    });
}

function renderTemplateCards(templates) {
    const container = document.getElementById('templateCardList');
    container.innerHTML = '';

    templates.forEach(template => {
        const card = document.createElement('div');
        card.className = 'col-6';

        card.innerHTML = `
            <div class="card h-100 cursor-pointer template-card" onclick="selectTemplate(${template.templateId}, '${template.mediaUrl}', '${template.previewUrl}')">
                <img src="${template.previewUrl}" class="card-img-top" alt="${template.name}">
                <div class="card-body">
                    <h6 class="card-title text-truncate">${template.name}</h6>
                </div>
            </div>
        `;

        container.appendChild(card);
    });
}

function selectTemplate(templateId, mediaUrl, previewUrl) {
    selectedTemplate = { templateId, mediaUrl, previewUrl };

    // Show preview
    document.getElementById('selectedTemplatePreview').src = previewUrl;

    // Show button
    document.getElementById('startEditingBtn').classList.remove('d-none');

    // Optional: Highlight selected card (reset all others first)
    document.querySelectorAll('.template-card').forEach(card => card.classList.remove('border-primary'));
    event.currentTarget.classList.add('border-primary');
}

document.getElementById("artworkFile").addEventListener("change", async function (event) {
    if (!selectedSize) {
        showAlert({
            type: 'info',
            title: 'Please select a size',
            text: 'Please select a size for product before uploading your artwork.',
            showCancel: true,
            onConfirm: () => $("#uploadArtworkModal").modal("hide"),
        });
        return;
    }

    if (!Object.keys(selectedSize).length) {
        showAlert({
            type: 'info',
            title: 'Please select a size',
            text: 'Please select a size for product before uploading your artwork.',
            showCancel: true,
            confirmText: 'Ok',
            onConfirm: () => $("#uploadArtworkModal").modal("hide"),
        });
        return;
    }

    const file = event.target.files[0];
    if (!file) return;

    const formData = new FormData();
    formData.append("artworkFile", file);

    // Show loading state if needed
    showTemplatePreview(null); // Hide existing preview

    try {
        const uploadResult = await uploadArtwork(file)
        if (!uploadResult) {
            throw new Error("Failed to upload artwork file.")
        }

        if (uploadResult) {
            showTemplatePreview(uploadResult)
        } else {
            showAlert({
                type: "error",
                title: "No preview available!",
                text: "File uploaded but no preview available.",
                timer: 1500,
                showConfirmButton: false
            });
        }
    } catch (err) {
        console.error("Upload error:", err);
        showAlert({
            type: "error",
            title: "Error uploading file!",
            text: "Failed to upload artwork file.",
            timer: 1500,
            showConfirmButton: false
        });
    }
});

let uploadedTemplateResult = null

function showTemplatePreview(uploadResult) {
    const wrapper = document.getElementById('templatePreviewWrapper');
    const image = document.getElementById('templatePreviewImage');
    const uploadArtworkStartEditingBtn = document.getElementById('uploadArtworkStartEditing');

    if (uploadResult) {
        const { mediaType, url, previewUrl } = uploadResult;
        uploadedTemplateResult = uploadResult;

        let displayPreviewUrl = previewUrl || `${BASE_URL}images/no-preview-available.jpg`;

        const isImage =
            mediaType.startsWith("image/") &&
            ![
                "image/vnd.adobe.photoshop",
                "image/x-eps",
                "image/x-coreldraw"
            ].includes(mediaType);

        const isVideo = mediaType.startsWith("video/");
        const isPDF = mediaType === "application/pdf";

        // Clean previous preview
        wrapper.innerHTML = '';

        if (isImage) {
            // Image preview
            const img = document.createElement('img');
            img.src = displayPreviewUrl;
            img.alt = "Template Preview";
            img.className = "img-fluid border rounded";
            img.style.maxHeight = "300px";
            wrapper.appendChild(img);

        } else if (isVideo) {
            // Video preview
            const video = document.createElement('video');
            video.src = url;
            video.controls = true;
            video.className = "img-fluid border rounded";
            video.style.maxHeight = "300px";
            wrapper.appendChild(video);

        } else if (isPDF) {
            // PDF preview using Google Docs Viewer
            const iframe = document.createElement('iframe');
            iframe.src = url;
            iframe.width = "100%";
            iframe.height = "300";
            iframe.frameBorder = "0";
            wrapper.appendChild(iframe);

        } else if (previewUrl && previewUrl !== `${BASE_URL}images/no-preview-available.jpg`) {
            // For design files converted to preview PNG by backend
            const img = document.createElement('img');
            img.src = displayPreviewUrl;
            img.alt = "Template Preview";
            img.className = "img-fluid border rounded";
            img.style.maxHeight = "300px";
            wrapper.appendChild(img);

        } else {
            // Fallback image
            const img = document.createElement('img');
            img.src = `${BASE_URL}images/no-preview-available.jpg`;
            img.alt = "Template Preview";
            img.className = "img-fluid border rounded";
            img.style.maxHeight = "300px";
            wrapper.appendChild(img);
        }

        wrapper.classList.remove('d-none');
        uploadArtworkStartEditingBtn?.classList?.remove("d-none");
        return;
    }

    uploadedTemplateResult = null;
    wrapper.classList.add('d-none');
    uploadArtworkStartEditingBtn?.classList?.add("d-none");
    image.src = '';
}

// function redirectToEditorWithUploadedTemplate() {
//     const token = localStorage.getItem('jwtTokenUser');

//     const queryParams = `token=${token}&productId=${productId}&uploadedTemplateUrl=${uploadedTemplateResult?.url}&uploadedTemplatePreviewUrl=${uploadedTemplateResult?.previewUrl}`

//     // Base64 encode
//     const encoded = btoa(queryParams) // browser-safe base64

//     window.location.href = `${BASE_URL_EDITOR}/?data=${encoded}`
// }

function addUploadedTemplateToCart() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    let cartItem = cart.find(item => item.productId === productId);
    cartItem = {
        ...cartItem,
        templateId: null,
        design: { ...uploadedTemplateResult }
    }

    cart = cart.filter(item => item.productId !== productId);

    cart.push(cartItem);
    localStorage.setItem('cart', JSON.stringify(cart));

    $("#uploadArtworkModal").modal("hide")
}

function redirectToEditorWithTemplate() {
    if (!selectedSize) {
        showAlert({
            type: 'info',
            title: 'Please select a size',
            text: 'Please select a size for product to start editing. This will help us customize the editor accordingly for best performance.',
            showCancel: true,
            onConfirm: () => $("#selectEditorTemplateModal").modal("hide"),
        });
        return;
    }

    if (!Object.keys(selectedSize).length) {
        showAlert({
            type: 'info',
            title: 'Please select a size',
            text: 'Please select a size for product to start editing. This will help us customize the editor accordingly for best performance.',
            showCancel: true,
            confirmText: 'Ok',
            onConfirm: () => $("#selectEditorTemplateModal").modal("hide"),
        });
        return;
    }

    const token = localStorage.getItem('jwtTokenUser');

    const params = new URLSearchParams();
    params.set("token", token);
    params.set("productId", productId);
    params.set("selectedTemplateId", selectedTemplate?.templateId);
    params.set("selectedTemplateMediaUrl", selectedTemplate?.mediaUrl);
    params.set("selectedSize", JSON.stringify(selectedSize));
    params.set("returnUrl", window.location.href);

    const encoded = btoa(params.toString());

    window.location.href = `${BASE_URL_EDITOR}/?data=${encoded}`
}
