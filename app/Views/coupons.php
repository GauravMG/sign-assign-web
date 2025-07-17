<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css'); ?>">
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
</style>
<?= $this->endSection(); ?>

<?= $this->section('headerButtons'); ?>
<div class="col-md-5 offset-md-7" id="addUserButtonContainer">
    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-add-coupon">
        Add New Coupon
    </button>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">All Coupons</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dtCouponList" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Coupon Code</th>
                            <th>For User<br>(if applicable)</th>
                            <th>Discount</th>
                            <th>Distribution Quantity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="dataCouponList">
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

<div class="modal fade" id="modal-add-coupon">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Coupon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Hidden field for couponId (for edits) -->
                <input type="hidden" class="form-control" id="add_couponId">

                <div class="form-group">
                    <label for="add_couponCode">Coupon Code</label>
                    <input type="text" class="form-control" id="add_couponCode" placeholder="Enter Coupon Code">
                </div>

                <div class="form-group">
                    <label for="add_discountType">Discount Type</label>
                    <select class="form-control" id="add_discountType">
                        <option value="amount">Amount</option>
                        <option value="percentage">Percentage</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="add_discount">Discount</label>
                    <input type="number" step="0.01" class="form-control" id="add_discount" placeholder="Enter Discount">
                </div>

                <div class="form-group">
                    <label for="add_couponQuantityType">Coupon Quantity Type</label>
                    <select class="form-control" id="add_couponQuantityType" onchange="toggleCouponQuantityField()">
                        <option value="limited">Limited</option>
                        <option value="unlimited">Unlimited</option>
                    </select>
                </div>

                <div class="form-group" id="couponQuantityGroup">
                    <label for="add_couponQuantity">Coupon Quantity</label>
                    <input type="number" class="form-control" id="add_couponQuantity" placeholder="Enter Quantity">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="onClickSubmitAddCoupon()">Save</button>
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

<script>
    $(document).ready(function() {
        fetchCoupons()
    })

    function initializeDTCouponList() {
        $("#dtCouponList").DataTable({
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

    async function fetchCoupons() {
        await postAPICall({
            endPoint: "/coupon/list",
            payload: JSON.stringify({
                "filter": {},
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "createdAt",
                    "orderDir": "desc"
                }]
            }),
            callbackBeforeSend: function() {
                $('#coupon-list-loader').fadeIn()
                if ($.fn.DataTable.isDataTable("#dtCouponList")) {
                    $('#dtCouponList').DataTable().destroy()
                }
            },
            callbackComplete: function() {
                $('#coupon-list-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    coupons = data

                    var html = ""

                    for (let coupon of data) {
                        html += `<tr>
                            <td>${coupon.couponCode ?? ""}</td>
                            <td>${coupon.user ? createFullName(coupon.user) : "N/A"}</td>
                            <td>${coupon.discount ?? "0"} ${coupon.discountType === "percentage" ? "%" : "flat"}</td>
                            <td>${coupon.couponQuantityType === "unlimited" ? "Unlimited" : coupon.couponQuantity}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-coupon-id="${coupon.couponId}" ${coupon.status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataCouponList").innerHTML = html;

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-status").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let couponId = this.getAttribute("data-coupon-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            console.log(`Coupon ID: ${couponId}, New Status: ${newStatus}`);

                            // Call API to update status
                            updateCouponStatus(couponId, newStatus);
                        });
                    });


                    initializeDTCouponList()
                }

                loader.hide()
            }
        })
    }

    async function updateCouponStatus(couponId, status) {
        if (confirm(`Are you sure to ${status === "inactive" ? "block" : "unblock"} the selected coupon?`)) {
            await postAPICall({
                endPoint: "/coupon/update",
                payload: JSON.stringify({
                    couponId: Number(couponId),
                    status: status === "inactive" ? false : true
                }),
                callbackSuccess: (response) => {
                    const {
                        success,
                        message
                    } = response

                    if (!success) {
                        toastr.error(message)
                        fetchCoupons()
                    } else {
                        toastr.success(`Coupon ${status === "inactive" ? "blocked" : "unblocked"} successfully`)
                    }
                }
            })
        }
    }

    function toggleCouponQuantityField() {
        const type = document.getElementById('add_couponQuantityType').value;
        const group = document.getElementById('couponQuantityGroup');
        if (type === 'limited') {
            group.style.display = 'block';
        } else {
            group.style.display = 'none';
            document.getElementById('add_couponQuantity').value = '';
        }
    }

    async function onClickSubmitAddCoupon() {
        const coupon = {
            couponCode: document.getElementById('add_couponCode').value,
            discountType: document.getElementById('add_discountType').value,
            discount: parseFloat(document.getElementById('add_discount').value || 0),
            couponQuantityType: document.getElementById('add_couponQuantityType').value,
            couponQuantity: document.getElementById('add_couponQuantity').value ?
                parseInt(document.getElementById('add_couponQuantity').value, 10) : null
        };

        await postAPICall({
            endPoint: "/coupon/create",
            payload: JSON.stringify(coupon),
            callbackSuccess: (response) => {
                const {
                    success,
                    message
                } = response

                if (!success) {
                    toastr.error(message)
                } else {
                    toastr.success(message)
                    $('#modal-add-coupon').modal("hide")
                    fetchCoupons()
                }
            }
        })
    }
</script>
<?= $this->endSection(); ?>