<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

    /* For Select2 multi-select selected items (Bootstrap theme or default) */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #343a40;
        /* Dark background (like .btn-dark) */
        color: #fff;
        /* White text */
        border: 1px solid #343a40;
    }

    /* Optional: Adjust the appearance of the search field */
    .select2-container--default .select2-search--inline .select2-search__field {
        height: 30px;
    }

    .list-image-container {
        text-align: center;
    }

    .list-image {
        width: 80px;
        height: 80px;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('headerButtons'); ?>
<div class="col-md-5 offset-md-7">
    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-add-media">Add New Template</button>
    <!-- <button type="button" class="btn btn-dark" onclick="addNewTemplate()">Add New Template</button> -->
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
                            <th>Preview</th>
                            <th>File Type</th>
                            <th>Status</th>
                            <th>Manage Tagging</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Preview</th>
                            <th>File Type</th>
                            <th>Status</th>
                            <th>Manage Tagging</th>
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

<div class="modal fade" id="modal-manage-reference-tag" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- modal-lg for more width -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Manage Tagging</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="manageReferenceTag_templateId">

                <!-- Section 1: Product Categories -->
                <div class="mb-4">
                    <h5 class="mb-2">Tag Product Categories</h5>
                    <select class="select2" id="manageReferenceTag_productCategories" multiple="multiple" data-placeholder="Select product categories" style="width: 100%;">
                    </select>
                </div>

                <!-- Section 2: Product Sub-categories -->
                <div class="mb-4">
                    <h5 class="mb-2">Tag Product Sub-categories</h5>
                    <select class="select2" id="manageReferenceTag_productSubCategories" multiple="multiple" data-placeholder="Select product sub-categories" style="width: 100%;">
                    </select>
                </div>

                <!-- Section 3: Products -->
                <div>
                    <h5 class="mb-2">Tag Products</h5>
                    <select class="select2" id="manageReferenceTag_products" multiple="multiple" data-placeholder="Select products" style="width: 100%;">
                    </select>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="onClickSubmitReferenceTag()">Save</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
    let templates = []

    $(document).ready(function() {
        fetchTemplates()

        $('#manageReferenceTag_productCategories').select2({
            placeholder: 'Search and select product categores',
            multiple: true,
            minimumInputLength: 1,
            ajax: {
                transport: function(params, success, failure) {
                    const searchTerm = params.data.term;

                    postAPICall({
                        endPoint: "/product-category/list",
                        payload: JSON.stringify({
                            filter: {
                                search: searchTerm
                            },
                            range: {
                                all: true
                            },
                            sort: [{
                                orderDir: "asc",
                                orderBy: "name"
                            }]
                        }),
                        callbackSuccess: (response) => {
                            const {
                                success: isSuccess,
                                data
                            } = response;
                            if (isSuccess && Array.isArray(data)) {
                                success({
                                    results: data.map(el => ({
                                        id: el.productCategoryId,
                                        text: el.name
                                    }))
                                });
                            } else {
                                success({
                                    results: []
                                });
                            }
                        },
                    });
                },
                processResults: function(data) {
                    return data;
                },
                delay: 300,
                cache: true
            }
        });

        $('#manageReferenceTag_productSubCategories').select2({
            placeholder: 'Search and select staff members',
            multiple: true,
            minimumInputLength: 1,
            ajax: {
                transport: function(params, success, failure) {
                    const searchTerm = params.data.term;

                    postAPICall({
                        endPoint: "/product-subcategory/list",
                        payload: JSON.stringify({
                            filter: {
                                search: searchTerm
                            },
                            range: {
                                all: true
                            },
                            sort: [{
                                orderDir: "asc",
                                orderBy: "name"
                            }]
                        }),
                        callbackSuccess: (response) => {
                            const {
                                success: isSuccess,
                                data
                            } = response;
                            if (isSuccess && Array.isArray(data)) {
                                success({
                                    results: data.map(el => ({
                                        id: el.productSubCategoryId,
                                        text: el.name
                                    }))
                                });
                            } else {
                                success({
                                    results: []
                                });
                            }
                        },
                    });
                },
                processResults: function(data) {
                    return data;
                },
                delay: 300,
                cache: true
            }
        });

        $('#manageReferenceTag_products').select2({
            placeholder: 'Search and select staff members',
            multiple: true,
            minimumInputLength: 1,
            ajax: {
                transport: function(params, success, failure) {
                    const searchTerm = params.data.term;

                    postAPICall({
                        endPoint: "/product/list",
                        payload: JSON.stringify({
                            filter: {
                                search: searchTerm
                            },
                            range: {
                                all: true
                            },
                            sort: [{
                                orderDir: "asc",
                                orderBy: "name"
                            }]
                        }),
                        callbackSuccess: (response) => {
                            const {
                                success: isSuccess,
                                data
                            } = response;
                            if (isSuccess && Array.isArray(data)) {
                                success({
                                    results: data.map(el => ({
                                        id: el.productId,
                                        text: el.name
                                    }))
                                });
                            } else {
                                success({
                                    results: []
                                });
                            }
                        },
                    });
                },
                processResults: function(data) {
                    return data;
                },
                delay: 300,
                cache: true
            }
        });

        $('#modal-add-media').on('hidden.bs.modal', function() {
            document.getElementById("mediaUploadInput").value = "";
            document.getElementById("mediaPreviewContainer").innerHTML = "";
            uploadedFiles = []
        });

        $('#modal-manage-reference-tag').on('hidden.bs.modal', function() {
            document.getElementById("manageReferenceTag_templateId").value = "";
            $('#manageReferenceTag_productCategories').val(null).trigger('change');
            $('#manageReferenceTag_productSubCategories').val(null).trigger('change');
            $('#manageReferenceTag_products').val(null).trigger('change');
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
                    templates = data
                    var html = ""

                    for (let i = 0; i < data?.length; i++) {
                        html += `<tr>
                            <td>${data[i].name ?? ""}</td>
                            <td class="list-image-container">
                                <img class="list-image" src="${(data[i].previewUrl ?? "").trim() !== "" ? data[i].previewUrl : `${BASE_URL}images/no-preview-available.jpg`}" alt="${data[i].name}" />
                            </td>
                            <td>${data[i].mediaType ?? ""}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-template-id="${data[i].templateId}" ${data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td>
                                <div class="project-actions text-right d-flex justify-content-end" style="gap: 0.5rem;">
                                    <a class="btn btn-primary btn-sm d-flex align-items-center" onclick="onClickManageReferenceTag(${data[i].templateId})">
                                        <i class="fas fa-folder mr-1">
                                        </i>
                                        View
                                    </a>
                                </div>
                            </td>
                            <td class="project-actions text-right d-flex justify-content-end" style="gap: 0.5rem;">
                                <div class="project-actions text-right d-flex justify-content-end" style="gap: 0.5rem;">
                                    <a class="btn btn-danger btn-sm d-flex align-items-center" onclick="onClickDeleteTemplate(${data[i].templateId})">
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

    function addNewTemplate() {
        const token = localStorage.getItem('jwtToken');

        const params = new URLSearchParams();
        params.set("token", token);
        params.set("returnUrl", window.location.href);

        const encoded = btoa(params.toString());

        window.location.href = `${BASE_URL_EDITOR}/?data=${encoded}`
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
                url,
                previewUrl
            } = await uploadArtwork(uploadedFiles[i])

            payload.push({
                name,
                mediaType,
                mediaUrl: url,
                size,
                previewUrl
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

    function prepopulateReferenceTagging({
        categories = [],
        subCategories = [],
        products = []
    }) {
        // Populate Product Categories
        categories.forEach(cat => {
            const option = new Option(cat.name, cat.productCategoryId, true, true);
            $('#manageReferenceTag_productCategories').append(option).trigger('change');
        });

        // Populate Product Sub-Categories
        subCategories.forEach(sub => {
            const option = new Option(sub.name, sub.productSubCategoryId, true, true);
            $('#manageReferenceTag_productSubCategories').append(option).trigger('change');
        });

        // Populate Products
        products.forEach(prod => {
            const option = new Option(prod.name, prod.productId, true, true);
            $('#manageReferenceTag_products').append(option).trigger('change');
        });
    }

    function onClickManageReferenceTag(templateId) {
        document.getElementById('manageReferenceTag_templateId').value = templateId

        $('#modal-manage-reference-tag').modal('show');

        const selectedTemplate = templates.find((template) => Number(template.templateId) === Number(templateId))

        const categories = []
        const subCategories = []
        const products = []
        selectedTemplate.templateTags.forEach((templateTag) => {
            if (templateTag.referenceType === "product_category") {
                categories.push({
                    productCategoryId: Number(templateTag.referenceId),
                    name: templateTag.referenceData.name
                })
            }
            if (templateTag.referenceType === "product_sub_category") {
                subCategories.push({
                    productSubCategoryId: Number(templateTag.referenceId),
                    name: templateTag.referenceData.name
                })
            }
            if (templateTag.referenceType === "product") {
                products.push({
                    productId: Number(templateTag.referenceId),
                    name: templateTag.referenceData.name
                })
            }
        })

        prepopulateReferenceTagging({
            categories,
            subCategories,
            products
        })
    }

    async function onClickSubmitReferenceTag() {
        // Get values from form inputs
        let templateId = document.getElementById('manageReferenceTag_templateId').value.trim();
        templateId = Number(templateId)
        const selectedProductCategoryIds = $('#manageReferenceTag_productCategories').val();
        const selectedProductSubCategoryIds = $('#manageReferenceTag_productSubCategories').val();
        const selectedProductIds = $('#manageReferenceTag_products').val();

        if (!selectedProductCategoryIds?.length && !selectedProductSubCategoryIds?.length && !selectedProductIds?.length) {
            alert("Please select at least 1 tagging reference!")
            return
        }
        let payload = []
        for (let el of selectedProductCategoryIds) {
            payload.push({
                templateId,
                referenceType: "product_category",
                referenceId: Number(el)
            })
        }
        for (let el of selectedProductSubCategoryIds) {
            payload.push({
                templateId,
                referenceType: "product_sub_category",
                referenceId: Number(el)
            })
        }
        for (let el of selectedProductIds) {
            payload.push({
                templateId,
                referenceType: "product",
                referenceId: Number(el)
            })
        }

        if (confirm("Are you sure you want to update tagging for selected template?")) {
            await postAPICall({
                endPoint: "/template-tag/save",
                payload: JSON.stringify(payload),
                callbackSuccess: (response) => {
                    if (!response.success) {
                        toastr.error(response.message)
                    } else {
                        toastr.success(`Template tagging updated successfully`)
                        $('#modal-manage-reference-tag').modal('hide');
                    }
                    fetchTemplates()
                }
            })
        }
    }
</script>
<?= $this->endSection(); ?>