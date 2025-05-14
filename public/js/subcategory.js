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

                categoryId = el.productSubCategoryId
                document.getElementById("subCategoryDescription").innerHTML = el.description
            }
        }
    })
}
