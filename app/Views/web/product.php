<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
<link rel="stylesheet" href="<?= base_url('css/banner-detail-page.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="detail-page-area">
    <div class="container-fluid">
        <div class="detail-flex-inner">
            <div class="slider-area">
                <a data-fancybox="gallery" id="coverImageLink">
                    <img id="productCoverImage" src="" alt="">
                </a>
                <div id="owl-example" class="owl-carousel owl-theme">
                </div>
            </div>
            <div class="product-detail-area">
                <div class="main-desc">
                    <h4 id="productName"></h4>
                    <div id="shortDescription">
                    </div>
                    <div class="price-area my-2">
                        <h5 class="text-success">
                            <span class="price-strikethrough" id="productPriceStriked"></span>$ <span id="productPrice"></span>
                        </h5>
                    </div>
                    <div class="sku-details">
                        <!-- <div class="review-area">
                            <div class="rating-area">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                            </div>
                            <p>1565 Reviews</p>
                        </div>
                        <div>|</div> -->
                        <p>SKU: <span id="productSku"></span></p>
                        <!-- <div>
                            <span><i class="fa-solid fa-share-nodes"></i></span>
                        </div> -->
                    </div>
                    <div class="change-address-area">
                        <p>
                            <span><i class="fa-solid fa-truck"></i></span> Priority Overnight by 10 Apr, Thursday |
                            30102, US | <a href="#">Change</a>
                        </p>
                    </div>
                </div>
                <div id="attributesContainer"></div>
                <div class="add-to-cart-area mt-2" data-product-id="123">
                    <div class="flex-area" id="cart-controls">
                        <a onclick="addToCart()" class="add-to-card-button" style="cursor: pointer;" id="add-to-cart-button">
                            <span><i class="fa-solid fa-cart-plus"></i></span>
                            Add to cart ($<span id="payablePrice"></span>)
                        </a>
                        <a class="add-to-card-button quantity-button" style="display: none;" id="quantity-controls">
                            <span onclick="updateQuantity(-1)" class="qty-btn">−</span>
                            <span id="cart-quantity" class="qty-number">1</span>
                            <span onclick="updateQuantity(1)" class="qty-btn">+</span>
                            <span>($<span id="payablePriceSmall"></span>)</span>
                        </a>
                        <a href="javascript:void(0);" id="select-design-method" class="select-design-method justify-content-center d-none" data-bs-toggle="modal" data-bs-target="#designMethodModal">
                            <span style="margin-right: 5px;"><i class="fa-solid fa-palette"></i></span>
                            Select&nbsp;Design&nbsp;Method
                        </a>
                        <a href="/checkout" class="go-to-card-button justify-content-center d-flex">
                            <span style="margin-right: 5px;"><i class="fa-solid fa-cart-plus"></i></span>
                            Go&nbsp;to&nbsp;cart
                        </a>
                    </div>
                </div>
                <!-- <div class="facility-grid mt-2">
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
                    !-- <div class="facility-card">
                        <span>
                            <i class="fa-solid fa-user-secret"></i>
                        </span>
                        <p>Hire a Designer</p>
                    </div> --
                </div> -->
                <div class="accordion mt-2 d-none" id="accordionBulkDiscountContainer">
                    <div class="accordion-item mt-2" id="bulkDiscountContainer">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOneBulkDiscount" aria-expanded="true"
                                aria-controls="collapseOneBulkDiscount">
                                <i class="bi bi-tags-fill me-2"></i> Bulk Purchase Discounts
                            </button>
                        </h2>
                        <div id="collapseOneBulkDiscount" class="accordion-collapse collapse show"
                            data-bs-parent="#accordionBulkDiscountContainer">
                            <div class="accordion-body">
                                <div class="table-responsive">
                                    <table class="table align-middle table-bordered table-hover mb-0 shadow-sm rounded">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th scope="col">📦 Quantity Range</th>
                                                <th scope="col">💸 Discount Offered</th>
                                                <!-- <th scope="col">🔍 Effective Price Info</th> -->
                                            </tr>
                                        </thead>
                                        <tbody class="text-center" id="dtBulkDiscountList">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="accordion mt-2" id="accordionExample">
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
                </div> -->
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
                <!-- <div class="main-desc mt-2 p-4 d-none" id="selectionVariantsContainer">
                    <h5 class="mb-3">Choose a Variant:</h5>
                    <div class="d-flex overflow-auto flex-nowrap gap-3 pb-2" id="selectionVariants">
                    </div>
                </div> -->
                <div id="attributes"></div>

            </div>
        </div>
    </div>
</div>

<div class="specification-area py-5">
    <div class="container-fluid">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-features-tab" data-bs-toggle="tab" data-bs-target="#nav-features"
                    type="button" role="tab" aria-controls="nav-features" aria-selected="true">
                    Key Features
                </button>
                <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="false">
                    Description
                </button>
                <button class="nav-link " id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
                    Product Specification
                </button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
                    FAQs
                </button>
                <!-- <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled"
                    type="button" role="tab" aria-controls="nav-disabled" aria-selected="false">
                    Customer Reviews
                </button> -->
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-features" role="tabpanel" aria-labelledby="nav-features-tab"
                tabindex="0">
            </div>
            <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
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
            <!-- <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab"
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
            </div> -->
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
        <div id="owlRelatedProducts" class="owl-carousel owl-theme">
        </div>
    </div>
