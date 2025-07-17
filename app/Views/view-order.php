<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<style>
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

<?= $this->section('content'); ?>

<div class="row" id="orderDetailsPage">
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="order-details-tab" data-toggle="pill"
                            href="#order-details" role="tab"
                            aria-controls="order-details" aria-selected="true">Order Details</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="checklist-tab" data-toggle="pill"
                            href="#checklist" role="tab"
                            aria-controls="checklist" aria-selected="false">Assigned Staff & Checklist</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" id="invoice-list-tab" data-toggle="pill"
                            href="#invoice-list" role="tab"
                            aria-controls="invoice-list" aria-selected="false">Invoices</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                    <div class="tab-pane fade show active" id="order-details"
                        role="tabpanel" aria-labelledby="order-details-tab">
                        <div class="overlay-wrapper">
                            <div id="order-details-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="mb-4">
                                <div style="display: flex; justify-content: center; align-items: center;" class="mb-2">
                                    <h5 style="margin-right: auto;"><strong>Purchased Products</strong></h5>
                                    <a onclick="onClickEditOrder()"><button type="button" class="btn btn-dark">Edit Order</button></a>
                                </div>
                                <ul class="list-group" id="productList"></ul>
                            </div>

                            <div class="mb-4">
                                <h5><strong>Shipping Address</strong></h5>
                                <p id="shippingAddress"></p>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <h5><strong>Order Amount Details</strong></h5>
                                    <ul class="list-group">
                                        <li class="list-group-item">Subtotal: $<span id="subtotal"></span></li>
                                        <li class="list-group-item">Discount: $<span id="discount"></span></li>
                                        <li class="list-group-item">Grand Total: $<span id="grandTotal"></span></li>
                                    </ul>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <h5><strong>Payment Details</strong></h5>
                                    <ul class="list-group">
                                        <li class="list-group-item">Brand: <span id="cardBrand"></span></li>
                                        <li class="list-group-item">Card Last 4: <span id="cardLast4"></span></li>
                                        <!-- <li class="list-group-item">Status: <span id="paymentStatus"></span></li> -->
                                        <li class="list-group-item">Amount Paid: $<span id="amountPaid"></span></li>
                                        <li class="list-group-item">Transaction Date: <span id="transactionDate"></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="checklist"
                        role="tabpanel" aria-labelledby="checklist-tab">
                        <div class="overlay-wrapper">
                            <div id="checklist-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="card mb-4 d-none" id="assignedStaffMemberParent">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5><strong>Assigned Staff Members</strong></h5>
                                        <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#addStaffModal">
                                            <i class="fa fa-plus me-1"></i> Assign Staff Member
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-horizontal flex-wrap gap-2 border-0" id="assignedStaffList"></ul>
                                </div>
                            </div>

                            <div class="card">
                                <!-- Task List Section -->
                                <div class="card-header staffTaskContainer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5><strong>Tasks Checklist</strong></h5>
                                        <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#addTaskModal">+ Add Task</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="dtTasksList" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Staff Member</th>
                                                <th>Task</th>
                                                <th>Created On</th>
                                                <th>Completed On</th>
                                                <th>Time Taken</th>
                                                <th>Number of Members Required</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataList">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="invoice-list"
                        role="tabpanel" aria-labelledby="invoice-list-tab">
                        <div class="overlay-wrapper">
                            <div id="invoice-list-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Invoices</h4>
                                </div>
                            </div>

                            <table id="dtInvoiceList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="dataInvoiceList">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Link Staff Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addStaffForm">
                    <div class="mb-3">
                        <label for="staffName" class="form-label">Staff Name</label>
                        <select id="staffName" class="form-control" multiple="multiple" style="width: 100%;"></select>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" form="addStaffForm" class="btn btn-dark">Add</button>
            </div>
        </div>

    </div>

</div>

<!-- Add Task Modal -->
<div class="modal fade" id="addTaskModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Task</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Staff</label>
                    <select class="form-control" id="staffSelect"></select>
                </div>
                <div class="form-group mb-3">
                    <label>Task Description</label>
                    <textarea class="form-control" id="taskDescription" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-dark" onclick="onClickAddTask()">Add Task</button>
            </div>
        </div>

    </div>

</div>

