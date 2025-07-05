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

    .media-card {
        width: 20rem;
        margin: 10px;
        cursor: move;
    }

    .media-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .media-card img,
    .media-card video {
        max-width: 100%;
        border-radius: 8px;
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
                        <a class="nav-link active" id="discount-list-tab" data-toggle="pill"
                            href="#discount-list" role="tab"
                            aria-controls="discount-list" aria-selected="true">Discounts</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                    <div class="tab-pane fade show active" id="discount-list" role="tabpanel" aria-labelledby="discount-list-tab">
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
    const productId = '<?php if (isset($data)) {
                            echo $data["productId"];
                        } else {
                            echo "";
                        } ?>'

    document.addEventListener("DOMContentLoaded", function() {
        if (productId !== "") {
            fetchProductBulkDiscount()
        }

        // Handle tab switching and show the loader for the active tab
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            // Get the target tab ID
            var targetTabId = $(e.target).attr('href') // This will give #lead-details, #manage-accounts, etc.

            // Hide all loaders
            $('.overlay').show()

            if (targetTabId.replace("#", "") === "discount-list") {
                fetchProductBulkDiscount(targetTabId)
            }
        })
    });

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