</div>

<div class="fixed-cart">
    <div class="container-fluid">

    </div>
</div>

<div class="modal fade" id="designMethodModal" tabindex="-1" aria-labelledby="designMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <h4 class="mb-4 fw-bold">Select Design Method</h4>
                <div class="row g-4 justify-content-center">

                    <!-- Design Online -->
                    <div class="col-md-4">
                        <div class="option-card p-4 border rounded shadow-sm h-100" onclick="handleDesignOption('online')">
                            <i class="fa-solid fa-laptop-code fa-2x mb-3 text-primary"></i>
                            <h5>Design Online</h5>
                            <p class="text-muted small">Use our built-in editor to design your product online.</p>
                        </div>
                    </div>

                    <!-- Upload Artwork -->
                    <div class="col-md-4">
                        <div class="option-card p-4 border rounded shadow-sm h-100" onclick="handleDesignOption('upload')">
                            <i class="fa-solid fa-upload fa-2x mb-3 text-success"></i>
                            <h5>Upload Artworks</h5>
                            <p class="text-muted small">Upload your ready-to-use artwork file directly.</p>
                        </div>
                    </div>

                    <!-- Skip -->
                    <div class="col-md-4">
                        <div class="option-card p-4 border rounded shadow-sm h-100" onclick="handleDesignOption('skip')">
                            <i class="fa-solid fa-forward fa-2x mb-3 text-warning"></i>
                            <h5>Skip for Now</h5>
                            <p class="text-muted small">Choose design method later during checkout.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadArtworkModal" tabindex="-1" aria-labelledby="uploadArtworkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <h4 class="mb-4 text-center fw-bold">Upload Your Artwork</h4>

                <form>
                    <div class="mb-3">
                        <label for="artworkFile" class="fw-bold form-label">Choose your design file</label>
                        <input class="form-control" type="file" id="artworkFile" name="artworkFile" accept=".pdf,.ai,.psd,.svg,.jpg,.png,.tiff,.cdr,.eps,.ps">
                    </div>

                    <!-- Image Preview Placeholder -->
                    <div id="templatePreviewWrapper" class="mt-3 d-none">
                        <h6 class="fw-bold mb-2">Template Preview:</h6>
                        <img id="templatePreviewImage" src="" alt="Template Preview" class="img-fluid border rounded" style="max-height: 300px;" />
                    </div>

                    <div class="text-center mt-4">
                        <!-- <button type="button" class="btn btn-success d-none" id="uploadArtworkStartEditing" onclick="redirectToEditorWithUploadedTemplate()">Start Editing</button> -->
                        <button type="button" class="btn btn-success d-none" id="uploadArtworkStartEditing" onclick="addUploadedTemplateToCart()">Add to cart</button>
                    </div>
                </form>

                <hr class="my-4">

                <!-- Artwork Instructions -->
                <div class="upload-instructions mt-4 text-start small text-muted">
                    <h6 class="fw-bold">A Few Things to Know Before You Upload:</h6>
                    <ul class="ps-3">
                        <li>If your design just needs printing, feel free to upload formats like <strong>PNG, JPG, AI, PSD, TIFF, CDR, PDF, EPS, or PS</strong>.</li>
                        <li>Planning something large? Stick with <strong>PDF, PSD, JPG, or TIFF</strong> to ensure crystal-clear quality without pixelation.</li>
                        <li>Need precision cutting? You'll want to upload a <strong>vector file</strong> — think <strong>SVG, AI, or EPS</strong>.</li>
                        <li>Want to avoid the guesswork? Download our ready-to-go templates from the product page (note: logo design not included).</li>
                        <li>Match your artwork size with the product dimensions to keep things aligned.</li>
                        <li>Leave a 1-inch safe zone around the edges — it's your safety net for clean, bleed-free prints.</li>
                        <li>Using layered design files? Be sure to embed all assets — or upload them individually.</li>
                        <li>Convert your fonts to outlines (curves), and don’t forget to include your logo!</li>
                    </ul>
                    <p class="mt-3"><strong>Pro tip:</strong> A high-resolution <strong>PDF in CMYK mode with bleed</strong> is your ticket to a flawless print.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="selectEditorTemplateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-4">
                <h4 class="mb-4 fw-bold text-center">Choose a Template to Start Designing</h4>
                <div class="row">
                    <!-- Left Section: Template List -->
                    <div class="col-md-6 border-end" style="max-height: 500px; overflow-y: auto;">
                        <div id="templateCardList" class="row g-3"></div>
                    </div>

                    <!-- Right Section: Preview -->
                    <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <h5 class="mb-3">Template Preview:</h5>
                        <img id="selectedTemplatePreview" src="" class="img-fluid border rounded mb-3" style="max-height: 300px;" alt="Select a template to preview" />
                        <button id="startEditingBtn" class="btn btn-success d-none" onclick="redirectToEditorWithTemplate()">Start Editing</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script>
    const productId = Number('<?= $data['productId']; ?>')
</script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
<script src="<?= base_url('js/product-detail.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>