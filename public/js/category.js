let productCategoryId = null
const selectedAttributeFilters = {};
let selectedSubCategoryIds = [];

$(document).ready(function () {
    fetchCategoryDetails()
    renderAttributeFilters()
})

function onSelectProductSubCategory(subCategoryId) {
    const link = event.target;

    // Toggle active class
    link.classList.toggle("active");

    const idIndex = selectedSubCategoryIds.indexOf(subCategoryId);

    if (idIndex === -1) {
        selectedSubCategoryIds.push(subCategoryId);
    } else {
        selectedSubCategoryIds.splice(idIndex, 1);
    }

    console.log("Selected Category IDs:", selectedSubCategoryIds);
    fetchProducts()
}

async function fetchCategoryDetails() {
    await postAPICall({
        endPoint: "/product-category/list",
        payload: JSON.stringify({
            "filter": {
                name: categoryName
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

                productCategoryId = Number(el.productCategoryId)
                document.getElementById("categoryDescription").innerHTML = el.description

                fetchSubCategories()
                fetchProducts()
            }
        }
    })
}

async function fetchSubCategories() {
    await postAPICall({
        endPoint: "/product-subcategory/list",
        payload: JSON.stringify({
            "filter": {
                productCategoryId: Number(productCategoryId)
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
                let htmlSortBySubCategories = ""
                let htmlFilterBySubCategories = ""

                for (let i = 0; i < data?.length; i++) {
                    htmlSortBySubCategories += `<div class="option" data-value="#">${data[i].name}</div>`

                    htmlFilterBySubCategories += `<li style="cursor: pointer;">
                        <a onclick="onSelectProductSubCategory(${data[i].productSubCategoryId})">${data[i].name}</a>
                    </li>`
                }

                // document.getElementById("sortBySubCategoriesContainer").innerHTML = htmlSortBySubCategories
                document.getElementById("filterBySubCategoriesContainer").innerHTML = htmlFilterBySubCategories
            }
        }
    })
}

async function fetchProducts() {
    await postAPICall({
        endPoint: "/product/list",
        payload: JSON.stringify({
            "filter": {
                productCategoryId: Number(productCategoryId),
                productSubCategoryId: selectedSubCategoryIds?.length ? selectedSubCategoryIds.map((selectedSubCategoryId) => Number(selectedSubCategoryId)) : null,
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
                        // case 'text':
                        // case 'textarea':
                        //     inputHTML = `
                        //         <input type="text" name="${attr.attributeId}" placeholder="Enter ${attr.name}" 
                        //             oninput="onFilterAttribute('${attr.attributeId}', this.value)" />
                        //     `;
                        //     break;

                        // case 'number':
                        //     inputHTML = `
                        //         <input type="number" name="${attr.attributeId}" placeholder="Enter ${attr.name}" 
                        //             oninput="onFilterAttribute('${attr.attributeId}', this.value)" />
                        //     `;
                        //     break;

                        case 'select':
                            inputHTML = `
                                <select onchange="onFilterAttribute('${attr.attributeId}', this.value)">
                                    <option value="">Select ${attr.name}</option>
                                    ${attr.options.map(opt => `<option value="${opt}">${opt}</option>`).join('')}
                                </select>
                            `;
                            break;

                        case 'multi_select':
                        case 'checkbox':
                            inputHTML = attr.options.map(opt => `
                                <label>
                                    <input type="checkbox" 
                                        onchange="onCheckboxFilter('${attr.attributeId}', '${opt}', this.checked)" />
                                    ${opt}
                                </label>
                            `).join('<br>');
                            break;

                        case 'radio':
                            inputHTML = attr.options.map(opt => `
                                <label>
                                    <input type="radio" name="${attr.attributeId}" 
                                        value="${opt}" onchange="onFilterAttribute('${attr.attributeId}', '${opt}')" />
                                    ${opt}
                                </label>
                            `).join('<br>');
                            break;

                        default:
                        // inputHTML = `<p>Unsupported type: ${attr.type}</p>`;
                    }

                    if ((inputHTML ?? "").trim() !== "") {
                        wrapper.innerHTML = `
                            <div class="filter-dropdown-area">
                                <h6>${attr.name}</h6>
                                <span><i class="fa-solid fa-caret-down"></i></span>
                            </div>
                            <div class="attribute-input d-none">${inputHTML}</div>
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
    selectedAttributeFilters[attributeId] = value;
    fetchProducts();
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
