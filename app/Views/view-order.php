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

                <!-- <div class="mb-4">
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

                <div class="mb-4">
                    <h5><strong>Staff Tasks</strong></h5>
                    <ul class="list-group" id="taskList"></ul>
                </div> -->

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

    document.addEventListener("DOMContentLoaded", function() {
        fetchOrder()

        /**
         * 
         * fetch(`/api/orders/${orderId}`)
            .then(res => res.json())
            .then(({
                data: order
            }) => {
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
                const source = order.transaction?.responseDataJson?.source ?? {};
                document.getElementById("cardBrand").innerText = source.brand ?? 'N/A';
                document.getElementById("cardLast4").innerText = source.last4 ?? 'N/A';
                document.getElementById("paymentStatus").innerText = order.transaction?.status ?? 'N/A';
                document.getElementById("amountPaid").innerText = order.amount ?? 0;

                // Assigned Staff
                const assignedStaffList = document.getElementById("assignedStaffList");
                (order.assignedStaff ?? []).forEach(staff => {
                    const li = document.createElement("li");
                    li.className = "list-group-item";
                    li.innerText = staff.name;
                    assignedStaffList.appendChild(li);
                });

                // Staff Dropdown for Task Assignment
                fetch(`/api/staff/list`)
                    .then(res => res.json())
                    .then(({
                        data: staffList
                    }) => {
                        const staffSelect = document.getElementById("staffSelect");
                        staffList.forEach(staff => {
                            const option = document.createElement("option");
                            option.value = staff.id;
                            option.text = staff.name;
                            staffSelect.appendChild(option);
                        });
                    });

                // Tasks
                renderTaskList(order.staffTasks ?? []);
            });
         */

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
        document.getElementById("addTaskForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const payload = {
                staff_id: document.getElementById("staffSelect").value,
                description: document.getElementById("taskDescription").value
            };
            fetch(`/api/orders/${orderId}/add-task`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(({
                    success,
                    data,
                    message
                }) => {
                    if (success) {
                        alert("Task added successfully");
                        renderTaskList(data.updatedTasks);
                        document.getElementById("addTaskForm").reset();
                    } else {
                        alert("Failed to add task: " + message);
                    }
                });
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
                    // order.orderProducts.forEach(orderProduct => {
                    //     const product = orderProduct.product;
                    //     const cartItem = orderProduct.dataJson;

                    //     if (!product) return;

                    //     let coverImage = null;

                    //     for (let k = 0; k < product?.productMedias?.length; k++) {
                    //         if (product.productMedias[k].mediaType.indexOf("image") >= 0 && (product.productMedias[k].mediaUrl ?? "").trim() !== "") {
                    //             coverImage = product.productMedias[k].mediaUrl;
                    //             break;
                    //         }
                    //     }

                    //     if ((coverImage ?? "").trim() === "") {
                    //         coverImage = `${BASE_URL}images/no-preview-available.jpg`;
                    //     }

                    //     const selectedAttrs = cartItem.selectedAttributes ?? [];

                    //     const attributesHtml = selectedAttrs.map(attr => {
                    //         let displayValue = attr.value;

                    //         if (attr.attribute?.type === "dimension") {
                    //             try {
                    //                 const val = JSON.parse(attr.value);
                    //                 displayValue = `${val.width} X ${val.height} (FT)`;
                    //             } catch (e) {
                    //                 displayValue = attr.value;
                    //             }
                    //         }

                    //         return `${attr.attribute?.name || 'Attribute'}: <span>${displayValue}</span>`;
                    //     }).join(" | ");

                    //     // Bulk Discount (optional, if needed for orders as well)
                    //     let bulkDiscountHeaderInnerHtml = "<th>Qty:</th>";
                    //     let bulkDiscountBodyInnerHtml = "<th>Discount:</th>";
                    //     if (product.productBulkDiscounts?.length) {
                    //         product.productBulkDiscounts.forEach((productBulkDiscount) => {
                    //             bulkDiscountHeaderInnerHtml += `<td>${productBulkDiscount.minQty}-${productBulkDiscount.maxQty}</td>`;
                    //             bulkDiscountBodyInnerHtml += `<td>${productBulkDiscount.discount}%</td>`;
                    //         });
                    //     }

                    //     const itemHtml = `<div class="box-inner">
                    //         <div class="inner">
                    //             <div class="left-area">
                    //                 <img alt="${product.name}" src="${coverImage}">
                    //                 <div>
                    //                     <h5>${product.name}</h5>
                    //                     <p>${attributesHtml}</p>
                    //                 </div>
                    //             </div>
                    //             <div class="right-area">
                    //                 <div class="qty-counter">
                    //                     <div class="left-area">
                    //                         <div class="price-container">
                    //                             ${cartItem.payablePriceByQuantity !== cartItem.payablePriceByQuantityAfterDiscount
                    //         ? `<h6 class="original-price">$${cartItem.payablePriceByQuantity.toFixed(2)}</h6>`
                    //         : ""}
                    //                             <h4 class="final-price">$${cartItem.payablePriceByQuantityAfterDiscount.toFixed(2)}</h4>
                    //                         </div>
                    //                     </div>
                    //                     <div class="right-area">
                    //                         <h6>Qty: ${cartItem.quantity}</h6>
                    //                     </div>
                    //                 </div>
                    //                 <p>Estimate Delivery</p>
                    //                 <h6>Wed, June 15, 2025</h6> <!-- Or fetch dynamically if you have order date -->
                    //             </div>
                    //         </div>

                    //         ${(product.productBulkDiscounts ?? []).length ? `<div class="bulk-qty-inner">
                    //             <div class="left-area">
                    //                 <p>Bulk Quantity Discount</p>
                    //                 <table class="table table-bordered">
                    //                     <tbody>
                    //                         <tr>${bulkDiscountHeaderInnerHtml}</tr>
                    //                         <tr>${bulkDiscountBodyInnerHtml}</tr>
                    //                     </tbody>
                    //                 </table>
                    //             </div>
                    //         </div>` : ""}
                    //     </div>`;

                    //     document.querySelector("#productList").insertAdjacentHTML("beforeend", itemHtml);
                    // });

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
                    const assignedStaffList = document.getElementById("assignedStaffList");
                    (data ?? []).forEach(staffMapping => {
                        const li = document.createElement("li");
                        li.className = "list-group-item";
                        li.innerText = createFullName(staffMapping.user);
                        assignedStaffList.appendChild(li);
                    });
                }
                loader.hide()
            }
        })
    }

    function openAddStaffModal() {
        const modal = new bootstrap.Modal(document.getElementById('addStaffModal'));
        modal.show();
    }

    // function renderTaskList(tasks) {
    //     const taskList = document.getElementById("taskList");
    //     taskList.innerHTML = "";
    //     tasks.forEach(task => {
    //         const li = document.createElement("li");
    //         li.className = "list-group-item d-flex justify-content-between align-items-center";
    //         li.innerHTML = `
    //         <div><strong>${task.staff_name}:</strong> ${task.description}</div>
    //         <span class="badge badge-${task.status === 'completed' ? 'success' : 'warning'}">
    //             ${capitalizeFirstLetter(task.status)}
    //         </span>`;
    //         taskList.appendChild(li);
    //     });
    // }
</script>
<?= $this->endSection(); ?>