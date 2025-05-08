<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<style>
    #productSubCategoryImage {
        width: 100%;
        max-width: 350px;
        height: auto;
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
                        <a class="nav-link active" id="product-subcategory-details-tab" data-toggle="pill"
                            href="#product-subcategory-details" role="tab"
                            aria-controls="product-subcategory-details" aria-selected="true">Sub-category Details</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                    <div class="tab-pane fade show active" id="product-subcategory-details"
                        role="tabpanel" aria-labelledby="product-subcategory-details-tab">
                        <div class="overlay-wrapper">
                            <div id="product-subcategory-details-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <h3 id="productSubCategoryName"></h3>

                            <p class="mt-3" id="productSubCategoryShortDescription"></p>

                            <img class="mt-3" src="" alt="Product Sub-category" id="productSubCategoryImage" />

                            <div class="mt-3" id="productSubCategoryDescription"></div>
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
    let productSubCategoryId = '<?php if (isset($data)) {
                                    echo $data["productSubCategoryId"];
                                } else {
                                    echo "";
                                } ?>'

    document.addEventListener("DOMContentLoaded", function() {
        if (productSubCategoryId !== "") {
            fetchProductSubCategory()
        }

        // Handle tab switching and show the loader for the active tab
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            // Get the target tab ID
            var targetTabId = $(e.target).attr('href') // This will give #lead-details, #manage-accounts, etc.

            // Hide all loaders
            $('.overlay').show()

            if (targetTabId.replace("#", "") === "product-subcategory-details") {
                fetchProductSubCategory(targetTabId)
            }
        })
    });

    async function fetchProductSubCategory() {
        await postAPICall({
            endPoint: "/product-subcategory/list",
            payload: JSON.stringify({
                "filter": {
                    productSubCategoryId: Number(productSubCategoryId)
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
                $('#product-subcategory-details-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#product-subcategory-details-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                if (response.success) {
                    const data = response.data[0]
                    document.getElementById("productSubCategoryName").innerText = data.name
                    document.getElementById("productSubCategoryShortDescription").innerText = data.shortDescription
                    document.getElementById("productSubCategoryDescription").innerHTML = data.description

                    let productSubCategoryImageEl = document.getElementById("productSubCategoryImage")
                    productSubCategoryImageEl.src = data.image
                    productSubCategoryImageEl.alt = data.name
                }

                loader.hide()
            }
        })
    }
</script>

<?= $this->endSection(); ?>