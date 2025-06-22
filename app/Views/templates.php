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

    .list-action-container {
        display: flex;
        justify-content: space-around;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('headerButtons'); ?>
<div class="col-md-5 offset-md-7">
    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-add-media">Add New Template</button>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">All Templates</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dtTemplatesList" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
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

<div class="modal fade" id="modal-add-media">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Template</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="file" id="mediaUploadInput" multiple accept="image/*,video/*">

                <div id="mediaPreviewContainer" class="d-flex flex-wrap mt-3 gap-2"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="onClickSubmitAddTemplate()">Save</button>
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
    const mediaInput = document.getElementById("mediaUploadInput");
    const previewContainer = document.getElementById("mediaPreviewContainer");

    let uploadedFiles = [];

    $(document).ready(function() {
        fetchTemplates()

        $('#modal-add-media').on('hidden.bs.modal', function() {
            document.getElementById("mediaUploadInput").value = "";
            document.getElementById("mediaPreviewContainer").innerHTML = "";
            uploadedFiles = []
        });
    })

    mediaInput.addEventListener("change", (e) => {
        const files = Array.from(e.target.files);

        // Append new files to uploadedFiles
        files.forEach(file => {
            if (!uploadedFiles.find(f => f.name === file.name && f.size === file.size)) {
                uploadedFiles.push(file);
            }
        });

        renderPreviews();
    });

    function renderPreviews() {
        previewContainer.innerHTML = "";

        uploadedFiles.forEach((file, index) => {
            const previewElement = document.createElement("div");
            previewElement.className = "position-relative m-2";
            const fileType = file.type;

            if (fileType.startsWith("image/") && ["image/vnd.adobe.photoshop"].indexOf(fileType) < 0) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewElement.innerHTML = `
                        <img src="${e.target.result}" style="width:100px; height:100px; object-fit:cover;" class="border rounded">
                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" onclick="removeImage(${index})">×</button>
                    `;
                    previewContainer.appendChild(previewElement);
                };
                reader.readAsDataURL(file);
            } else {
                // For non-image files like PSD, PDF, AI, etc.
                const ext = file.name.split('.').pop().toLowerCase();
                const icon = getFileIcon(ext);

                previewElement.innerHTML = `
                    <div class="position-relative m-2" style="width: 100px; height: 100px;">
                        <div class="border rounded d-flex flex-column align-items-center justify-content-center text-center bg-light w-100 h-100">
                            <i class="${icon}" style="font-size:24px;"></i>
                            <small class="text-truncate px-1" style="width: 90px;">${file.name}</small>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger position-absolute" style="top: -10px; right: -10px;" onclick="removeImage(${index})">×</button>
                    </div>
                `;
                previewContainer.appendChild(previewElement);
            }
        });
    }

    function removeImage(index) {
        uploadedFiles.splice(index, 1);
        renderPreviews();
    }

    function initializeDTTemplatesList() {
        $("#dtTemplatesList").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })
    }

    async function fetchTemplates() {
        if ($.fn.DataTable.isDataTable("#dtTemplatesList")) {
            $('#dtTemplatesList').DataTable().destroy()
        }

        await postAPICall({
            endPoint: "/template/list",
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
                            <td>${data[i].name ?? ""}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-template-id="${data[i].templateId}" ${data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td class="list-action-container">
                                <!-- <span onclick="onClickUpdateTemplate(${data[i].templateId})"><i class="fa fa-edit view-icon"></i></span> -->
                                <!-- <span onclick="onClickViewTemplate(${data[i].templateId})"><i class="fa fa-eye view-icon"></i></span> -->
                                <span onclick="onClickDeleteTemplate(${data[i].templateId})"><i class="fa fa-trash view-icon"></i></span>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataList").innerHTML = html;

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-status").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let templateId = this.getAttribute("data-template-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            console.log(`Template ID: ${templateId}, New Status: ${newStatus}`);

                            updateTemplateStatus(templateId, newStatus);
                        });
                    });


                    initializeDTTemplatesList()
                }
                loader.hide()
            }
        })
    }

    async function updateTemplateStatus(templateId, status) {
        await postAPICall({
            endPoint: "/template/update",
            payload: JSON.stringify({
                templateId: Number(templateId),
                status: status === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchTemplates()
                } else {
                    toastr.success(`Template status updated successfully`)
                }
            }
        })
    }

    function onClickUpdateTemplate(templateId) {
        window.location.href = `/admin/templates/update/${templateId}`
    }

    function onClickViewTemplate(templateId) {
        window.location.href = `/admin/templates/${templateId}`
    }

    async function onClickDeleteTemplate(templateId) {
        if (confirm("Are you sure you want to delete this item?")) {
            await postAPICall({
                endPoint: "/template/delete",
                payload: JSON.stringify({
                    templateIds: [Number(templateId)]
                }),
                callbackSuccess: (response) => {
                    if (!response.success) {
                        toastr.error(response.message)
                    } else {
                        toastr.success(`Template deleted successfully`)
                    }
                    fetchTemplates()
                }
            })
        }
    }

    async function onClickSubmitAddTemplate() {
        if (uploadedFiles.length === 0) {
            alert("Please upload at least one template.");
            return;
        }

        const payload = []
        for (let i = 0; i < uploadedFiles?.length; i++) {
            const {
                mediaType,
                name,
                size,
                url
            } = await uploadImage(uploadedFiles[i])

            payload.push({
                name,
                mediaType,
                mediaUrl: url,
                size
            })
        }

        await postAPICall({
            endPoint: "/template/create",
            payload: JSON.stringify(payload),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                const {
                    success,
                    message
                } = response

                if (success) {
                    toastr.success(response.message);
                    fetchTemplates()
                    $('#modal-add-media').modal('hide');
                } else {
                    toastr.error(response.message);
                }
                loader.hide()
            }
        })
    }
</script>
<?= $this->endSection(); ?>