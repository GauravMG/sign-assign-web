// Get the current URL
const urlParams = new URLSearchParams(window.location.search);

const orderIdStr = urlParams.get("orderId");
const orderId = orderIdStr !== null ? Number(orderIdStr) : null;
localStorage.setItem("checkoutUpdateByAdminOrderId", orderIdStr)

const userToken = urlParams.get("userToken");
localStorage.setItem("jwtTokenUser", userToken)

fetchOrder()

let cart = JSON.parse(localStorage.getItem('cart')) || [];
let productData = []
let rushChargesData = []
let userDiscountPercentage = 0
let grandTotalPrice = 0
let amountDetails = {
    subTotalPrice: 0,
    businessDiscountPrice: 0,
    totalBulkOrderDiscount: 0,
    totalDiscount: 0,
    totalRushHourDeliveryAmount: 0,
    grandTotalPrice: 0,
    couponData: null
}
let amountDetailsOriginal = {
    subTotalPrice: 0,
    businessDiscountPrice: 0,
    totalBulkOrderDiscount: 0,
    totalDiscount: 0,
    totalRushHourDeliveryAmount: 0,
    grandTotalPrice: 0,
    couponData: null
}
let userAddresses = []
let businessClients = []
let selectedShippingAddressId = null
let selectedBusinessClientId = null
let selfData = null
let isGuestCheckout = false

getSelfData()
fetchProducts()
fetchRushCharges()

async function fetchOrder() {
    await postAPICall({
        endPoint: "/order/list",
        payload: JSON.stringify({
            "filter": {
                orderId: Number(orderId)
            },
            linkedEntities: true
        }),
        callbackSuccess: (response) => {
            const {
                success,
                message,
                data
            } = response

            if (success) {
                let order = data[0]
                console.log(`order ===`, order)

                let result = cart
                if (!cart?.length) {
                    result = order.orderProducts.filter(product => product.productId).map((product) => {
                        const d = product.dataJson;

                        return {
                            productId: product.productId,
                            selectedAttributes: d.selectedAttributes.map(attr => ({
                                productAttributeId: attr.productAttributeId,
                                attributeId: attr.attributeId,
                                productId: attr.productId,
                                value: attr.value,
                                mediaUrl: attr.mediaUrl,
                                additionalPrice: attr.additionalPrice,
                                status: attr.status,
                                createdAt: attr.createdAt,
                                updatedAt: attr.updatedAt,
                                deletedAt: attr.deletedAt,
                                createdById: attr.createdById,
                                updatedById: attr.updatedById,
                                deletedById: attr.deletedById,
                                attribute: attr.attribute
                            })),
                            productPrice: d.productPrice,
                            totalSelectedAttributePrice: d.totalSelectedAttributePrice,
                            totalDiscount: d.totalDiscount,
                            quantity: d.quantity,
                            payablePrice: d.payablePrice,
                            payablePriceByQuantity: d.payablePriceByQuantity,
                            payablePriceByQuantityAfterDiscount: d.payablePriceByQuantityAfterDiscount,
                            rushHourDelivery: d.rushHourDelivery,
                            rushHourDeliveryAmount: d.rushHourDeliveryAmount
                        };
                    });
                }

                cart = result
                localStorage.setItem("cart", result)

                order.amountDetails = typeof order.amountDetails === "string" ? JSON.parse(order.amountDetails) : order.amountDetails
                amountDetails = order.amountDetails
                amountDetailsOriginal = {
                    ...order.amountDetails
                }

                renderCartItems()
            }
        }
    })
}

async function getSelfData() {
    const isUserLoggedIn = checkIfUserLoggedIn()
    if (isUserLoggedIn) {
        selfData = await getMe()

        if (Number(selfData.roleId) === 2) {
            document.getElementById("promo-code-area").classList.remove("d-none")
        } else {
            document.getElementById("promo-code-area").classList.add("d-none")
        }

        userDiscountPercentage = selfData?.userDiscountPercentage ?? 0
        if (Number(userDiscountPercentage) > 0) {
            renderCartItems()
        }
    }
}

