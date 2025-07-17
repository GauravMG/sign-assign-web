<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<style>
    /* Switch container */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    /* Hide default checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* Slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
    }

    /* Circle inside the slider */
    .slider::before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    /* Checked state */
    input:checked+.slider {
        background-color: #28a745;
        /* Green */
    }

    input:checked+.slider::before {
        transform: translateX(26px);
    }

    .list-action-container {
        display: flex;
        justify-content: space-around;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('headerButtons'); ?>
<div class="col-md-5 offset-md-7" id="addUserButtonContainer">
    <a href="/admin/staff/add"><button type="button" class="btn btn-dark">Add New Staff</button></a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">All Staff</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dtUsersList" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Account Status</th>
                            <th>Actions</th>
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
    $(document).ready(function() {
        if (parseInt(userData.roleId) != 1) {
            document.getElementById("addUserButtonContainer").style.display = "none"
        }

        fetchUsers()
    })

    function initializeDTUsersList() {
        $("#dtUsersList").DataTable({
            "paging": true,
            "lengthChange": true,
            "lengthMenu": [ [10, 25, 50, 100], [10, 25, 50, 100] ],
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "fixedHeader": true,
        })
    }

    async function fetchUsers() {
        if ($.fn.DataTable.isDataTable("#dtUsersList")) {
            $('#dtUsersList').DataTable().destroy()
        }

        await postAPICall({
            endPoint: "/user/list",
            payload: JSON.stringify({
                "filter": {
                    "roleId": [5]
                },
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "firstName",
                    "orderDir": "asc"
                }]
            }),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                if (response.success) {
                    var html = ""

                    for (let i = 0; i < response.data?.length; i++) {
                        html += `<tr>
                            <td>${response.data[i].fullName ?? ""}</td>
                            <td>${response.data[i].email}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-user-id="${response.data[i].userId}" ${response.data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td class="list-action-container">
                                <span onclick="onClickUpdateUser(${response.data[i].userId})"><i class="fa fa-edit view-icon"></i></span>
                                <span onclick="onClickViewUser(${response.data[i].userId})"><i class="fa fa-eye view-icon"></i></span>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataList").innerHTML = html;

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-status").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let userId = this.getAttribute("data-user-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            console.log(`User ID: ${userId}, New Status: ${newStatus}`);

                            // Call API to update user status
                            updateUserStatus(userId, newStatus);
                        });
                    });


                    initializeDTUsersList()
                }
                loader.hide()
            }
        })
    }

    async function updateUserStatus(userId, status) {
        await postAPICall({
            endPoint: "/user/update",
            payload: JSON.stringify({
                userId: Number(userId),
                status: status === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchUsers()
                } else {
                    toastr.success(`Staff ${status === "inactive" ? "blocked" : "unblocked"} successfully`)
                }
            }
        })
    }

    function onClickUpdateUser(userId) {
        window.location.href = `/admin/staff/update/${userId}`
    }

    function onClickViewUser(userId) {
        window.location.href = `/admin/staff/${userId}`
    }
</script>
<?= $this->endSection(); ?>