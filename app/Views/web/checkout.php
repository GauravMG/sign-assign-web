<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/checkout.css') . '?t=' . time(); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="checkout-page-area py-5">
    <div class="container-fluid">
        <h3>Your Cart</h3>
        <div class="two-col-layout">
            <div class="left-inner-area">
                <div class="shopping-cart-strip">
                    <h6>Shopping Cart <span id="shoppingCartitemCount"></span></h6>
                    <a href="/">Continue Shopping <span><i class="fa-solid fa-arrow-right"></i></span></a>
                </div>
                <div class="product-detail-area" id="cartItemsContainer"></div>
            </div>
            <div class="right-inner-area">
                <div class="promo-code-area" id="promo-code-area">
                    <input type="text" class="form-control" id="couponCode" placeholder="Promocode">
                    <button type="button" class="" onclick="applyCoupon()">Apply</button>
                </div>
                <!-- <a href="#" class="coupon-link">View all coupons <span><i class="fa-solid fa-arrow-right"></i></span></a> -->
                <div class="order-summary-area">
                    <h6>Order Summary</h6>
                    <!-- <div class="visible-area">
                        <p>Estimate Shipping</p>
                        <span><i class="fa-solid fa-angle-down"></i></span>
                    </div> -->
                    <div class="hidden-area">
                        <div class="subtotal-area">
                            <div class="flex-value">
                                <p>Subtotal(<span id="subTotalItemCount"></span>)</p>
                                <p>$<span id="subTotalPrice"></span></p>
                            </div>
                            <!-- <div class="flex-value">
                                <p>Super saver shipping</p>
                                <p>$0.00</p>
                            </div> -->
                            <!-- <div class="flex-value mt-2 d-none" id="bulkOrderDiscountContainer">
                                <p>Bulk order discount</p>
                                <p><span id="bulkOrderDiscountPrice"></span>
                            </div> -->
                            <div class="flex-value mt-2 d-none" id="businessDiscountContainer">
                                <p>Business discount</p>
                                <p><span id="businessDiscountPrice"></span> (<span id="businessDiscountPercentage"></span>)</p>
                            </div>
                            <div class="flex-value mt-2 d-none" id="couponDiscountContainer">
                                <p>Coupon Discount</p>
                                <p><span id="couponDiscountPrice"></span></p>
                                <button id="removeCouponBtn" class="btn btn-sm btn-link text-danger p-0 ml-2" title="Remove Coupon" onclick="removeCoupon()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="flex-value mt-2 d-none" id="totalRushHourDeliveryContainer">
                                <p>Rush Charge</p>
                                <p><span id="totalRushHourDeliveryAmount"></span>
                            </div>
                            <h6 class="mt-3">Estimated delivery Wed, June 15, 2025</h6>
                        </div>
                        <div class="total-area">
                            <div class="flex-value">
                                <p>Grand Total</p>
                                <p>$<span class="grandTotalPrice"></span></p>
                            </div>
                        </div>
                    </div>
                    <a onclick="openShippingAddressModal()" class="checkout-button" style="cursor: pointer;">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shipping Selection Modal -->
<!-- <div id="shippingSelectionModal" class="shipping-modal">
    <div class="shipping-modal-content">
        <span class="shipping-modal-close" onclick="closeShippingModal()">&times;</span>

        <div id="shippingSelectionArea">
            <h4>Select Shipping Options</h4>

            <!-- Show only for business user --
            <div id="shippingSelectionBusinessContainer" class="d-none">
                <div class="form-group mb-3">
                    <label><input type="radio" name="orderType" value="self" checked onchange="toggleOrderType(this.value)"> Order for Myself</label>
                    <label><input type="radio" name="orderType" value="client" onchange="toggleOrderType(this.value)"> Order for Client</label>
                </div>

                <div id="clientSelectionArea" class="form-group mb-3 d-none">
                    <label for="clientSelect">Select Client:</label>
                    <select id="clientSelect" class="form-control" onchange="loadClientAddress(this.value)">
                        <option value="">-- Select Client --</option>
                    </select>
                </div>
            </div>

            <div id="addressSelectionArea" class="form-group mb-3">
                <label for="shippingAddress">Select Shipping Address:</label>
                <select id="shippingAddress" class="form-control">
                </select>
            </div>
        </div>

        <div class="text-end">
            <button class="btn btn-success" onclick="continueToPayment()">Continue to Payment</button>
        </div>
    </div>