async function fetchProducts() {
    let productIds = cart.map((el) => Number(el.productId))

    await postAPICall({
        endPoint: "/product/list",
        payload: JSON.stringify({
            "filter": {
                productId: productIds
            },
            "range": {
                all: true
            },
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data: allData } = response

            if (success) {
                productData = allData

                renderCartItems()
            }
        }
    })
}

async function fetchRushCharges() {
    await postAPICall({
        endPoint: "/rush-hour-rate/list",
        payload: JSON.stringify({
            "range": {
                all: true
            }
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data: allData } = response

            if (success) {
                rushChargesData = allData

                renderCartItems()
            }
        }
    })
}

function renderCartItems() {
    localStorage.setItem('cart', JSON.stringify(cart));

    const container = document.getElementById("cartItemsContainer");
    container.innerHTML = "";

    let subTotalItemCount = 0
    let subTotalPrice = 0
    let totalBulkOrderDiscount = 0
    let totalRushHourDeliveryAmount = 0

    cart.forEach(cartItem => {
        const product = productData.find(p => p.productId === cartItem.productId);
        if (!product) return;

        let coverImage = null

        for (let k = 0; k < product?.productMedias?.length; k++) {
            if (product.productMedias[k].mediaType.indexOf("image") >= 0 && (product.productMedias[k].mediaUrl ?? "").trim() !== "") {
                coverImage = product.productMedias[k].mediaUrl
                break
            }
        }

        if ((coverImage ?? "").trim() === "") {
            coverImage = `${BASE_URL}images/no-preview-available.jpg`
        }

        const selectedAttrs = cartItem.selectedAttributes;

        // Dynamically create HTML for selected attributes
        const attributesHtml = selectedAttrs.map(attr => {
            let displayValue = attr.value;

            if (attr.attribute.type === "dimension") {
                try {
                    const val = JSON.parse(attr.value);
                    displayValue = `${val.width} X ${val.height} (FT)`;
                } catch (e) {
                    displayValue = attr.value;
                }
            }

            return `${attr.attribute.name}: <span>${displayValue}</span>`;
        }).join(" | ");

        let bulkDiscountHeaderInnerHtml = "<th>Qty:</th>"
        let bulkDiscountBodyInnerHtml = "<th>Discount:</th>"
        product.productBulkDiscounts?.forEach((productBulkDiscount) => {
            bulkDiscountHeaderInnerHtml += `<td>${productBulkDiscount.minQty}-${productBulkDiscount.maxQty}</td>`
            bulkDiscountBodyInnerHtml += `<td>${productBulkDiscount.discount}%</td>`
        })

        // let isRushHourRateAvailable = false
        // product.productRushHourRates?.forEach((productRushHourRate) => {
        //     if (Number(cartItem.quantity) >= Number(productRushHourRate.minQty) && Number(cartItem.quantity) <= Number(productRushHourRate.maxQty)) {
        //         isRushHourRateAvailable = true
        //     }
        // })

        let rushChargeAmount = 0;

        for (const rate of rushChargesData) {
            const inRange =
                Number(product.price) >= Number(rate.minPrice) &&
                (rate.maxPrice === null || Number(product.price) <= Number(rate.maxPrice));

            if (inRange) {
                rushChargeAmount =
                    rate.chargeType === 'flat'
                        ? Number(rate.amount)
                        : (Number(product.price) * Number(rate.amount)) / 100;

                break;
            }
        }

        rushChargeAmount = rushChargeAmount * cartItem.quantity;

        // Round to 2 decimals
        rushChargeAmount = Math.round(rushChargeAmount * 100) / 100;
        cartItem.rushHourDeliveryAmount = rushChargeAmount

        const itemHtml = `<div class="box-inner">
            ${rushChargesData?.length ? `<div class="rush-hour-area">
                <label class="switch">
                    <input type="checkbox" class="rush-hour-toggle" data-product-id="${product.productId}" ${cartItem.rushHourDelivery ? "checked" : ""}>
                    <span class="slider"></span>
                </label>
                <span>Rush Charges <span>($${rushChargeAmount} extra charges apply*)</span></span>
            </div>` : ""}
            <div class="inner">
                <div class="left-area">
                    <img alt="" src="${coverImage}" alt="${product.name}" style="cursor: pointer;" data-product-name="${product.name}" data-product-id="${product.productId}" onclick="redirectToProduct(this)">
                    <div>
                        <h5 data-product-name="${product.name}" style="cursor: pointer;" data-product-id="${product.productId}" onclick="redirectToProduct(this)">${product.name}</h5>
                        <p>${attributesHtml}</p>
                    </div>
                </div>
                <div class="right-area">
                    <div class="qty-counter">
                        <div class="left-area">
                            <div class="price-container">
                                ${cartItem.payablePriceByQuantity !== cartItem.payablePriceByQuantityAfterDiscount
                ? `<h6 class="original-price">$${cartItem.payablePriceByQuantity.toFixed(2)}</h6>`
                : ""}
                                <h4 class="final-price">$${cartItem.payablePriceByQuantityAfterDiscount.toFixed(2)}</h4>
                            </div>
                        </div>
                        <div class="right-area">
                            <span class="minus" onclick="changeQuantity(${product.productId}, 'remove')">
                                <i class="fa-solid fa-minus"></i>
                            </span>
                            <span>
                                <h6>${cartItem.quantity}</h6>
                            </span>
                            <span class="plus" onclick="changeQuantity(${product.productId}, 'add')">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                        </div>
                    </div>
                    <p>Estimate Delivery</p>
                    <h6>Web, June 15, 2025</h6>
                </div>
            </div>
            ${(product.productBulkDiscounts ?? []).length ? `<div class="bulk-qty-inner">
                <div class="left-area">
                    <p>Bulk Quantity Discount</p>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>${bulkDiscountHeaderInnerHtml}</tr>
                            <tr>${bulkDiscountBodyInnerHtml}</tr>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="right-area">
                    <a href="#"><span><i class="fa-regular fa-bookmark"></i></span>Save for later</a>
                </div> -->
            </div>` : ""}
        </div>`

        container.insertAdjacentHTML("beforeend", itemHtml);

        totalBulkOrderDiscount += Number(cartItem.bulkOrderDiscount ?? 0)
        subTotalItemCount += cartItem.quantity
        subTotalPrice += cartItem.payablePriceByQuantityAfterDiscount
        if (cartItem.rushHourDelivery) {
            totalRushHourDeliveryAmount += Number(rushChargeAmount)
        }
    })

    // Initialize rush charge toggles
    document.querySelectorAll('.rush-hour-toggle').forEach(toggle => {
        // Add event listener to each toggle
        toggle.addEventListener('change', function () {
            const productId = this.dataset.productId;
            const isRushHour = this.checked;

            // Store or process the rush charge selection for this product
            handleRushHourSelection(productId, isRushHour);
        });
    });

    document.getElementById("subTotalItemCount").innerText = `${subTotalItemCount} item${subTotalItemCount > 1 ? "s" : ""}`
    document.getElementById("subTotalPrice").innerText = subTotalPrice.toFixed(2)

    /**
     * 
     * handle business discount
     */
    let businessDiscountPrice = [3, 4].indexOf(Number(selfData.roleId)) >= 0 ? Math.round(((subTotalPrice * userDiscountPercentage) / 100) * 100) / 100 : 0
    if (Number(userDiscountPercentage) > 0 && [3, 4].indexOf(Number(selfData.roleId)) >= 0) {
        businessDiscountPrice = Math.round(((subTotalPrice * userDiscountPercentage) / 100) * 100) / 100
        document.getElementById("businessDiscountContainer").classList.remove("d-none")
        document.getElementById("businessDiscountPercentage").innerText = `${userDiscountPercentage}%`
        document.getElementById("businessDiscountPrice").innerText = `$${businessDiscountPrice}`
    }

    // document.getElementById("bulkOrderDiscountContainer").classList.remove("d-none")
    // document.getElementById("bulkOrderDiscountPrice").innerText = `$${totalBulkOrderDiscount}`

    /**
     * 
     * handle coupon discount
     */
    let couponDiscountPrice = 0;
    const couponData = amountDetails.couponData;
    if (couponData) {
        const discountType = couponData.discountType;
        const discountValue = Number(couponData.discount);

        if (discountType === "amount") {
            couponDiscountPrice = discountValue;
        } else if (discountType === "percentage") {
            couponDiscountPrice = (subTotalPrice * discountValue) / 100;
        }

        // Ensure discount is not negative
        if (couponDiscountPrice < 0) {
            couponDiscountPrice = 0;
        }

        // Cap discount so it does not exceed subtotal
        if (couponDiscountPrice > subTotalPrice) {
            couponDiscountPrice = subTotalPrice;
        }

        // Round to two decimal places
        couponDiscountPrice = Math.round(couponDiscountPrice * 100) / 100;

        document.getElementById("couponDiscountPrice").innerText = `$${couponDiscountPrice}${discountType === "amount" ? ` (flat)` : discountType === "percentage" ? ` (${discountValue}%)` : ""
            }`
    }

    /**
     * 
     * handle rush charges
     */
    document.getElementById("totalRushHourDeliveryAmount").innerText = `$${totalRushHourDeliveryAmount}`
    if (Number(totalRushHourDeliveryAmount) > 0) {
        document.getElementById("totalRushHourDeliveryContainer").classList.remove("d-none")
    } else {
        document.getElementById("totalRushHourDeliveryContainer").classList.add("d-none")
    }

    /**
     * 
     * total calcuations
     */
    let totalDiscount = 0
    let businessDiscountApplicable = false
    let couponDiscountApplicable = false

    if (businessDiscountPrice > couponDiscountPrice) {
        businessDiscountApplicable = true
        document.getElementById("businessDiscountContainer").classList.remove("discount-strikethrough")
        document.getElementById("couponDiscountContainer").classList.add("discount-strikethrough")
        totalDiscount = businessDiscountPrice
    }
    if (couponDiscountPrice > businessDiscountPrice) {
        couponDiscountApplicable = true
        document.getElementById("couponDiscountContainer").classList.remove("discount-strikethrough")
        document.getElementById("businessDiscountContainer").classList.add("discount-strikethrough")
        totalDiscount = couponDiscountPrice
    }
    grandTotalPrice = Math.round(((subTotalPrice - totalDiscount) + totalRushHourDeliveryAmount) * 100) / 100
    document.querySelectorAll(".grandTotalPrice").forEach(element => {
        element.textContent = grandTotalPrice;
    });

    amountDetails = {
        subTotalPrice,
        businessDiscountPrice: businessDiscountApplicable ? businessDiscountPrice : null,
        totalBulkOrderDiscount,
        totalDiscount,
        totalRushHourDeliveryAmount,
        grandTotalPrice,
        couponData: couponDiscountApplicable ? couponData : null
    }

    showUpdatedCartItemCount()
}

