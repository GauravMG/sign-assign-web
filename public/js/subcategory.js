let productSubCategoryId = null

$(document).ready(function () {
    fetchSubCategoryDetails()
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
                productSubCategoryId: Number(productSubCategoryId)
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
