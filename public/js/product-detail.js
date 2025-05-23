let productId = null

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

                document.getElementById("section1Title").innerText = data.section1Title
                document.getElementById("section1Description").innerHTML = data.section1Description
                document.getElementById("section2Title").innerText = data.section2Title
                document.getElementById("section2Description").innerHTML = data.section2Description
                document.getElementById("section3Title").innerText = data.section3Title
                document.getElementById("section3Description").innerHTML = data.section3Description

                document.getElementById("nav-home").innerHTML = data.description
                document.getElementById("nav-profile").innerHTML = data.specification
            }
        }
    })
}