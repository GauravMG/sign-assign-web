<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<style>
    .ticket-info-card {
        display: inline-block;
    }

    .ticket-info-card>*>.info-box-text {
        font-size: 15px;
    }

    .dropdown-item {
        cursor: pointer;
    }

    .ticket-info-card,
    .ticket-info-card .info-box-content {
        position: relative;
        overflow: visible !important;
        z-index: 1;
    }

    .dropdown-menu {
        z-index: 1050;
    }

    .download-icon-container {
        cursor: pointer;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-8">
        <div class="card card-dark card-tabs">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 id="subject"></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 p-0">
                        <div class="info-box shadow-none col-md-3 p-0 ticket-info-card">
                            <div class="info-box-content">
                                <span class="info-box-text">Requested By:</span>
                                <span class="info-box-number" id="createdByUserFullName"></span>
                            </div>

                        </div>

                        <div class="info-box shadow-none col-md-3 p-0 ticket-info-card">
                            <div class="info-box-content">
                                <span class="info-box-text">Created Date:</span>
                                <span class="info-box-number" id="createdDate"></span>
                            </div>

                        </div>

                        <div class="info-box shadow-none col-md-3 p-0 ticket-info-card">
                            <div class="info-box-content">
                                <span class="info-box-text">Updated Date:</span>
                                <span class="info-box-number" id="updatedDate"></span>
                            </div>

                        </div>

                        <div class="info-box shadow-none col-md-3 p-0 ticket-info-card">
                            <div class="info-box-content">
                                <span class="info-box-text">Status:</span>
                                <span class="info-box-number">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" id="ticketStatusText_<?= $data['supportTicketId']; ?>"></button>
                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" id="ticketStatusDropdown_<?= $data['supportTicketId']; ?>"
                                            data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" onclick="onClickUpdateTicketStatus(<?= $data['supportTicketId']; ?>, 'open')">Open</a>
                                            <a class="dropdown-item" onclick="onClickUpdateTicketStatus(<?= $data['supportTicketId']; ?>, 'pending')">Pending</a>
                                            <a class="dropdown-item" onclick="onClickUpdateTicketStatus(<?= $data['supportTicketId']; ?>, 'closed')">Closed</a>
                                        </div>
                                    </div>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Overview :</h3>
                    </div>
                    <div class="col-md-12">
                        <div id="description"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-dark card-tabs">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>File Attachment</h3>
                    </div>
                </div>
                <div class="row" id="attachmentContainer">
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
    let supportTicketId = '<?php if (isset($data)) {
                                echo $data["supportTicketId"];
                            } else {
                                echo "";
                            } ?>'
    supportTicketId = Number(supportTicketId)

    document.addEventListener("DOMContentLoaded", function() {
        if (supportTicketId !== "") {
            fetchSupportTickets()
        }
    })

    async function fetchSupportTickets() {
        await postAPICall({
            endPoint: "/support-ticket/list",
            payload: JSON.stringify({
                "filter": {
                    supportTicketId
                },
                "range": {},
                "sort": [{
                    "orderBy": "createdAt",
                    "orderDir": "asc"
                }]
            }),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                if (response.success) {
                    const {
                        data
                    } = response

                    const ticketStatusBtnType = data[0].ticketStatus === "closed" ? "success" : data[0].ticketStatus === "pending" ? "warning" : "info"

                    document.getElementById("subject").innerText = data[0]?.subject ?? "-"
                    document.getElementById("createdByUserFullName").innerText = data[0]?.createdByUser?.fullName ?? "-"
                    document.getElementById("createdDate").innerText = data[0]?.createdAt ? formatDate(data[0].createdAt) : "-"
                    document.getElementById("updatedDate").innerText = data[0]?.updatedAt ? formatDate(data[0].updatedAt) : "-"

                    let ticketStatusTextEl = document.getElementById(`ticketStatusText_${supportTicketId}`)
                    ticketStatusTextEl.innerText = capitalizeFirstLetter(data[0].ticketStatus)
                    ticketStatusTextEl.classList.forEach(className => {
                        if (className.startsWith('btn-')) {
                            ticketStatusTextEl.classList.remove(className);
                        }
                    });
                    ticketStatusTextEl.classList.add(`btn-${ticketStatusBtnType}`)

                    let ticketStatusDropdownEl = document.getElementById(`ticketStatusDropdown_${supportTicketId}`)
                    ticketStatusDropdownEl.classList.forEach(className => {
                        if (className.startsWith('btn-')) {
                            ticketStatusDropdownEl.classList.remove(className);
                        }
                    });
                    ticketStatusDropdownEl.classList.add(`btn-${ticketStatusBtnType}`)

                    document.getElementById("description").innerHTML = data[0]?.description ?? "-"

                    let attachmentHtml = ``

                    for (let i = 0; i < data[0]?.supportTicketMedias?.length ?? 0; i++) {
                        attachmentHtml += `<div class="col-12 mt-3 d-flex flex-row justify-content-between">
                            <div>
                                <span><i class="fa fa-image"></i></span>
                                <span>Wirefram-Escreenshots.Jpg</span>
                            </div>
                            <span class="download-icon-container"><i class="fa fa-download"></i></span>
                        </div>`
                    }

                    document.getElementById("attachmentContainer").innerHTML = attachmentHtml
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

                        const ticketStatusBtnType = ticketStatus === "closed" ? "success" : ticketStatus === "pending" ? "warning" : "info"

                        let ticketStatusTextEl = document.getElementById(`ticketStatusText_${supportTicketId}`)
                        ticketStatusTextEl.innerText = capitalizeFirstLetter(ticketStatus)
                        ticketStatusTextEl.classList.forEach(className => {
                            if (className.startsWith('btn-')) {
                                ticketStatusTextEl.classList.remove(className);
                            }
                        });
                        ticketStatusTextEl.classList.add(`btn-${ticketStatusBtnType}`)

                        let ticketStatusDropdownEl = document.getElementById(`ticketStatusDropdown_${supportTicketId}`)
                        ticketStatusDropdownEl.classList.forEach(className => {
                            if (className.startsWith('btn-')) {
                                ticketStatusDropdownEl.classList.remove(className);
                            }
                        });
                        ticketStatusDropdownEl.classList.add(`btn-${ticketStatusBtnType}`)
                    }
                }
            })
        }
    }
</script>

<?= $this->endSection(); ?>