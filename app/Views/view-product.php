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
                        <a class="nav-link" id="variant-list-tab" data-toggle="pill"
                            href="#variant-list" role="tab"
                            aria-controls="variant-list" aria-selected="false">Variants</a>
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
                                    <a href="/admin/variants/add/<?= $data["productId"]; ?>"><button type="button" class="btn btn-dark">Add New Variant</button></a>
                                </div>
                            </div>

                            <table id="dtVariantList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
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
            } else if (targetTabId.replace("#", "") === "variant-list") {
                fetchVariant(targetTabId)
            }
        })
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
                    document.getElementById("productDescription").innerHTML = data.description
                    document.getElementById("productSpecification").innerHTML = data.specification
                }

                loader.hide()
            }
        })
    }

    async function fetchVariant() {
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
                            <td class="list-image-container">${firstImageData ? `<img class="list-image" src="${firstImageData.mediaUrl}" alt="${firstImageData.name}" />` : ""}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-variant-id="${data[i].variantId}" ${data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td class="list-action-container">
                                <span onclick="onClickUpdateVariant(${data[i].variantId})"><i class="fa fa-edit view-icon"></i></span>
                                <span onclick="onClickViewVariant(${data[i].variantId})"><i class="fa fa-eye view-icon"></i></span>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataList").innerHTML = html;

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

    function onClickUpdateVariant(variantId) {
        window.location.href = `/admin/variants/update/${variantId}`
    }

    function onClickViewVariant(variantId) {
        window.location.href = `/admin/variants/view/${variantId}`
    }
</script>

<?= $this->endSection(); ?>