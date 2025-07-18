const checkoutUpdateByAdminOrderId = localStorage.getItem("checkoutUpdateByAdminOrderId")
if (checkoutUpdateByAdminOrderId) {
    window.location.href = `/checkout-update?orderId=${checkoutUpdateByAdminOrderId}&userToken=${localStorage.getItem("jwtTokenUser")}`
}

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
let userAddresses = []
let businessClients = []
let selectedShippingAddressId = null
let selectedBusinessClientId = null
let selfData = null
let isGuestCheckout = false

getSelfData()
fetchProducts()
fetchRushCharges()

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
            ${cartItem.design?.previewUrl ? `
                <div class="mt-2">
                    <h5>Uploaded Design</h5>
                    <img class="mt-2" style="width: 150px; border: 1px solid;" src="${cartItem.design?.previewUrl}" alt="Design" />
                </div>
            ` : ""}
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

    document.getElementById("shoppingCartitemCount").innerText = `(${subTotalItemCount} Item${subTotalItemCount > 1 ? "s" : ""})`
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
 * shipping address 
 */
// Modal functions
async function openShippingAddressModal() {
    const isUserLoggedIn = checkIfUserLoggedIn();
    if (!isUserLoggedIn) {
        showAlert({
            type: 'info',
            title: 'Proceed to Checkout',
            text: 'To proceed, you can either log in for a faster experience and access to your account, or continue as a guest.',
            showCancel: true,
            confirmText: 'Login / Signup',
            cancelText: 'Continue as Guest',
            onConfirm: () => {
                $("#loginModal").modal("show");
            },
            onCancel: () => {
                // User chooses Guest Checkout
                proceedAsGuest();
            }
        });
        return;
    }

    proceedToShippingModal();
}

function proceedAsGuest() {
    isGuestCheckout = true;

    proceedToShippingModal();
}

// function proceedToShippingModal() {
//     resetShippingModalState(); // reset before showing
//     document.getElementById('shippingSelectionModal').style.display = 'block';

//     const selectedOrderType = document.querySelector('input[name="orderType"]:checked')?.value || 'self';
//     toggleOrderType(selectedOrderType);
// }
function proceedToShippingModal() {
    resetShippingModalState();

    if (isGuestCheckout) {
        document.getElementById('guestPersonalInfoContainer').classList.remove('d-none');
        document.getElementById("shippingAddressModalHeading").innerText = "Guest Checkout Details"
        document.getElementById("shippingAddressModalAddNewAddressHeading").innerText = "Shipping Address Details"
    } else {
        document.getElementById('guestPersonalInfoContainer').classList.add('d-none');
        document.getElementById("shippingAddressModalHeading").innerText = "Select Shipping Options"
        document.getElementById("shippingAddressModalAddNewAddressHeading").innerText = "Add New Shipping Address"
    }

    document.getElementById('shippingSelectionModal').style.display = 'block';

    const selectedOrderType = document.querySelector('input[name="orderType"]:checked')?.value || 'self';
    toggleOrderType(selectedOrderType);
}

function closeShippingModal() {
    document.getElementById('shippingSelectionModal').style.display = 'none';
    resetShippingModalState();
}

function resetShippingModalState() {
    // Hide all dynamic sections
    document.getElementById('shippingSelectionBusinessContainer')?.classList.add('d-none');
    document.getElementById('clientSelectionArea')?.classList.add('d-none');
    document.getElementById('addressSelectionArea')?.classList.remove('d-none'); // default visible for 'self'
    document.getElementById('newAddressForm')?.classList.add('d-none');

    // Clear dropdowns/HTML
    document.getElementById('clientSelect') && (document.getElementById('clientSelect').innerHTML = '');
    document.getElementById('addressSelectionArea') && (document.getElementById('addressSelectionArea').innerHTML = `
        <label for="shippingAddress">Select Shipping Address:</label>
        <select id="shippingAddress" class="form-control">
        </select>`);

    // Reset radio
    const orderTypeInputs = document.querySelectorAll('input[name="orderType"]');
    orderTypeInputs.forEach(input => {
        if (input.value === 'self') input.checked = true;
    });
}

// function continueToPayment() {
//     selectedShippingAddressId = document.getElementById("shippingAddress")?.value ?? null;

//     closeShippingModal();
//     openCloverModal(); // your existing Clover flow
// }
async function continueToPayment() {
    let tempUserIdUser = selfData?.userId ?? null

    // capture guest personal details if guest checkout
    if (isGuestCheckout) {
        const guestDetails = {
            firstName: document.getElementById('guestFirstName').value.trim(),
            lastName: document.getElementById('guestLastName').value.trim(),
            email: document.getElementById('guestEmail').value.trim(),
            mobile: document.getElementById('guestMobile').value.trim(),
            roleId: 2
        };

        await postAPICall({
            endPoint: "/user/create",
            payload: JSON.stringify(guestDetails),
            callbackComplete: () => { },
            callbackSuccess: async (response) => {
                const { success, message, data, jwtToken } = response

                if (success) {
                    localStorage.setItem("jwtTokenUser", jwtToken)
                    tempUserIdUser = data[0].userId
                    await continueToPaymentPart2(tempUserIdUser)
                }
            }
        })
    } else {
        await continueToPaymentPart2(tempUserIdUser)
    }
}