function redirectToProduct(element) {
    const productId = element.dataset.productId
    const productName = element.dataset.productName

    window.location.href = `/product/${getLinkFromName(productName)}?pid=${productId}`
}

function changeQuantity(productId, changeType) {
    cart = cart.map((cartItem) => {
        if (productId === cartItem.productId) {
            const product = productData.find(p => p.productId === cartItem.productId);
            if (!product) return cartItem;  // Return unchanged if product not found

            // Update quantity
            const newQuantity = changeType === "add"
                ? cartItem.quantity + 1
                : changeType === "remove"
                    ? cartItem.quantity - 1
                    : cartItem.quantity;

            // Remove item if quantity reaches 0
            if (newQuantity <= 0) {
                return null;
            }

            // Update quantity
            cartItem.quantity = newQuantity;

            // Calculate prices in cents to avoid floating point errors
            const priceInCents = Math.round(cartItem.payablePrice * 100);
            const quantity = cartItem.quantity;

            // Calculate total price (in cents)
            let totalPriceInCents = priceInCents * quantity;

            // Calculate discount (if any)
            const applicableBulkDiscount = product.productBulkDiscounts?.find(
                el => Number(el.minQty) <= quantity && Number(el.maxQty) >= quantity
            );

            let bulkOrderDiscountInCents = 0;

            if (applicableBulkDiscount) {
                // Calculate discount amount in cents
                bulkOrderDiscountInCents = Math.round((totalPriceInCents * applicableBulkDiscount.discount) / 100);
            }

            // cartItem.rushHourDeliveryAmount = 0
            // product.productRushHourRates?.forEach((productRushHourRate) => {
            //     if (Number(cartItem.quantity) >= Number(productRushHourRate.minQty) && Number(cartItem.quantity) <= Number(productRushHourRate.maxQty) && cartItem.rushHourDelivery) {
            //         cartItem.rushHourDeliveryAmount = Number(productRushHourRate.amount)
            //     }
            // })
            // if (cartItem.rushHourDeliveryAmount <= 0) {
            //     cartItem.rushHourDelivery = false
            // }

            if (cartItem.rushHourDelivery) {
                let rushChargeAmount = 0;

                for (const rate of rushChargesData) {
                    const inRange =
                        Number(product.price) >= Number(rate.minPrice) &&
                        (rate.maxPrice === null || Number(product.price) <= Number(rate.maxPrice));

                    if (inRange) {
                        rushChargeAmount =
                            rate.chargeType === 'flat'
                                ? Number(rate.amount)
                                : (Number(product.price) * Number(rate.amount)) / 100;

                        break;
                    }
                }

                rushChargeAmount = rushChargeAmount * cartItem.quantity;

                // Round to 2 decimals
                rushChargeAmount = Math.round(rushChargeAmount * 100) / 100;
                cartItem.rushHourDeliveryAmount = rushChargeAmount

            }

            // Update cart item prices (converting back to dollars)
            cartItem.bulkOrderDiscount = bulkOrderDiscountInCents / 100;
            cartItem.totalDiscount = cartItem.bulkOrderDiscount
            cartItem.payablePriceByQuantity = totalPriceInCents / 100;
            cartItem.payablePriceByQuantityAfterDiscount = (totalPriceInCents - bulkOrderDiscountInCents) / 100;
        }

        return { ...cartItem };
    }).filter(cartItem => cartItem !== null);

    fetchProducts();
}

