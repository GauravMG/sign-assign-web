<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<style>
    .list-action-container {
        display: flex;
        justify-content: space-around;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow">
            <div class="info-box-content">
                <span class="info-box-text">Total Tickets</span>
                <span class="info-box-number" id="statTotalTickets">0</span>
            </div>
            <span class="info-box-icon bg-info"><i class="fas fa-ticket-alt"></i></span>

        </div>

    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow">
            <div class="info-box-content">
                <span class="info-box-text">Open Tickets</span>
                <span class="info-box-number" id="statOpenTickets">0</span>
            </div>
            <span class="info-box-icon bg-info"><i class="fas fa-ticket-alt"></i></span>

        </div>

    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow">
            <div class="info-box-content">
                <span class="info-box-text">Pending Tickets</span>
                <span class="info-box-number" id="statPendingTickets">0</span>
            </div>
            <span class="info-box-icon bg-warning"><i class="far fa-clock"></i></span>

        </div>

    </div>

    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box shadow">
            <div class="info-box-content">
                <span class="info-box-text">Closed Tickets</span>
                <span class="info-box-number" id="statClosedTickets">0</span>
            </div>
            <span class="info-box-icon bg-success"><i class="far fa-check-circle"></i></span>

        </div>

    </div>

</div>

<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">All Support Tickets</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dtSupportTicketsList" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Requested By</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="dataList"></tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Requested By</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
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
<script src="<?= base_url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
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
        fetchSupportTickets()
    })

    function initializeDTUsersList() {
        $("#dtSupportTicketsList").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })
    }

    async function fetchSupportTickets() {
        if ($.fn.DataTable.isDataTable("#dtSupportTicketsList")) {
            $('#dtSupportTicketsList').DataTable().destroy()
        }

        await postAPICall({
            endPoint: "/support-ticket/list",
            payload: JSON.stringify({
                "filter": {},
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "createdAt",
                    "orderDir": "asc"
                }]
            }),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                if (response.success) {
                    const {
                        data,
                        stats
                    } = response

                    document.getElementById("statTotalTickets").innerText = formatINR(stats.totalTickets ?? 0)
                    document.getElementById("statOpenTickets").innerText = formatINR(stats.openTickets ?? 0)
                    document.getElementById("statPendingTickets").innerText = formatINR(stats.pendingTickets ?? 0)
                    document.getElementById("statClosedTickets").innerText = formatINR(stats.closedTickets ?? 0)

                    var html = ""

                    for (let i = 0; i < data?.length; i++) {
                        const ticketStatusBtnType = data[i].ticketStatus === "closed" ? "success" : data[i].ticketStatus === "pending" ? "warning" : "info"
                        console.log(`data[i].createdAt`, data[i].createdAt)
                        console.log(`formatDate(data[i].createdAt)`, formatDate(data[i].createdAt))

                        html += `<tr>
                            <td>#${i + 1}</td>
                            <td>${data[i].createdByUser?.fullName ?? "-"}</td>
                            <td>${data[i].subject}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-${ticketStatusBtnType}">${capitalizeFirstLetter(data[i].ticketStatus)}</button>
                                    <button type="button" class="btn btn-${ticketStatusBtnType} dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" onclick="onClickUpdateTicketStatus(${data[i].supportTicketId}, "open")">Open</a>
                                        <a class="dropdown-item" onclick="onClickUpdateTicketStatus(${data[i].supportTicketId}, "pending")">Pending</a>
                                        <a class="dropdown-item" onclick="onClickUpdateTicketStatus(${data[i].supportTicketId}, "closed")">Closed</a>
                                    </div>
                                </div>
                            </td>
                            <td>${formatDate(data[i].createdAt)}</td>
                            <td class="list-action-container">
                                <span onclick="onClickViewSupportTicket(${data[i].supportTicketId})"><i class="fa fa-eye view-icon"></i></span>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataList").innerHTML = html;

                    initializeDTUsersList()
                }
                loader.hide()
            }
        })
    }

    async function onClickUpdateTicketStatus(supportTicketId, ticketStatus) {
        if (confirm("Are you sure you want to update status of this ticket?")) {
            await postAPICall({
                endPoint: "/support-ticket/update",
                payload: JSON.stringify({
                    supportTicketId: Number(supportTicketId),
                    ticketStatus
                }),
                callbackSuccess: (response) => {
                    if (!response.success) {
                        toastr.error(response.message)
                        fetchSupportTickets()
                    } else {
                        toastr.success(`Support ticket status updated successfully`)
                    }
                }
            })
        }
    }

    function onClickViewSupportTicket(supportTicketId) {
        window.location.href = `/admin/support-tickets/${supportTicketId}`
    }
</script>
<?= $this->endSection(); ?>