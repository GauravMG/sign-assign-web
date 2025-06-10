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
                <!-- <div class="promo-code-area">
                    <input type="text" class="form-control" placeholder="Promocode">
                    <button type="button" class="">Apply</button>
                </div>
                <a href="#" class="coupon-link">View all coupons <span><i class="fa-solid fa-arrow-right"></i></span></a> -->
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
                            <div class="flex-value d-none" id="businessDiscountContainer">
                                <p>Business discount</p>
                                <p><span id="businessDiscountPrice"></span> (<span id="businessDiscountPercentage"></span>)</p>
                            </div>
                            <h6>Estimated delivery Wed,</h6>
                            <h6>June 15, 2025</h6>
                        </div>
                        <div class="total-area">
                            <div class="flex-value">
                                <p>Grand Total</p>
                                <p>$<span id="grandTotalPrice"></span></p>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="checkout-button">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('js/checkout.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>