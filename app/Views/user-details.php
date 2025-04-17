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
            <div class="col-md-3">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Personal Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="fullName" placeholder="Enter full name" readonly>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="status">Mobile</label>
                                <input type="text" class="form-control" id="mobile" placeholder="Enter mobile" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="source">DOB</label>
                                <input type="text" class="form-control" id="dob" placeholder="Enter dob" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">UPI Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="upiName" placeholder="Enter UPI name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">UPI ID</label>
                            <input type="text" class="form-control" id="upiID" placeholder="Enter UPI ID" readonly>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Bank Account Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Beneficiary Name</label>
                                <input type="text" class="form-control" id="beneficiaryName" placeholder="Enter beneficiary name" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Account Number</label>
                                <input type="text" class="form-control" id="accountNumber" placeholder="Enter account number" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Bank Name</label>
                                <input type="text" class="form-control" id="bankName" placeholder="Enter bank name" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">IFSC Code</label>
                                <input type="text" class="form-control" id="ifscCode" placeholder="Enter IFSC code" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-dark card-tabs">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="wallet-tab" data-toggle="pill" href="#wallet" role="tab" aria-controls="wallet" aria-selected="true">Wallet</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="bid-history-tab" data-toggle="pill" href="#bid-history" role="tab" aria-controls="bid-history" aria-selected="false">Bid History</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-five-tabContent">
                            <div class="tab-pane fade show active" id="wallet" role="tabpanel" aria-labelledby="wallet-tab">
                                <div class="overlay-wrapper">
                                    <table id="dtUserWalletList" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Transaction Type</th>
                                                <th>Amount</th>
                                                <th>Remaining Balance</th>
                                                <th>Transaction Date</th>
                                                <th>Remarks</th>
                                                <th>Updated Date</th>
                                                <th>Approval / Rejection Remarks</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataWalletList">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Transaction Type</th>
                                                <th>Amount</th>
                                                <th>Remaining Balance</th>
                                                <th>Transaction Date</th>
                                                <th>Remarks</th>
                                                <th>Updated Date</th>
                                                <th>Approval / Rejection Remarks</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="bid-history" role="tabpanel" aria-labelledby="bid-history-tab">
                                <div class="overlay-wrapper">
                                    <table id="dtUserBidHistoryList" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Game Name</th>
                                                <th>Bet Placed On</th>
                                                <th>Total Bid Amount</th>
                                                <th>Numbers</th>
                                                <th>Bet Status</th>
                                                <th>Total Winnings</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataBidHistoryList">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Game Name</th>
                                                <th>Bet Placed On</th>
                                                <th>Total Bid Amount</th>
                                                <th>Numbers</th>
                                                <th>Bet Status</th>
                                                <th>Total Winnings</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->

        <!-- Modal for Remarks and File Upload -->
        <div class="modal fade" id="remarksModal" tabindex="-1" role="dialog" aria-labelledby="remarksModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="remarksModalLabel">Rejection Remarks</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="walletIdInput">
                        <textarea id="remarksInput" class="form-control" placeholder="Enter remarks..." required></textarea>
                        <br>
                        <label for="imageInput">Upload Image (Optional):</label>
                        <input type="file" id="imageInput" class="form-control" accept="image/*">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="submitRejection()">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imagePreviewModalLabel">Image Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="previewImage" src="" class="img-fluid" style="max-width: 100%;" />
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
    <script>
        const userId = Number('<?php echo $data["userId"]; ?>')

        $(document).ready(function() {
            fetchUsers()
            fetchWallet()
        })

        function showImage(imageUrl) {
            $("#previewImage").attr("src", imageUrl);
            $("#imagePreviewModal").modal("show");
        }

        function initializeDTUserWalletList() {
            $("#dtUserWalletList").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            })
        }

        function initializeDTUserBidHistoryList() {
            $("#dtUserBidHistoryList").DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            })
        }

        function calculateFinalBetStatusAndWinningAmount(gameObject) {
            const {
                bets
            } = gameObject;

            let betStatus = '';
            let winningAmount = 0;
            let hasWon = false;
            let allLost = true;

            for (const bet of bets) {
                if (bet.betStatus === 'won') {
                    hasWon = true;
                    winningAmount += Number(bet.winningAmount);
                }
                if (bet.betStatus !== 'lost') {
                    allLost = false;
                }
            }

            if (hasWon) {
                betStatus = 'won';
            } else if (allLost) {
                betStatus = 'lost';
            }

            return {
                betStatus,
                winningAmount,
            };
        }

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

                            document.getElementById("fullName").value = data.fullName
                            document.getElementById("mobile").value = data.mobile
                            document.getElementById("dob").value = formatDateWithoutTime(data.dob)
                        }
                        loader.hide()
                    }
                }),

                postAPICall({
                    endPoint: "/user-bank-detail/list",
                    payload: JSON.stringify({
                        "filter": {
                            userId
                        }
                    }),
                    callbackComplete: () => {},
                    callbackSuccess: (response) => {
                        if (response.success) {
                            for (let i = 0; i < response.data?.length; i++) {
                                const data = response.data[i]

                                switch (data.accountType) {
                                    case "upi":
                                        document.getElementById("upiName").value = data.accountHolderName
                                        document.getElementById("upiID").value = data.accountNumber

                                        break

                                    case "bank_saving":
                                        document.getElementById("beneficiaryName").value = data.accountHolderName
                                        document.getElementById("accountNumber").value = data.accountNumber
                                        document.getElementById("bankName").value = data.bankName
                                        document.getElementById("ifscCode").value = data.ifscCode

                                        break
                                }
                            }
                        }
                        loader.hide()
                    }
                }),

                postAPICall({
                    endPoint: "/game/list-user-bet",
                    payload: JSON.stringify({
                        filter: {
                            userId,
                        },
                        range: {
                            all: true,
                        },
                        sort: [{
                            orderBy: 'createdAt',
                            orderDir: 'desc',
                        }],
                    }),
                    callbackComplete: () => {},
                    callbackSuccess: (response) => {
                        if (response.success) {
                            var html = ""

                            for (let i = 0; i < response.data?.length; i++) {
                                response.data[i] = {
                                    ...response.data[i],
                                    ...calculateFinalBetStatusAndWinningAmount(response.data[i])
                                }

                                html += `<tr class="${response.data[i].betStatus === 'won' ? 'green' : response.data[i].betStatus === 'lost' ? 'red' : ''}">
                                    <td>${i + 1}</td>
                                    <td>${response.data[i].game?.name ?? "-"} (${response.data[i].pairType.toUpperCase()})</td>
                                    <td>${formatDate(response.data[i].bets[0]?.createdAt)}</td>
                                    <td>₹ ${response.data[i].bets.map((bet) => Number(bet.betAmount)).reduce((acc, curr) => acc + curr, 0)}</td>
                                    <td><ul>`

                                if (response.data[i].bets?.length) {
                                    response.data[i].bets.map((bet) => {
                                        html += `<span class="bet-pair ${bet.betStatus === 'lost' ? 'red' : bet.betStatus === 'won' ? 'green' : ''}">${bet.betNumber} : ₹ ${bet.betAmount}${["won"].indexOf(bet.betStatus) >= 0 ? `<br>${bet.betStatus.toUpperCase()} ₹ ${bet.winningAmount}` : ""}</span>`
                                    })
                                }

                                html += `</ul></td>
                                    <td>${['won', 'lost'].includes(response.data[i].betStatus) ? response.data[i].betStatus.toUpperCase() : ''}</td>
                                    <td>₹ ${response.data[i].bets.reduce((sum, bet) => {
                                        return Number(sum) + Number(bet.winningAmount);
                                    }, 0)}</td>
                                </tr>`
                            }

                            document.getElementById("dataBidHistoryList").innerHTML = html

                            if ($.fn.DataTable.isDataTable("#dtUserBidHistoryList")) {
                                $('#dtUserBidHistoryList').DataTable().destroy()
                            }
                            initializeDTUserBidHistoryList()
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

        async function onClickUpdateApprovalStatus(walletId, approvalStatus) {
            // Ask for remarks if the status is 'rejected'
            if (approvalStatus === "rejected") {
                $("#walletIdInput").val(walletId);
                $("#remarksInput").val("");
                $("#imageInput").val("");
                $("#remarksModal").modal("show");
            } else {
                processApproval(walletId, approvalStatus)
            }
        }

        async function submitRejection() {
            const walletId = $("#walletIdInput").val();
            const approvalRemarks = $("#remarksInput").val();
            const fileInput = document.getElementById("imageInput");

            let additionalPayload = {}

            if (!approvalRemarks.trim()) {
                toastr.error("Remarks are required for rejection!");
                return;
            }

            additionalPayload = {
                ...additionalPayload,
                approvalRemarks
            }

            if (fileInput.files.length > 0) {
                const imageUrl = await uploadImage(fileInput.files[0]);
                additionalPayload = {
                    ...additionalPayload,
                    imageUrl
                }
            }

            processApproval(walletId, "rejected", additionalPayload)
        }

        async function processApproval(walletId, approvalStatus, additionalPayload = {}) {
            if (confirm(`Are you sure you want to ${approvalStatus === "approved" ? "approve" : "reject"} this transaction?`)) {
                await postAPICall({
                    endPoint: "/wallet/update",
                    payload: JSON.stringify({
                        walletId: parseInt(walletId),
                        approvalStatus,
                        ...additionalPayload
                    }),
                    callbackSuccess: (response) => {
                        if (response.success) {
                            toastr.success(`Transaction ${approvalStatus}!`);

                            if (approvalStatus === "rejected") {
                                $("#remarksModal").modal("hide");
                            }

                            fetchWallet();
                        }
                    }
                })
            }
        }
    </script>

    <?= $this->endSection(); ?>