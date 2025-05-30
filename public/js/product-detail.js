let productId = null
let variants = []

$(document).ready(function () {
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
}

async function fetchProducts() {
    await postAPICall({
        endPoint: "/product/list",
        payload: JSON.stringify({
            "filter": {
                name: productName
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

                productId = data.productId

                document.getElementById("productName").innerText = data.name

                document.getElementById("shortDescription").innerHTML = data.shortDescription

                if ((data.section1Title ?? "").trim() !== "") {
                    document.getElementById("section1Title").innerText = data.section1Title
                    document.getElementById("section1Description").innerHTML = data.section1Description
                    document.getElementById("accordionSection1Container").classList.remove("d-none")
                }
                if ((data.section2Title ?? "").trim() !== "") {
                    document.getElementById("section2Title").innerText = data.section2Title
                    document.getElementById("section2Description").innerHTML = data.section2Description
                    document.getElementById("accordionSection2Container").classList.remove("d-none")
                }
                if ((data.section3Title ?? "").trim() !== "") {
                    document.getElementById("section3Title").innerText = data.section3Title
                    document.getElementById("section3Description").innerHTML = data.section3Description
                    document.getElementById("accordionSection3Container").classList.remove("d-none")
                }

                document.getElementById("nav-home").innerHTML = data.description
                document.getElementById("nav-profile").innerHTML = data.specification

                fetchProductVariants()
                fetchProductFAQs()
            }
        }
    })
}

async function fetchProductVariants() {
    await postAPICall({
        endPoint: "/variant/list",
        payload: JSON.stringify({
            "filter": {
                productId: Number(productId)
            },
            "range": {
                all: true
            },
            "sort": [{
                "orderBy": "price",
                "orderDir": "asc"
            }],
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data } = response

            if (success) {
                variants = data ?? []
                let html = ``
                let firstVariantId = null

                for (let variant of data) {
                    if (!firstVariantId) {
                        firstVariantId = variant.variantId
                    }

                    let coverImage = null
                    let price = null

                    if ((variant.price ?? "").toString() !== "") {
                        price = variant.price
                    }

                    for (let k = 0; k < variant.variantMedias?.length; k++) {
                        if (variant.variantMedias[k].mediaType.indexOf("image") >= 0 && (variant.variantMedias[k].mediaUrl ?? "").trim() !== "") {
                            coverImage = variant.variantMedias[k].mediaUrl
                            break
                        }
                    }

                    if ((coverImage ?? "").trim() === "") {
                        coverImage = `${baseUrl}images/no-preview-available.jpg`
                    }

                    html += `<div class="card variant-card" id="variantSelection_${variant.variantId}">
                        <img src="${coverImage}" class="card-img-top variant-image" alt="${variant.name}">
                        <div class="mt-2">
                            <h6 class="card-title mb-1">${variant.name}</h6>
                            <p class="card-text text-muted mb-2">${price ? `$${price}` : "-"}</p>
                            <button class="btn btn-outline-primary btn-sm w-100" onclick="onSelectProductVariant(${variant.variantId})">Select</button>
                        </div>
                    </div>`
                }

                if (data?.length > 1) {
                    document.getElementById("selectionVariantsContainer").classList.remove("d-none")
                }

                document.getElementById("selectionVariants").innerHTML = html

                onSelectProductVariant(firstVariantId)
            }
        }
    })
}

function onSelectProductVariant(variantId) {
    const selectedVariant = variants.find((variant) => Number(variant.variantId) === Number(variantId))

    if (!selectedVariant) {
        return false
    }

    let htmlImagesSlider = []
    let firstImage = null

    for (let media of selectedVariant.variantMedias) {
        if (!firstImage) {
            firstImage = media
        }

        htmlImagesSlider.push(`<div class="inner-card">
            <img src="${media.mediaUrl}" alt="${selectedVariant.name}">
        </div>`)
    }

    $("#productCoverImage").attr("src", firstImage?.mediaUrl ?? `${baseUrl}images/no-preview-available.jpg`)

    reloadOwlCarousel($("#owl-example"), htmlImagesSlider)

    // Group attributes by attribute name
    const groupedAttributes = {};

    selectedVariant.variantAttributes.forEach((item) => {
        const attrName = item.attribute.name;
        if (!groupedAttributes[attrName]) {
            groupedAttributes[attrName] = [];
        }
        groupedAttributes[attrName].push(item);
    });

    // Create and inject HTML
    const mainDesc = document.querySelector('.main-desc');

    // Create container to insert after .main-desc
    const container = document.createElement('div');
    container.classList.add('attribute-options');

    Object.entries(groupedAttributes).forEach(([groupName, items]) => {
        const groupDiv = document.createElement('div');
        groupDiv.classList.add('attribute-group');
        groupDiv.classList.add('main-desc');
        groupDiv.classList.add('mt-2');
        groupDiv.classList.add('p-4');

        // Header
        const header = document.createElement('h5');
        header.textContent = groupName;
        groupDiv.appendChild(header);

        // Option cards
        const optionWrapper = document.createElement('div');
        optionWrapper.classList.add('option-wrapper');
        optionWrapper.style.display = 'flex';
        optionWrapper.style.flexWrap = 'wrap';
        optionWrapper.style.gap = '10px';

        items.forEach((item) => {
            const card = document.createElement('div');
            card.classList.add('option-card');
            card.style.border = '1px solid #ccc';
            card.style.borderRadius = '6px';
            card.style.padding = '8px 12px';
            card.style.cursor = 'pointer';
            card.style.userSelect = 'none';
            card.style.transition = 'all 0.3s';
            card.style.marginRight = '10px';
            card.style.minWidth = '100px';
            card.style.textAlign = 'center';

            // Value
            const valueEl = document.createElement('div');
            valueEl.textContent = item.value;
            valueEl.style.fontWeight = 'bold';

            // Additional price
            const priceEl = document.createElement('div');
            priceEl.textContent = item.additionalPrice && item.additionalPrice !== "0" ? `+ $${item.additionalPrice}` : '';
            priceEl.style.fontSize = '12px';
            priceEl.style.color = '#777';

            card.appendChild(valueEl);
            card.appendChild(priceEl);

            card.addEventListener('click', () => {
                optionWrapper.querySelectorAll('.option-card').forEach(el => el.classList.remove('selected'));
                card.classList.add('selected');
            });

            optionWrapper.appendChild(card);
        });

        groupDiv.appendChild(optionWrapper);
        container.appendChild(groupDiv);
    });

    // Insert container after .main-desc
    // mainDesc.parentNode.insertBefore(container, mainDesc.nextSibling);
    document.getElementById("attributesContainer").innerHTML = ""
    document.getElementById("attributesContainer").append(container)
}

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