// Function to handle rush charge selection
function handleRushHourSelection(productId, isSelected) {
    cart = cart.map((cartItem) => {
        if (Number(productId) === Number(cartItem.productId)) {
            cartItem.rushHourDelivery = isSelected;

            if (!isSelected) {
                cartItem.rushHourDeliveryAmount = 0
            } else {
                const product = productData.find(p => p.productId === cartItem.productId);
                // product.productRushHourRates?.forEach((productRushHourRate) => {
                //     if (Number(cartItem.quantity) >= Number(productRushHourRate.minQty) && Number(cartItem.quantity) <= Number(productRushHourRate.maxQty)) {
                //         cartItem.rushHourDeliveryAmount = Number(productRushHourRate.amount)
                //     }
                // })
                let rushChargeAmount = 0;

                for (const rate of rushChargesData) {
                    const inRange =
                        Number(product.price) >= Number(rate.minPrice) &&
                        (rate.maxPrice === null || Number(product.price) <= Number(rate.maxPrice));

                    if (inRange) {
                        rushChargeAmount =
                            rate.chargeType === 'flat'
                                ? Number(rate.amount)
                                : (Number(product.price) * Number(rate.amount)) / 100;

                        break;
                    }
                }

                rushChargeAmount = rushChargeAmount * cartItem.quantity;

                // Round to 2 decimals
                rushChargeAmount = Math.round(rushChargeAmount * 100) / 100;
                cartItem.rushHourDeliveryAmount = rushChargeAmount

            }
        }

        return { ...cartItem };
    })
    renderCartItems()
}

