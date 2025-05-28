let productSubCategoryId = null
const selectedAttributeFilters = {};

$(document).ready(function () {
    fetchSubCategoryDetails()
    renderAttributeFilters()
})

async function fetchSubCategoryDetails() {
    await postAPICall({
        endPoint: "/product-subcategory/list",
        payload: JSON.stringify({
            "filter": {
                name: subCategoryName
            },
            "range": {
                page: 1,
                pageSize: 1
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
                const [el] = data

                productSubCategoryId = Number(el.productSubCategoryId)
                document.getElementById("subCategoryDescription").innerHTML = el.description

                fetchProducts()
            }
        }
    })
}

async function fetchProducts() {
    await postAPICall({
        endPoint: "/product/list",
        payload: JSON.stringify({
            "filter": {
                productSubCategoryId: Number(productSubCategoryId),
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

            if (success) {
                let html = []

                for (let i = 0; i < data?.length; i++) {
                    let coverImage = null
                    let price = null

                    for (let j = 0; j < data[i].variants?.length; j++) {
                        if ((data[i].variants[j].price ?? "").toString() !== "") {
                            price = data[i].variants[j].price
                        }

                        for (let k = 0; k < data[i].variants[j]?.variantMedias?.length; k++) {
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
                        coverImage = `${baseUrl}images/no-preview-available.jpg`
                    }

                    html.push(`<div class="inner-card">
                        <a href="/product/${getLinkFromName(data[i].name)}">
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
                                <h6>Starts at: <span class="text-green">${price ? `$${price}` : "-"}</span></h6>
                            </div>
                            <a href="http://3.109.198.252/editor" target="_blank" class="customized-button">Customize</a>
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
