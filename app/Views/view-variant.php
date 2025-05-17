<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<style>
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

    .media-card {
        width: 20rem;
        margin: 10px;
        cursor: move;
    }

    .media-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .media-card img,
    .media-card video {
        max-width: 100%;
        border-radius: 8px;
    }

    .variant-info-card {
        display: inline-block;
    }

    .variant-info-card>*>.info-box-text {
        font-size: 15px;
    }

    .variant-info-card,
    .variant-info-card .info-box-content {
        position: relative;
        overflow: visible !important;
        z-index: 1;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-dark card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="variant-details-tab" data-toggle="pill"
                            href="#variant-details" role="tab"
                            aria-controls="variant-details" aria-selected="true">Variant Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="medias-tab" data-toggle="pill"
                            href="#medias" role="tab"
                            aria-controls="medias" aria-selected="false">Images</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="attribute-list-tab" data-toggle="pill"
                            href="#attribute-list" role="tab"
                            aria-controls="attribute-list" aria-selected="false">Attributes</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                    <div class="tab-pane fade show active" id="variant-details"
                        role="tabpanel" aria-labelledby="variant-details-tab">
                        <div class="overlay-wrapper">
                            <div id="variant-details-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <h3 id="variantName"></h3>

                            <div class="row">
                                <div class="col-md-12 p-0">
                                    <div class="info-box shadow-none col-md-3 p-0 variant-info-card">
                                        <div class="info-box-content">
                                            <span class="info-box-text">Price:</span>
                                            <span class="info-box-number" id="variantPrice"></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="medias"
                        role="tabpanel" aria-labelledby="medias-tab">
                        <div class="overlay-wrapper">
                            <div id="medias-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>All Images</h4>
                                </div>

                                <div class="col-md-6 mb-4 text-right">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-add-media">
                                        Add New Images
                                    </button>
                                </div>
                            </div>

                            <h5 class="mb-2"><small><i>Please drag-n-drop the cards to arrange sequence of images. The images will show in the same sequence on website.</i></small>
                            </h5>
                            <div id="mediaList" class="media-container">
                            </div>
                            <button class="btn btn-dark mt-3 ml-2" id="saveOrderBtn">Save Order</button>
                            <button class="btn btn-dark mt-3 ml-2" onclick="fetchVariantMedias()">Refresh</button>
                        </div>
                    </div>

                    <div class="tab-pane fade show" id="attribute-list"
                        role="tabpanel" aria-labelledby="attribute-list-tab">
                        <div class="overlay-wrapper">
                            <div id="attribute-list-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>All Attributes</h4>
                                </div>

                                <div class="col-md-6 mb-4 text-right">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-add-attribute">
                                        Add New Attribute
                                    </button>
                                </div>
                            </div>

                            <table id="dtVariantAttributeList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="dataVariantAttributeList">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-media">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Variant</h4>
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
                <button type="button" class="btn btn-dark" onclick="onClickSubmitAddVariantMedia()">Save</button>
            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="modal-add-attribute">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Attribute</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="selectedAttributeId" />

                <!-- Attribute Selector -->
                <div class="form-group">
                    <label for="attributeSelect">Select Attribute</label>
                    <select class="form-control" id="attributeSelect" onchange="onAttributeChange()">
                        <option value="" disabled selected>Select Attribute</option>
                    </select>
                </div>

                <!-- Text Input -->
                <div class="form-group d-none" id="textInputGroup">
                    <label for="textInput">Enter Text</label>
                    <input type="text" class="form-control" id="textInput" />
                </div>

                <!-- Number Input -->
                <div class="form-group d-none" id="numberInputGroup">
                    <label for="numberInput">Enter Number</label>
                    <input type="number" class="form-control" id="numberInput" />
                </div>

                <!-- Dimension Inputs -->
                <div class="d-none" id="dimensionGroup">
                    <div class="form-group">
                        <label for="dimensionWidth">Width</label>
                        <input type="text" class="form-control" id="dimensionWidth" placeholder="e.g. 10cm" />
                    </div>
                    <div class="form-group">
                        <label for="dimensionHeight">Height</label>
                        <input type="text" class="form-control" id="dimensionHeight" placeholder="e.g. 20cm" />
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="onClickSubmitAddVariantAttribute()">Save</button>
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
    const variantId = '<?php if (isset($data)) {
                            echo $data["variantId"];
                        } else {
                            echo "";
                        } ?>'

    let allAttributes = []

    function initializeDTVariantAttributeList() {
        $("#dtVariantAttributeList").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })
    }

    const sortable = new Sortable(document.getElementById('mediaList'), {
        animation: 150
    });

    document.getElementById('saveOrderBtn').addEventListener('click', () => {
        const orderedIds = [];
        document.querySelectorAll('#mediaList .media-card').forEach((el, index) => {
            orderedIds.push({
                variantMediaId: parseInt(el.getAttribute('data-id')),
                sequenceNumber: index + 1
            });
        });

        updateVariantMediaSequence(orderedIds)
    });

    const mediaInput = document.getElementById("mediaUploadInput");
    const previewContainer = document.getElementById("mediaPreviewContainer");

    let uploadedFiles = [];
    let currentVariantMediaLength = 0

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
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewElement = document.createElement("div");
                previewElement.className = "position-relative m-2";

                previewElement.innerHTML = `
                    <img src="${e.target.result}" style="width:100px; height:100px; object-fit:cover;" class="border rounded">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" style="right: 0; top: 0;" onclick="removeImage(${index})">×</button>
                `;

                previewContainer.appendChild(previewElement);
            };

            reader.readAsDataURL(file);
        });
    }

    function removeImage(index) {
        uploadedFiles.splice(index, 1);
        renderPreviews();
    }

    document.addEventListener("DOMContentLoaded", function() {
        if (variantId !== "") {
            fetchVariant()
        }

        // Handle tab switching and show the loader for the active tab
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            // Get the target tab ID
            var targetTabId = $(e.target).attr('href') // This will give #lead-details, #manage-accounts, etc.

            // Hide all loaders
            $('.overlay').show()

            if (targetTabId.replace("#", "") === "variant-details") {
                fetchVariant(targetTabId)
            } else if (targetTabId.replace("#", "") === "medias") {
                fetchVariantMedias(targetTabId)
            } else if (targetTabId.replace("#", "") === "attribute-list") {
                fetchAttributes()
            }
        })

        $('#modal-add-media').on('hidden.bs.modal', function() {
            document.getElementById("mediaUploadInput").value = "";
            document.getElementById("mediaPreviewContainer").innerHTML = "";
            uploadedFiles = []
        });

        $('#modal-add-attribute').on('hidden.bs.modal', function() {
            document.getElementById("selectedAttributeId").value = "";
            document.getElementById("attributeSelect").value = "";
            if (document.getElementById("textInput")) document.getElementById("textInput").value = "";
            if (document.getElementById("numberInput")) document.getElementById("numberInput").value = "";
            if (document.getElementById("dimensionWidth")) document.getElementById("dimensionWidth").value = "";
            if (document.getElementById("dimensionHeight")) document.getElementById("dimensionHeight").value = "";
            selectedAttributeId = ""
        });
    });

    async function fetchVariant() {
        await postAPICall({
            endPoint: "/variant/list",
            payload: JSON.stringify({
                "filter": {
                    variantId: Number(variantId)
                },
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "createdAt",
                    "orderDir": "asc"
                }]
            }),
            callbackBeforeSend: function() {
                $('#variant-details-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#variant-details-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                if (response.success) {
                    const data = response.data[0]
                    document.getElementById("variantName").innerText = data.name
                    document.getElementById("variantPrice").innerText = data.price ?? "-"
                }

                loader.hide()
            }
        })
    }

    async function fetchVariantMedias() {
        await postAPICall({
            endPoint: "/variant-media/list",
            payload: JSON.stringify({
                "filter": {
                    variantId: Number(variantId)
                },
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "sequenceNumber",
                    "orderDir": "asc"
                }]
            }),
            callbackBeforeSend: function() {
                $('#medias-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#medias-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    currentVariantMediaLength = data?.length

                    var html = ""

                    for (let i = 0; i < data?.length; i++) {
                        let htmlMediaEl = data[i].mediaType.includes("video") ? `<video src="${data[i].mediaUrl}" controls></video>` : `<img src="${data[i].mediaUrl}" alt="${data[i].name}" style="height: 100%;">`

                        html += `<div class="card media-card position-relative" data-id="${data[i].variantMediaId}">
                            <div class="card-body d-flex flex-column justify-content-between align-items-center text-center p-2" style="height: 100%;">
                                ${htmlMediaEl}
                                <p class="mt-2 mb-0">${data[i].name}</p>
                                <button class="btn btn-sm btn-danger delete-media-btn" onclick="onClickDeleteVariantMedia(${data[i].variantMediaId})" data-id="${data[i].variantMediaId}" style="position: absolute; top: 5px; right: 5px;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>`;
                    }

                    document.getElementById("mediaList").innerHTML = html;
                }

                loader.hide()
            }
        })
    }

    async function onClickDeleteVariantMedia(variantMediaId) {
        await postAPICall({
            endPoint: "/variant-media/delete",
            payload: JSON.stringify({
                variantMediaIds: [Number(variantMediaId)]
            }),
            callbackBeforeSend: function() {
                $('#variant-details-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#variant-details-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                if (response.success) {
                    fetchVariantMedias()
                }

                loader.hide()
            }
        })
    }

    async function onClickSubmitAddVariantMedia() {
        if (uploadedFiles.length === 0) {
            alert("Please upload at least one image.");
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
                variantId: parseInt(variantId),
                name,
                mediaType,
                mediaUrl: url,
                size,
                sequenceNumber: parseInt(currentVariantMediaLength) + i + 1
            })
        }

        await postAPICall({
            endPoint: "/variant-media/create",
            payload: JSON.stringify(payload),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                const {
                    success,
                    message
                } = response

                if (success) {
                    toastr.success(response.message);
                    fetchVariantMedias()
                    $('#modal-add-media').modal('hide');
                } else {
                    toastr.error(response.message);
                }
                loader.hide()
            }
        })
    }

    async function updateVariantMediaSequence(payload) {
        if (confirm("Are you sure you want to update the ordering of images?")) {
            await postAPICall({
                endPoint: "/variant-media/update-sequence",
                payload: JSON.stringify(payload),
                callbackComplete: () => {},
                callbackSuccess: (response) => {
                    const {
                        success,
                        message
                    } = response

                    if (success) {
                        toastr.success(response.message);
                        fetchVariantMedias()
                    } else {
                        toastr.error(response.message);
                    }
                    loader.hide()
                }
            })
        }
    }

    async function fetchAttributes() {
        await postAPICall({
            endPoint: "/attribute/list",
            payload: JSON.stringify({
                "filter": {},
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "name",
                    "orderDir": "asc"
                }]
            }),
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    allAttributes = data

                    let html = `<option value="" disabled selected>Select Attribute</option>`

                    for (let i = 0; i < data?.length; i++) {
                        html += `<option value="${data[i].attributeId}">${data[i].name}</option>`
                    }

                    document.getElementById("attributeSelect").innerHTML = html
                }

                loader.hide()
            }
        })

        fetchVariantAttributes()
    }

    async function fetchVariantAttributes() {
        await postAPICall({
            endPoint: "/variant-attribute/list",
            payload: JSON.stringify({
                "filter": {
                    variantId: Number(variantId)
                },
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "createdAt",
                    "orderDir": "asc"
                }]
            }),
            callbackBeforeSend: function() {
                $('#attribute-list-loader').fadeIn()
                if ($.fn.DataTable.isDataTable("#dtVariantAttributeList")) {
                    $('#dtVariantAttributeList').DataTable().destroy()
                }
            },
            callbackComplete: function() {
                $('#attribute-list-loader').fadeOut()
            },
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
                            <td>${data[i].attribute?.name ?? ""}</td>
                            <td>${data[i].value ?? ""}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-variant-id="${data[i].variantAttributeId}" ${data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataVariantAttributeList").innerHTML = html;

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-status").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let variantId = this.getAttribute("data-variant-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            // Call API to update status
                            updateVariantAttributeStatus(variantId, newStatus);
                        });
                    });


                    initializeDTVariantAttributeList()
                }

                loader.hide()
            }
        })
    }

    function onAttributeChange() {
        const attributeId = document.getElementById('attributeSelect').value;

        selectedAttributeId = attributeId

        const selectedAttribute = allAttributes.find((attribute) => parseInt(attribute.attributeId) === parseInt(attributeId))

        // Hide all fields first
        document.getElementById('textInputGroup').classList.add('d-none');
        document.getElementById('numberInputGroup').classList.add('d-none');
        document.getElementById('dimensionGroup').classList.add('d-none');

        // Show relevant field based on type
        switch (selectedAttribute.type) {
            case 'text':
                document.getElementById('textInputGroup').classList.remove('d-none');
                break;
            case 'number':
                document.getElementById('numberInputGroup').classList.remove('d-none');
                break;
            case 'dimension':
                document.getElementById('dimensionGroup').classList.remove('d-none');
                break;
            case 'boolean':
                // No input needed
                break;
        }
    }

    async function onClickSubmitAddVariantAttribute() {
        const type = document.getElementById('attributeSelect').value;
        let value = null;

        if ((selectedAttributeId ?? "").trim() === "") {
            alert("Please select an attribute!")
            return
        }

        const selectedAttribute = allAttributes.find((attribute) => parseInt(attribute.attributeId) === parseInt(selectedAttributeId))

        switch (selectedAttribute.type) {
            case 'text':
                value = document.getElementById('textInput').value.trim();
                break;
            case 'number':
                value = document.getElementById('numberInput').value.trim();
                break;
            case 'dimension':
                const width = document.getElementById('dimensionWidth').value.trim();
                const height = document.getElementById('dimensionHeight').value.trim();
                value = JSON.stringify({
                    width,
                    height
                })
                break;
        }

        const payload = {
            attributeId: selectedAttributeId,
            variantId,
            value
        };

        await postAPICall({
            endPoint: "/variant-attribute/create",
            payload: JSON.stringify(payload),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                const {
                    success,
                    message
                } = response

                if (success) {
                    toastr.success(response.message);
                    fetchVariantAttributes()
                    $('#modal-add-attribute').modal('hide');
                } else {
                    toastr.error(response.message);
                }
                loader.hide()
            }
        })
    }

    async function updateVariantAttributeStatus(variantAttributeId, status) {
        await postAPICall({
            endPoint: "/variant-attribute/update",
            payload: JSON.stringify({
                variantAttributeId: Number(variantAttributeId),
                status: status === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchProductCategories()
                } else {
                    toastr.success(`Variant attribute ${status === "inactive" ? "blocked" : "unblocked"} successfully`)
                }
            }
        })
    }
</script>

<?= $this->endSection(); ?>