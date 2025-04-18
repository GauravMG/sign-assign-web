<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<style>
    .red {
        color: red;
    }

    .green {
        color: green;
    }

    .bet-pair {
        border: 1px solid;
        margin: 5px;
        padding: 5px;
        display: inline-block;
        border-radius: 7px;
        text-align: center;
    }

    .image-icon {
        cursor: pointer;
        font-size: 24px;
        /* Increase icon size */
        color: #343a40;
        /* Set icon color */
        margin-left: 10px;
    }

    .image-icon:hover {
        color: #535c65;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Personal Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="text" class="form-control" id="firstName" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input type="text" class="form-control" id="lastName" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Email ID</label>
                            <input type="text" class="form-control" id="email" readonly>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="status">Mobile</label>
                                <input type="text" class="form-control" id="mobile" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="source">DOB</label>
                                <input type="text" class="form-control" id="dob" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
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
    <script>
        const userId = Number('<?php echo $data["userId"]; ?>')

        $(document).ready(function() {
            fetchUsers()
        })

        async function fetchUsers() {
            await Promise.all([
                postAPICall({
                    endPoint: "/user/list",
                    payload: JSON.stringify({
                        "filter": {
                            userId
                        }
                    }),
                    callbackComplete: () => {},
                    callbackSuccess: (response) => {
                        if (response.success) {
                            const data = response.data[0]

                            document.getElementById("firstName").value = data.firstName
                            document.getElementById("lastName").value = data.lastName
                            document.getElementById("email").value = data.email
                            document.getElementById("mobile").value = data.mobile
                            document.getElementById("dob").value = data.dob ? formatDateWithoutTime(data.dob) : ""
                        }
                        loader.hide()
                    }
                }),
            ])
        }

        async function fetchWallet() {
            if ($.fn.DataTable.isDataTable("#dtUserWalletList")) {
                $('#dtUserWalletList').DataTable().destroy()
            }

            await Promise.all([
                postAPICall({
                    endPoint: "/wallet/list",
                    payload: JSON.stringify({
                        filter: {
                            userId,
                        },
                        range: {
                            all: true,
                        },
                        sort: [{
                            orderBy: 'walletId',
                            orderDir: 'desc',
                        }],
                    }),
                    callbackComplete: () => {},
                    callbackSuccess: (response) => {
                        if (response.success) {
                            var html = ""

                            for (let i = 0; i < response.data?.length; i++) {
                                html += `<tr>
                                    <td>${i + 1}</td>
                                    <td class="${response.data[i].transactionType === 'credit' ? 'green' : 'red'}">${response.data[i].transactionType.toUpperCase()}</td>
                                    <td class="${response.data[i].transactionType === 'credit' ? 'green' : 'red'}">₹ ${response.data[i].amount}</td>
                                    <td>₹ ${response.data[i].remainingBalance}</td>
                                    <td>${formatDate(response.data[i].createdAt)}</td>
                                    <td>${response.data[i].remarks ?? ""}</td>
                                    <td>${(response.data[i].updatedAt ?? "").trim() !== "" ? formatDate(response.data[i].updatedAt) : ""}</td>
                                    <td>
                                        <div style="display: flex; justify-content: space-between;">
                                            <span>${response.data[i].approvalRemarks ?? ""}</span>
                                            ${(response.data[i].imageUrl ?? "").trim() !== "" ? `
                                                <span onclick="showImage('${response.data[i].imageUrl}')">
                                                    <i class="fa fa-image view-icon image-icon"></i>
                                                </span>
                                            ` : ""}
                                        </div>
                                    </td>
                                    <td>
                                        <div style="display: flex; justify-content: space-around;">
                                            ${response.data[i].approvalStatus === "pending" ? `
                                            <span class="green" onclick="onClickUpdateApprovalStatus(${response.data[i].walletId}, 'approved')"><i class="fa fa-check view-icon"></i></span>
                                            <span class="red" onclick="onClickUpdateApprovalStatus(${response.data[i].walletId}, 'rejected')"><i class="fa fa-times view-icon"></i></span>
                                            ` : `<span class="${response.data[i].approvalStatus === 'approved' ? 'green' : 'red'}">${response.data[i].approvalStatus.toUpperCase()} </span>`}
                                        </div>
                                    </td>
                                </tr>`
                            }

                            document.getElementById("dataWalletList").innerHTML = html

                            if ($.fn.DataTable.isDataTable("#dtUserWalletList")) {
                                $('#dtUserWalletList').DataTable().destroy()
                            }
                            initializeDTUserWalletList()
                        }
                        loader.hide()
                    }
                }),
            ])
        }
    </script>

    <?= $this->endSection(); ?>