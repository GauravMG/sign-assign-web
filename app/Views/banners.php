<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<style>
    .banner-card {
        width: 200px;
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

                        html += `<div class="card banner-card" data-id="${data[i].bannerId}">
                            <div class="card-body d-flex flex-column justify-content-between align-items-center text-center p-2" style="height: 100%;">
                                ${htmlMediaEl}
                                <p class="mt-2 mb-0">${data[i].name}</p>
                            </div>
                        </div>`;
                    }

                    document.getElementById("bannerList").innerHTML = html;
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
</script>
<?= $this->endSection(); ?>