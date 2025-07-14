<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<style>
    #productCategoryImage {
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
                        <a class="nav-link active" id="product-category-details-tab" data-toggle="pill"
                            href="#product-category-details" role="tab"
                            aria-controls="product-category-details" aria-selected="true">Category Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="subcategory-list-tab" data-toggle="pill"
                            href="#subcategory-list" role="tab"
                            aria-controls="subcategory-list" aria-selected="false">Sub-categories</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                    <div class="tab-pane fade show active" id="product-category-details"
                        role="tabpanel" aria-labelledby="product-category-details-tab">
                        <div class="overlay-wrapper">
                            <div id="product-category-details-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <h3 id="productCategoryName"></h3>

                            <p class="mt-3" id="productCategoryShortDescription"></p>

                            <img class="mt-3" src="" alt="Product Category" id="productCategoryImage" />

                            <div class="mt-3" id="productCategoryDescription"></div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="subcategory-list"
                        role="tabpanel" aria-labelledby="subcategory-list-tab">
                        <div class="overlay-wrapper">
                            <div id="subcategory-list-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>All Sub-categories</h4>
                                </div>

                                <div class="col-md-6 mb-4 text-right">
                                    <a href="/admin/product-subcategories/add/<?= $data["productCategoryId"]; ?>"><button type="button" class="btn btn-dark">Add New Product Sub-category</button></a>
                                </div>
                            </div>

                            <table id="dtProductSubCategoriesList" class="table table-bordered table-hover">
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
    let productCategoryId = '<?php if (isset($data)) {
                                    echo $data["productCategoryId"];
                                } else {
                                    echo "";
                                } ?>'

    function initializeDTProductSubCategoriesList() {
        $("#dtProductSubCategoriesList").DataTable({
            "paging": true,
            "lengthChange": true,
            "lengthMenu": [ [10, 25, 50, 100], [10, 25, 50, 100] ],
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })
    }

    document.addEventListener("DOMContentLoaded", function() {
        if (productCategoryId !== "") {
            fetchProductCategory()
        }

        // Handle tab switching and show the loader for the active tab
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            // Get the target tab ID
            var targetTabId = $(e.target).attr('href') // This will give #lead-details, #manage-accounts, etc.

            // Hide all loaders
            $('.overlay').show()

            if (targetTabId.replace("#", "") === "product-category-details") {
                fetchProductCategory(targetTabId)
            } else if (targetTabId.replace("#", "") === "subcategory-list") {
                fetchProductSubCategories(targetTabId)
            }
        })
    });

    async function fetchProductCategory() {
        await postAPICall({
            endPoint: "/product-category/list",
            payload: JSON.stringify({
                "filter": {
                    productCategoryId: Number(productCategoryId)
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
                $('#product-category-details-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#product-category-details-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                if (response.success) {
                    const data = response.data[0]
                    document.getElementById("productCategoryName").innerText = data.name
                    document.getElementById("productCategoryShortDescription").innerText = data.shortDescription
                    document.getElementById("productCategoryDescription").innerHTML = data.description

                    let productCategoryImageEl = document.getElementById("productCategoryImage")
                    productCategoryImageEl.src = data.image
                    productCategoryImageEl.alt = data.name
                }

                loader.hide()
            }
        })
    }

    async function fetchProductSubCategories() {
        await postAPICall({
            endPoint: "/product-subcategory/list",
            payload: JSON.stringify({
                "filter": {
                    productCategoryId: Number(productCategoryId)
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
                $('#subcategory-list-loader').fadeIn()
                if ($.fn.DataTable.isDataTable("#dtProductSubCategoriesList")) {
                    $('#dtProductSubCategoriesList').DataTable().destroy()
                }
            },
            callbackComplete: function() {
                $('#subcategory-list-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                if (response.success) {
                    var html = ""

                    for (let i = 0; i < response.data?.length; i++) {
                        html += `<tr>
                            <td>${response.data[i].name ?? ""}</td>
                            <td class="list-image-container"><img class="list-image" src="${response.data[i].image}" alt="${response.data[i].name}" /></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-product-subcategory-id="${response.data[i].productSubCategoryId}" ${response.data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td class="list-action-container">
                                <span onclick="onClickUpdateProductSubCategory(${response.data[i].productSubCategoryId})"><i class="fa fa-edit view-icon"></i></span>
                                <span onclick="onClickViewProductSubCategory(${response.data[i].productSubCategoryId})"><i class="fa fa-eye view-icon"></i></span>
                                <span onclick="onClickDeleteProductSubCategory(${response.data[i].productSubCategoryId})"><i class="fa fa-trash view-icon"></i></span>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataList").innerHTML = html;

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-status").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let productSubCategoryId = this.getAttribute("data-product-subcategory-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            console.log(`Product Sub-category ID: ${productSubCategoryId}, New Status: ${newStatus}`);

                            // Call API to update status
                            updateProductSubCategoryStatus(productSubCategoryId, newStatus);
                        });
                    });


                    initializeDTProductSubCategoriesList()
                }

                loader.hide()
            }
        })
    }

    async function updateProductSubCategoryStatus(productSubCategoryId, status) {
        await postAPICall({
            endPoint: "/product-subcategory/update",
            payload: JSON.stringify({
                productSubCategoryId: Number(productSubCategoryId),
                status: status === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchProductCategories()
                } else {
                    toastr.success(`Product sub-category ${status === "inactive" ? "blocked" : "unblocked"} successfully`)
                }
            }
        })
    }

    function onClickUpdateProductSubCategory(productSubCategoryId) {
        window.location.href = `/admin/product-subcategories/update/${productSubCategoryId}`
    }

    function onClickViewProductSubCategory(productSubCategoryId) {
        window.location.href = `/admin/product-subcategories/view/${productSubCategoryId}`
    }

    async function onClickDeleteProductSubCategory(productSubCategoryId) {
        if (confirm("Are you sure you want to delete this item?")) {
            await postAPICall({
                endPoint: "/product-subcategory/delete",
                payload: JSON.stringify({
                    productSubCategoryIds: [Number(productSubCategoryId)]
                }),
                callbackSuccess: (response) => {
                    if (!response.success) {
                        toastr.error(response.message)
                    } else {
                        toastr.success(`Product sub-category deleted successfully`)
                    }
                    fetchProductSubCategories()
                }
            })
        }
    }
</script>

<?= $this->endSection(); ?>