<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<style>
    #productImage {
        width: 100%;
        max-width: 350px;
        height: auto;
    }

    /* Switch container */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    /* Hide default checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* Slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
    }

    /* Circle inside the slider */
    .slider::before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    /* Checked state */
    input:checked+.slider {
        background-color: #28a745;
        /* Green */
    }

    input:checked+.slider::before {
        transform: translateX(26px);
    }

    .list-action-container {
        display: flex;
        justify-content: space-around;
    }

    .list-image-container {
        text-align: center;
    }

    .list-image {
        width: 80px;
        height: 80px;
    }

    .media-card {
        width: 20rem;
        margin: 10px;
        cursor: move;
    }

    .media-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .media-card img,
    .media-card video {
        max-width: 100%;
        border-radius: 8px;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-dark card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-details-tab" data-toggle="pill"
                            href="#product-details" role="tab"
                            aria-controls="product-details" aria-selected="true">Product Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="medias-tab" data-toggle="pill"
                            href="#medias" role="tab"
                            aria-controls="medias" aria-selected="false">Media</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="attribute-list-tab" data-toggle="pill"
                            href="#attribute-list" role="tab"
                            aria-controls="attribute-list" aria-selected="false">Attributes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="faq-list-tab" data-toggle="pill"
                            href="#faq-list" role="tab"
                            aria-controls="faq-list" aria-selected="false">FAQs</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="customer-review-list-tab" data-toggle="pill"
                            href="#customer-review-list" role="tab"
                            aria-controls="customer-review-list" aria-selected="false">Customer Reviews</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="variant-list-tab" data-toggle="pill"
                            href="#variant-list" role="tab"
                            aria-controls="variant-list" aria-selected="false">Variants</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" id="discount-list-tab" data-toggle="pill"
                            href="#discount-list" role="tab"
                            aria-controls="discount-list" aria-selected="false">Discounts</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="rush-hour-rate-list-tab" data-toggle="pill"
                            href="#rush-hour-rate-list" role="tab"
                            aria-controls="rush-hour-rate-list" aria-selected="false">Rush Charge Rate</a>
                    </li> -->
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                    <div class="tab-pane fade show active" id="product-details"
                        role="tabpanel" aria-labelledby="product-details-tab">
                        <div class="overlay-wrapper">
                            <div id="product-details-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="d-flex align-items-center flex-wrap mb-3" style="gap: 1rem;">
                                <h3 id="productName" class="mb-0 me-3"></h3>
                                <span id="productSku" class="badge bg-secondary text-white px-3 py-2 me-3"></span>
                                <span id="productPrice" class="badge bg-success text-white px-3 py-2"></span>
                            </div>

                            <div class="row mt-4 pt-3 border-top border-dark">
                                <div class="col-md-5 p-0">
                                    <div class="col-md-12">
                                        <h3>Short Description :</h3>
                                    </div>
                                    <div class="col-md-12 bg-light p-2 border">
                                        <div id="shortDescription"></div>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-1 p-0">
                                    <div class="col-md-12">
                                        <h3>Key Features :</h3>
                                    </div>
                                    <div class="col-md-12 bg-light p-2 border">
                                        <div id="productFeatures"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4 pt-3 border-top border-dark">
                                <div class="col-md-12">
                                    <h3>Description :</h3>
                                </div>
                                <div class="col-md-12 bg-light p-2 border">
                                    <div id="productDescription"></div>
                                </div>
                            </div>

                            <div class="row mt-4 pt-3 border-top border-dark">
                                <div class="col-md-12">
                                    <h3>Specification :</h3>
                                </div>
                                <div class="col-md-12 bg-light p-2 border">
                                    <div id="productSpecification"></div>
                                </div>
                            </div>

                            <!-- <div class="row mt-4 pt-3 border-top border-dark">
                                <div class="col-md-12">
                                    <h3>Accordion Sections :</h3>
                                </div>
                                <div class="col-md-12 mt-2 bg-light p-2 border">
                                    <h5 id="section1Title"></h5>
                                    <div class="bold" id="section1Description"></div>
                                </div>
                                <div class="col-md-12 mt-2 bg-light p-2 border">
                                    <h5 id="section2Title"></h5>
                                    <div class="bold" id="section2Description"></div>
                                </div>
                                <div class="col-md-12 mt-2 bg-light p-2 border">
                                    <h5 id="section3Title"></h5>
                                    <div class="bold" id="section3Description"></div>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="medias"
                        role="tabpanel" aria-labelledby="medias-tab">
                        <div class="overlay-wrapper">
                            <div id="medias-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>All Media</h4>
                                </div>

                                <div class="col-md-6 mb-4 text-right">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-add-media">
                                        Add New Media
                                    </button>
                                </div>
                            </div>

                            <h5 class="mb-2"><small><i>Please drag-n-drop the cards to arrange sequence of images. The images will show in the same sequence on website.</i></small>
                            </h5>
                            <div id="mediaList" class="media-container">
                            </div>
                            <button class="btn btn-dark mt-3 ml-2" id="saveOrderBtn">Save Order</button>
                            <button class="btn btn-dark mt-3 ml-2" onclick="fetchProductMedias()">Refresh</button>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="attribute-list"
                        role="tabpanel" aria-labelledby="attribute-list-tab">
                        <div class="overlay-wrapper">
                            <div id="attribute-list-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>All Attributes</h4>
                                </div>

                                <div class="col-md-6 mb-4 text-right">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-add-attribute">
                                        Add New Attribute
                                    </button>
                                </div>
                            </div>

                            <table id="dtProductAttributeList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Additional Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="dataProductAttributeList">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="faq-list"
                        role="tabpanel" aria-labelledby="faq-list-tab">
                        <div class="overlay-wrapper">
                            <div id="faq-list-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>FAQs</h4>
                                </div>

                                <div class="col-md-6 mb-4 text-right">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-add-faq">
                                        Add New FAQ
                                    </button>
                                </div>
                            </div>

                            <table id="dtFAQList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="dataFAQList">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="variant-list"
                        role="tabpanel" aria-labelledby="variant-list-tab">
                        <div class="overlay-wrapper">
                            <div id="variant-list-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>All Variant</h4>
                                </div>

                                <div class="col-md-6 mb-4 text-right">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-add-variant">
                                        Add New Variant
                                    </button>
                                </div>
                            </div>

                            <table id="dtVariantList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="dataVariantList">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="discount-list" role="tabpanel" aria-labelledby="discount-list-tab">
                        <div class="overlay-wrapper">
                            <div id="discount-list-loader" class="overlay">
                                <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mb-0">Manage Bulk Purchase Discounts</h4>
                                <button type="button" class="btn btn-success" id="addDiscountRow">
                                    <i class="fas fa-plus"></i> Add Discount
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center align-middle" id="bulkDiscountTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Min Qty</th>
                                            <th>Max Qty</th>
                                            <th>Discount (%)</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="discountTableBody">
                                        <!-- Existing rows will be added here dynamically -->
                                    </tbody>
                                </table>

                                <div class="text-right mt-2">
                                    <button class="btn btn-success" id="saveDiscountsBtn">Save Discounts</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="rush-hour-rate-list" role="tabpanel" aria-labelledby="rush-hour-rate-list-tab">
                        <div class="overlay-wrapper">
                            <div id="rush-hour-rate-list-loader" class="overlay">
                                <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mb-0">Manage Rush Charge Rates</h4>
                                <button type="button" class="btn btn-success" id="addRushHourRateRow">
                                    <i class="fas fa-plus"></i> Add Rush Charge Rate
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center align-middle" id="rushHourRateTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Min Qty</th>
                                            <th>Max Qty</th>
                                            <th>Amount</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="rushHourRateTableBody">
                                        <!-- Existing rows will be added here dynamically -->
                                    </tbody>
                                </table>

                                <div class="text-right mt-2">
                                    <button class="btn btn-success" id="saveRushHourRatesBtn">Save Rush Charge Rates</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-media">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Media</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="file" id="mediaUploadInput" multiple accept="image/*,video/*">

                <div id="mediaPreviewContainer" class="d-flex flex-wrap mt-3 gap-2"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="onClickSubmitAddProductMedia()">Save</button>
            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="modal-add-attribute">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Attribute</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="selectedAttributeId" />

                <!-- Attribute Selector -->
                <div class="form-group">
                    <label for="attributeSelect">Select Attribute</label>
                    <select class="form-control" id="attributeSelect" onchange="onAttributeChange()">
                        <option value="" disabled selected>Select Attribute</option>
                    </select>
                </div>

                <!-- Text Input -->
                <div class="form-group d-none" id="textInputGroup">
                    <label for="textInput">Enter Text</label>
                    <input type="text" class="form-control" id="textInput" />
                </div>

                <!-- Number Input -->
                <div class="form-group d-none" id="numberInputGroup">
                    <label for="numberInput">Enter Number</label>
                    <input type="number" class="form-control" id="numberInput" />
                </div>

                <!-- Boolean Input -->
                <div class="form-group d-none" id="booleanInputGroup">
                    <label>
                        <input type="checkbox" id="booleanInput" />
                        Yes / No
                    </label>
                </div>

                <!-- Select Input -->
                <div class="form-group d-none" id="selectInputGroup">
                    <label for="selectInput">Choose Option</label>
                    <select class="form-control" id="selectInput">
                        <!-- options will be populated dynamically -->
                    </select>
                </div>

                <!-- Multi Select Input -->
                <div class="form-group d-none" id="multiSelectInputGroup">
                    <label for="multiSelectInput">Choose Multiple Options</label>
                    <select multiple class="form-control" id="multiSelectInput">
                        <!-- options will be populated dynamically -->
                    </select>
                </div>

                <!-- Dimension Inputs -->
                <div class="d-none" id="dimensionGroup">
                    <div class="form-group">
                        <label for="dimensionWidth">Width</label>
                        <input type="text" class="form-control" id="dimensionWidth" placeholder="e.g. 10cm" />
                    </div>
                    <div class="form-group">
                        <label for="dimensionHeight">Height</label>
                        <input type="text" class="form-control" id="dimensionHeight" placeholder="e.g. 20cm" />
                    </div>
                </div>

                <!-- Additional Price Input -->
                <div class="form-group" id="additionalPriceGroup">
                    <label for="additionalPrice">Additional Price (optional)</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input
                            type="text"
                            class="form-control"
                            id="additionalPrice"
                            placeholder="Enter price"
                            oninput="validateDecimal(this)">
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="onClickSubmitAddProductAttribute()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="modal-add-variant">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Variant</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="add_variantId">
                <div class="form-group">
                    <label for="add_variantName">Name</label>
                    <input type="text" class="form-control" id="add_variantName" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="add_variantPrice">Price</label>
                    <input type="text" class="form-control" id="add_variantPrice" placeholder="Enter price">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="onClickSubmitAddVariant()">Save</button>
            </div>
        </div>

    </div>

</div> -->

<div class="modal fade" id="modal-add-faq">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add FAQ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="add_faqId">
                <div class="form-group">
                    <label for="add_faqQuestion">Question</label>
                    <input type="text" class="form-control" id="add_faqQuestion" placeholder="Enter Question">
                </div>
                <div class="form-group">
                    <label for="add_faqAnswer">Answer</label>
                    <textarea class="form-control" id="add_faqAnswer" rows="5"></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="onClickSubmitAddFAQ()">Save</button>
            </div>
        </div>

    </div>

</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-fixedheader/js/dataTables.fixedHeader.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-fixedheader/js/fixedHeader.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
    const productId = '<?php if (isset($data)) {
                            echo $data["productId"];
                        } else {
                            echo "";
                        } ?>'

    let allAttributes = []
    let productFAQs = []

    function initializeDTProductAttributeList() {
        $("#dtProductAttributeList").DataTable({
            "paging": true,
            "lengthChange": true,
            "lengthMenu": [ [10, 25, 50, 100], [10, 25, 50, 100] ],
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "fixedHeader": true,
        })
    }

    // function initializeDTVariantList() {
    //     $("#dtVariantList").DataTable({
    //         "paging": true,
            // "lengthChange": true,
            // "lengthMenu": [ [10, 25, 50, 100], [10, 25, 50, 100] ],
    //         "searching": true,
    //         "ordering": true,
    //         "info": true,
    //         "autoWidth": false,
    //         "responsive": true,
            // "fixedHeader": true,
    //     })
    // }

    function initializeDTFAQList() {
        $("#dtFAQList").DataTable({
            "paging": true,
            "lengthChange": true,
            "lengthMenu": [ [10, 25, 50, 100], [10, 25, 50, 100] ],
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "fixedHeader": true,
        })
    }

    const sortable = new Sortable(document.getElementById('mediaList'), {
        animation: 150
    });

    document.getElementById('saveOrderBtn').addEventListener('click', () => {
        const orderedIds = [];
        document.querySelectorAll('#mediaList .media-card').forEach((el, index) => {
            orderedIds.push({
                productMediaId: parseInt(el.getAttribute('data-id')),
                sequenceNumber: index + 1
            });
        });

        updateProductMediaSequence(orderedIds)
    });

    const mediaInput = document.getElementById("mediaUploadInput");
    const previewContainer = document.getElementById("mediaPreviewContainer");

    let uploadedFiles = [];
    let currentProductMediaLength = 0

    mediaInput.addEventListener("change", (e) => {
        const files = Array.from(e.target.files);

        // Append new files to uploadedFiles
        files.forEach(file => {
            if (!uploadedFiles.find(f => f.name === file.name && f.size === file.size)) {
                uploadedFiles.push(file);
            }
        });

        renderPreviews();
    });

    function renderPreviews() {
        previewContainer.innerHTML = "";

        uploadedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewElement = document.createElement("div");
                previewElement.className = "position-relative m-2";

                previewElement.innerHTML = `
                    <img src="${e.target.result}" style="width:100px; height:100px; object-fit:cover;" class="border rounded">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" style="right: 0; top: 0;" onclick="removeImage(${index})">×</button>
                `;

                previewContainer.appendChild(previewElement);
            };

            reader.readAsDataURL(file);
        });
    }

    function removeImage(index) {
        uploadedFiles.splice(index, 1);
        renderPreviews();
    }

    document.addEventListener("DOMContentLoaded", function() {
        if (productId !== "") {
            fetchProduct()
        }

        // Handle tab switching and show the loader for the active tab
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            // Get the target tab ID
            var targetTabId = $(e.target).attr('href') // This will give #lead-details, #manage-accounts, etc.

            // Hide all loaders
            $('.overlay').show()

            if (targetTabId.replace("#", "") === "product-details") {
                fetchProduct(targetTabId)
            } else if (targetTabId.replace("#", "") === "medias") {
                fetchProductMedias(targetTabId)
            } else if (targetTabId.replace("#", "") === "attribute-list") {
                fetchAttributes()
            } else if (targetTabId.replace("#", "") === "faq-list") {
                fetchFAQs(targetTabId)
            } else if (targetTabId.replace("#", "") === "customer-review-list") {
                fetchCustomerReviews(targetTabId)
                // } else if (targetTabId.replace("#", "") === "variant-list") {
                //     fetchVariants(targetTabId)
            } else if (targetTabId.replace("#", "") === "discount-list") {
                fetchProductBulkDiscount(targetTabId)
            } else if (targetTabId.replace("#", "") === "rush-hour-rate-list") {
                fetchProductRushHourRate(targetTabId)
            }
        })

        $('#modal-add-media').on('hidden.bs.modal', function() {
            document.getElementById("mediaUploadInput").value = "";
            document.getElementById("mediaPreviewContainer").innerHTML = "";
            uploadedFiles = []
        });

        $('#modal-add-attribute').on('hidden.bs.modal', function() {
            document.getElementById("selectedAttributeId").value = "";
            document.getElementById("attributeSelect").value = "";
            if (document.getElementById("textInput")) document.getElementById("textInput").value = "";
            if (document.getElementById("numberInput")) document.getElementById("numberInput").value = "";
            if (document.getElementById("dimensionWidth")) document.getElementById("dimensionWidth").value = "";
            if (document.getElementById("dimensionHeight")) document.getElementById("dimensionHeight").value = "";
            selectedAttributeId = ""
        });

        // $('#modal-add-variant').on('hidden.bs.modal', function() {
        //     document.getElementById("add_variantId").value = "";
        //     document.getElementById("add_variantName").value = "";
        //     document.getElementById("add_variantPrice").value = "";
        // });

        $('#modal-add-faq').on('hidden.bs.modal', function() {
            document.getElementById("add_faqId").value = "";
            document.getElementById("add_faqQuestion").value = "";
            document.getElementById("add_faqAnswer").value = "";
        });
    });

    async function fetchProduct() {
        await postAPICall({
            endPoint: "/product/list",
            payload: JSON.stringify({
                "filter": {
                    productId: Number(productId)
                },
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "createdAt",
                    "orderDir": "asc"
                }]
            }),
            callbackBeforeSend: function() {
                $('#product-details-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#product-details-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                if (response.success) {
                    const data = response.data[0]

                    document.getElementById("productName").innerText = data.name
                    document.getElementById('productSku').textContent = `SKU: ${data.sku ?? "-"}`;
                    document.getElementById('productPrice').textContent = `$ ${data.price ?? 0}`;

                    document.getElementById("shortDescription").innerHTML = data.shortDescription

                    // document.getElementById("section1Title").innerText = data.section1Title
                    // document.getElementById("section1Description").innerHTML = data.section1Description
                    // document.getElementById("section2Title").innerText = data.section2Title
                    // document.getElementById("section2Description").innerHTML = data.section2Description
                    // document.getElementById("section3Title").innerText = data.section3Title
                    // document.getElementById("section3Description").innerHTML = data.section3Description

                    document.getElementById("productFeatures").innerHTML = data.features
                    document.getElementById("productDescription").innerHTML = data.description
                    document.getElementById("productSpecification").innerHTML = data.specification
                }

                loader.hide()
            }
        })
    }

    // async function fetchVariants() {
    //     await postAPICall({
    //         endPoint: "/variant/list",
    //         payload: JSON.stringify({
    //             "filter": {
    //                 productId: Number(productId)
    //             },
    //             "range": {
    //                 "all": true
    //             },
    //             "sort": [{
    //                 "orderBy": "createdAt",
    //                 "orderDir": "asc"
    //             }]
    //         }),
    //         callbackBeforeSend: function() {
    //             $('#variant-list-loader').fadeIn()
    //             if ($.fn.DataTable.isDataTable("#dtVariantList")) {
    //                 $('#dtVariantList').DataTable().destroy()
    //             }
    //         },
    //         callbackComplete: function() {
    //             $('#variant-list-loader').fadeOut()
    //         },
    //         callbackSuccess: (response) => {
    //             const {
    //                 success,
    //                 message,
    //                 data
    //             } = response

    //             if (success) {
    //                 var html = ""

    //                 for (let i = 0; i < data?.length; i++) {
    //                     let firstImageData = null
    //                     for (let j = 0; j < data[i].variantMedias?.length; j++) {
    //                         if (data[i].variantMedias[j].mediaType.indexOf("image") >= 0) {
    //                             firstImageData = data[i].variantMedias[j]
    //                         }
    //                     }

    //                     html += `<tr>
    //                         <td>${data[i].name ?? ""}</td>
    //                         <td>${data[i].price ?? "-"}</td>
    //                         <td class="list-image-container">${firstImageData ? `<img class="list-image" src="${firstImageData.mediaUrl}" alt="${firstImageData.name}" />` : ""}</td>
    //                         <td>
    //                             <label class="switch">
    //                                 <input type="checkbox" class="toggle-status" data-variant-id="${data[i].variantId}" ${data[i].status ? "checked" : ""}>
    //                                 <span class="slider"></span>
    //                             </label>
    //                         </td>
    //                         <td class="list-action-container">
    //                             <span onclick="onClickUpdateVariant(${data[i].variantId}, '${data[i].name}', '${data[i].price ?? ""}')"><i class="fa fa-edit view-icon"></i></span>
    //                             <span onclick="onClickViewVariant(${data[i].variantId})"><i class="fa fa-eye view-icon"></i></span>
    //                         </td>
    //                     </tr>`;
    //                 }

    //                 // Insert the generated table rows
    //                 document.getElementById("dataVariantList").innerHTML = html;

    //                 // Add event listeners to all toggle switches after rendering
    //                 document.querySelectorAll(".toggle-status").forEach((toggle) => {
    //                     toggle.addEventListener("change", function() {
    //                         let variantId = this.getAttribute("data-variant-id");
    //                         let newStatus = this.checked ? "active" : "inactive";

    //                         console.log(`Variant ID: ${variantId}, New Status: ${newStatus}`);

    //                         // Call API to update status
    //                         updateVariantStatus(variantId, newStatus);
    //                     });
    //                 });


    //                 initializeDTVariantList()
    //             }

    //             loader.hide()
    //         }
    //     })
    // }

    // async function onClickSubmitAddVariant() {
    //     const variantId = document.getElementById("add_variantId")?.value ?? null;
    //     const name = document.getElementById("add_variantName").value;
    //     const price = document.getElementById("add_variantPrice").value;

    //     if ((name ?? "").trim() === "") {
    //         toastr.error("Please enter a valid name!");
    //         return;
    //     }

    //     if ((price ?? "").trim() === "") {
    //         toastr.error("Please enter a valid price!");
    //         return;
    //     }

    //     let payload = {
    //         name,
    //         price
    //     }

    //     if (variantId !== "") {
    //         if (confirm("Are you sure you want to update this variant?")) {
    //             await postAPICall({
    //                 endPoint: "/variant/update",
    //                 payload: JSON.stringify({
    //                     variantId: Number(variantId),
    //                     ...payload
    //                 }),
    //                 callbackSuccess: (response) => {
    //                     if (response.success) {
    //                         toastr.success(response.message);
    //                         $('#modal-add-variant').modal('hide');
    //                         fetchVariants()
    //                     }
    //                 }
    //             })
    //         }
    //     } else {
    //         if (confirm("Are you sure you want to create this variant?")) {
    //             await postAPICall({
    //                 endPoint: "/variant/create",
    //                 payload: JSON.stringify({
    //                     ...payload,
    //                     productId
    //                 }),
    //                 callbackSuccess: (response) => {
    //                     if (response.success) {
    //                         toastr.success(response.message);
    //                         $('#modal-add-variant').modal('hide');
    //                         fetchVariants()
    //                     }
    //                 }
    //             })
    //         }
    //     }
    // }

    // async function updateVariantStatus(variantId, status) {
    //     await postAPICall({
    //         endPoint: "/variant/update",
    //         payload: JSON.stringify({
    //             variantId: Number(variantId),
    //             status: status === "inactive" ? false : true
    //         }),
    //         callbackSuccess: (response) => {
    //             if (!response.success) {
    //                 toastr.error(response.message)
    //                 fetchProductCategories()
    //             } else {
    //                 toastr.success(`Variant ${status === "inactive" ? "blocked" : "unblocked"} successfully`)
    //             }
    //         }
    //     })
    // }

    // function onClickUpdateVariant(variantId, name, price) {
    //     document.getElementById("add_variantId").value = variantId
    //     document.getElementById("add_variantName").value = name
    //     document.getElementById("add_variantPrice").value = price
    //     $('#modal-add-variant').modal('show');
    // }

    // function onClickViewVariant(variantId) {
    //     window.location.href = `/admin/variants/view/${variantId}`
    // }

    async function fetchProductMedias() {
        await postAPICall({
            endPoint: "/product-media/list",
            payload: JSON.stringify({
                "filter": {
                    productId: Number(productId)
                },
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "sequenceNumber",
                    "orderDir": "asc"
                }]
            }),
            callbackBeforeSend: function() {
                $('#medias-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#medias-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    currentProductMediaLength = data?.length

                    var html = ""

                    for (let i = 0; i < data?.length; i++) {
                        let htmlMediaEl = data[i].mediaType.includes("video") ? `<video src="${data[i].mediaUrl}" controls></video>` : `<img src="${data[i].mediaUrl}" alt="${data[i].name}" style="height: 100%;">`

                        html += `<div class="card media-card position-relative" data-id="${data[i].productMediaId}">
                            <div class="card-body d-flex flex-column justify-content-between align-items-center text-center p-2" style="height: 100%;">
                                ${htmlMediaEl}
                                <p class="mt-2 mb-0">${data[i].name}</p>
                                <button class="btn btn-sm btn-danger delete-media-btn" onclick="onClickDeleteProductMedia(${data[i].productMediaId})" data-id="${data[i].productMediaId}" style="position: absolute; top: 5px; right: 5px;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>`;
                    }

                    document.getElementById("mediaList").innerHTML = html;
                }

                loader.hide()
            }
        })
    }

    async function onClickDeleteProductMedia(productMediaId) {
        await postAPICall({
            endPoint: "/product-media/delete",
            payload: JSON.stringify({
                productMediaIds: [Number(productMediaId)]
            }),
            callbackBeforeSend: function() {
                $('#product-details-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#product-details-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                if (response.success) {
                    fetchProductMedias()
                }

                loader.hide()
            }
        })
    }

    async function onClickSubmitAddProductMedia() {
        if (uploadedFiles.length === 0) {
            alert("Please upload at least one image.");
            return;
        }

        const payload = []
        for (let i = 0; i < uploadedFiles?.length; i++) {
            const {
                mediaType,
                name,
                size,
                url
            } = await uploadImage(uploadedFiles[i])

            payload.push({
                productId: parseInt(productId),
                name,
                mediaType,
                mediaUrl: url,
                size,
                sequenceNumber: parseInt(currentProductMediaLength) + i + 1
            })
        }

        await postAPICall({
            endPoint: "/product-media/create",
            payload: JSON.stringify(payload),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                const {
                    success,
                    message
                } = response

                if (success) {
                    toastr.success(response.message);
                    fetchProductMedias()
                    $('#modal-add-media').modal('hide');
                } else {
                    toastr.error(response.message);
                }
                loader.hide()
            }
        })
    }

    async function updateProductMediaSequence(payload) {
        if (confirm("Are you sure you want to update the ordering of images?")) {
            await postAPICall({
                endPoint: "/product-media/update-sequence",
                payload: JSON.stringify(payload),
                callbackComplete: () => {},
                callbackSuccess: (response) => {
                    const {
                        success,
                        message
                    } = response

                    if (success) {
                        toastr.success(response.message);
                        fetchProductMedias()
                    } else {
                        toastr.error(response.message);
                    }
                    loader.hide()
                }
            })
        }
    }

    async function fetchAttributes() {
        await postAPICall({
            endPoint: "/attribute/list",
            payload: JSON.stringify({
                "filter": {},
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "name",
                    "orderDir": "asc"
                }]
            }),
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    allAttributes = data

                    let html = `<option value="" disabled selected>Select Attribute</option>`

                    for (let i = 0; i < data?.length; i++) {
                        html += `<option value="${data[i].attributeId}">${data[i].name}</option>`
                    }

                    document.getElementById("attributeSelect").innerHTML = html
                }

                loader.hide()
            }
        })

        fetchProductAttributes()
    }

    async function fetchProductAttributes() {
        await postAPICall({
            endPoint: "/product-attribute/list",
            payload: JSON.stringify({
                "filter": {
                    productId: Number(productId)
                },
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "createdAt",
                    "orderDir": "asc"
                }]
            }),
            callbackBeforeSend: function() {
                $('#attribute-list-loader').fadeIn()
                if ($.fn.DataTable.isDataTable("#dtProductAttributeList")) {
                    $('#dtProductAttributeList').DataTable().destroy()
                }
            },
            callbackComplete: function() {
                $('#attribute-list-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    var html = ""

                    for (let i = 0; i < data?.length; i++) {
                        let value = ''
                        if (data[i].value) {
                            if (Array.isArray(data[i].value)) {
                                value = data[i].value.join(',');
                            } else if (typeof data[i].value === "string") {
                                try {
                                    const parsed = JSON.parse(data[i].value);
                                    if (Array.isArray(parsed)) {
                                        value = parsed.join(',');
                                    } else {
                                        // fallback: treat the string as plain text
                                        value = data[i].value;
                                    }
                                } catch (e) {
                                    // If JSON parsing fails, treat as plain comma-separated string
                                    value = data[i].value;
                                }
                            }
                        }

                        html += `<tr>
                            <td>${data[i].attribute?.name ?? ""}</td>
                            <td>${value ?? ""}</td>
                            <td>${(data[i].additionalPrice ?? "").toString().trim() !== "" ? `$${data[i].additionalPrice ?? ""}` : "-"}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-product-id="${data[i].productAttributeId}" ${data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataProductAttributeList").innerHTML = html;

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-status").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let productId = this.getAttribute("data-product-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            // Call API to update status
                            updateProductAttributeStatus(productId, newStatus);
                        });
                    });


                    initializeDTProductAttributeList()
                }

                loader.hide()
            }
        })
    }

    function populateAttributeDropdown() {
        const dropdown = document.getElementById('attributeSelect');
        dropdown.innerHTML = '<option value="" disabled selected>Select Attribute</option>';

        allAttributes.forEach(attr => {
            const option = document.createElement('option');
            option.value = attr.attributeId;
            option.text = attr.name;
            dropdown.appendChild(option);
        });
    }

    function onAttributeChange() {
        const selectedId = parseInt(document.getElementById('attributeSelect').value);
        const selectedAttr = allAttributes.find(attr => parseInt(attr.attributeId) === parseInt(selectedId));

        // Hide all input groups first
        ['textInputGroup', 'numberInputGroup', 'booleanInputGroup', 'selectInputGroup', 'multiSelectInputGroup', 'dimensionGroup'].forEach(id => {
            document.getElementById(id).classList.add('d-none');
        });

        if (!selectedAttr) return;

        document.getElementById('selectedAttributeId').value = selectedAttr.attributeId;

        switch (selectedAttr.type) {
            case 'text':
                document.getElementById('textInputGroup').classList.remove('d-none');
                break;
            case 'number':
                document.getElementById('numberInputGroup').classList.remove('d-none');
                break;
            case 'boolean':
                document.getElementById('booleanInputGroup').classList.remove('d-none');
                break;
            case 'select':
                const selectInput = document.getElementById('selectInput');
                selectInput.innerHTML = '';
                try {
                    const options = JSON.parse(selectedAttr.options || '[]');
                    options.forEach(opt => {
                        const option = document.createElement('option');
                        option.value = opt;
                        option.text = opt;
                        selectInput.appendChild(option);
                    });
                } catch (err) {
                    console.error('Invalid JSON in select options');
                }
                document.getElementById('selectInputGroup').classList.remove('d-none');
                break;
            case 'multi_select':
                const multiSelectInput = document.getElementById('multiSelectInput');
                multiSelectInput.innerHTML = '';
                try {
                    const options = JSON.parse(selectedAttr.options || '[]');
                    options.forEach(opt => {
                        const option = document.createElement('option');
                        option.value = opt;
                        option.text = opt;
                        multiSelectInput.appendChild(option);
                    });
                } catch (err) {
                    console.error('Invalid JSON in multi_select options');
                }
                document.getElementById('multiSelectInputGroup').classList.remove('d-none');
                break;
            case 'dimension':
                document.getElementById('dimensionGroup').classList.remove('d-none');
                break;
        }
    }

    async function onClickSubmitAddProductAttribute() {
        const selectedAttributeId = document.getElementById('selectedAttributeId').value?.trim();
        let value = null;

        if (!selectedAttributeId) {
            alert("Please select an attribute!");
            return;
        }

        const selectedAttribute = allAttributes.find((attribute) => parseInt(attribute.attributeId) === parseInt(selectedAttributeId));
        if (!selectedAttribute) {
            alert("Invalid attribute selected!");
            return;
        }

        switch (selectedAttribute.type) {
            case 'text':
                value = document.getElementById('textInput').value.trim();
                if (!value) {
                    alert("Text value required.");
                    return;
                }
                break;

            case 'number':
                const num = document.getElementById('numberInput').value.trim();
                if (!num || isNaN(num)) {
                    alert("Valid number required.");
                    return;
                }
                value = parseFloat(num);
                break;

            case 'boolean':
                value = document.getElementById('booleanInput').checked;
                break;

            case 'select':
                value = document.getElementById('selectInput').value;
                if (!value) {
                    alert("Please select an option.");
                    return;
                }
                break;

            case 'multi_select':
                const selectedOptions = Array.from(document.getElementById('multiSelectInput').selectedOptions);
                value = selectedOptions.map(opt => opt.value);
                if (value.length === 0) {
                    alert("Please select at least one option.");
                    return;
                }
                value = JSON.stringify(value); // Optional: store as JSON
                break;

            case 'dimension':
                const width = document.getElementById('dimensionWidth').value.trim();
                const height = document.getElementById('dimensionHeight').value.trim();
                if (!width || !height) {
                    alert("Both width and height required.");
                    return;
                }
                value = JSON.stringify({
                    width,
                    height
                });
                break;

            default:
                alert("Unsupported attribute type.");
                return;
        }

        // Get optional additional price
        const additionalPriceInput = document.getElementById('additionalPrice').value.trim();
        let additionalPrice = null;
        if (additionalPriceInput !== "") {
            if (isNaN(additionalPriceInput) || parseFloat(additionalPriceInput) < 0) {
                return toastr.error("Additional price must be a positive number.");
            }
            additionalPrice = parseFloat(additionalPriceInput);
        }

        const payload = {
            attributeId: selectedAttributeId,
            productId,
            value,
            ...(additionalPrice !== null && {
                additionalPrice
            }) // only include if set
        };

        await postAPICall({
            endPoint: "/product-attribute/create",
            payload: JSON.stringify(payload),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                const {
                    success,
                    message
                } = response;
                if (success) {
                    toastr.success(message);
                    fetchProductAttributes();
                    $('#modal-add-attribute').modal('hide');
                } else {
                    toastr.error(message);
                }
                loader.hide();
            }
        });
    }

    async function updateProductAttributeStatus(productAttributeId, status) {
        await postAPICall({
            endPoint: "/product-attribute/update",
            payload: JSON.stringify({
                productAttributeId: Number(productAttributeId),
                status: status === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchProductCategories()
                } else {
                    toastr.success(`Product attribute ${status === "inactive" ? "blocked" : "unblocked"} successfully`)
                }
            }
        })
    }

    async function fetchFAQs() {
        await postAPICall({
            endPoint: "/product-faq/list",
            payload: JSON.stringify({
                "filter": {
                    productId: Number(productId)
                },
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "createdAt",
                    "orderDir": "asc"
                }]
            }),
            callbackBeforeSend: function() {
                $('#faq-list-loader').fadeIn()
                if ($.fn.DataTable.isDataTable("#dtFAQList")) {
                    $('#dtFAQList').DataTable().destroy()
                }
            },
            callbackComplete: function() {
                $('#faq-list-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    productFAQs = data

                    var html = ""

                    for (let i = 0; i < data?.length; i++) {
                        html += `<tr>
                            <td>${data[i].question ?? ""}</td>
                            <td>${data[i].answer ?? ""}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-faq-id="${data[i].productFAQId}" ${data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td class="list-action-container">
                                <span onclick="onClickUpdateFAQ(${data[i].productFAQId})"><i class="fa fa-edit view-icon"></i></span>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataFAQList").innerHTML = html;

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-status").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let faqId = this.getAttribute("data-faq-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            console.log(`FAQ ID: ${faqId}, New Status: ${newStatus}`);

                            // Call API to update status
                            updateFAQStatus(faqId, newStatus);
                        });
                    });


                    initializeDTFAQList()
                }

                loader.hide()
            }
        })
    }

    async function onClickSubmitAddFAQ() {
        const productFAQId = document.getElementById("add_faqId")?.value ?? null;
        const question = document.getElementById("add_faqQuestion").value;
        const answer = document.getElementById("add_faqAnswer").value;

        if ((question ?? "").trim() === "") {
            toastr.error("Please enter a valid question!");
            return;
        }

        if ((answer ?? "").trim() === "") {
            toastr.error("Please enter a valid answer!");
            return;
        }

        let payload = {
            question,
            answer
        }

        if (productFAQId !== "") {
            if (confirm("Are you sure you want to update this faq?")) {
                await postAPICall({
                    endPoint: "/product-faq/update",
                    payload: JSON.stringify({
                        productFAQId: Number(productFAQId),
                        ...payload
                    }),
                    callbackSuccess: (response) => {
                        if (response.success) {
                            toastr.success(response.message);
                            $('#modal-add-faq').modal('hide');
                            fetchFAQs()
                        }
                    }
                })
            }
        } else {
            if (confirm("Are you sure you want to create this faq?")) {
                await postAPICall({
                    endPoint: "/product-faq/create",
                    payload: JSON.stringify({
                        ...payload,
                        productId
                    }),
                    callbackSuccess: (response) => {
                        if (response.success) {
                            toastr.success(response.message);
                            $('#modal-add-faq').modal('hide');
                            fetchFAQs()
                        }
                    }
                })
            }
        }
    }

    async function updateFAQStatus(productFAQId, status) {
        await postAPICall({
            endPoint: "/product-faq/update",
            payload: JSON.stringify({
                productFAQId: Number(productFAQId),
                status: status === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchProductCategories()
                } else {
                    toastr.success(`FAQ ${status === "inactive" ? "blocked" : "unblocked"} successfully`)
                }
            }
        })
    }

    function onClickUpdateFAQ(productFAQId) {
        const selectedFAQ = productFAQs.find((productFAQ) => Number(productFAQ.productFAQId) === Number(productFAQId))

        document.getElementById("add_faqId").value = productFAQId
        document.getElementById("add_faqQuestion").value = selectedFAQ.question
        document.getElementById("add_faqAnswer").value = selectedFAQ.answer
        $('#modal-add-faq').modal('show');
    }

    const discountTableBody = document.getElementById('discountTableBody');
    const addRowBtn = document.getElementById('addDiscountRow');
    const saveDiscountsBtn = document.getElementById('saveDiscountsBtn');

    function createDiscountRow(minQty = '', maxQty = '', discount = '') {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td><input type="number" class="form-control form-control-sm minQty" value="${minQty}" /></td>
            <td><input type="number" class="form-control form-control-sm maxQty" value="${maxQty}" /></td>
            <td><input type="number" class="form-control form-control-sm discount" step="0.01" value="${discount}" /></td>
            <td>
                <button class="btn btn-sm btn-danger delete-btn">Delete</button>
            </td>
        `;

        row.querySelector('.delete-btn').addEventListener('click', () => {
            row.remove();
        });

        discountTableBody.appendChild(row);
    }

    // Add new row on button click
    addRowBtn.addEventListener('click', () => {
        createDiscountRow();
    });

    async function fetchProductBulkDiscount() {
        await postAPICall({
            endPoint: "/product-bulk-discount/list",
            payload: JSON.stringify({
                "filter": {
                    productId: Number(productId)
                },
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "createdAt",
                    "orderDir": "asc"
                }]
            }),
            callbackBeforeSend: function() {
                $('#discount-list-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#discount-list-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    if (data[0]?.dataJson) {
                        let dataJson = typeof data[0].dataJson === "string" ? JSON.parse(data[0].dataJson) : data[0].dataJson

                        dataJson.forEach(d => createDiscountRow(d.minQty, d.maxQty, d.discount))
                    }
                }

                loader.hide()
            }
        })
    }

    // Save all discount data to backend
    saveDiscountsBtn.addEventListener('click', async () => {
        const allRows = discountTableBody.querySelectorAll('tr');
        const discounts = [];

        allRows.forEach(row => {
            const minQty = row.querySelector('.minQty').value;
            const maxQty = row.querySelector('.maxQty').value;
            const discount = row.querySelector('.discount').value;

            if (minQty || maxQty || discount) {
                discounts.push({
                    minQty: Number(minQty),
                    maxQty: Number(maxQty),
                    discount: parseFloat(discount)
                });
            }
        });

        if (confirm("Are you sure you want to update bulk discounts?")) {
            await postAPICall({
                endPoint: "/product-bulk-discount/update",
                payload: JSON.stringify({
                    productId: Number(productId),
                    dataJson: JSON.stringify(discounts)
                }),
                callbackSuccess: (response) => {
                    if (response.success) {
                        toastr.success(response.message);
                    } else if (!response.success) {
                        toastr.error(response.message);
                    }
                }
            })
        }
    });

    const rushHourRateTableBody = document.getElementById('rushHourRateTableBody');
    const addRushHourRateRowBtn = document.getElementById('addRushHourRateRow');
    const saveRushHourRatesBtn = document.getElementById('saveRushHourRatesBtn');

    function createRushHourRateRow(minQty = '', maxQty = '', amount = '') {
        const row = document.createElement('tr');

        row.innerHTML = `
            <td><input type="number" class="form-control form-control-sm minQty" value="${minQty}" /></td>
            <td><input type="number" class="form-control form-control-sm maxQty" value="${maxQty}" /></td>
            <td><input type="number" class="form-control form-control-sm amount" step="0.01" value="${amount}" /></td>
            <td>
                <button class="btn btn-sm btn-danger delete-btn">Delete</button>
            </td>
        `;

        row.querySelector('.delete-btn').addEventListener('click', () => {
            row.remove();
        });

        rushHourRateTableBody.appendChild(row);
    }

    // Add new row on button click
    addRushHourRateRowBtn.addEventListener('click', () => {
        createRushHourRateRow();
    });

    async function fetchProductRushHourRate() {
        await postAPICall({
            endPoint: "/product-rush-hour-rate/list",
            payload: JSON.stringify({
                "filter": {
                    productId: Number(productId)
                },
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "createdAt",
                    "orderDir": "asc"
                }]
            }),
            callbackBeforeSend: function() {
                $('#rush-hour-rate-list-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#rush-hour-rate-list-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    if (data[0]?.dataJson) {
                        let dataJson = typeof data[0].dataJson === "string" ? JSON.parse(data[0].dataJson) : data[0].dataJson

                        dataJson.forEach(d => createRushHourRateRow(d.minQty, d.maxQty, d.amount))
                    }
                }

                loader.hide()
            }
        })
    }

    // Save all rush charge rate data to backend
    saveRushHourRatesBtn.addEventListener('click', async () => {
        const allRows = rushHourRateTableBody.querySelectorAll('tr');
        const rushHourRates = [];

        allRows.forEach(row => {
            const minQty = row.querySelector('.minQty').value;
            const maxQty = row.querySelector('.maxQty').value;
            const amount = row.querySelector('.amount').value;

            if (minQty || maxQty || amount) {
                rushHourRates.push({
                    minQty: Number(minQty),
                    maxQty: Number(maxQty),
                    amount: parseFloat(amount)
                });
            }
        });

        if (confirm("Are you sure you want to update rush charge rates?")) {
            await postAPICall({
                endPoint: "/product-rush-hour-rate/update",
                payload: JSON.stringify({
                    productId: Number(productId),
                    dataJson: JSON.stringify(rushHourRates)
                }),
                callbackSuccess: (response) => {
                    if (response.success) {
                        toastr.success(response.message);
                    } else if (!response.success) {
                        toastr.error(response.message);
                    }
                }
            })
        }
    });
</script>

<?= $this->endSection(); ?>