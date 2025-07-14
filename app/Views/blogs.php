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
<div class="col-md-5 offset-md-7">
    <a href="/admin/blogs/add"><button type="button" class="btn btn-dark">Add New Blog</button></a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">All Blogs</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dtBlogsList" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
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
        fetchBlogs()
    })

    function initializeDTBlogsList() {
        $("#dtBlogsList").DataTable({
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

    async function fetchBlogs() {
        if ($.fn.DataTable.isDataTable("#dtBlogsList")) {
            $('#dtBlogsList').DataTable().destroy()
        }

        await postAPICall({
            endPoint: "/blog/list",
            payload: JSON.stringify({
                "filter": {},
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "createdAt",
                    "orderDir": "desc"
                }],
                linkedEntities: true
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

                    for (let i = 0; i < data?.length; i++) {
                        html += `<tr>
                            <td>${data[i].title ?? ""}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-blog-id="${data[i].blogId}" ${data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td>
                                <div class="project-actions text-right d-flex justify-content-end" style="gap: 0.5rem;">
                                    <a class="btn btn-primary btn-sm d-flex align-items-center" onclick="onClickViewBlog(${data[i].blogId})">
                                        <i class="fas fa-folder mr-1">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm d-flex align-items-center" onclick="onClickUpdateBlog(${data[i].blogId})">
                                        <i class="fas fa-pencil-alt mr-1">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm d-flex align-items-center" onclick="onClickDeleteBlog(${data[i].blogId})">
                                        <i class="fas fa-trash mr-1">
                                        </i>
                                        Delete
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
                            let blogId = this.getAttribute("data-blog-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            console.log(`Blog ID: ${blogId}, New Status: ${newStatus}`);

                            updateBlogStatus(blogId, newStatus);
                        });
                    });


                    initializeDTBlogsList()
                }
                loader.hide()
            }
        })
    }

    async function updateBlogStatus(blogId, status) {
        await postAPICall({
            endPoint: "/blog/update",
            payload: JSON.stringify({
                blogId: Number(blogId),
                status: status === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchBlogs()
                } else {
                    toastr.success(`Blog status updated successfully`)
                }
            }
        })
    }

    function onClickUpdateBlog(blogId) {
        window.location.href = `/admin/blogs/update/${blogId}`
    }

    function onClickViewBlog(blogId) {
        window.location.href = `/admin/blogs/${blogId}`
    }

    async function onClickDeleteBlog(blogId) {
        if (confirm("Are you sure you want to delete this item?")) {
            await postAPICall({
                endPoint: "/blog/delete",
                payload: JSON.stringify({
                    blogIds: [Number(blogId)]
                }),
                callbackSuccess: (response) => {
                    if (!response.success) {
                        toastr.error(response.message)
                    } else {
                        toastr.success(`Blog deleted successfully`)
                    }
                    fetchBlogs()
                }
            })
        }
    }
</script>
<?= $this->endSection(); ?>