<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">

<style>
    #productImage {
        width: 100%;
        max-width: 350px;
        height: auto;
    }

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

    .list-image-container {
        text-align: center;
    }

    .list-image {
        width: 80px;
        height: 80px;
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
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-dark card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="medias-tab" data-toggle="pill"
                            href="#medias" role="tab"
                            aria-controls="medias" aria-selected="true">Medias</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                    <div class="tab-pane fade show active" id="medias"
                        role="tabpanel" aria-labelledby="medias-tab">
                        <div class="overlay-wrapper">
                            <div id="medias-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>All Medias</h4>
                                </div>

                                <div class="col-md-6 mb-4 text-right">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-add-media">
                                        Add New Medias
                                    </button>
                                </div>
                            </div>

                            <h5 class="mb-2"><small><i>Please drag-n-drop the cards to arrange sequence of images. The images will show in the same sequence on website.</i></small>
                            </h5>
                            <div id="mediaList" class="media-container">
                            </div>
                            <button class="btn btn-dark mt-3 ml-2" id="saveOrderBtn">Save Order</button>
                            <button class="btn btn-dark mt-3 ml-2" onclick="fetchProductMedias()">Refresh</button>
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
                <h4 class="modal-title">Add Media</h4>
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
                <button type="button" class="btn btn-dark" onclick="onClickSubmitAddProductMedia()">Save</button>
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
    const productId = '<?php if (isset($data)) {
                            echo $data["productId"];
                        } else {
                            echo "";
                        } ?>'

    const sortable = new Sortable(document.getElementById('mediaList'), {
        animation: 150
    });

    document.getElementById('saveOrderBtn').addEventListener('click', () => {
        const orderedIds = [];
        document.querySelectorAll('#mediaList .media-card').forEach((el, index) => {
            orderedIds.push({
                productMediaId: parseInt(el.getAttribute('data-id')),
                sequenceNumber: index + 1
            });
        });

        updateProductMediaSequence(orderedIds)
    });

    const mediaInput = document.getElementById("mediaUploadInput");
    const previewContainer = document.getElementById("mediaPreviewContainer");

    let uploadedFiles = [];
    let currentProductMediaLength = 0

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
        if (productId !== "") {
            fetchProductMedias()
        }

        // Handle tab switching and show the loader for the active tab
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            // Get the target tab ID
            var targetTabId = $(e.target).attr('href') // This will give #lead-details, #manage-accounts, etc.

            // Hide all loaders
            $('.overlay').show()

            if (targetTabId.replace("#", "") === "medias") {
                fetchProductMedias(targetTabId)
            }
        })

        $('#modal-add-media').on('hidden.bs.modal', function() {
            document.getElementById("mediaUploadInput").value = "";
            document.getElementById("mediaPreviewContainer").innerHTML = "";
            uploadedFiles = []
        });
    });

    async function fetchProductMedias() {
        await postAPICall({
            endPoint: "/product-media/list",
            payload: JSON.stringify({
                "filter": {
                    productId: Number(productId)
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
                    currentProductMediaLength = data?.length

                    var html = ""

                    for (let i = 0; i < data?.length; i++) {
                        let htmlMediaEl = data[i].mediaType.includes("video") ? `<video src="${data[i].mediaUrl}" controls></video>` : `<img src="${data[i].mediaUrl}" alt="${data[i].name}" style="height: 100%;">`

                        html += `<div class="card media-card position-relative" data-id="${data[i].productMediaId}">
                            <div class="card-body d-flex flex-column justify-content-between align-items-center text-center p-2" style="height: 100%;">
                                ${htmlMediaEl}
                                <p class="mt-2 mb-0">${data[i].name}</p>
                                <button class="btn btn-sm btn-danger delete-media-btn" onclick="onClickDeleteProductMedia(${data[i].productMediaId})" data-id="${data[i].productMediaId}" style="position: absolute; top: 5px; right: 5px;">
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

    async function onClickDeleteProductMedia(productMediaId) {
        await postAPICall({
            endPoint: "/product-media/delete",
            payload: JSON.stringify({
                productMediaIds: [Number(productMediaId)]
            }),
            callbackBeforeSend: function() {
                $('#product-details-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#product-details-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                if (response.success) {
                    fetchProductMedias()
                }

                loader.hide()
            }
        })
    }

    async function onClickSubmitAddProductMedia() {
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
                productId: parseInt(productId),
                name,
                mediaType,
                mediaUrl: url,
                size,
                sequenceNumber: parseInt(currentProductMediaLength) + i + 1
            })
        }

        await postAPICall({
            endPoint: "/product-media/create",
            payload: JSON.stringify(payload),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                const {
                    success,
                    message
                } = response

                if (success) {
                    toastr.success(response.message);
                    fetchProductMedias()
                    $('#modal-add-media').modal('hide');
                } else {
                    toastr.error(response.message);
                }
                loader.hide()
            }
        })
    }

    async function updateProductMediaSequence(payload) {
        if (confirm("Are you sure you want to update the ordering of images?")) {
            await postAPICall({
                endPoint: "/product-media/update-sequence",
                payload: JSON.stringify(payload),
                callbackComplete: () => {},
                callbackSuccess: (response) => {
                    const {
                        success,
                        message
                    } = response

                    if (success) {
                        toastr.success(response.message);
                        fetchProductMedias()
                    } else {
                        toastr.error(response.message);
                    }
                    loader.hide()
                }
            })
        }
    }
</script>

<?= $this->endSection(); ?>