/**
 * 
 * handle coupon code
 */
async function applyCoupon() {
    const couponCode = document.getElementById("couponCode").value

    await postAPICall({
        endPoint: "/coupon/list",
        payload: JSON.stringify({
            "filter": {
                couponCode,
                userId: selfData?.userId ?? undefined
            },
            "range": {
                all: true
            },
            linkedEntities: true
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data } = response

            if (!success || !data?.length) {
                showAlert({
                    type: 'error',
                    title: 'Invalid Coupon',
                    text: 'The coupon code you entered is either invalid or has expired. Please check your code and try again.',
                    confirmText: 'OK'
                });
                return;
            }

            const couponData = {
                couponId: data[0].couponId,
                couponCode: data[0].couponCode,
                discountType: data[0].discountType,
                discount: data[0].discount,
                couponQuantityType: data[0].couponQuantityType,
                couponQuantity: data[0].couponQuantity,
                userId: data[0].userId,
                isAvailable: data[0].isAvailable
            }

            if (!couponData.isAvailable) {
                showAlert({
                    type: 'error',
                    title: 'Invalid Coupon',
                    text: 'The coupon code you entered is either invalid or has expired. Please check your code and try again.',
                    confirmText: 'OK'
                });
                return;
            }

            amountDetails = {
                ...amountDetails,
                couponData
            }

            document.getElementById("couponCode").value = ""
            document.getElementById("couponDiscountContainer").classList.remove("d-none")
            document.getElementById("couponDiscountPrice").innerText = ""
            document.getElementById("promo-code-area").classList.add("d-none")

            renderCartItems()
        }
    })
}