<!-- Mark Task Completed Modal -->
<div class="modal fade" id="taskDetailsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Task Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Assigned To</label>
                    <select class="form-control" id="taskDetailsModalStaffSelect" disabled></select>
                </div>
                <div class="mb-3">
                    <label>Task Description</label>
                    <textarea class="form-control" id="taskDetailsModalTaskDescription" rows="2" disabled></textarea>
                </div>
                <div class="mb-3">
                    <label>Number of People Assigned</label>
                    <input type="number" class="form-control" id="taskDetailsModalPeopleAssigned" min="1" required>
                </div>
                <div class="mb-3">
                    <label>Remarks</label>
                    <textarea class="form-control" id="taskDetailsModalCompletionRemarksByStaff" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-success" onclick="onClickMarkTaskAsCompleted()">Mark as Completed</button>
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
    const orderId = '<?= $data["orderId"]; ?>'
    let orderStaffMappingIds = []
    const loggedInUserUserId = parseInt(userData.userId)
    const loggedInUserRoleId = parseInt(userData.roleId)

    document.addEventListener("DOMContentLoaded", function() {
        if (orderId !== "") {
            fetchOrder()
        }

        // Handle tab switching and show the loader for the active tab
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            // Get the target tab ID
            var targetTabId = $(e.target).attr('href') // This will give #lead-details, #manage-accounts, etc.

            // Hide all loaders
            $('.overlay').show()

            if (targetTabId.replace("#", "") === "order-details") {
                fetchOrder(targetTabId)
            } else if (targetTabId.replace("#", "") === "checklist") {
                fetchOrderStaffMapping(targetTabId)
            } else if (targetTabId.replace("#", "") === "invoice-list") {
                fetchInvoices(targetTabId)
            }
        })

        $('#addStaffModal').on('hidden.bs.modal', function() {
            // Clear Select2 selections
            $('#staffName').val(null).trigger('change');
        });

        $('#addTaskModal').on('hidden.bs.modal', function() {
            // Clear the select and textarea fields
            $('#staffSelect').val('').trigger('change'); // Use .trigger('change') if you're using Select2
            $('#taskDescription').val('');
        });

        $('#taskDetailsModal').on('hidden.bs.modal', function() {
            // Clear form fields
            $(this).removeAttr('data-order-staff-task-id'); // Remove task ID

            $('#taskDetailsModalStaffSelect').val('').trigger('change'); // if using Select2
            $('#taskDetailsModalTaskDescription').val('');
            $('#taskDetailsModalPeopleAssigned').val('');
            $('#taskDetailsModalCompletionRemarksByStaff').val('');
        });


        $('#staffName').select2({
            placeholder: 'Search and select staff members',
            multiple: true,
            minimumInputLength: 1,
            ajax: {
                transport: function(params, success, failure) {
                    const searchTerm = params.data.term;

                    postAPICall({
                        endPoint: "/user/list",
                        payload: JSON.stringify({
                            filter: {
                                roleId: [5],
                                search: searchTerm
                            }
                        }),
                        callbackSuccess: (response) => {
                            const {
                                success: isSuccess,
                                data
                            } = response;
                            if (isSuccess && Array.isArray(data)) {
                                success({
                                    results: data.map(staff => ({
                                        id: staff.userId,
                                        text: createFullName(staff)
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

        $('#addStaffForm').on('submit', async function(e) {
            e.preventDefault();

            const selectedStaffIds = $('#staffName').val();

            if (!selectedStaffIds?.length) {
                alert("Please select at least 1 staff member!")
                return
            }

            await postAPICall({
                endPoint: "/order-staff-mapping/create",
                payload: JSON.stringify(selectedStaffIds.map((selectedStaffId) => ({
                    orderId: Number(orderId),
                    userId: Number(selectedStaffId)
                }))),
                callbackComplete: () => {},
                callbackSuccess: (response) => {
                    const {
                        success,
                        message
                    } = response

                    if (success) {
                        $('#addStaffModal').modal('hide');
                        fetchOrderStaffMapping()
                    } else {
                        alert(message)
                    }
                    loader.hide()
                }
            })
        });

        document.getElementById('dataList').addEventListener('click', function(e) {
            if (e.target.closest('.edit-task-btn')) {
                e.preventDefault();

                const btn = e.target.closest('.edit-task-btn');
                const orderStaffTaskId = btn.dataset.orderStaffTaskId;
                const orderStaffMappingId = btn.dataset.orderStaffMappingId;
                const taskText = decodeURIComponent(btn.dataset.task);

                // Pre-fill modal values
                $('#staffSelect').val(orderStaffMappingId).trigger('change');
                $('#taskDescription').val(taskText);

                // Store orderStaffTaskId to identify it's an edit
                $('#addTaskModal').attr('data-order-staff-task-id', orderStaffTaskId);

                // Update button text
                $('#addTaskModal .btn-dark').text('Update Task');

                // Show modal
                $('#addTaskModal').modal('show');
            }

            if (e.target.closest('.view-task-btn')) {
                e.preventDefault();

                const btn = e.target.closest('.view-task-btn');
                const orderStaffTaskId = btn.dataset.orderStaffTaskId;
                const orderStaffMappingId = btn.dataset.orderStaffMappingId;
                const task = decodeURIComponent(btn.dataset.task || '');
                const numberOfPeople = btn.dataset.numberOfPeople || '';
                const remarksByStaff = decodeURIComponent(btn.dataset.remarksByStaff || '');

                // Pre-fill the modal fields
                $('#taskDetailsModalStaffSelect').val(orderStaffMappingId).trigger('change');
                $('#taskDetailsModalTaskDescription').val(task);
                $('#taskDetailsModalPeopleAssigned').val(numberOfPeople);
                $('#taskDetailsModalCompletionRemarksByStaff').val(remarksByStaff);

                // Optionally store orderStaffTaskId for submit action
                $('#taskDetailsModal').attr('data-order-staff-task-id', orderStaffTaskId);

                // Show modal
                $('#taskDetailsModal').modal('show');
            }
        });

    });

    function initializeDTTasksList() {
        $("#dtTasksList").DataTable({
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

    function initializeDTInvoiceList() {
        $("#dtInvoiceList").DataTable({
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

    async function fetchOrder() {
        await postAPICall({
            endPoint: "/order/list",
            payload: JSON.stringify({
                "filter": {
                    orderId: Number(orderId)
                },
                linkedEntities: true
            }),
            callbackBeforeSend: function() {
                $('#order-details-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#order-details-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    let order = data[0]
                    order.amountDetails = typeof order.amountDetails === "string" ? JSON.parse(order.amountDetails) : order.amountDetails

                    // Products
                    const productList = document.getElementById("productList");
                    productList.innerHTML = ""
                    order.orderProducts.forEach(orderProduct => {
                        const product = orderProduct.product;
                        if (!product) return;

                        let coverImage = null

                        for (let k = 0; k < product?.productMedias?.length; k++) {
                            if (product.productMedias[k].mediaType.indexOf("image") >= 0 && (product.productMedias[k].mediaUrl ?? "").trim() !== "") {
                                coverImage = product.productMedias[k].mediaUrl
                                break
                            }
                        }

                        if ((coverImage ?? "").trim() === "") {
                            coverImage = `${BASE_URL}images/no-preview-available.jpg`
                        }

                        const dataJson = typeof orderProduct.dataJson === "string" ? JSON.parse(orderProduct.dataJson) : orderProduct.dataJson;

                        const selectedAttrs = dataJson.selectedAttributes;

                        // Dynamically create HTML for selected attributes
                        const attributesHtml = selectedAttrs.map(attr => {
                            let displayValue = attr.value;

                            if (attr.attribute.type === "dimension") {
                                try {
                                    const val = JSON.parse(attr.value);
                                    displayValue = `${val.width} X ${val.height} (FT)`;
                                } catch (e) {
                                    displayValue = attr.value;
                                }
                            }

                            return `<strong>${attr.attribute.name}:</strong> <span>${displayValue}</span>`;
                        }).join("<br>");

                        const li = document.createElement("li");
                        li.className = "list-group-item d-flex justify-content-between align-items-center";
                        li.className = "list-group-item"
                        li.innerHTML = `<div class="row align-items-center justify-space-between">
                            
                            <!-- Column 1: Image -->
                            <div class="col-auto">
                                <img src="${coverImage}" alt="${product.name}" style="width: 150px; height: auto;">
                            </div>

                            <!-- Column 2: Product Info -->
                            <div class="col">
                                <div class="fw-bold">${product.name}</div>
                                <div class="text-muted small">${attributesHtml}</div>
                            </div>

                            <!-- Column 3: Price Info -->
                            <div class="text-end">
                                <div><strong>Price:</strong> $${dataJson.payablePriceByQuantityAfterDiscount}</div>
                                <div><strong>Qty:</strong> ${dataJson.quantity}</div>
                            </div>

                        </div>`

                        productList.appendChild(li);
                    });

                    // Shipping Address
                    document.getElementById("shippingAddress").innerText = formatAddressWithName(order.shippingAddressDetails);

                    // Amount
                    document.getElementById("subtotal").innerText = order.amountDetails?.subTotalPrice ?? 0;
                    document.getElementById("discount").innerText = order.amountDetails?.businessDiscountPrice ?? 0;
                    document.getElementById("grandTotal").innerText = order.amountDetails?.grandTotalPrice ?? 0;

                    // Payment
                    let transactionResponseDataJson = order.transaction?.responseDataJson ?? null;
                    if (transactionResponseDataJson && typeof transactionResponseDataJson === "string") {
                        transactionResponseDataJson = JSON.parse(transactionResponseDataJson)
                    }
                    document.getElementById("cardBrand").innerText = transactionResponseDataJson?.source?.brand ?? 'N/A';
                    document.getElementById("cardLast4").innerText = transactionResponseDataJson?.source?.last4 ?? 'N/A';
                    // document.getElementById("paymentStatus").innerText = order.transaction?.status ?? 'N/A';
                    document.getElementById("amountPaid").innerText = order.amount ?? 0;
                    document.getElementById("transactionDate").innerText = new Date(
                        transactionResponseDataJson?.created
                    ).toLocaleString();

                }
                loader.hide()
            }
        })
    }

    async function fetchOrderStaffMapping() {
        let payloadFilter = {
            orderId: Number(orderId)
        }
        if (loggedInUserRoleId !== 1) {
            payloadFilter = {
                ...payloadFilter,
                userId: loggedInUserUserId
            }
        }

        await postAPICall({
            endPoint: "/order-staff-mapping/list",
            payload: JSON.stringify({
                "filter": {
                    ...payloadFilter
                },
                range: {
                    all: true
                },
                "sort": [{
                    "orderBy": "createdAt",
                    "orderDir": "desc"
                }]
            }),
            callbackBeforeSend: function() {
                $('#checklist-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#checklist-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    orderStaffMappingIds = []

                    const assignedStaffList = document.getElementById("assignedStaffList");
                    assignedStaffList.innerHTML = "";

                    const staffSelect = document.getElementById("staffSelect");
                    staffSelect.innerHTML = "";

                    const taskDetailsModalStaffSelect = document.getElementById("taskDetailsModalStaffSelect");
                    taskDetailsModalStaffSelect.innerHTML = "";

                    // Populate both select and list
                    data.forEach(staffMapping => {
                        const fullName = createFullName(staffMapping.user);

                        orderStaffMappingIds.push(Number(staffMapping.orderStaffMappingId))

                        // Append to list
                        const li = document.createElement("li");
                        li.className = "list-group-item border-0 p-0 mr-2";

                        const pill = document.createElement("span");
                        pill.className = "badge bg-warning text-white rounded-pill d-flex align-items-center pe-2 p-2";
                        pill.style.fontSize = "0.9rem";

                        pill.innerHTML = `
                        <span class="me-2">${fullName}</span>
                        <span class="badge bg-dark text-white rounded-pill d-flex align-items-center pe-2 p-2 ml-2 button"></span>
                        `;

                        // Optional: handle remove logic
                        pill.querySelector(".button").addEventListener("click", () => {
                            onClickRemoveOrderStaffMapping(staffMapping.orderStaffMappingId)
                        });

                        li.appendChild(pill);
                        assignedStaffList.appendChild(li);

                        // Append to select
                        const option = document.createElement("option");
                        option.value = staffMapping.orderStaffMappingId;
                        option.textContent = fullName;
                        staffSelect.appendChild(option);

                        // Append to select
                        const optionTaskDetailsModalStaffSelect = document.createElement("option");
                        optionTaskDetailsModalStaffSelect.value = staffMapping.orderStaffMappingId;
                        optionTaskDetailsModalStaffSelect.textContent = fullName;
                        taskDetailsModalStaffSelect.appendChild(optionTaskDetailsModalStaffSelect);
                    });

                    renderTaskList()

                    if (loggedInUserRoleId === 1) {
                        document.getElementById("assignedStaffMemberParent").classList.remove("d-none")
                    } else {
                        document.getElementById("assignedStaffMemberParent").classList.add("d-none")
                    }
                }
                loader.hide()
            }
        })
    }

    async function onClickRemoveOrderStaffMapping(orderStaffMappingId) {
        if (confirm("Are you sure you want to remove selected staff member from this order?")) {
            await postAPICall({
                endPoint: "/order-staff-mapping/delete",
                payload: JSON.stringify({
                    orderStaffMappingIds: [Number(orderStaffMappingId)]
                }),
                callbackSuccess: (response) => {
                    const {
                        success,
                        message
                    } = response

                    if (success) {
                        toastr.success(message);
                        fetchOrderStaffMapping()
                    } else {
                        toastr.error(message);
                    }
                    loader.hide()
                }
            })
        }
    }

    async function renderTaskList() {
        if ($.fn.DataTable.isDataTable("#dtTasksList")) {
            $('#dtTasksList').DataTable().destroy()
        }

        if (orderStaffMappingIds?.length) {

            await postAPICall({
                endPoint: "/order-staff-task/list",
                payload: JSON.stringify({
                    "filter": {
                        orderStaffMappingId: orderStaffMappingIds.map((orderStaffMappingId) => Number(orderStaffMappingId)),
                    },
                    range: {
                        all: true
                    },
                    sort: [{
                            orderBy: "orderStaffMappingId",
                            orderDir: "asc"
                        },
                        {
                            orderBy: "createdAt",
                            orderDir: "asc"
                        }
                    ]
                }),
                callbackSuccess: (response) => {
                    const {
                        success,
                        message,
                        data: tasks
                    } = response

                    if (success) {
                        let html = ``

                        tasks.forEach(task => {
                            html += `<tr>
                                <td>${createFullName(task.orderStaffMapping.user)}</td>
                                <td>${task.task}</td>
                                <td>${formatDate(task.createdAt)}</td>
                                <td>${task.taskStatus === "completed" ? formatDate(task.updatedAt) : "-"}</td>
                                <td>${task.taskStatus === "completed" ? getDateTimeDifference(task.createdAt, task.updatedAt) : "-"}</td>
                                <td>${task.numberOfPeople ?? "-"}</td>
                                <td class="project-state">
                                    <span class="badge badge-${task.taskStatus === 'completed' ? 'success' : 'secondary'}">${capitalizeFirstLetter(task.taskStatus)}</span>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm view-task-btn"
                                        data-order-staff-task-id="${task.orderStaffTaskId}"
                                        data-order-staff-mapping-id="${task.orderStaffMappingId}"
                                        data-task="${encodeURIComponent(task.task)}"
                                        data-number-of-people="${task.numberOfPeople || ''}"
                                        data-remarks-by-staff="${encodeURIComponent(task.remarksByStaff || '')}">
                                        <i class="fas fa-folder"></i> View
                                    </a>
                                    ${task.taskStatus !== 'completed' ? `<a class="btn btn-info btn-sm edit-task-btn"
                                        data-order-staff-task-id="${task.orderStaffTaskId}"
                                        data-order-staff-mapping-id="${task.orderStaffMappingId}"
                                        data-task="${encodeURIComponent(task.task)}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" onclick="onClickDeleteOrderStaffTask(${task.orderStaffTaskId})">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>` : ""}
                                </td>
                            </tr>`
                        });

                        // Insert the generated table rows
                        document.getElementById("dataList").innerHTML = html;

                        initializeDTTasksList()
                    }
                    loader.hide()
                }
            })
        }
    }

    async function onClickAddTask() {
        const orderStaffTaskId = $('#addTaskModal').attr('data-order-staff-task-id');

        let payload = {
            orderStaffMappingId: document.getElementById("staffSelect").value,
            task: document.getElementById("taskDescription").value
        };

        if (!payload.orderStaffMappingId) {
            alert("Please select at least 1 staff member!")
            return
        }

        if (!payload.task.length) {
            alert("Please enter task description!")
            return
        }

        payload.orderStaffMappingId = Number(payload.orderStaffMappingId)

        await postAPICall({
            endPoint: `/order-staff-task/${orderStaffTaskId ? "update" : "create"}`,
            payload: JSON.stringify(orderStaffTaskId ? {
                ...payload,
                orderStaffTaskId: Number(orderStaffTaskId)
            } : {
                ...payload
            }),
            callbackSuccess: (response) => {
                const {
                    success,
                    message
                } = response

                if (success) {
                    $('#addTaskModal').modal('hide');
                    renderTaskList()
                } else {
                    alert(message)
                }
                loader.hide()
            }
        })
    }

    async function onClickMarkTaskAsCompleted() {
        const orderStaffTaskId = $('#taskDetailsModal').attr('data-order-staff-task-id');

        const numberOfPeople = document.getElementById("taskDetailsModalPeopleAssigned").value.trim();
        const remarksByStaff = document.getElementById("taskDetailsModalCompletionRemarksByStaff").value.trim();

        // Validate number of people
        if (!numberOfPeople || isNaN(numberOfPeople) || Number(numberOfPeople) < 1) {
            alert("Please enter a valid number of people assigned (minimum 1)!");
            return;
        }

        // Validate remarks
        if (!remarksByStaff) {
            alert("Please enter remarks for task completion!");
            return;
        }

        // Prepare payload
        const payload = {
            orderStaffTaskId: Number(orderStaffTaskId),
            numberOfPeople: Number(numberOfPeople),
            remarksByStaff,
            taskStatus: "completed"
        };

        if (confirm("Are you sure you want to mark the task as completed?")) {
            await postAPICall({
                endPoint: `/order-staff-task/update`,
                payload: JSON.stringify(payload),
                callbackSuccess: (response) => {
                    const {
                        success,
                        message
                    } = response

                    if (success) {
                        $('#taskDetailsModal').modal('hide');
                        renderTaskList()
                    } else {
                        alert(message)
                    }
                    loader.hide()
                }
            })
        }
    }

    async function onClickDeleteOrderStaffTask(orderStaffTaskId) {
        if (confirm("Are you sure you want to delete the selected task for the staff member?")) {
            await postAPICall({
                endPoint: "/order-staff-task/delete",
                payload: JSON.stringify({
                    orderStaffTaskIds: [Number(orderStaffTaskId)]
                }),
                callbackSuccess: (response) => {
                    const {
                        success,
                        message
                    } = response

                    if (success) {
                        toastr.success(message);
                        renderTaskList()
                    } else {
                        toastr.error(message);
                    }
                    loader.hide()
                }
            })
        }
    }

    async function fetchInvoices() {
        await postAPICall({
            endPoint: "/invoice/list",
            payload: JSON.stringify({
                "filter": {
                    orderId: Number(orderId)
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
                $('#invoice-list-loader').fadeIn()
                if ($.fn.DataTable.isDataTable("#dtInvoiceList")) {
                    $('#dtInvoiceList').DataTable().destroy()
                }
            },
            callbackComplete: function() {
                $('#invoice-list-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    var html = ""

                    for (let el of data) {
                        html += `<tr>
                            <td>${el.invoiceNumber ?? ""}</td>
                            <td>
                                <div class="project-actions text-right d-flex justify-content-end" style="gap: 0.5rem;">
                                    <a class="btn btn-primary btn-sm d-flex align-items-center" onclick="onClickViewInvoice(${el.invoiceId})">
                                        <i class="fas fa-print mr-1">
                                        </i>
                                        Download / Print
                                    </a>
                                </div>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataInvoiceList").innerHTML = html;

                    initializeDTInvoiceList()
                }

                loader.hide()
            }
        })
    }

    function onClickViewInvoice(invoiceId) {
        window.location.href = `/admin/invoices/${invoiceId}`
    }

    async function onClickEditOrder() {
        await postAPICall({
            endPoint: `/order/user-token-by-order`,
            payload: JSON.stringify({
                orderId: Number(orderId)
            }),
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    jwtToken
                } = response

                if (success) {
                    window.location.href = `/checkout-update?orderId=${orderId}&userToken=${jwtToken}`
                }
            }
        })
    }
</script>
<?= $this->endSection(); ?>