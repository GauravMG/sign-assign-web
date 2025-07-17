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
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title"><?php if (isset($data["userId"])) {
                                            echo "Edit Staff";
                                        } else {
                                            echo "Add New Staff";
                                        } ?></h3>
            </div>
            <!-- /.card-header -->
            <form>
                <div class="card-body">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter last name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email ID</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email id">
                    </div>
                    <div class="form-group">
                        <label for="password">Temporary Password (for new staff)</label>
                        <input type="password" class="form-control" id="password" placeholder="******">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-dark"><?php if (isset($data["userId"])) {
                                                                                        echo "Update";
                                                                                    } else {
                                                                                        echo "Create";
                                                                                    } ?> Staff</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
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
    let userId = '<?php if (isset($data)) {
                        echo $data["userId"];
                    } else {
                        echo "";
                    } ?>'

    document.addEventListener("DOMContentLoaded", function() {
        if (userId !== "") {
            fetchUser()
        }

        async function fetchUser() {
            await postAPICall({
                endPoint: "/user/list",
                payload: JSON.stringify({
                    "filter": {
                        userId: Number(userId)
                    },
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
                        const data = response.data[0]
                        document.getElementById("firstName").value = data.firstName
                        document.getElementById("lastName").value = data.lastName
                        document.getElementById("email").value = data.email
                    }

                    loader.hide()
                }
            })
        }

        async function onClickSubmit() {
            const firstName = document.getElementById("firstName").value;
            const lastName = document.getElementById("lastName").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            if ((firstName ?? "").trim() === "") {
                toastr.error("Please enter a valid first name!");
                return;
            }

            if ((lastName ?? "").trim() === "") {
                toastr.error("Please enter a valid last name!");
                return;
            }

            if ((email ?? "").trim() === "") {
                toastr.error("Please enter a valid email id!");
                return;
            }

            if (userId === "" && (password ?? "").trim() === "") {
                toastr.error("Please enter a valid password!");
                return;
            }

            let payload = {
                firstName,
                lastName,
                email
            }
            if ((password ?? "").trim() !== "") {
                payload = {
                    ...payload,
                    password
                }
            }

            if (userId !== "") {
                if (confirm("Are you sure you want to update this staff?")) {
                    await postAPICall({
                        endPoint: "/user/update",
                        payload: JSON.stringify({
                            userId: Number(userId),
                            ...payload
                        }),
                        callbackSuccess: (response) => {
                            if (response.success) {
                                toastr.success(response.message);
                                window.location.href = "/admin/staff";
                            }
                        }
                    })
                }
            } else {
                if (confirm("Are you sure you want to create this staff?")) {
                    await postAPICall({
                        endPoint: "/user/create",
                        payload: JSON.stringify({
                            roleId: 5,
                            ...payload
                        }),
                        callbackSuccess: (response) => {
                            if (response.success) {
                                toastr.success(response.message);
                                window.location.href = "/admin/staff";
                            }
                        }
                    })
                }
            }
        }

        document.querySelector(".btn-dark").addEventListener("click", onClickSubmit);
    });
</script>

<?= $this->endSection(); ?>