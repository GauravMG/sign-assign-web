$(document).ready(function () {
    if (document.getElementById("catContainer")) {
        fetchAllCategories()
    }
})

async function fetchAllCategories() {
    await postAPICall({
        endPoint: "/product-category/list",
        payload: JSON.stringify({
            "range": {
                page: 1,
                pageSize: 8
            },
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data } = response

            if (success) {
                let html = []

                for (let cat of data) {
                    html.push(`<div class="inner-card">
                        <div class="p-3 m-0"><img src="${cat.image}" alt="${cat.name}" class="w-100 rounded"></div>
                        <div class="px-3 mt-0">
                            <h5>${cat.name}</h5>
                            <p>${sliceTextWithEllipses(cat.shortDescription, 80)}</p>
                            <a href="/category/${getLinkFromName(cat.name)}?catid=${cat.productCategoryId}">View All Products <span><svg class="svg-inline--fa fa-arrow-right-long" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-right-long" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>`)
                }

                document.getElementById("catContainer").innerHTML = html.join("")
            }
        }
    })
}
