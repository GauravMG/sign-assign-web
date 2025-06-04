<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/checkout.css'). '?t=' . time(); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="checkout-page-area py-5">
    <div class="container-fluid">
        <h3>Your Cart</h3>
        <div class="two-col-layout">
            <div class="left-inner-area">
                <div class="shopping-cart-strip">
                    <h6>Shopping Cart <span>(04 Items)</span></h6>
                    <a href="#">Continue Shopping <span><i class="fa-solid fa-arrow-right"></i></span></a>
                </div>
                <div class="product-detail-area">
                    <div class="box-inner">
                        <div class="inner">
                            <div class="left-area"><img alt="" src="https://placehold.co/300x200">
                                <div>
                                    <h5>Custom Vinyl Banner</h5>
                                    <p>Size (W X H): <span>3' X 2'(FT)</span> | Choose Material:<span>Vinyl Print</span></p>
                                    <p>Sides: <span>Single Sided</span> | Upgrade to Premium:<span>Standard 13 Oz</span></p>
                                    <p>Hanging OPtions: <span>Metal Grommets</span></p>
                                </div>
                            </div>
                            <div class="right-area">
                                <div class="qty-counter">
                                    <div class="left-area">
                                        <h4>$2500.00</h4>
                                    </div>
                                    <div class="right-area">
                                        <span class="minus">
                                            <i class="fa-solid fa-minus"></i>
                                        </span>
                                        <span>
                                            <h6>02</h6>
                                        </span>
                                        <span class="plus">
                                            <i class="fa-solid fa-plus"></i>
                                        </span>
                                    </div>
                                </div>
                                <p>Estimate Delivery</p>
                                <h6>Web, June 15, 2025</h6>
                            </div>
                        </div>
                        <div class="bulk-qty-inner">
                            <div class="left-area">
                                <p>Bulk Quantity Discount</p>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Qty:</th>
                                            <td>2-10</td>
                                            <td>11-50</td>
                                            <td>51-100</td>
                                            <td>101-250</td>
                                            <td>251-500</td>
                                            <td>501-999</td>
                                        </tr>
                                        <tr>
                                            <th>Price:</th>
                                            <td>$10.50</td>
                                            <td>$10.00</td>
                                            <td>$9.50</td>
                                            <td>$9.00</td>
                                            <td>$8.00</td>
                                            <td>$7.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="right-area">
                                <a href="#"><span><i class="fa-regular fa-bookmark"></i></span>Save for later</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-inner-area">
                <div class="promo-code-area">
                    <input type="text" class="form-control" placeholder="Promocode">
                    <button type="button" class="">Apply</button>
                </div>
                <a href="#" class="coupon-link">View all coupons <span><i class="fa-solid fa-arrow-right"></i></span></a>
                <div class="order-summary-area">
                    <h6>Order Summary</h6>
                    <div class="visible-area">
                        <p>Estimate Shipping</p>
                        <span><i class="fa-solid fa-angle-down"></i></span>
                    </div>
                    <div class="hidden-area">
                        <div class="subtotal-area">
                            <div class="flex-value">
                                <p>Subtotal(50 items)</p>
                                <p>$5000.00</p>
                            </div>
                            <div class="flex-value">
                                <p>Super saver shipping</p>
                                <p>$0.00</p>
                            </div>
                            <h6>Estimated delivery Wed,</h6>
                            <h6>June 15, 2025</h6>
                        </div>
                        <div class="total-area">
                            <div class="flex-value">
                                <p>Grand Total</p>
                                <p>$5000.00</p>
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