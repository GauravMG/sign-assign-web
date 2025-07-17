<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<style>
    .red {
        color: red;
    }

    .green {
        color: green;
    }

    .bet-pair {
        border: 1px solid;
        margin: 5px;
        padding: 5px;
        display: inline-block;
        border-radius: 7px;
        text-align: center;
    }

    .image-icon {
        cursor: pointer;
        font-size: 24px;
        /* Increase icon size */
        color: #343a40;
        /* Set icon color */
        margin-left: 10px;
    }

    .image-icon:hover {
        color: #535c65;
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
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?><div class="row">
    <div class="col-md-12">
        <div class="card card-dark card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="personal-details-tab" data-toggle="pill"
                            href="#personal-details" role="tab"
                            aria-controls="personal-details" aria-selected="true">Personal Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="coupon-list-tab" data-toggle="pill"
                            href="#coupon-list" role="tab"
                            aria-controls="coupon-list" aria-selected="false">Coupons</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                    <div class="tab-pane fade show active" id="personal-details"
                        role="tabpanel" aria-labelledby="personal-details-tab">
                        <div class="overlay-wrapper">
                            <div id="personal-details-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email ID</label>
                                <input type="text" class="form-control" id="email" readonly>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="dob">DOB</label>
                                    <input type="text" class="form-control" id="dob" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">Discounts</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="discountPercentage" class="form-label">Discount Percentage</label>
                                            <div class="input-group">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="discountPercentage"
                                                    oninput="validateDecimal(this)">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-dark" onclick="onClickSubmitDiscountPercentage()">
                                            Update Discount
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="coupon-list"
                        role="tabpanel" aria-labelledby="coupon-list-tab">
                        <div class="overlay-wrapper">
                            <div id="coupon-list-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Coupons</h4>
                                </div>

                                <div class="col-md-6 mb-4 text-right">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-add-coupon">
                                        Add New Coupon
                                    </button>
                                </div>
                            </div>

                            <table id="dtCouponList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Coupon Code</th>
                                        <th>Discount</th>
                                        <th>Distribution Quantity</th>
                                        <th>Expiry Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="dataCouponList">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
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

                <div class="form-group">
                    <label for="add_expiryDate">Expiry Date</label>
                    <input type="date" class="form-control" id="add_couponExpiryDate" min="">
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
    const userId = Number('<?php echo $data["userId"]; ?>')
    let coupons = []

    function initializeDTCouponList() {
        $("#dtCouponList").DataTable({
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
            "fixedHeader": true,
        })
    }

    $(document).ready(function() {
        if (userId !== "") {
            fetchUsers()
        }

        // Handle tab switching and show the loader for the active tab
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            // Get the target tab ID
            var targetTabId = $(e.target).attr('href') // This will give #lead-details, #manage-accounts, etc.

            // Hide all loaders
            $('.overlay').show()

            if (targetTabId.replace("#", "") === "personal-details") {
                fetchUsers(targetTabId)
            } else if (targetTabId.replace("#", "") === "coupon-list") {
                fetchCoupons(targetTabId)
            }
        })

        $('#modal-add-coupon').on('hidden.bs.modal', function() {
            $('#add_couponId').val('');
            $('#add_couponCode').val('');
            $('#add_discountType').val('');
            $('#add_discount').val('');
            $('#add_couponQuantityType').val('');
            $('#add_couponQuantity').val('');
            $('#add_couponExpiryDate').val('');
        });

        $('#modal-add-coupon').on('shown.bs.modal', function() {
            // Set today's date as min
            const dateInput = document.getElementById('add_couponExpiryDate');
            const today = new Date().toISOString().split('T')[0];
            dateInput.min = today;

            // Optional: Revalidate on change or blur
            dateInput.addEventListener('blur', function() {
                if (this.value && this.value < today) {
                    alert("Please select today or a future date.");
                    this.value = ""; // Clear invalid input
                }
            });
        });
    })

    async function fetchUsers() {
        await Promise.all([
            postAPICall({
                endPoint: "/user/list",
                payload: JSON.stringify({
                    "filter": {
                        userId
                    }
                }),
                callbackBeforeSend: function() {
                    $('#personal-details-loader').fadeIn()
                },
                callbackComplete: function() {
                    $('#personal-details-loader').fadeOut()
                },
                callbackSuccess: (response) => {
                    if (response.success) {
                        const data = response.data[0]

                        document.getElementById("firstName").value = data.firstName
                        document.getElementById("lastName").value = data.lastName
                        document.getElementById("email").value = data.email
                        document.getElementById("mobile").value = data.mobile
                        document.getElementById("dob").value = data.dob ? formatDateWithoutTime(data.dob) : ""

                        document.getElementById("discountPercentage").value = data.userDiscountPercentage ?? 0
                    }
                    loader.hide()
                }
            }),
        ])
    }

    async function onClickSubmitDiscountPercentage() {
        const discountPercentage = document.getElementById("discountPercentage").value.trim();

        const payload = {
            userId: Number(userId),
            discountPercentage: Number(discountPercentage)
        };

        await Promise.all([
            postAPICall({
                endPoint: "/user-discount/update",
                payload: JSON.stringify({
                    ...payload
                }),
                callbackComplete: () => {},
                callbackSuccess: (response) => {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                    loader.hide()
                }
            }),
        ])
    }

    async function fetchCoupons() {
        await postAPICall({
            endPoint: "/coupon/list",
            payload: JSON.stringify({
                "filter": {
                    userId: Number(userId)
                },
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
                        <td>${coupon.discount ?? "0"} ${coupon.discountType === "percentage" ? "%" : "flat"}</td>
                        <td>${coupon.couponQuantityType === "unlimited" ? "Unlimited" : coupon.couponQuantity}</td>
                        <td>${coupon.expiryDate ? formatDateWithoutTime(coupon.expiryDate) : "—"}</td>
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
        const expiryDateRaw = document.getElementById('add_couponExpiryDate').value;
        const expiryDate = expiryDateRaw ? new Date(expiryDateRaw).toISOString() : null;

        const coupon = {
            couponCode: document.getElementById('add_couponCode').value,
            discountType: document.getElementById('add_discountType').value,
            discount: parseFloat(document.getElementById('add_discount').value || 0),
            couponQuantityType: document.getElementById('add_couponQuantityType').value,
            couponQuantity: document.getElementById('add_couponQuantity').value ?
                parseInt(document.getElementById('add_couponQuantity').value, 10) : null,
            expiryDate,
            userId
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