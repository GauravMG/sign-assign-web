<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<style>
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

    /* For Select2 multi-select selected items (Bootstrap theme or default) */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #343a40;
        /* Dark background (like .btn-dark) */
        color: #fff;
        /* White text */
        border: 1px solid #343a40;
    }

    /* Optional: Adjust the appearance of the search field */
    .select2-container--default .select2-search--inline .select2-search__field {
        height: 30px;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('headerButtons'); ?>
<div class="col-md-5 offset-md-7">
    <a href="/admin/products/add"><button type="button" class="btn btn-dark">Add New Product</button></a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">All Products</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="filterCategoryId">Filter by Category</label>
                        <select id="filterCategoryId" class="form-control">
                            <option value="">All</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-dark" id="applyFiltersBtn" onclick="filterList()">Apply Filters</button>
                    </div>
                </div>

                <table id="dtProductsList" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Sku</th>
                            <th>Category</th>
                            <th>Use Editor</th>
                            <th>Status</th>
                            <th>Preview</th>
                            <th>Manage Data</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

<div class="modal fade" id="modal-manage-related-products" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- modal-lg for more width -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Manage Related Products</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="manageRelatedProducts_productId">

                <div>
                    <h5 class="mb-2">Tag Products</h5>
                    <select class="select2" id="manageRelatedProducts_products" multiple="multiple" data-placeholder="Select products" style="width: 100%;">
                    </select>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="onClickSubmitRelatedProducts()">Save</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
    let products = []

    $(document).ready(function() {
        fetchProducts()
        fetchProductCategories()

        $('#manageRelatedProducts_products').select2({
            placeholder: 'Search and select products',
            multiple: true,
            minimumInputLength: 1,
            ajax: {
                transport: function(params, success, failure) {
                    const searchTerm = params.data.term;

                    postAPICall({
                        endPoint: "/product/list",
                        payload: JSON.stringify({
                            filter: {
                                search: searchTerm
                            },
                            range: {
                                all: true
                            },
                            sort: [{
                                orderDir: "asc",
                                orderBy: "name"
                            }]
                        }),
                        callbackSuccess: (response) => {
                            const {
                                success: isSuccess,
                                data
                            } = response;
                            if (isSuccess && Array.isArray(data)) {
                                success({
                                    results: data.map(el => ({
                                        id: el.productId,
                                        text: el.name
                                    }))
                                });
                            } else {
                                success({
                                    results: []
                                });
                            }
                        },
                    });
                },
                processResults: function(data) {
                    return data;
                },
                delay: 300,
                cache: true
            }
        });

        $('#modal-manage-related-products').on('hidden.bs.modal', function() {
            document.getElementById("manageRelatedProducts_productId").value = "";
            $('#manageRelatedProducts_products').val(null).trigger('change');
        });
    })

    function initializeDTProductsList() {
        $("#dtProductsList").DataTable({
            "paging": true,
            "lengthChange": true,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })
    }

    async function fetchProductCategories() {
        await postAPICall({
            endPoint: "/product-category/list",
            payload: JSON.stringify({
                filter: {},
                range: {
                    all: true
                },
                sort: [{
                    orderBy: "name",
                    orderDir: "asc"
                }],
                linkedEntities: true
            }),
            callbackSuccess: (response) => {
                const {
                    success,
                    data
                } = response;

                if (success) {
                    let html = `<option value="">All</option>`

                    for (let category of data) {
                        html += `<option value="${category.productCategoryId}">${category.name}</option>`
                    }

                    document.getElementById("filterCategoryId").innerHTML = html
                }
            }
        });
    }

    function filterList() {
        let additionalFilters = {}

        const filterCategoryId = document.getElementById("filterCategoryId").value
        if (filterCategoryId) {
            additionalFilters = {
                ...additionalFilters,
                productCategoryId: Number(filterCategoryId)
            }
        }

        fetchProducts(additionalFilters)
    }

    async function fetchProducts(additionalFilters = {}) {
        if ($.fn.DataTable.isDataTable("#dtProductsList")) {
            $('#dtProductsList').DataTable().destroy()
        }

        await postAPICall({
            endPoint: "/product/list",
            payload: JSON.stringify({
                "filter": {
                    ...additionalFilters
                },
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "name",
                    "orderDir": "asc"
                }],
                linkedEntities: true
            }),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    products = data
                    var html = ""

                    for (let i = 0; i < data?.length; i++) {
                        html += `<tr>
                            <td>${data[i].name ?? ""}</td>
                            <td>${data[i].sku ?? ""}</td>
                            <td>${data[i].productCategory?.name ?? ""}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-editor-flag" data-product-id="${data[i].productId}" ${data[i].isEditorEnabled ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-product-id="${data[i].productId}" ${data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td>
                                <div class="project-actions text-right d-flex justify-content-end" style="gap: 0.5rem;">
                                    <a class="btn btn-primary btn-sm d-flex align-items-center" target="_blank" href="/product/${getLinkFromName(data[i].name)}?pid=${data[i].productId}">
                                        <i class="fas fa-eye mr-1">
                                        </i>
                                        Preview
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="project-actions text-right d-flex justify-content-end" style="gap: 0.5rem;">
                                    <a class="btn btn-info btn-sm d-flex align-items-center" onclick="onClickUpdateProduct(${data[i].productId})">
                                        <i class="fas fa-pencil-alt mr-1">
                                        </i>
                                        Edit Details
                                    </a>
                                    <a class="btn btn-info btn-sm d-flex align-items-center" onclick="onClickManageProductMedia(${data[i].productId})">
                                        <i class="fas fa-pencil-alt mr-1">
                                        </i>
                                        Manage Media
                                    </a>
                                    <a class="btn btn-info btn-sm d-flex align-items-center" onclick="onClickManageProductAttribute(${data[i].productId})">
                                        <i class="fas fa-pencil-alt mr-1">
                                        </i>
                                        Manage Atributes
                                    </a>
                                    <a class="btn btn-info btn-sm d-flex align-items-center" onclick="onClickManageProductFAQ(${data[i].productId})">
                                        <i class="fas fa-pencil-alt mr-1">
                                        </i>
                                        Manage FAQ
                                    </a>
                                    <a class="btn btn-info btn-sm d-flex align-items-center" onclick="onClickManageProductDiscount(${data[i].productId})">
                                        <i class="fas fa-pencil-alt mr-1">
                                        </i>
                                        Manage Discounts
                                    </a>
                                    <a class="btn btn-info btn-sm d-flex align-items-center" onclick="onClickManageRelatedProducts(${data[i].productId})">
                                        <i class="fas fa-pencil-alt mr-1">
                                        </i>
                                        Manage Related Products
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="project-actions text-right d-flex justify-content-end" style="gap: 0.5rem;">
                                    <!-- <a class="btn btn-primary btn-sm d-flex align-items-center" onclick="onClickViewProduct(${data[i].productId})">
                                        <i class="fas fa-folder mr-1">
                                        </i>
                                        View
                                    </a> -->
                                    <a class="btn btn-danger btn-sm d-flex align-items-center" onclick="onClickDeleteProduct(${data[i].productId})">
                                        <i class="fas fa-trash mr-1">
                                        </i>
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataList").innerHTML = html;

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-editor-flag").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let productId = this.getAttribute("data-product-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            console.log(`Product ID: ${productId}, New editor flag: ${newStatus}`);

                            updateProductEditorFlag(productId, newStatus);
                        });
                    });

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-status").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let productId = this.getAttribute("data-product-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            console.log(`Product ID: ${productId}, New Status: ${newStatus}`);

                            updateProductStatus(productId, newStatus);
                        });
                    });

                    initializeDTProductsList()
                }
                loader.hide()
            }
        })
    }

    async function updateProductEditorFlag(productId, isEditorEnabled) {
        await postAPICall({
            endPoint: "/product/update",
            payload: JSON.stringify({
                productId: Number(productId),
                isEditorEnabled: isEditorEnabled === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchProducts()
                } else {
                    toastr.success(`Editor ${isEditorEnabled === "inactive" ? "disabled" : "enabled"} for product successfully`)
                }
            }
        })
    }

    async function updateProductStatus(productId, status) {
        await postAPICall({
            endPoint: "/product/update",
            payload: JSON.stringify({
                productId: Number(productId),
                status: status === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchProducts()
                } else {
                    toastr.success(`Product ${status === "inactive" ? "blocked" : "unblocked"} successfully`)
                }
            }
        })
    }

    function onClickUpdateProduct(productId) {
        window.location.href = `/admin/products/update/${productId}`
    }

    function onClickViewProduct(productId) {
        window.location.href = `/admin/products/${productId}`
    }

    function onClickManageProductMedia(productId) {
        window.location.href = `/admin/products/${productId}/manage-media`
    }

    function onClickManageProductAttribute(productId) {
        window.location.href = `/admin/products/${productId}/manage-attribute`
    }

    function onClickManageProductFAQ(productId) {
        window.location.href = `/admin/products/${productId}/manage-faq`
    }

    function onClickManageProductDiscount(productId) {
        window.location.href = `/admin/products/${productId}/manage-discount`
    }

    async function onClickDeleteProduct(productId) {
        if (confirm("Are you sure you want to delete this item?")) {
            await postAPICall({
                endPoint: "/product/delete",
                payload: JSON.stringify({
                    productIds: [Number(productId)]
                }),
                callbackSuccess: (response) => {
                    if (!response.success) {
                        toastr.error(response.message)
                    } else {
                        toastr.success(`Product deleted successfully`)
                    }
                    fetchProducts()
                }
            })
        }
    }

    function prepopulateRelatedProducts({
        products = []
    }) {
        // Populate Products
        products.forEach(prod => {
            const option = new Option(prod.name, prod.productId, true, true);
            $('#manageRelatedProduct_products').append(option).trigger('change');
        });
    }

    function onClickManageRelatedProducts(productId) {
        document.getElementById('manageRelatedProducts_productId').value = productId

        $('#modal-manage-related-products').modal('show');

        const selectedProduct = products.find((product) => Number(product.productId) === Number(productId))

        const relatedProducts = []
        selectedProduct.relatedProducts.forEach((productTag) => {
            if (productTag.referenceType === "product") {
                relatedProducts.push({
                    productId: Number(productTag.referenceId),
                    name: productTag.referenceData.name
                })
            }
        })

        prepopulateRelatedProducts({
            products: relatedProducts
        })
    }

    async function onClickSubmitRelatedProducts() {
        // Get values from form inputs
        let productId = document.getElementById('manageRelatedProducts_productId').value.trim();
        productId = Number(productId)
        const selectedProductIds = $('#manageRelatedProducts_products').val();

        if (!selectedProductIds?.length) {
            alert("Please select at least 1 related product!")
            return
        }
        let payload = []
        for (let el of selectedProductIds) {
            payload.push({
                productId,
                referenceType: "product",
                referenceId: Number(el)
            })
        }

        if (confirm("Are you sure you want to update related products for selected product?")) {
            await postAPICall({
                endPoint: "/related-product/save",
                payload: JSON.stringify(payload),
                callbackSuccess: (response) => {
                    if (!response.success) {
                        toastr.error(response.message)
                    } else {
                        toastr.success(`Related products updated successfully`)
                        $('#modal-manage-related-products').modal('hide');
                    }
                    fetchProducts()
                }
            })
        }
    }
</script>
<?= $this->endSection(); ?>