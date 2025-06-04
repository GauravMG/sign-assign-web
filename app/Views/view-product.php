<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
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
                        <a class="nav-link" id="faq-list-tab" data-toggle="pill"
                            href="#faq-list" role="tab"
                            aria-controls="faq-list" aria-selected="false">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="customer-review-list-tab" data-toggle="pill"
                            href="#customer-review-list" role="tab"
                            aria-controls="customer-review-list" aria-selected="false">Customer Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="variant-list-tab" data-toggle="pill"
                            href="#variant-list" role="tab"
                            aria-controls="variant-list" aria-selected="false">Variants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="discount-list-tab" data-toggle="pill"
                            href="#discount-list" role="tab"
                            aria-controls="discount-list" aria-selected="false">Discounts</a>
                    </li>
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

                            <h3 id="productName"></h3>

                            <div class="row mt-4">
                                <div class="col-12" id="shortDescription"></div>
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

                            <div class="row mt-4 pt-3 border-top border-dark">
                                <div class="col-md-12">
                                    <h3>Key Features :</h3>
                                </div>
                                <div class="col-md-12 bg-light p-2 border">
                                    <div id="productFeatures"></div>
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
                                <tfoot>
                                    <tr>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
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
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
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

                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-variant">
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

</div>

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
<script src="<?= base_url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>
<script>
    const productId = '<?php if (isset($data)) {
                            echo $data["productId"];
                        } else {
                            echo "";
                        } ?>'

    let productFAQs = []

    function initializeDTVariantList() {
        $("#dtVariantList").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })
    }

    function initializeDTFAQList() {
        $("#dtFAQList").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })
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
            } else if (targetTabId.replace("#", "") === "faq-list") {
                fetchFAQs(targetTabId)
            } else if (targetTabId.replace("#", "") === "customer-review-list") {
                fetchCustomerReviews(targetTabId)
            } else if (targetTabId.replace("#", "") === "variant-list") {
                fetchVariants(targetTabId)
            } else if (targetTabId.replace("#", "") === "discount-list") {
                fetchProductBulkDiscount(targetTabId)
            }
        })

        $('#modal-add-variant').on('hidden.bs.modal', function() {
            document.getElementById("add_variantId").value = "";
            document.getElementById("add_variantName").value = "";
            document.getElementById("add_variantPrice").value = "";
        });

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

    async function fetchVariants() {
        await postAPICall({
            endPoint: "/variant/list",
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
                $('#variant-list-loader').fadeIn()
                if ($.fn.DataTable.isDataTable("#dtVariantList")) {
                    $('#dtVariantList').DataTable().destroy()
                }
            },
            callbackComplete: function() {
                $('#variant-list-loader').fadeOut()
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
                        let firstImageData = null
                        for (let j = 0; j < data[i].variantMedias?.length; j++) {
                            if (data[i].variantMedias[j].mediaType.indexOf("image") >= 0) {
                                firstImageData = data[i].variantMedias[j]
                            }
                        }

                        html += `<tr>
                            <td>${data[i].name ?? ""}</td>
                            <td>${data[i].price ?? "-"}</td>
                            <td class="list-image-container">${firstImageData ? `<img class="list-image" src="${firstImageData.mediaUrl}" alt="${firstImageData.name}" />` : ""}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-variant-id="${data[i].variantId}" ${data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td class="list-action-container">
                                <span onclick="onClickUpdateVariant(${data[i].variantId}, '${data[i].name}', '${data[i].price ?? ""}')"><i class="fa fa-edit view-icon"></i></span>
                                <span onclick="onClickViewVariant(${data[i].variantId})"><i class="fa fa-eye view-icon"></i></span>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataVariantList").innerHTML = html;

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-status").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let variantId = this.getAttribute("data-variant-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            console.log(`Variant ID: ${variantId}, New Status: ${newStatus}`);

                            // Call API to update status
                            updateVariantStatus(variantId, newStatus);
                        });
                    });


                    initializeDTVariantList()
                }

                loader.hide()
            }
        })
    }

    async function onClickSubmitAddVariant() {
        const variantId = document.getElementById("add_variantId")?.value ?? null;
        const name = document.getElementById("add_variantName").value;
        const price = document.getElementById("add_variantPrice").value;

        if ((name ?? "").trim() === "") {
            toastr.error("Please enter a valid name!");
            return;
        }

        if ((price ?? "").trim() === "") {
            toastr.error("Please enter a valid price!");
            return;
        }

        let payload = {
            name,
            price
        }

        if (variantId !== "") {
            if (confirm("Are you sure you want to update this variant?")) {
                await postAPICall({
                    endPoint: "/variant/update",
                    payload: JSON.stringify({
                        variantId: Number(variantId),
                        ...payload
                    }),
                    callbackSuccess: (response) => {
                        if (response.success) {
                            toastr.success(response.message);
                            $('#modal-add-variant').modal('hide');
                            fetchVariants()
                        }
                    }
                })
            }
        } else {
            if (confirm("Are you sure you want to create this variant?")) {
                await postAPICall({
                    endPoint: "/variant/create",
                    payload: JSON.stringify({
                        ...payload,
                        productId
                    }),
                    callbackSuccess: (response) => {
                        if (response.success) {
                            toastr.success(response.message);
                            $('#modal-add-variant').modal('hide');
                            fetchVariants()
                        }
                    }
                })
            }
        }
    }

    async function updateVariantStatus(variantId, status) {
        await postAPICall({
            endPoint: "/variant/update",
            payload: JSON.stringify({
                variantId: Number(variantId),
                status: status === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchProductCategories()
                } else {
                    toastr.success(`Variant ${status === "inactive" ? "blocked" : "unblocked"} successfully`)
                }
            }
        })
    }

    function onClickUpdateVariant(variantId, name, price) {
        document.getElementById("add_variantId").value = variantId
        document.getElementById("add_variantName").value = name
        document.getElementById("add_variantPrice").value = price
        $('#modal-add-variant').modal('show');
    }

    function onClickViewVariant(variantId) {
        window.location.href = `/admin/variants/view/${variantId}`
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
                            updateVariantStatus(faqId, newStatus);
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
                        console.log(`dataJson`, dataJson)

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

        console.log('Saving discounts:', discounts);

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
</script>

<?= $this->endSection(); ?>