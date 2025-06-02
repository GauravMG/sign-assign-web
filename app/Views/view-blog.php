<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
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

    .blog-info-card {
        display: inline-block;
    }

    .blog-info-card>*>.info-box-text {
        font-size: 15px;
    }

    .blog-info-card,
    .blog-info-card .info-box-content {
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
                        <a class="nav-link active" id="blog-details-tab" data-toggle="pill"
                            href="#blog-details" role="tab"
                            aria-controls="blog-details" aria-selected="true">Blog Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="medias-tab" data-toggle="pill"
                            href="#medias" role="tab"
                            aria-controls="medias" aria-selected="false">Images</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                    <div class="tab-pane fade show active" id="blog-details"
                        role="tabpanel" aria-labelledby="blog-details-tab">
                        <div class="overlay-wrapper">
                            <div id="blog-details-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <h3 id="blogTitle"></h3>

                            <div class="row mt-4 pt-3 border-top border-dark">
                                <div class="col-md-12">
                                    <h3>Description :</h3>
                                </div>
                                <div class="col-md-12 bg-light p-2 border">
                                    <div id="blogDescription"></div>
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
                            <button class="btn btn-dark mt-3 ml-2" onclick="fetchBlogMedias()">Refresh</button>
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
                <h4 class="modal-title">Add Blog</h4>
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
                <button type="button" class="btn btn-dark" onclick="onClickSubmitAddBlogMedia()">Save</button>
            </div>
        </div>

    </div>

</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
    const blogId = '<?php if (isset($data)) {
                        echo $data["blogId"];
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
                blogMediaId: parseInt(el.getAttribute('data-id')),
                sequenceNumber: index + 1
            });
        });

        updateBlogMediaSequence(orderedIds)
    });

    const mediaInput = document.getElementById("mediaUploadInput");
    const previewContainer = document.getElementById("mediaPreviewContainer");

    let uploadedFiles = [];
    let currentBlogMediaLength = 0

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
        if (blogId !== "") {
            fetchBlog()
        }

        // Handle tab switching and show the loader for the active tab
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            // Get the target tab ID
            var targetTabId = $(e.target).attr('href') // This will give #lead-details, #manage-accounts, etc.

            // Hide all loaders
            $('.overlay').show()

            if (targetTabId.replace("#", "") === "blog-details") {
                fetchBlog(targetTabId)
            } else if (targetTabId.replace("#", "") === "medias") {
                fetchBlogMedias(targetTabId)
            }
        })

        $('#modal-add-media').on('hidden.bs.modal', function() {
            document.getElementById("mediaUploadInput").value = "";
            document.getElementById("mediaPreviewContainer").innerHTML = "";
            uploadedFiles = []
        });
    });

    async function fetchBlog() {
        await postAPICall({
            endPoint: "/blog/list",
            payload: JSON.stringify({
                "filter": {
                    blogId: Number(blogId)
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
                $('#blog-details-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#blog-details-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                if (response.success) {
                    const data = response.data[0]
                    document.getElementById("blogTitle").innerText = data.title
                    document.getElementById("blogDescription").innerHTML = data.description
                }

                loader.hide()
            }
        })
    }

    async function fetchBlogMedias() {
        await postAPICall({
            endPoint: "/blog-media/list",
            payload: JSON.stringify({
                "filter": {
                    blogId: Number(blogId)
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
                    currentBlogMediaLength = data?.length

                    var html = ""

                    for (let i = 0; i < data?.length; i++) {
                        let htmlMediaEl = data[i].mediaType.includes("video") ? `<video src="${data[i].mediaUrl}" controls></video>` : `<img src="${data[i].mediaUrl}" alt="${data[i].name}" style="height: 100%;">`

                        html += `<div class="card media-card position-relative" data-id="${data[i].blogMediaId}">
                            <div class="card-body d-flex flex-column justify-content-between align-items-center text-center p-2" style="height: 100%;">
                                ${htmlMediaEl}
                                <p class="mt-2 mb-0">${data[i].name}</p>
                                <button class="btn btn-sm btn-danger delete-media-btn" onclick="onClickDeleteBlogMedia(${data[i].blogMediaId})" data-id="${data[i].blogMediaId}" style="position: absolute; top: 5px; right: 5px;">
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

    async function onClickDeleteBlogMedia(blogMediaId) {
        await postAPICall({
            endPoint: "/blog-media/delete",
            payload: JSON.stringify({
                blogMediaIds: [Number(blogMediaId)]
            }),
            callbackBeforeSend: function() {
                $('#blog-details-loader').fadeIn()
            },
            callbackComplete: function() {
                $('#blog-details-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                if (response.success) {
                    fetchBlogMedias()
                }

                loader.hide()
            }
        })
    }

    async function onClickSubmitAddBlogMedia() {
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
                blogId: parseInt(blogId),
                name,
                mediaType,
                mediaUrl: url,
                size,
                sequenceNumber: parseInt(currentBlogMediaLength) + i + 1
            })
        }

        await postAPICall({
            endPoint: "/blog-media/create",
            payload: JSON.stringify(payload),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                const {
                    success,
                    message
                } = response

                if (success) {
                    toastr.success(response.message);
                    fetchBlogMedias()
                    $('#modal-add-media').modal('hide');
                } else {
                    toastr.error(response.message);
                }
                loader.hide()
            }
        })
    }

    async function updateBlogMediaSequence(payload) {
        if (confirm("Are you sure you want to update the ordering of images?")) {
            await postAPICall({
                endPoint: "/blog-media/update-sequence",
                payload: JSON.stringify(payload),
                callbackComplete: () => {},
                callbackSuccess: (response) => {
                    const {
                        success,
                        message
                    } = response

                    if (success) {
                        toastr.success(response.message);
                        fetchBlogMedias()
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