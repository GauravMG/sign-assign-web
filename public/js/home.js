$(document).ready(function () {
    fetchCuratedBestsellers()
})

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
                        <a href="/subcategory/${getLinkFromName(data[i].name)}">
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
