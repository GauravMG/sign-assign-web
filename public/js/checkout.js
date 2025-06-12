let cart = JSON.parse(localStorage.getItem('cart')) || [];
let productData = []
let userDiscountPercentage = 0
let grandTotalPrice = 0
let amountDetails = {
    subTotalPrice: 0,
    businessDiscountPrice: 0,
    grandTotalPrice: 0
}

getSelfData()
fetchProducts()

async function getSelfData() {
    const isUserLoggedIn = checkIfUserLoggedIn()
    if (isUserLoggedIn) {
        selfData = await getMe()
        userDiscountPercentage = selfData?.userDiscountPercentage ?? 0

        if (userDiscountPercentage > 0) {
            document.getElementById("businessDiscountContainer").classList.remove("d-none")
            document.getElementById("businessDiscountPercentage").innerText = `${userDiscountPercentage}%`
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

function renderCartItems() {
    localStorage.setItem('cart', JSON.stringify(cart));

    const container = document.getElementById("cartItemsContainer");
    container.innerHTML = "";

    let subTotalItemCount = 0
    let subTotalPrice = 0

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

        const itemHtml = `<div class="box-inner">
            <div class="rush-hour-area">
                <label class="switch">
                    <input type="checkbox" class="rush-hour-toggle" data-product-id="${product.productId}" ${cartItem.rushHourDelivery ? "checked" : ""}>
                    <span class="slider"></span>
                </label>
                <span>Rush Hour Delivery <span>(extra charges apply*)</span></span>
            </div>
            <div class="inner">
                <div class="left-area">
                    <img alt="" src="${coverImage}" alt="${product.name}">
                    <div>
                        <h5>${product.name}</h5>
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

        subTotalItemCount += cartItem.quantity
        subTotalPrice += cartItem.payablePriceByQuantityAfterDiscount
    })

    document.getElementById("shoppingCartitemCount").innerText = `(${subTotalItemCount} Item${subTotalItemCount > 1 ? "s" : ""})`
    document.getElementById("subTotalItemCount").innerText = `${subTotalItemCount} item${subTotalItemCount > 1 ? "s" : ""}`
    document.getElementById("subTotalPrice").innerText = subTotalPrice

    let businessDiscountPrice = Math.round(((subTotalPrice * userDiscountPercentage) / 100) * 100) / 100
    document.getElementById("businessDiscountPrice").innerText = `$${businessDiscountPrice}`

    grandTotalPrice = Math.round((subTotalPrice - businessDiscountPrice) * 100) / 100
    document.querySelectorAll(".grandTotalPrice").forEach(element => {
        element.textContent = grandTotalPrice;
    });

    amountDetails = {
        subTotalPrice,
        businessDiscountPrice,
        grandTotalPrice
    }

    showUpdatedCartItemCount()
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

            let discountInCents = 0;

            if (applicableBulkDiscount) {
                // Calculate discount amount in cents
                discountInCents = Math.round((totalPriceInCents * applicableBulkDiscount.discount) / 100);
            }

            // Update cart item prices (converting back to dollars)
            cartItem.totalDiscount = discountInCents / 100;
            cartItem.payablePriceByQuantity = totalPriceInCents / 100;
            cartItem.payablePriceByQuantityAfterDiscount = (totalPriceInCents - discountInCents) / 100;
        }

        return { ...cartItem };
    }).filter(cartItem => cartItem !== null);

    fetchProducts();
}

// Initialize rush hour toggles
document.querySelectorAll('.rush-hour-toggle').forEach(toggle => {
    // Add event listener to each toggle
    toggle.addEventListener('change', function () {
        const productId = this.dataset.productId;
        const isRushHour = this.checked;

        // Store or process the rush hour selection for this product
        handleRushHourSelection(productId, isRushHour);
    });
});

// Function to handle rush hour selection
function handleRushHourSelection(productId, isSelected) {
    // Here you can:
    // 1. Update your cart data structure
    // 2. Recalculate prices
    // 3. Update UI

    // Example: Update a cart object
    const cartItem = cart.find(item => item.productId === productId);
    if (cartItem) {
        cartItem.rushHourDelivery = isSelected;
        calculatePayablePrice(); // Recalculate prices
    }
}

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
    const isUserLoggedIn = checkIfUserLoggedIn()
    if (!isUserLoggedIn) {
        alert('Please login to complete your purchase!');
        $("#loginModal").modal("show");
        return
    }

    document.getElementById('cloverModal').style.display = 'block';
    initializeClover();
}

function closeCloverModal() {
    document.getElementById('cloverModal').style.display = 'none';
    // Clean up Clover elements if needed
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
        try {
            await postAPICall({
                endPoint: "/payment/create",
                payload: JSON.stringify({
                    sourceToken: token,
                    amount: grandTotalPrice,
                    cart,
                    amountDetails
                }),
                callbackComplete: () => { },
                callbackSuccess: (response) => {
                    const { success, message, data } = response

                    if (success) {
                        // Payment successful
                        alert('Payment successful!');
                        closeCloverModal();
                        clearCart()
                        // Redirect or update UI as needed
                    } else {
                        // Payment failed
                        alert(`Payment failed: ${message}`);
                    }
                }
            })
        } catch (error) {
            console.error('API call failed:', error);
            return {
                success: false,
                error: 'Network error'
            };
        }
    } catch (error) {
        console.error('Payment error:', error);
        alert('An error occurred during payment processing.');
    } finally {
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
