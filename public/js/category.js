$(document).ready(function () {
    fetchCategoryDetails()
})

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

                categoryId = el.productCategoryId
                document.getElementById("categoryDescription").innerHTML = el.description

                fetchSubCategories()
            }
        }
    })
}

async function fetchSubCategories() {
    await postAPICall({
        endPoint: "/product-subcategory/list",
        payload: JSON.stringify({
            "filter": {
                productCategoryId: categoryId
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

                    htmlFilterBySubCategories += `<li>
                        <a href="#" class="active">${data[i].name}</a>
                    </li>`
                }

                document.getElementById("sortBySubCategoriesContainer").innerHTML = htmlSortBySubCategories
                document.getElementById("filterBySubCategoriesContainer").innerHTML = htmlFilterBySubCategories
            }
        }
    })
}
