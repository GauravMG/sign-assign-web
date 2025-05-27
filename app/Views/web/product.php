<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/banner-detail-page.css'); ?>">

<style>
    .customer-review-image {
        width: 70px;
        height: 70px;
    }

    .variant-card {
        min-width: 120px;
        padding: 5px;
    }

    .variant-image {
        width: 120px;
        height: 60px;
        object-fit: fill;
    }

    .detail-page-area .owl-carousel .inner-card img {
        width: 120px;
        height: 100px;
    }
</style>
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
                <img id="productCoverImage" src="" alt="">
                <div id="owl-example" class="owl-carousel owl-theme">
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
                    <div class="accordion-item mt-2 d-none" id="accordionSection1Container">
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
                    <div class="accordion-item mt-2 d-none" id="accordionSection2Container">
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
                    <div class="accordion-item mt-2 d-none" id="accordionSection3Container">
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
                <!-- <div class="main-desc mt-2">
                    <h5 class="mb-3">Choose a Variant:</h5>
                    <div class="btn-group" role="group" aria-label="Product Variants">
                        <input type="radio" class="btn-check" name="variant" id="variant1" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="variant1">Standard Vinyl</label>

                        <input type="radio" class="btn-check" name="variant" id="variant2" autocomplete="off">
                        <label class="btn btn-outline-primary" for="variant2">Premium Matte</label>

                        <input type="radio" class="btn-check" name="variant" id="variant3" autocomplete="off">
                        <label class="btn btn-outline-primary" for="variant3">Mesh Banner</label>
                    </div>
                </div> -->
                <div class="main-desc mt-2 p-4 d-none" id="selectionVariantsContainer">
                    <h5 class="mb-3">Choose a Variant:</h5>
                    <div class="d-flex overflow-auto flex-nowrap gap-3 pb-2" id="selectionVariants">
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
                tabindex="0" id="customerReviewsContainer">
                <div class="d-flex mb-4">
                    <img src="https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png" class="rounded-circle me-3 customer-review-image" alt="John Doe">
                    <div>
                        <h6 class="mb-1">Melissa R., <small class="text-muted">Event Coordinator</small></h6>
                        <div class="text-warning mb-2" style="font-size: 1rem;">
                            ★★★★★
                        </div>
                        <strong>"Great Quality and Super Fast Turnaround!"</strong>
                        <p class="mb-0 mt-2">
                            We needed a large outdoor banner for a charity fundraiser and SignAssign delivered beyond expectations.
                            The colors were vibrant, the material felt sturdy, and it withstood wind and light rain without any issues.
                            The order process was easy, and it arrived two days ahead of schedule. Will definitely be ordering again!
                        </p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <img src="https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png" class="rounded-circle me-3 customer-review-image" alt="Sarah Lee">
                    <div>
                        <h6 class="mb-1">Jason T., <small class="text-muted">Small Business Owner</small></h6>
                        <div class="text-warning mb-2" style="font-size: 1rem;">
                            ★★★★★
                        </div>
                        <strong>"Exactly What We Needed for Our Grand Opening"</strong>
                        <p class="mb-0 mt-2">
                            I ordered a vinyl banner to hang outside my new café, and it came out perfect. The print was sharp and eye-catching,
                            and the grommets made installation a breeze. The team was responsive and helped me size the design just right.
                            Couldn’t be happier with the result!
                        </p>
                    </div>
                </div>
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