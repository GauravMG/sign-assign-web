<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="row" id="orderDetailsPage">
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Order Details</h3>
            </div>
            <div class="card-body">

                <div class="mb-4">
                    <h5><strong>Purchased Products</strong></h5>
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
                        </ul>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5><strong>Assigned Staff Members</strong></h5>
                        <button type="button" class="btn btn-dark btn-sm" onclick="openAddStaffModal()">
                            <i class="fa fa-plus me-1"></i> Add Staff Member
                        </button>
                    </div>
                    <ul class="list-group" id="assignedStaffList"></ul>
                </div>

                <div class="mb-4 d-none staffTaskContainer">
                    <h5><strong>Add Task</strong></h5>
                    <form id="addTaskForm">
                        <div class="form-group">
                            <label>Staff</label>
                            <select class="form-control" id="staffSelect"></select>
                        </div>
                        <div class="form-group">
                            <label>Task Description</label>
                            <textarea class="form-control" id="taskDescription" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Add Task</button>
                    </form>
                </div>

                <div class="mb-4 d-none staffTaskContainer">
                    <h5><strong>Staff Tasks</strong></h5>
                    <ul class="list-group" id="taskList"></ul>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Add Staff Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStaffModalLabel">Add Staff Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStaffForm">
                    <div class="mb-3">
                        <label for="staffName" class="form-label">Staff Name</label>
                        <select id="staffName" class="form-control" multiple="multiple" style="width: 100%;"></select>
                    </div>
                    <!-- You can add more fields here -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addStaffForm" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    const orderId = '<?= $data["orderId"]; ?>'
    let orderStaffMappingIds = []

    document.addEventListener("DOMContentLoaded", function() {
        fetchOrder()

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
                        window.location.reload()
                    } else {
                        alert(message)
                    }
                    loader.hide()
                }
            })
        });

        // Handle Add Task Form
        document.getElementById("addTaskForm").addEventListener("submit", async function(e) {
            e.preventDefault();
            const payload = {
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

            await postAPICall({
                endPoint: "/order-staff-task/create",
                payload: JSON.stringify(payload),
                callbackComplete: () => {},
                callbackSuccess: (response) => {
                    const {
                        success,
                        message
                    } = response

                    if (success) {
                        window.location.reload()
                    } else {
                        alert(message)
                    }
                    loader.hide()
                }
            })
        });
    });

    async function fetchOrder() {
        await postAPICall({
            endPoint: "/order/list",
            payload: JSON.stringify({
                "filter": {
                    orderId: Number(orderId)
                },
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
                    const order = data[0]

                    // Products
                    const productList = document.getElementById("productList");
                    order.orderProducts.forEach(product => {
                        const dataJson = typeof product.dataJson === "string" ? JSON.parse(product.dataJson) : product.dataJson;
                        const li = document.createElement("li");
                        li.className = "list-group-item d-flex justify-content-between align-items-center";
                        li.innerHTML = `${product.product.name} <span><strong>$${dataJson.payablePriceByQuantityAfterDiscount}</strong></span>`;
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

                    fetchOrderStaffMapping()

                }
                loader.hide()
            }
        })
    }

    async function fetchOrderStaffMapping() {
        await postAPICall({
            endPoint: "/order-staff-mapping/list",
            payload: JSON.stringify({
                "filter": {
                    orderId: Number(orderId)
                }
            }),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    const staffTaskElements = document.querySelectorAll('.staffTaskContainer');
                    if (data?.length) {
                        staffTaskElements.forEach(el => el.classList.remove('d-none'));
                    } else {
                        staffTaskElements.forEach(el => el.classList.add('d-none'));
                    }

                    const assignedStaffList = document.getElementById("assignedStaffList");
                    assignedStaffList.innerHTML = "";

                    const staffSelect = document.getElementById("staffSelect");
                    staffSelect.innerHTML = "";

                    // Populate both select and list
                    (data ?? []).forEach(staffMapping => {
                        const fullName = createFullName(staffMapping.user);

                        // Append to list
                        const li = document.createElement("li");
                        li.className = "list-group-item";
                        li.innerText = fullName;
                        assignedStaffList.appendChild(li);

                        // Append to select
                        const option = document.createElement("option");
                        option.value = staffMapping.orderStaffMappingId;
                        option.textContent = fullName;
                        staffSelect.appendChild(option);

                        orderStaffMappingIds.push(Number(staffMapping.orderStaffMappingId))
                    });

                    renderTaskList()
                }
                loader.hide()
            }
        })
    }

    function openAddStaffModal() {
        const modal = new bootstrap.Modal(document.getElementById('addStaffModal'));
        modal.show();
    }

    async function renderTaskList() {
        await postAPICall({
            endPoint: "/order-staff-task/list",
            payload: JSON.stringify({
                "filter": {
                    orderStaffMappingId: orderStaffMappingIds.map((orderStaffMappingId) => Number(orderStaffMappingId))
                }
            }),
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data: tasks
                } = response

                if (success) {
                    const taskList = document.getElementById("taskList");
                    taskList.innerHTML = "";
                    tasks.forEach(task => {
                        const li = document.createElement("li");
                        li.className = "list-group-item d-flex justify-content-between align-items-center";
                        li.innerHTML = `
                        <div><strong>${createFullName(task.orderStaffMapping.user)}:</strong> ${task.task}</div>
                        <span class="badge badge-${task.taskStatus === 'completed' ? 'success' : 'warning'}">
                            ${capitalizeFirstLetter(task.taskStatus)}
                        </span>`;
                        taskList.appendChild(li);
                    });
                }
                loader.hide()
            }
        })
    }
</script>
<?= $this->endSection(); ?>