<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">All Orders</h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body p-0">
                <table id="dtOrdersList" class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 20%">
                                Order ID #
                            </th>
                            <th style="width: 30%">
                                Assigned Staff
                            </th>
                            <th>
                                Order Progress
                            </th>
                            <th style="width: 8%" class="text-center">
                                Status
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                    </tbody>
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

<script>
    $(document).ready(function() {
        fetchOrders()
    })

    async function fetchOrders() {
        await postAPICall({
            endPoint: "/order/list",
            payload: JSON.stringify({
                "filter": {
                },
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "createdAt",
                    "orderDir": "desc"
                }]
            }),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                const {success, message, data} = response

                if (success) {
                    console.log(`data ===`, data)
                    var html = ""

                    for (let order of data) {
                        let orderStatusClass = ""
                        switch (order.orderStatus) {
                            case "pending": orderStatusClass = "badge-secondary"

                            break

                            case "delivered": orderStatusClass = "badge-success"

                            break

                            default:
                        }

                        let assignedStaff = order.assignedStaff ?? []

                        html += `<tr>
                            <td>
                                #
                            </td>
                            <td>
                                <a>
                                    ${order.referenceNumber}
                                </a>
                                <br />
                                <small>
                                    Placed On: ${formatDate(order.createdAt)}
                                </small>
                            </td>
                            <td>
                                <ul class="list-inline">`
                        
                        for (let assignedStaffEl of assignedStaff) {
                            html += `<li class="list-inline-item">
                                <img alt="Avatar" class="table-avatar" src="../../dist/img/avatar.png">
                            </li>`
                        }
                        
                        html += `</ul>
                            </td>
                            <td class="project_progress">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57"
                                        aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                                    </div>
                                </div>
                                <small>
                                    57% Complete
                                </small>
                            </td>
                            <td class="project-state">
                                <span class="badge ${orderStatusClass}">${capitalizeFirstLetter(order.orderStatus)}</span>
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="/admin/orders/${order.orderId}">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a>
                            </td>
                        </tr>`;
                    }

                    // // Insert the generated table rows
                    document.getElementById("dataList").innerHTML = html;
                }
                loader.hide()
            }
        })
    }
</script>
<?= $this->endSection(); ?>