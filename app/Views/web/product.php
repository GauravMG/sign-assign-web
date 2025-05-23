<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/banner-detail-page.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- <div class="blog-area pt-5">
    <div class="container-fluid">
        <h6>The Ultimate Signage Guide</h6>
        <h3>Learning Center</h3>
        <div id="owl-example" class="owl-carousel owl-theme">
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h6>by signassi | Nov 11, 2024 | Signage</h6>
                    <h5>How Festive Thanksgiving Signage Can Enhance Your Business Atmo</h5>
                    <p>Thanksgiving is a cherished holiday in the U.S., full of warmth, gratitude, and togetherness.
                        For businesses, it’s the perfect season to create an...
                    </p>
                    <a href="#">Read More <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
                </div>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h6>by signassi | Nov 11, 2024 | Signage</h6>
                    <h5>How Festive Thanksgiving Signage Can Enhance Your Business Atmo</h5>
                    <p>Thanksgiving is a cherished holiday in the U.S., full of warmth, gratitude, and togetherness.
                        For businesses, it’s the perfect season to create an...
                    </p>
                    <a href="#">Read More <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
                </div>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h6>by signassi | Nov 11, 2024 | Signage</h6>
                    <h5>How Festive Thanksgiving Signage Can Enhance Your Business Atmo</h5>
                    <p>Thanksgiving is a cherished holiday in the U.S., full of warmth, gratitude, and togetherness.
                        For businesses, it’s the perfect season to create an...
                    </p>
                    <a href="#">Read More <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
                </div>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h6>by signassi | Nov 11, 2024 | Signage</h6>
                    <h5>How Festive Thanksgiving Signage Can Enhance Your Business Atmo</h5>
                    <p>Thanksgiving is a cherished holiday in the U.S., full of warmth, gratitude, and togetherness.
                        For businesses, it’s the perfect season to create an...
                    </p>
                    <a href="#">Read More <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
                </div>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h6>by signassi | Nov 11, 2024 | Signage</h6>
                    <h5>How Festive Thanksgiving Signage Can Enhance Your Business Atmo</h5>
                    <p>Thanksgiving is a cherished holiday in the U.S., full of warmth, gratitude, and togetherness.
                        For businesses, it’s the perfect season to create an...
                    </p>
                    <a href="#">Read More <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
                </div>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h6>by signassi | Nov 11, 2024 | Signage</h6>
                    <h5>How Festive Thanksgiving Signage Can Enhance Your Business Atmo</h5>
                    <p>Thanksgiving is a cherished holiday in the U.S., full of warmth, gratitude, and togetherness.
                        For businesses, it’s the perfect season to create an...
                    </p>
                    <a href="#">Read More <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
                </div>
            </div>
        </div>
        <div class="view-all-btn-area">
            <a href="#">View All <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
        </div>
    </div>
</div> -->

