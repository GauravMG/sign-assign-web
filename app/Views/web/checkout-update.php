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
                <div class="product-detail-area" id="cartItemsContainer"></div>
            </div>
            <div class="right-inner-area">
                <div class="promo-code-area d-none" id="promo-code-area">
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
                    <a onclick="verifyPaymentAmount()" class="checkout-button" style="cursor: pointer;">Update Order</a>
                </div>
            </div>
        </div>
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

<script src="<?= base_url('js/checkout-update.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>