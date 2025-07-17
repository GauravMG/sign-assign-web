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

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Manage Rush Charges</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="overlay-wrapper">
                    <div id="rush-hour-rate-list-loader" class="overlay">
                        <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                        <div class="text-bold pt-2">Loading...</div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0"></h4>
                        <button type="button" class="btn btn-success" id="addRushHourRateRow">
                            <i class="fas fa-plus"></i> Add Rush Charge Rate
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center align-middle" id="rushHourRateTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Min Price</th>
                                    <th>Max Price</th>
                                    <th>Charge Type</th>
                                    <th>Amount / Percentage</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="rushHourRateTableBody">
                                <!-- Dynamic rows -->
                            </tbody>
                        </table>

                        <div class="text-right mt-2">
                            <button class="btn btn-success" id="saveRushHourRatesBtn">Save Rush Charge Rates</button>
                        </div>
                    </div>
                </div>
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
        fetchRushHourRate()
    })

    const rushHourRateTableBody = document.getElementById('rushHourRateTableBody');
    const addRushHourRateRowBtn = document.getElementById('addRushHourRateRow');
    const saveRushHourRatesBtn = document.getElementById('saveRushHourRatesBtn');

    function createRushHourRateRow(minPrice = '', maxPrice = '', chargeType = 'flat', amount = '') {
        const row = document.createElement('tr');

        row.innerHTML = `
        <td><input type="number" class="form-control form-control-sm minPrice" step="0.01" value="${minPrice}" /></td>
        <td><input type="number" class="form-control form-control-sm maxPrice" step="0.01" value="${maxPrice}" /></td>
        <td>
            <select class="form-control form-control-sm chargeType">
            <option value="flat" ${chargeType === 'flat' ? 'selected' : ''}>Flat</option>
            <option value="percentage" ${chargeType === 'percentage' ? 'selected' : ''}>Percentage</option>
            </select>
        </td>
        <td><input type="number" class="form-control form-control-sm amount" step="0.01" value="${amount}" /></td>
        <td>
            <button class="btn btn-sm btn-danger delete-btn">Delete</button>
        </td>
        `;

        row.querySelector('.delete-btn').addEventListener('click', () => {
            row.remove();
        });

        rushHourRateTableBody.appendChild(row);
    }

    // Add new row on button click
    addRushHourRateRowBtn.addEventListener('click', () => {
        createRushHourRateRow();
    });

    async function fetchRushHourRate() {
        await postAPICall({
            endPoint: "/rush-hour-rate/list",
            payload: JSON.stringify({
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "minPrice",
                    "orderDir": "asc"
                }]
            }),
            callbackBeforeSend: function() {
                $('#rush-hour-rate-list-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#rush-hour-rate-list-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success && data?.length) {
                    data.forEach(d => createRushHourRateRow(
                        d.minPrice,
                        d.maxPrice,
                        d.chargeType,
                        d.amount
                    ));
                }
            }
        })
    }

    // Save all rush charge rate data to backend
    saveRushHourRatesBtn.addEventListener('click', async () => {
        const allRows = rushHourRateTableBody.querySelectorAll('tr');
        const rushHourRates = [];

        allRows.forEach(row => {
            const minPrice = row.querySelector('.minPrice').value;
            const maxPrice = row.querySelector('.maxPrice').value;
            const chargeType = row.querySelector('.chargeType').value;
            const amount = row.querySelector('.amount').value;

            if (minPrice || maxPrice || amount) {
                rushHourRates.push({
                    minPrice: parseFloat(minPrice),
                    maxPrice: maxPrice ? parseFloat(maxPrice) : null,
                    chargeType,
                    amount: parseFloat(amount)
                });
            }
        });

        if (confirm("Are you sure you want to update rush charge rates?")) {
            await postAPICall({
                endPoint: "/rush-hour-rate/update",
                payload: JSON.stringify(rushHourRates),
                callbackSuccess: (response) => {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                }
            })
        }
    });
</script>
<?= $this->endSection(); ?>