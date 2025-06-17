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
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Personal Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" id="firstName" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" id="lastName" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email ID</label>
                            <input type="text" class="form-control" id="email" readonly>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mobile">Mobile</label>
                                <input type="text" class="form-control" id="mobile" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dob">DOB</label>
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
    </script>

    <?= $this->endSection(); ?>