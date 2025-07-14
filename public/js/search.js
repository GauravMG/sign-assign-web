let searchQuery = ""
const selectedAttributeFilters = {};
let selectedCategoryIds = [];

$(document).ready(function () {
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    searchQuery = getQueryParam('q');

    // Example: populate search results or fill back the input
    document.getElementById('navbar-search').value = searchQuery || '';

    fetchCategories()
    renderAttributeFilters()
    fetchProducts()
})

function onSelectProductCategory(categoryId) {
    const link = event.target;

    // Toggle active class
    link.classList.toggle("active");

    const idIndex = selectedCategoryIds.indexOf(categoryId);

    if (idIndex === -1) {
        selectedCategoryIds.push(categoryId);
    } else {
        selectedCategoryIds.splice(idIndex, 1);
    }

    fetchProducts()
}

async function fetchCategories() {
    await postAPICall({
        endPoint: "/product-category/list",
        payload: JSON.stringify({
            "filter": {
            },
            "range": {
                all: true
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
                let htmlFilterByCategories = ""

                for (let i = 0; i < data?.length; i++) {
                    htmlFilterByCategories += `<li style="cursor: pointer;">
                        <a onclick="onSelectProductCategory(${data[i].productCategoryId})">${data[i].name}</a>
                    </li>`
                }

                document.getElementById("filterByCategoriesContainer").innerHTML = htmlFilterByCategories
            }
        }
    })
}

async function fetchProducts() {
    await postAPICall({
        endPoint: "/product/list",
        payload: JSON.stringify({
            "filter": {
                search: searchQuery,
                productCategoryId: selectedCategoryIds?.length ? selectedCategoryIds.map((selectedCategoryId) => Number(selectedCategoryId)) : null,
                // productSubCategoryId: selectedSubCategoryIds?.length ? selectedSubCategoryIds.map((selectedSubCategoryId) => Number(selectedSubCategoryId)) : null,
                attributeFilters: selectedAttributeFilters
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
            const { success, message, data } = response

            if (!success || !data?.length) {
                document.getElementById("dataList").innerHTML = `
                    <div class="no-results d-flex flex-column justify-content-center align-items-center w-100 my-5">
                        <h4 class="text-muted mb-3">No Products Found</h4>
                        <p class="text-secondary text-center">Try adjusting your search or filter to find what you're looking for.</p>
                    </div>
                `
            }

            if (success && data?.length) {
                let html = []

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
                    if (productOfferPrice > 0 && productOfferPrice !== productRegularPrice) {
                        price = productOfferPrice
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

                document.getElementById("dataList").innerHTML = html.join("")
            }
        }
    })
}

async function renderAttributeFilters() {
    await postAPICall({
        endPoint: "/attribute/list",
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
        callbackSuccess: (response) => {
            const {
                success,
                message,
                data
            } = response

            if (success) {
                const container = document.getElementById('dynamicAttributeFilters');
                container.innerHTML = '';

                data.forEach(attr => {
                    if (attr.options) {
                        attr.options = typeof attr.options === "string" ? JSON.parse(attr.options) : attr.options
                    }

                    const wrapper = document.createElement('div');
                    wrapper.className = 'filters-inner';

                    let inputHTML = '';
                    switch (attr.type) {
                        case 'select':
                        case 'multi_select':
                        case 'checkbox':
                        case 'radio':
                            attr.options.forEach((opt) => {
                                inputHTML += `<li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(${attr.attributeId}, '${opt}')">${opt}</a>
                                </li>`
                            })
                            break

                        default:
                    }

                    if ((inputHTML ?? "").trim() !== "") {
                        wrapper.innerHTML = `
                            <div class="filter-dropdown-area">
                                <h6>${attr.name}</h6>
                                <span><i class="fa-solid fa-caret-down"></i></span>
                            </div>
                            <ul class="d-none d-block">${inputHTML}</ul>
                        `;

                        container.appendChild(wrapper);
                    }
                });

                bindFilterToggle();
            }
        }
    })
}

function bindFilterToggle() {
    document.querySelectorAll('.filter-dropdown-area').forEach(toggle => {
        toggle.addEventListener('click', function () {
            const content = this.nextElementSibling;
            const icon = this.querySelector('span svg'); // Make sure this is available

            if (content) {
                content.classList.toggle('d-none');
                content.classList.toggle('d-block');
            }

            if (icon) {
                icon.classList.toggle('fa-caret-down');
                icon.classList.toggle('fa-caret-up');
            } else {
                console.warn('Icon not found in:', this); // Debug log
            }
        });
    });
}

function onFilterAttribute(attributeId, value) {
    if (!selectedAttributeFilters[attributeId]) {
        selectedAttributeFilters[attributeId] = []
    }

    const link = event.target;

    // Toggle active class
    link.classList.toggle("active");

    const idIndex = selectedAttributeFilters[attributeId].indexOf(value);

    if (idIndex === -1) {
        selectedAttributeFilters[attributeId].push(value);
    } else {
        selectedAttributeFilters[attributeId].splice(idIndex, 1);
    }
    fetchProducts()
}

function onCheckboxFilter(attributeId, value, isChecked) {
    if (!selectedAttributeFilters[attributeId]) {
        selectedAttributeFilters[attributeId] = [];
    }

    const list = selectedAttributeFilters[attributeId];
    if (isChecked) {
        list.push(value);
    } else {
        const index = list.indexOf(value);
        if (index > -1) list.splice(index, 1);
    }

    fetchProducts();
}
