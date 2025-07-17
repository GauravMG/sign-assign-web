<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="invoice p-3 mb-3">

            <div class="row">
                <div class="col-12">
                    <h4 style="display: flex; justify-content: center; align-items: center;">
                        <img src="<?= base_url('images/cropped-sign-assign_icon-32x32.jpg'); ?>" alt="Sign Assign" />
                        <span style="margin-right: auto;">Sign Assign</span>
                        <small class="float-right">Date: <span id="invoiceDate"></span></small>
                    </h4>
                </div>

            </div>

            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>Sign Assign</strong><br>
                        702 Shephar Dr<br>
                        garland, US 75042<br>
                        Phone: (972) 418-5253<br>
                        Email: orders@signassign.com
                    </address>
                </div>

                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong id="toName">John Doe</strong><br>
                        <span id="toAddress">795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107</span><br>
                        Phone: <span id="toPhone">(555) 539-1037</span><br>
                        Email: <span id="toEmail"><a href="mailto:orders@signassign.com" style="text-decoration: none; color: unset;">orders@signassign.com</a></span>
                    </address>
                </div>

                <div class="col-sm-4 invoice-col">
                    <b>Invoice #<span id="invoiceNumber">007612</span></b><br>
                    <br>
                    <b>Order ID:</b> <span id="orderReferenceNumber">4F3S8J</span><br>
                    <b>Payment Date:</b> <span id="paymentDate"></span><br>
                    <!-- <b>Account:</b> 968-34567 -->
                </div>

            </div>

            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>SKU #</th>
                                <th>Discount</th>
                                <th>Subtotal</th>
                                <th>Rush Charges</th>
                            </tr>
                        </thead>
                        <tbody id="orderProductList">
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row">

                <div class="col-6">
                    <p class="lead">Payment Method:</p>
                    <div id="paymentMethodBrandImage" style="display: flex; align-items: center;"></div>
                </div>

                <div class="col-6">
                    <!-- <p class="lead">Amount Due 2/22/2014</p> -->
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td id="subTotalAmount"></td>
                            </tr>
                            <!-- <tr>
                                <th>Tax (9.3%)</th>
                                <td>$10.34</td>
                            </tr> -->
                            <!-- <tr>
                                <th>Shipping:</th>
                                <td id="shipppingCharges"></td>
                            </tr> -->
                            <tr>
                                <th>Discount:</th>
                                <td id="totalDiscountAmount"></td>
                            </tr>
                            <tr>
                                <th>Rush Charges:</th>
                                <td id="totalRushCharges"></td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td id="grandTotalAmount"></td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>


            <div class="row no-print">
                <div class="col-12">
                    <!-- <a href="/admin/invoices/print" rel="noopener" target="_blank"
                        class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
                    <a onclick="printInvoice()" rel="noopener" target="_blank"
                        class="btn btn-primary float-right"><i class="fas fa-print"></i> Print</a>
                    <!-- <button type="button" class="btn btn-success float-right"><i
                            class="far fa-credit-card"></i> Submit
                        Payment
                    </button> -->
                    <!-- <button type="button" class="btn btn-primary float-right"
                        style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate PDF
                    </button> -->
                </div>
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
    const invoiceId = '<?= $data["invoiceId"]; ?>'
    let allProducts = []

    document.addEventListener("DOMContentLoaded", function() {
        if (invoiceId !== "") {
            fetchProducts()
        }
    })

    async function fetchProducts(orderId) {
        await postAPICall({
            endPoint: "/product/list",
            payload: JSON.stringify({
                "range": {
                    all: true
                }
            }),
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    allProducts = data

                    fetchInvoice()
                }
            }
        })
    }

    async function fetchInvoice() {
        await postAPICall({
            endPoint: "/invoice/list",
            payload: JSON.stringify({
                "filter": {
                    invoiceId: Number(invoiceId)
                },
                "range": {
                    "page": 1,
                    "pageSize": 1
                }
            }),
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    const invoice = data[0]
                    const invoiceData = typeof invoice.invoiceData === "string" ? JSON.parse(invoice.invoiceData) : invoice.invoiceData

                    const shippingAddressDetails = typeof invoiceData.shippingAddressDetails === "string" ? JSON.parse(invoiceData.shippingAddressDetails) : invoiceData.shippingAddressDetails

                    const amountDetails = typeof invoiceData.amountDetails === "string" ? JSON.parse(invoiceData.amountDetails) : invoiceData.amountDetails

                    const payloadOrderProduct = typeof invoiceData.payloadOrderProduct === "string" ? JSON.parse(invoiceData.payloadOrderProduct) : invoiceData.payloadOrderProduct

                    const orderTransaction = typeof invoiceData.orderTransaction === "string" ? JSON.parse(invoiceData.orderTransaction) : invoiceData.orderTransaction
                    const orderTransactionRequest = typeof orderTransaction.requestDataJson === "string" ? JSON.parse(orderTransaction.requestDataJson) : orderTransaction.requestDataJson
                    const orderTransactionResponse = typeof orderTransaction.responseDataJson === "string" ? JSON.parse(orderTransaction.responseDataJson) : orderTransaction.responseDataJson

                    document.getElementById("invoiceDate").innerText = formatDateWithoutTime(invoice.invoiceDate)

                    document.getElementById("invoiceNumber").innerText = invoice.invoiceNumber
                    document.getElementById("paymentDate").innerText = formatDateWithoutTime(orderTransaction.updatedAt)

                    document.getElementById("toName").innerText = createFullName(shippingAddressDetails)
                    document.getElementById("toAddress").innerText = formatAddress(shippingAddressDetails)
                    document.getElementById("toPhone").innerText = shippingAddressDetails.phoneNumber
                    document.getElementById("toEmail").innerHTML = orderTransactionRequest.receipt_email ?? ""

                    const adminLTECreditCardBrandImageDir = '<?= base_url('assets/adminlte/dist/img/credit/'); ?>'
                    const paymentMethodCardBrand = orderTransactionResponse?.source?.brand ?? null

                    document.getElementById("paymentMethodBrandImage").innerHTML = paymentMethodCardBrand ? `<img style="margin-right: 10px;" src="${adminLTECreditCardBrandImageDir}${paymentMethodCardBrand.toLowerCase()}.png" alt="${paymentMethodCardBrand}">` : ""
                    document.getElementById("paymentMethodBrandImage").innerHTML += orderTransactionResponse?.source?.last4 ? `**${orderTransactionResponse.source.last4}` : ""

                    document.getElementById("subTotalAmount").innerText = `$${amountDetails.subTotalPrice ?? 0}`
                    document.getElementById("totalDiscountAmount").innerText = `$${amountDetails.totalDiscount ?? 0}`
                    document.getElementById("totalRushCharges").innerText = `$${amountDetails.totalRushHourDeliveryAmount ?? 0}`
                    document.getElementById("grandTotalAmount").innerText = `$${amountDetails.grandTotalPrice ?? 0}`

                    let orderProductListHtml = ""
                    for (let el of payloadOrderProduct) {
                        el.dataJson = typeof el.dataJson === "string" ? JSON.parse(el.dataJson) : el.dataJson

                        const product = allProducts.find((product) => product.productId === Number(el.productId))

                        orderProductListHtml += `<tr>`
                        orderProductListHtml += `<td>${el.dataJson.quantity}</td>`
                        orderProductListHtml += `<td>${product.name}</td>`
                        orderProductListHtml += `<td>${product.sku}</td>`
                        orderProductListHtml += `<td>${(el.dataJson.totalDiscount ?? 0) > 0 ? `$${el.dataJson.totalDiscount}` : "-"}</td>`
                        orderProductListHtml += `<td>$${el.dataJson.payablePriceByQuantityAfterDiscount ?? 0}</td>`
                        orderProductListHtml += `<td>${el.dataJson.rushHourDelivery && (el.dataJson.rushHourDeliveryAmount ?? 0) > 0 ? `$${el.dataJson.rushHourDeliveryAmount}` : "-"}</td>`
                        orderProductListHtml += `</tr>`
                    }

                    document.getElementById("orderProductList").innerHTML = orderProductListHtml

                    fetchOrder()
                }
            }
        })
    }

    async function fetchOrder(orderId) {
        await postAPICall({
            endPoint: "/order/list",
            payload: JSON.stringify({
                "filter": {
                    orderId: Number(orderId)
                },
                "range": {
                    "page": 1,
                    "pageSize": 1
                }
            }),
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    const order = data[0]

                    document.getElementById("orderReferenceNumber").innerText = order.referenceNumber
                }
            }
        })
    }

    function printInvoice() {
        window.print()
    }
</script>
<?= $this->endSection(); ?>