function removeCoupon() {
    amountDetails = {
        ...amountDetails,
        couponData: null
    }

    document.getElementById("couponDiscountContainer").classList.add("d-none")
    document.getElementById("couponDiscountPrice").innerText = ""
    document.getElementById("promo-code-area").classList.remove("d-none")

    renderCartItems()
}

/**
 * 
 * verify payment amount on update order
 */
async function verifyPaymentAmount() {
    const newPaymentAmountToPay = amountDetailsOriginal.grandTotalPrice < amountDetails.grandTotalPrice
        ? Math.round((amountDetails.grandTotalPrice - amountDetailsOriginal.grandTotalPrice) * 100) / 100
        : null;

    const newPaymentAmountToRefund = amountDetailsOriginal.grandTotalPrice > amountDetails.grandTotalPrice
        ? Math.round((amountDetailsOriginal.grandTotalPrice - amountDetails.grandTotalPrice) * 100) / 100
        : null;

    await postAPICall({
        endPoint: "/order/update-by-admin",
        payload: JSON.stringify({
            orderId: Number(orderId),
            amount: grandTotalPrice,
            cart,
            amountDetails,
            newPaymentAmountToPay,
            newPaymentAmountToRefund,
        }),
        callbackComplete: () => { },
        callbackSuccess: (response) => {
            const { success, message, data } = response

            if (success) {
                showAlert({
                    type: 'success',
                    title: 'Order updated!',
                    text: `Customer's order updated successfully.`,
                    confirmText: 'OK'
                });

                setTimeout(() => {
                    window.location.href = `/admin/orders/${orderId}`
                }, 1500)
            }
        }
    })
}
