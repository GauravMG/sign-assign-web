let cart = JSON.parse(localStorage.getItem('cart')) || [];
let productData = []
let userDiscountPercentage = 0
let grandTotalPrice = 0
let amountDetails = {
    subTotalPrice: 0,
    businessDiscountPrice: 0,
    totalBulkOrderDiscount: 0,
    totalDiscount: 0,
    totalRushHourDeliveryAmount: 0,
    grandTotalPrice: 0
}
let userAddresses = []
let businessClients = []
let selectedShippingAddressId = null
let selectedBusinessClientId = null

getSelfData()
fetchProducts()

async function getSelfData() {
    const isUserLoggedIn = checkIfUserLoggedIn()
    if (isUserLoggedIn) {
        selfData = await getMe()
        userDiscountPercentage = selfData?.userDiscountPercentage ?? 0
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

        let isRushHourRateAvailable = false
        product.productRushHourRates?.forEach((productRushHourRate) => {
            if (Number(cartItem.quantity) >= Number(productRushHourRate.minQty) && Number(cartItem.quantity) <= Number(productRushHourRate.maxQty)) {
                isRushHourRateAvailable = true
            }
        })

        const itemHtml = `<div class="box-inner">
            ${isRushHourRateAvailable ? `<div class="rush-hour-area">
                <label class="switch">
                    <input type="checkbox" class="rush-hour-toggle" data-product-id="${product.productId}" ${cartItem.rushHourDelivery ? "checked" : ""}>
                    <span class="slider"></span>
                </label>
                <span>Rush Charge <span>(${Number(cartItem.rushHourDeliveryAmount) > 0 ? `$${cartItem.rushHourDeliveryAmount} ` : ""}extra charges apply*)</span></span>
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
        totalRushHourDeliveryAmount += Number(cartItem.rushHourDeliveryAmount)
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

    let businessDiscountPrice = Math.round(((subTotalPrice * userDiscountPercentage) / 100) * 100) / 100
    document.getElementById("businessDiscountContainer").classList.remove("d-none")
    document.getElementById("businessDiscountPercentage").innerText = `${userDiscountPercentage}%`
    document.getElementById("businessDiscountPrice").innerText = `$${businessDiscountPrice}`

    // document.getElementById("bulkOrderDiscountContainer").classList.remove("d-none")
    // document.getElementById("bulkOrderDiscountPrice").innerText = `$${totalBulkOrderDiscount}`

    document.getElementById("totalRushHourDeliveryAmount").innerText = `$${totalRushHourDeliveryAmount}`
    if (Number(totalRushHourDeliveryAmount) > 0) {
        document.getElementById("totalRushHourDeliveryContainer").classList.remove("d-none")
    } else {
        document.getElementById("totalRushHourDeliveryContainer").classList.add("d-none")
    }

    const totalDiscount = businessDiscountPrice
    grandTotalPrice = Math.round(((subTotalPrice - totalDiscount) + totalRushHourDeliveryAmount) * 100) / 100
    document.querySelectorAll(".grandTotalPrice").forEach(element => {
        element.textContent = grandTotalPrice;
    });

    amountDetails = {
        subTotalPrice,
        businessDiscountPrice,
        totalBulkOrderDiscount,
        totalDiscount,
        totalRushHourDeliveryAmount,
        grandTotalPrice
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

            cartItem.rushHourDeliveryAmount = 0
            product.productRushHourRates?.forEach((productRushHourRate) => {
                if (Number(cartItem.quantity) >= Number(productRushHourRate.minQty) && Number(cartItem.quantity) <= Number(productRushHourRate.maxQty) && cartItem.rushHourDelivery) {
                    cartItem.rushHourDeliveryAmount = Number(productRushHourRate.amount)
                }
            })
            if (cartItem.rushHourDeliveryAmount <= 0) {
                cartItem.rushHourDelivery = false
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
                product.productRushHourRates?.forEach((productRushHourRate) => {
                    if (Number(cartItem.quantity) >= Number(productRushHourRate.minQty) && Number(cartItem.quantity) <= Number(productRushHourRate.maxQty)) {
                        cartItem.rushHourDeliveryAmount = Number(productRushHourRate.amount)
                    }
                })
            }
        }

        return { ...cartItem };
    })
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
            title: 'Login Required to Continue',
            text: 'To select a shipping address and proceed with your order, please log in to your account.',
            showCancel: true,
            confirmText: 'Login Now',
            cancelText: 'Go Back',
            onConfirm: () => $("#loginModal").modal("show"),
        });
        return;
    }

    resetShippingModalState(); // reset before showing
    document.getElementById('shippingSelectionModal').style.display = 'block';

    const selectedOrderType = document.querySelector('input[name="orderType"]:checked')?.value || 'self';
    await toggleOrderType(selectedOrderType);
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

function continueToPayment() {
    selectedShippingAddressId = document.getElementById("shippingAddress")?.value ?? null;

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
