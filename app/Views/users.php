<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
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
</style>
<?= $this->endSection(); ?>

<?= $this->section('headerButtons'); ?>
<!-- <div class="col-md-5 offset-md-7" id="addUserButtonContainer">
    <a href="/admin/customers/add"><button type="button" class="btn btn-dark">Add New Customer</button></a>
</div> -->
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">All Customers</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="filterRoleId">Filter by Customer Type</label>
                        <select id="filterRoleId" class="form-control">
                            <option value="">All</option>
                            <option value="2">Individual</option>
                            <option value="3">B2B</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-dark" id="applyFiltersBtn" onclick="filterList()">Apply Filters</button>
                    </div>
                </div>

                <table id="dtUsersList" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Customer Type</th>
                            <th>Resgistration Date</th>
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
        // if (parseInt(userData.roleId) != 3) {
        //     document.getElementById("addUserButtonContainer").style.display = "none"
        // }

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
        })
    }

    function filterList() {
        let additionalFilters = {}

        const filterRoleId = document.getElementById("filterRoleId").value
        if (filterRoleId) {
            additionalFilters = {
                ...additionalFilters,
                roleId: Number(filterRoleId)
            }
        }

        fetchUsers(additionalFilters)
    }

    async function fetchUsers(additionalFilters = {}) {
        if ($.fn.DataTable.isDataTable("#dtUsersList")) {
            $('#dtUsersList').DataTable().destroy()
        }

        await postAPICall({
            endPoint: "/user/list",
            payload: JSON.stringify({
                "filter": {
                    "roleId": [2, 3, 4],
                    ...additionalFilters
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
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    var html = ""

                    for (let user of data) {
                        html += `<tr>
                            <td>${user.fullName ?? ""}</td>
                            <td>${user.email}</td>
                            <td>${user.role.name === "Business Admin" ? "B2B" : "Individual"}</td>
                            <td>${formatDate(user.createdAt)}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-user-id="${user.userId}" ${user.status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td>
                                <div class="project-actions text-right d-flex justify-content-end" style="gap: 0.5rem;">
                                    <a class="btn btn-primary btn-sm d-flex align-items-center" onclick="onClickViewUser(${user.userId})">
                                        <i class="fas fa-folder mr-1">
                                        </i>
                                        Discounts & Promos
                                    </a>
                                    <a class="btn btn-info btn-sm d-flex align-items-center" onclick="onClickUpdateUser(${user.userId})">
                                        <i class="fas fa-pencil-alt mr-1">
                                        </i>
                                        Edit
                                    </a>
                                </div>
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
                    toastr.success(`User ${status === "inactive" ? "blocked" : "unblocked"} successfully`)
                }
            }
        })
    }

    function onClickUpdateUser(userId) {
        window.location.href = `/admin/customers/update/${userId}`
    }

    function onClickViewUser(userId) {
        window.location.href = `/admin/customers/${userId}`
    }
</script>
<?= $this->endSection(); ?>