<div class="detail-page-area">
    <div class="container-fluid">
        <div class="detail-flex-inner">
            <div class="slider-area">
                <img src="<?= base_url('images/detail-page-slider.jpg') . '?t=' . time(); ?>" alt="">
                <div id="owl-example" class="owl-carousel owl-theme">
                    <div class="inner-card">
                        <img src="<?= base_url('images/detail-page-slider.jpg') . '?t=' . time(); ?>" alt="">
                    </div>
                    <div class="inner-card">
                        <img src="<?= base_url('images/detail-page-slider.jpg') . '?t=' . time(); ?>" alt="">
                    </div>
                    <div class="inner-card">
                        <img src="<?= base_url('images/detail-page-slider.jpg') . '?t=' . time(); ?>" alt="">
                    </div>
                    <div class="inner-card">
                        <img src="<?= base_url('images/detail-page-slider.jpg') . '?t=' . time(); ?>" alt="">
                    </div>
                    <div class="inner-card">
                        <img src="<?= base_url('images/detail-page-slider.jpg') . '?t=' . time(); ?>" alt="">
                    </div>
                    <div class="inner-card">
                        <img src="<?= base_url('images/detail-page-slider.jpg') . '?t=' . time(); ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="product-detail-area">
                <div class="main-desc">
                    <h4 id="productName"></h4>
                    <div id="shortDescription">
                    </div>
                    <div class="sku-details">
                        <div class="review-area">
                            <div class="rating-area">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                            </div>
                            <p>1565 Reviews</p>
                        </div>
                        <div>|</div>
                        <p>SKU: BBRM0B01</p>
                        <div>
                            <span><i class="fa-solid fa-share-nodes"></i></span>
                        </div>
                    </div>
                    <div class="change-address-area">
                        <p>
                            <span><i class="fa-solid fa-truck"></i></span> Priority Overnight by 10 Apr, Thursday |
                            30102, US | <a href="#">Change</a>
                        </p>
                    </div>
                </div>
                <div class="facility-grid mt-2">
                    <div class="facility-card">
                        <span>
                            <i class="fa-solid fa-truck-fast"></i>
                        </span>
                        <p>Free Shipping</p>
                    </div>
                    <div class="facility-card">
                        <span>
                            <i class="fa-solid fa-medal"></i>
                        </span>
                        <p>Premium Quality</p>
                    </div>
                    <div class="facility-card">
                        <span>
                            <i class="fa-solid fa-lightbulb"></i>
                        </span>
                        <p>Free Design Proof</p>
                    </div>
                    <!-- <div class="facility-card">
                        <span>
                            <i class="fa-solid fa-user-secret"></i>
                        </span>
                        <p>Hire a Designer</p>
                    </div> -->
                </div>
                <div class="accordion mt-2" id="accordionExample">
                    <div class="accordion-item mt-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="section1Title">
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" id="section1Description">
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mt-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" id="section2Title">
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" id="section2Description">
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mt-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" id="section3Title">
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body" id="section3Description">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="specification-area py-5">
    <div class="container-fluid">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                    Description
                </button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                    Product Specification
                </button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
                    FAQs
                </button>
                <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled"
                    type="button" role="tab" aria-controls="nav-disabled" aria-selected="false">
                    Customer Reviews
                </button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                tabindex="0">
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                tabindex="0">
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"
                tabindex="0">
                <div class="accordion" id="faqAccordion">
                </div>
            </div>
            <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab"
                tabindex="0">
                <p>
                    At Sign Assign, we redefine advertising prowess with our unparalleled range of custom banners,
                    providing a dynamic and
                    impactful solution to elevate your brand's visibility. Our vinyl banners stand as a testament to
                    our commitment to
                    quality, versatility, and visual excellence. Crafted with precision and vibrancy, our custom
                    banners serve as a powerful
                    marketing tool, captivating attention and communicating messages effectively. Each banner is a
                    testament to our
                    dedication to meeting your specific needs, be it for outdoor events, storefronts, trade shows,
                    or promotional displays.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="container-slide-area py-5">
    <div class="container-fluid">
        <div class="view-all-area">
            <div class="left">
                <h3 class="mb-0">Related Products</h3>
            </div>
            <div class="right">
                <div class="owl-nav">
                    <button type="button" role="presentation" class="owl-prev"><i
                            class="fa-solid fa-arrow-left-long"></i></button>
                    <button type="button" role="presentation" class="owl-next"><i
                            class="fa-solid fa-arrow-right-long"></i></button>
                </div>
            </div>
        </div>
        <div id="owl-example" class="owl-carousel owl-theme">
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h5>Vinyl Banner</h5>
                    <h6>Size (W X H): 4' x 8')</h6>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                    <h6>Starts at: <span class="text-green">$22.47</span></h6>
                </div>
                <a href="#">Customize</a>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h5>Vinyl Banner</h5>
                    <h6>Size (W X H): 4' x 8')</h6>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                    <h6>Starts at: <span class="text-green">$22.47</span></h6>
                </div>
                <a href="#">Customize</a>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h5>Vinyl Banner</h5>
                    <h6>Size (W X H): 4' x 8')</h6>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                    <h6>Starts at: <span class="text-green">$22.47</span></h6>
                </div>
                <a href="#">Customize</a>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h5>Vinyl Banner</h5>
                    <h6>Size (W X H): 4' x 8')</h6>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                    <h6>Starts at: <span class="text-green">$22.47</span></h6>
                </div>
                <a href="#">Customize</a>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h5>Vinyl Banner</h5>
                    <h6>Size (W X H): 4' x 8')</h6>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                    <h6>Starts at: <span class="text-green">$22.47</span></h6>
                </div>
                <a href="#">Customize</a>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h5>Vinyl Banner</h5>
                    <h6>Size (W X H): 4' x 8')</h6>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                    <h6>Starts at: <span class="text-green">$22.47</span></h6>
                </div>
                <a href="#">Customize</a>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h5>Vinyl Banner</h5>
                    <h6>Size (W X H): 4' x 8')</h6>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                    <h6>Starts at: <span class="text-green">$22.47</span></h6>
                </div>
                <a href="#">Customize</a>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h5>Vinyl Banner</h5>
                    <h6>Size (W X H): 4' x 8')</h6>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                    <h6>Starts at: <span class="text-green">$22.47</span></h6>
                </div>
                <a href="#">Customize</a>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h5>Vinyl Banner</h5>
                    <h6>Size (W X H): 4' x 8')</h6>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                    <h6>Starts at: <span class="text-green">$22.47</span></h6>
                </div>
                <a href="#">Customize</a>
            </div>
            <div class="inner-card">
                <div class="p-3 m-0">
                    <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                </div>
                <div class="px-3 mt-0">
                    <h5>Vinyl Banner</h5>
                    <h6>Size (W X H): 4' x 8')</h6>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                    <h6>Starts at: <span class="text-green">$22.47</span></h6>
                </div>
                <a href="#">Customize</a>
            </div>
        </div>
    </div>
</div>

<div class="fixed-cart">
    <div class="container-fluid">

    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script>
    const productName = '<?= $data['productName']; ?>'
</script>
<script src="<?= base_url('js/product-detail.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>