</div> -->

<!-- Shipping Selection Modal -->
<div id="shippingSelectionModal" class="shipping-modal">
    <div class="shipping-modal-content">
        <span class="shipping-modal-close" onclick="closeShippingModal()">&times;</span>

        <div id="shippingSelectionArea">
            <h4 id="shippingAddressModalHeading">Select Shipping Options</h4>

            <!-- Guest Personal Info Section -->
            <div id="guestPersonalInfoContainer" class="mb-6 d-none">
                <h5>Personal Details</h5>
                <div class="row mt-2">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="guestFirstName" placeholder="First Name *" />
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="guestLastName" placeholder="Last Name *" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="email" class="form-control" id="guestEmail" placeholder="Email Address *" />
                    </div>
                    <div class="form-group col-md-6">
                        <input type="tel" class="form-control" id="guestMobile" placeholder="Cell Phone Number *" />
                    </div>
                </div>
                <hr />
            </div>

            <!-- Business user radio -->
            <div id="shippingSelectionBusinessContainer" class="d-none">
                <div class="form-group mb-3">
                    <label><input type="radio" name="orderType" value="self" checked onchange="toggleOrderType(this.value)"> Order for Myself</label>
                    <label><input type="radio" name="orderType" value="client" onchange="toggleOrderType(this.value)"> Order for Client</label>
                </div>

                <div id="clientSelectionArea" class="form-group mb-3 d-none">
                    <label for="clientSelect">Select Client:</label>
                    <select id="clientSelect" class="form-control" onchange="loadClientAddress(this.value)">
                        <option value="">-- Select Client --</option>
                    </select>
                </div>
            </div>

            <!-- Existing address selection -->
            <div id="addressSelectionArea" class="form-group mb-3">
                <label for="shippingAddress">Select Shipping Address:</label>
                <select id="shippingAddress" class="form-control">
                    <!-- dynamically filled -->
                </select>
            </div>

            <!-- Add New Address Section -->
            <div id="newAddressContainer" class="form-group mb-3">
                <h5 id="shippingAddressModalAddNewAddressHeading">Add New Shipping Address</h5>
                <div class="row mt-2">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control me-2" id="newFirstName" placeholder="First Name *" />
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="newLastName" placeholder="Last Name *" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="tel" class="form-control" id="newCellPhone" placeholder="Cell Phone Number *" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="newStreetAddress" placeholder="Street Address *" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="newCity" placeholder="City *" />
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="newState" placeholder="State *" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="newCountry" placeholder="Country *" />
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="newZipCode" placeholder="Zip/Postal Code *" />
                    </div>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button class="btn btn-success" onclick="continueToPayment()">Continue to Payment</button>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div id="cloverModal" class="clover-modal">
    <div class="clover-modal-content">
        <span class="close" onclick="closeCloverModal()">&times;</span>
        <h2>Payment Information</h2>

        <form id="cloverPaymentForm">
            <div class="clover-form-row">
                <div id="card-number" class="clover-field p-1"></div>
                <div id="card-number-error" class="clover-error"></div>
            </div>

            <div class="clover-form-row flex">
                <div style="flex: 1;">
                    <div id="card-date" class="clover-field p-1"></div>
                    <div id="card-date-error" class="clover-error"></div>
                </div>
                <div style="flex: 1;">
                    <div id="card-cvv" class="clover-field p-1"></div>
                    <div id="card-cvv-error" class="clover-error"></div>
                </div>
                <div style="flex: 1;">
                    <div id="card-postal-code" class="clover-field p-1"></div>
                    <div id="card-postal-code-error" class="clover-error"></div>
                </div>
            </div>

            <div class="clover-form-row">
                <button type="submit" id="submitButton" class="clover-button">Pay $<span class="grandTotalPrice"></span></button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= CLOVER_SDK_SCRIPT_PATH; ?>"></script>

<script>
    // Clover configuration
    const cloverConfig = {
        merchantId: '<?= CLOVER_MERCHANT_ID; ?>', // Replace with your merchant ID
        publicToken: '<?= CLOVER_PUBLIC_TOKEN; ?>', // Replace with your public token
        environment: '<?= CLOVER_ENVIRONMENT; ?>', // or 'production'
    };
</script>

<script src="<?= base_url('js/checkout.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>