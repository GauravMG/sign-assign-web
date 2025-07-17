<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Manage Tagging</th>
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

<div class="modal fade" id="modal-manage-reference-tag" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- modal-lg for more width -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Manage Tagging</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="manageReferenceTag_couponId">

                <!-- Section 1: Product Categories -->
                <div class="mb-4">
                    <h5 class="mb-2">Tag Product Categories</h5>
                    <select class="select2" id="manageReferenceTag_productCategories" multiple="multiple" data-placeholder="Select product categories" style="width: 100%;">
                    </select>
                </div>

                <!-- Section 2: Product Sub-categories -->
                <div class="mb-4">
                    <h5 class="mb-2">Tag Product Sub-categories</h5>
                    <select class="select2" id="manageReferenceTag_productSubCategories" multiple="multiple" data-placeholder="Select product sub-categories" style="width: 100%;">
                    </select>
                </div>

                <!-- Section 3: Products -->
                <div>
                    <h5 class="mb-2">Tag Products</h5>
                    <select class="select2" id="manageReferenceTag_products" multiple="multiple" data-placeholder="Select products" style="width: 100%;">
                    </select>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="onClickSubmitReferenceTag()">Save</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

        $('#manageReferenceTag_productCategories').select2({
            placeholder: 'Search and select product categores',
            multiple: true,
            minimumInputLength: 1,
            ajax: {
                transport: function(params, success, failure) {
                    const searchTerm = params.data.term;

                    postAPICall({
                        endPoint: "/product-category/list",
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
                                        id: el.productCategoryId,
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

        $('#manageReferenceTag_productSubCategories').select2({
            placeholder: 'Search and select staff members',
            multiple: true,
            minimumInputLength: 1,
            ajax: {
                transport: function(params, success, failure) {
                    const searchTerm = params.data.term;

                    postAPICall({
                        endPoint: "/product-subcategory/list",
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
                                        id: el.productSubCategoryId,
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

        $('#manageReferenceTag_products').select2({
            placeholder: 'Search and select staff members',
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

        $('#modal-manage-reference-tag').on('hidden.bs.modal', function() {
            document.getElementById("manageReferenceTag_couponId").value = "";
            $('#manageReferenceTag_productCategories').val(null).trigger('change');
            $('#manageReferenceTag_productSubCategories').val(null).trigger('change');
            $('#manageReferenceTag_products').val(null).trigger('change');
        });
    })

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
                            <td>${coupon.expiryDate ? formatDateWithoutTime(coupon.expiryDate) : "—"}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-coupon-id="${coupon.couponId}" ${coupon.status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td>
                                <div class="project-actions text-right d-flex justify-content-end" style="gap: 0.5rem;">
                                    <a class="btn btn-info btn-sm d-flex align-items-center" onclick="onClickManageReferenceTag(${coupon.couponId})">
                                        <i class="fas fa-pencil-alt mr-1">
                                        </i>
                                        Manage Tagging
                                    </a>
                                </div>
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
            expiryDate
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

    function prepopulateReferenceTagging({
        categories = [],
        subCategories = [],
        products = []
    }) {
        // Populate Product Categories
        categories.forEach(cat => {
            const option = new Option(cat.name, cat.productCategoryId, true, true);
            $('#manageReferenceTag_productCategories').append(option).trigger('change');
        });

        // Populate Product Sub-Categories
        subCategories.forEach(sub => {
            const option = new Option(sub.name, sub.productSubCategoryId, true, true);
            $('#manageReferenceTag_productSubCategories').append(option).trigger('change');
        });

        // Populate Products
        products.forEach(prod => {
            const option = new Option(prod.name, prod.productId, true, true);
            $('#manageReferenceTag_products').append(option).trigger('change');
        });
    }

    function onClickManageReferenceTag(couponId) {
        document.getElementById('manageReferenceTag_couponId').value = couponId

        $('#modal-manage-reference-tag').modal('show');

        const selectedCoupon = coupons.find((coupon) => Number(coupon.couponId) === Number(couponId))

        const categories = []
        const subCategories = []
        const products = []
        selectedCoupon.couponTags.forEach((couponTag) => {
            if (couponTag.referenceType === "product_category") {
                categories.push({
                    productCategoryId: Number(couponTag.referenceId),
                    name: couponTag.referenceData.name
                })
            }
            if (couponTag.referenceType === "product_sub_category") {
                subCategories.push({
                    productSubCategoryId: Number(couponTag.referenceId),
                    name: couponTag.referenceData.name
                })
            }
            if (couponTag.referenceType === "product") {
                products.push({
                    productId: Number(couponTag.referenceId),
                    name: couponTag.referenceData.name
                })
            }
        })

        prepopulateReferenceTagging({
            categories,
            subCategories,
            products
        })
    }

    async function onClickSubmitReferenceTag() {
        // Get values from form inputs
        let couponId = document.getElementById('manageReferenceTag_couponId').value.trim();
        couponId = Number(couponId)
        const selectedProductCategoryIds = $('#manageReferenceTag_productCategories').val();
        const selectedProductSubCategoryIds = $('#manageReferenceTag_productSubCategories').val();
        const selectedProductIds = $('#manageReferenceTag_products').val();

        if (!selectedProductCategoryIds?.length && !selectedProductSubCategoryIds?.length && !selectedProductIds?.length) {
            alert("Please select at least 1 tagging reference!")
            return
        }
        let payload = []
        for (let el of selectedProductCategoryIds) {
            payload.push({
                couponId,
                referenceType: "product_category",
                referenceId: Number(el)
            })
        }
        for (let el of selectedProductSubCategoryIds) {
            payload.push({
                couponId,
                referenceType: "product_sub_category",
                referenceId: Number(el)
            })
        }
        for (let el of selectedProductIds) {
            payload.push({
                couponId,
                referenceType: "product",
                referenceId: Number(el)
            })
        }

        if (confirm("Are you sure you want to update tagging for selected coupon?")) {
            await postAPICall({
                endPoint: "/coupon-tag/save",
                payload: JSON.stringify(payload),
                callbackSuccess: (response) => {
                    if (!response.success) {
                        toastr.error(response.message)
                    } else {
                        toastr.success(`Coupon tagging updated successfully`)
                        $('#modal-manage-reference-tag').modal('hide');
                    }
                    fetchCoupons()
                }
            })
        }
    }
</script>
<?= $this->endSection(); ?>