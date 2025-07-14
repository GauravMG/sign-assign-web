<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
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

<?= $this->section('headerButtons'); ?>
<div class="col-md-6 offset-md-6">
    <a href="/admin/product-categories/add"><button type="button" class="btn btn-dark">Add New Product Category</button></a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">All Product Categories</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dtProductCategoriesList" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
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
    $(document).ready(function() {
        fetchProductCategories()
    })

    function initializeDTProductCategoriesList() {
        $("#dtProductCategoriesList").DataTable({
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

    async function fetchProductCategories() {
        if ($.fn.DataTable.isDataTable("#dtProductCategoriesList")) {
            $('#dtProductCategoriesList').DataTable().destroy()
        }

        await postAPICall({
            endPoint: "/product-category/list",
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
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                if (response.success) {
                    var html = ""

                    for (let i = 0; i < response.data?.length; i++) {
                        html += `<tr>
                            <td>${response.data[i].name ?? ""}</td>
                            <td class="list-image-container"><img class="list-image" src="${response.data[i].image}" alt="${response.data[i].name}" /></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-product-category-id="${response.data[i].productCategoryId}" ${response.data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td class="list-action-container">
                                <span onclick="onClickUpdateProductCategory(${response.data[i].productCategoryId})"><i class="fa fa-edit view-icon"></i></span>
                                <span onclick="onClickViewProductCategory(${response.data[i].productCategoryId})"><i class="fa fa-eye view-icon"></i></span>
                                <span onclick="onClickDeleteProductCategory(${response.data[i].productCategoryId})"><i class="fa fa-trash view-icon"></i></span>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataList").innerHTML = html;

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-status").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let productCategoryId = this.getAttribute("data-product-category-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            console.log(`Product Category ID: ${productCategoryId}, New Status: ${newStatus}`);

                            // Call API to update status
                            updateProductCategoryStatus(productCategoryId, newStatus);
                        });
                    });


                    initializeDTProductCategoriesList()
                }
                loader.hide()
            }
        })
    }

    async function updateProductCategoryStatus(productCategoryId, status) {
        await postAPICall({
            endPoint: "/product-category/update",
            payload: JSON.stringify({
                productCategoryId: Number(productCategoryId),
                status: status === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchProductCategories()
                } else {
                    toastr.success(`Product category ${status === "inactive" ? "blocked" : "unblocked"} successfully`)
                }
            }
        })
    }

    function onClickUpdateProductCategory(productCategoryId) {
        window.location.href = `/admin/product-categories/update/${productCategoryId}`
    }

    function onClickViewProductCategory(productCategoryId) {
        window.location.href = `/admin/product-categories/view/${productCategoryId}`
    }

    async function onClickDeleteProductCategory(productCategoryId) {
        if (confirm("Are you sure you want to delete this item?")) {
            await postAPICall({
                endPoint: "/product-category/delete",
                payload: JSON.stringify({
                    productCategoryIds: [Number(productCategoryId)]
                }),
                callbackSuccess: (response) => {
                    if (!response.success) {
                        toastr.error(response.message)
                    } else {
                        toastr.success(`Product category deleted successfully`)
                    }
                    fetchProductCategories()
                }
            })
        }
    }
</script>
<?= $this->endSection(); ?>