async function continueToPaymentPart2(tempUserIdUser) {
    if (document.getElementById('shippingAddress')?.value) {
        await continueToPaymentPart3()
    } else if (document.getElementById('newFirstName')?.value) {
        // always capture new address fields (even for logged-in users adding new address)
        const newAddress = {
            firstName: document.getElementById('newFirstName').value.trim(),
            lastName: document.getElementById('newLastName').value.trim(),
            phoneNumber: document.getElementById('newCellPhone').value.trim(),
            streetAddress: document.getElementById('newStreetAddress').value.trim(),
            postal: document.getElementById('newZipCode').value.trim(),
            city: document.getElementById('newCity').value.trim(),
            state: document.getElementById('newState').value.trim(),
            country: document.getElementById('newCountry').value.trim(),
            userId: tempUserIdUser
        };

        await postAPICall({
            endPoint: "/user-address/create",
            payload: JSON.stringify(newAddress),
            callbackComplete: () => { },
            callbackSuccess: async (response) => {
                const { success, message, data } = response

                if (success) {
                    newShippingAddressId = data[0].userAddressId
                    userAddresses = data

                    await continueToPaymentPart3(newShippingAddressId)
                }
            }
        })
    } else {
        showAlert({
            type: 'info',
            title: 'No shipping address selected!',
            text: 'Please select a shipping address or add a new shipping address.',
            confirmText: 'OK'
        });
    }
}

async function continueToPaymentPart3(newShippingAddressId = null) {
    // capture selected existing address if any
    selectedShippingAddressId = newShippingAddressId ?? document.getElementById('shippingAddress')?.value ?? null;

    closeShippingModal();
    openCloverModal(); // your existing Clover flow
}

window.addEventListener("click", function (event) {
    const modal = document.getElementById('shippingSelectionModal');
    if (event.target === modal) {
        closeShippingModal();
    }
});

async function toggleOrderType(value) {
    const clientArea = document.getElementById('clientSelectionArea');
    const addressArea = document.getElementById('addressSelectionArea');
    const businessContainer = document.getElementById('shippingSelectionBusinessContainer');
    const addressSelectContainer = document.getElementById('addressSelectionArea');

    // Clear address area before re-rendering
    addressArea.innerHTML = '';

    // Show business-specific container only if roleId is business
    const userDataUser = JSON.parse(localStorage.getItem("userDataUser") || "{}");
    const isBusinessUser = [3, 4].includes(Number(userDataUser.roleId));
    if (isBusinessUser) {
        businessContainer.classList.remove("d-none");
    } else {
        businessContainer.classList.add("d-none");
    }

    if (!isGuestCheckout) {
        if (value === 'self') {
            // Hide client-related fields
            clientArea.classList.add('d-none');
            addressArea.classList.remove('d-none');

            // Load user's own addresses
            if (!userAddresses || userAddresses.length === 0) {
                userAddresses = await fetchUserAddresses();
            }

            let html = `<label for="shippingAddress">Select Shipping Address:</label>`;
            html += `<select id="shippingAddress" class="form-control">`;
            for (const addr of userAddresses) {
                html += `<option value="${addr.userAddressId}">${createFullName(addr)} - ${formatAddress(addr)}</option>`;
            }
            html += `</select>`;

            addressArea.innerHTML = html;

        } else if (value === 'client') {
            // Show client dropdown, hide own address list
            clientArea.classList.remove('d-none');
            addressArea.classList.add('d-none');
            addressArea.innerHTML = '';

            if (!businessClients || businessClients.length === 0) {
                businessClients = await fetchBusinessClients();
            }

            let options = `<option value="">-- Select Client --</option>`;
            for (const client of businessClients) {
                options += `<option value="${client.businessClientId}">${createFullName(client)}</option>`;
            }

            document.getElementById('clientSelect').innerHTML = options;
        }
    }
}

function loadClientAddress(businessClientId) {
    if (!businessClientId) {
        document.getElementById('addressSelectionArea').classList.add('d-none');
        document.getElementById('addressSelectionArea').innerHTML = '';
        return;
    }

    const selectedClient = businessClients.find(client =>
        Number(client.businessClientId) === Number(businessClientId)
    );

    if (!selectedClient) return;

    selectedBusinessClientId = businessClientId

    document.getElementById('addressSelectionArea').innerHTML = `
        <div class="custom-shipping-alert">
            Shipping to: <strong>${formatAddress(selectedClient)}</strong>
        </div>
    `;
    document.getElementById('addressSelectionArea').classList.remove('d-none');
}

/**
 * 
 * clover payment gateway
 */
// Clover elements
let clover;
let cardNumber;
let cardDate;
let cardCvv;
let cardPostalCode;

