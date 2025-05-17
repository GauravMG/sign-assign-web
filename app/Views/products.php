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
                <table id="dtProductsList" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
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
        fetchProducts()
    })

    function initializeDTProductsList() {
        $("#dtProductsList").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })
    }

    async function fetchProducts() {
        if ($.fn.DataTable.isDataTable("#dtProductsList")) {
            $('#dtProductsList').DataTable().destroy()
        }

        await postAPICall({
            endPoint: "/product/list",
            payload: JSON.stringify({
                "filter": {},
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
                    var html = ""

                    for (let i = 0; i < data?.length; i++) {
                        let coverImage = null
                        for (let j = 0; j < data[i]?.productMedias?.length; j++) {
                            if (data[i].productMedias[j].mediaType.indexOf("image") >= 0) {
                                coverImage = data[i].productMedias[j]
                                break
                            }
                        }

                        html += `<tr>
                            <td>${data[i].name ?? ""}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-product-id="${data[i].productId}" ${data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td class="list-action-container">
                                <span onclick="onClickUpdateProduct(${data[i].productId})"><i class="fa fa-edit view-icon"></i></span>
                                <span onclick="onClickViewProduct(${data[i].productId})"><i class="fa fa-eye view-icon"></i></span>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataList").innerHTML = html;

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
</script>
<?= $this->endSection(); ?>