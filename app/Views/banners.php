<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<style>
    .banner-card {
        width: 30rem;
        margin: 10px;
        cursor: move;
    }

    .banner-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .banner-card img,
    .banner-card video {
        max-width: 100%;
        border-radius: 8px;
    }

    /* Switch container */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
        margin-right: 10px;
        margin-top: 10px;
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
<div class="col-md-6 offset-md-6 text-right">
    <a href="/admin/banners/add"><button type="button" class="btn btn-dark"><i class="fas fa-plus"></i> Add New Banner</button></a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-image"></i> Manage Banners</h3>
    </div>
    <div class="card-body">
        <h5 class="mb-2"><small><i>Please drag-n-drop the cards to arrange sequence of banners. The banners will show in the same sequence on website.</i></small>
        </h5>
        <div id="bannerList" class="banner-container">
        </div>
        <button class="btn btn-dark mt-3 ml-2" id="saveOrderBtn">Save Order</button>
        <button class="btn btn-dark mt-3 ml-2" onclick="fetchBanners()">Refresh</button>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    $(document).ready(function() {
        fetchBanners()
    })

    const sortable = new Sortable(document.getElementById('bannerList'), {
        animation: 150
    });

    document.getElementById('saveOrderBtn').addEventListener('click', () => {
        const orderedIds = [];
        document.querySelectorAll('#bannerList .banner-card').forEach((el, index) => {
            orderedIds.push({
                bannerId: parseInt(el.getAttribute('data-id')),
                sequenceNumber: index + 1
            });
        });

        updateBannerSequence(orderedIds)
    });

    async function fetchBanners() {
        await postAPICall({
            endPoint: "/banner/list",
            payload: JSON.stringify({
                "filter": {},
                "range": {
                    "all": true
                },
                "sort": [{
                    "orderBy": "sequenceNumber",
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

                    for (let i = 0; i < data?.length; i++) {
                        let htmlMediaEl = data[i].mediaType.includes("video") ? `<video src="${data[i].mediaUrl}" controls></video>` : `<img src="${data[i].mediaUrl}" alt="${data[i].name}" style="height: 100%;">`

                        html += `<div class="card banner-card position-relative" data-id="${data[i].bannerId}">
                            <div class="card-body d-flex flex-column justify-content-between align-items-center text-center p-2" style="height: 100%;">
                                ${htmlMediaEl}
                                <p class="mt-2 mb-1">${data[i].name}</p>
                            </div>
                            <div class="card-footer" style="position: absolute; top: 5px; right: 5px; background-color: #fff; border-bottom-left-radius: 8px; padding: 5px;">
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-banner-id="${data[i].bannerId}" ${data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>

                                <!-- Delete icon on right -->
                                <button class="btn btn-sm btn-danger" onclick="onClickDeleteBanner(${data[i].bannerId})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>`;
                    }

                    document.getElementById("bannerList").innerHTML = html;

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-status").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let bannerId = this.getAttribute("data-banner-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            console.log(`Banner ID: ${bannerId}, New Status: ${newStatus}`);

                            updateBannerStatus(bannerId, newStatus);
                        });
                    });
                }
                loader.hide()
            }
        })
    }

    async function updateBannerSequence(payload) {
        if (confirm("Are you sure you want to update the ordering of banners?")) {
            await postAPICall({
                endPoint: "/banner/update-sequence",
                payload: JSON.stringify(payload),
                callbackComplete: () => {},
                callbackSuccess: (response) => {
                    const {
                        success,
                        message
                    } = response

                    if (success) {
                        toastr.success(response.message);
                        fetchBanners()
                    } else {
                        toastr.error(response.message);
                    }
                    loader.hide()
                }
            })
        }
    }

    async function onClickDeleteBanner(bannerId) {
        if (confirm("Are you sure you want to delete the selected banner?")) {
            await postAPICall({
                endPoint: "/banner/delete",
                payload: JSON.stringify({
                    bannerIds: [parseInt(bannerId)]
                }),
                callbackComplete: () => {},
                callbackSuccess: (response) => {
                    const {
                        success,
                        message
                    } = response

                    if (!success) {
                        toastr.error(message)
                    } else {
                        toastr.success(message)
                    }
                    fetchBanners()
                    loader.hide()
                }
            })
        }
    }

    async function updateBannerStatus(bannerId, status) {
        await postAPICall({
            endPoint: "/banner/update",
            payload: JSON.stringify({
                bannerId: Number(bannerId),
                status: status === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (response.success) {
                    toastr.success("Banner status updated")
                } else {
                    toastr.error(response.message || "Failed to update status")
                }
            },
            callbackComplete: () => {
                loader.hide()
            }
        })
    }
</script>
<?= $this->endSection(); ?>