// Initialize Clover when modal opens
function initializeClover() {
    // Load Clover SDK if not already loaded
    if (typeof Clover === 'undefined') {
        console.error('Clover SDK not loaded');
        return;
    }

    // Initialize Clover instance
    clover = new Clover(cloverConfig.publicToken, {
        merchantId: cloverConfig.merchantId
    });

    // Create card elements
    const elements = clover.elements();
    cardNumber = elements.create('CARD_NUMBER');
    cardDate = elements.create('CARD_DATE');
    cardCvv = elements.create('CARD_CVV');
    cardPostalCode = elements.create('CARD_POSTAL_CODE');

    // Mount elements to DOM
    cardNumber.mount('#card-number');
    cardDate.mount('#card-date');
    cardCvv.mount('#card-cvv');
    cardPostalCode.mount('#card-postal-code');

    // Add event listeners for validation
    cardNumber.addEventListener('change', (event) => handleElementChange(event, 'card-number'));
    cardDate.addEventListener('change', (event) => handleElementChange(event, 'card-date'));
    cardCvv.addEventListener('change', (event) => handleElementChange(event, 'card-cvv'));
    cardPostalCode.addEventListener('change', (event) => handleElementChange(event, 'card-postal-code'));
}

// Handle element change events
function handleElementChange(event, elementId) {
    const errorElement = document.getElementById(`${elementId}-error`);
    if (event.error) {
        errorElement.textContent = event.error.message;
    } else {
        errorElement.textContent = '';
    }
}

// Modal functions
function openCloverModal() {
    document.getElementById('shippingSelectionModal').style.display = 'none';

    document.getElementById('cloverModal').style.display = 'block';
    initializeClover();
}

function closeCloverModal() {
    const cloverModal = document.getElementById('cloverModal');
    cloverModal.style.display = 'none';

    // Optional: Clear Clover field containers if you're reinitializing later
    document.getElementById('card-number').innerHTML = '';
    document.getElementById('card-date').innerHTML = '';
    document.getElementById('card-cvv').innerHTML = '';
    document.getElementById('card-postal-code').innerHTML = '';

    // Also clear any error messages
    document.querySelectorAll('.clover-error').forEach(el => el.textContent = '');

    // Optional: Reset form (if needed)
    document.getElementById('cloverPaymentForm').reset();

    // Optional: Re-enable the button in case it was disabled
    document.getElementById('submitButton').disabled = false;
}

// Form submission
document.getElementById('cloverPaymentForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const submitButton = document.getElementById('submitButton');
    submitButton.disabled = true;
    submitButton.textContent = 'Processing...';

    try {
        // Create payment token
        const { token, errors } = await clover.createToken();

        if (errors) {
            // Display errors to user
            Object.keys(errors).forEach(key => {
                const errorElement = document.getElementById(`${key.toLowerCase().replace('_', '-')}-error`);
                if (errorElement) {
                    errorElement.textContent = errors[key];
                }
            });
            return;
        }

        // Call your backend to process the payment
        await new Promise((resolve, reject) => {
            postAPICall({
                endPoint: "/payment/create",
                payload: JSON.stringify({
                    sourceToken: token,
                    amount: grandTotalPrice,
                    cart,
                    amountDetails,
                    shippingAddressId: selectedShippingAddressId ? Number(selectedShippingAddressId) : null,
                    shippingAddressDetails: selectedBusinessClientId ? businessClients.find((businessClient) => Number(businessClient.businessClientId) === Number(selectedBusinessClientId)) : userAddresses.find((userAddress) => Number(userAddress.userAddressId) === Number(selectedShippingAddressId)),
                    businessClientId: selectedBusinessClientId ? Number(selectedBusinessClientId) : null
                }),
                callbackComplete: () => { },
                callbackSuccess: (response) => {
                    const { success, message, data } = response

                    if (success) {
                        // Payment successful
                        showAlert({
                            type: 'success',
                            title: 'Payment Successful',
                            text: 'Thank you for your purchase! Your order has been placed and a confirmation has been sent to your email.',
                            confirmText: 'OK',
                            onConfirm: () => {
                                // Optional: redirect to orders page or homepage
                                window.location.href = `${BASE_URL_USER_DASHBOARD}/orders`;
                            }
                        });

                        if (isGuestCheckout) {
                            localStorage.removeItem("jwtTokenUser")
                        }

                        closeCloverModal();
                        clearCart()
                        // Redirect or update UI as needed
                        resolve()
                    } else {
                        // Payment failed
                        reject(new Error(message))

                    }
                },
                callbackError: (errorMessage) => {
                    reject(new Error(errorMessage))
                }
            })
        })
    } catch (error) {
        console.error('Payment error:', error);
        showAlert({
            type: 'error',
            title: 'Payment Failed',
            text: 'Unfortunately, your payment could not be processed. Please try again or use a different payment method.',
            confirmText: 'Try Again',
            onConfirm: () => {
                window.location.href = '/checkout';
            }
        });

        submitButton.disabled = false;
        submitButton.textContent = `Pay $${grandTotalPrice}`;
    }
});

// Close modal when clicking outside
window.onclick = function (event) {
    const modal = document.getElementById('cloverModal');
    if (event.target === modal) {
        closeCloverModal();
    }
}

function clearCart() {
    localStorage.setItem('cart', JSON.stringify([]));
    window.location.href = `${BASE_URL_USER_DASHBOARD}`
}
