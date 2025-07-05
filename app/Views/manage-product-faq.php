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
                        <a class="nav-link active" id="faq-list-tab" data-toggle="pill"
                            href="#faq-list" role="tab"
                            aria-controls="faq-list" aria-selected="true">FAQs</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                    <div class="tab-pane fade show active" id="faq-list"
                        role="tabpanel" aria-labelledby="faq-list-tab">
                        <div class="overlay-wrapper">
                            <div id="faq-list-loader" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>FAQs</h4>
                                </div>

                                <div class="col-md-6 mb-4 text-right">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-add-faq">
                                        Add New FAQ
                                    </button>
                                </div>
                            </div>

                            <table id="dtFAQList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="dataFAQList">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Status</th>
                                        <th>Actions</th>
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

<div class="modal fade" id="modal-add-faq">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add FAQ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="add_faqId">
                <div class="form-group">
                    <label for="add_faqQuestion">Question</label>
                    <input type="text" class="form-control" id="add_faqQuestion" placeholder="Enter Question">
                </div>
                <div class="form-group">
                    <label for="add_faqAnswer">Answer</label>
                    <textarea class="form-control" id="add_faqAnswer" rows="5"></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="onClickSubmitAddFAQ()">Save</button>
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

    let productFAQs = []

    function initializeDTFAQList() {
        $("#dtFAQList").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })
    }

    document.addEventListener("DOMContentLoaded", function() {
        if (productId !== "") {
            fetchFAQs()
        }

        // Handle tab switching and show the loader for the active tab
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            // Get the target tab ID
            var targetTabId = $(e.target).attr('href') // This will give #lead-details, #manage-accounts, etc.

            // Hide all loaders
            $('.overlay').show()

            if (targetTabId.replace("#", "") === "faq-list") {
                fetchFAQs(targetTabId)
            }
        })

        $('#modal-add-faq').on('hidden.bs.modal', function() {
            document.getElementById("add_faqId").value = "";
            document.getElementById("add_faqQuestion").value = "";
            document.getElementById("add_faqAnswer").value = "";
        });
    });

    async function fetchFAQs() {
        await postAPICall({
            endPoint: "/product-faq/list",
            payload: JSON.stringify({
                "filter": {
                    productId: Number(productId)
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
                $('#faq-list-loader').fadeIn()
                if ($.fn.DataTable.isDataTable("#dtFAQList")) {
                    $('#dtFAQList').DataTable().destroy()
                }
            },
            callbackComplete: function() {
                $('#faq-list-loader').fadeOut()
            },
            callbackSuccess: (response) => {
                const {
                    success,
                    message,
                    data
                } = response

                if (success) {
                    productFAQs = data

                    var html = ""

                    for (let i = 0; i < data?.length; i++) {
                        html += `<tr>
                            <td>${data[i].question ?? ""}</td>
                            <td>${data[i].answer ?? ""}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-faq-id="${data[i].productFAQId}" ${data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td class="list-action-container">
                                <span onclick="onClickUpdateFAQ(${data[i].productFAQId})"><i class="fa fa-edit view-icon"></i></span>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataFAQList").innerHTML = html;

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-status").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let faqId = this.getAttribute("data-faq-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            console.log(`FAQ ID: ${faqId}, New Status: ${newStatus}`);

                            // Call API to update status
                            updateFAQStatus(faqId, newStatus);
                        });
                    });


                    initializeDTFAQList()
                }

                loader.hide()
            }
        })
    }

    async function onClickSubmitAddFAQ() {
        const productFAQId = document.getElementById("add_faqId")?.value ?? null;
        const question = document.getElementById("add_faqQuestion").value;
        const answer = document.getElementById("add_faqAnswer").value;

        if ((question ?? "").trim() === "") {
            toastr.error("Please enter a valid question!");
            return;
        }

        if ((answer ?? "").trim() === "") {
            toastr.error("Please enter a valid answer!");
            return;
        }

        let payload = {
            question,
            answer
        }

        if (productFAQId !== "") {
            if (confirm("Are you sure you want to update this faq?")) {
                await postAPICall({
                    endPoint: "/product-faq/update",
                    payload: JSON.stringify({
                        productFAQId: Number(productFAQId),
                        ...payload
                    }),
                    callbackSuccess: (response) => {
                        if (response.success) {
                            toastr.success(response.message);
                            $('#modal-add-faq').modal('hide');
                            fetchFAQs()
                        }
                    }
                })
            }
        } else {
            if (confirm("Are you sure you want to create this faq?")) {
                await postAPICall({
                    endPoint: "/product-faq/create",
                    payload: JSON.stringify({
                        ...payload,
                        productId
                    }),
                    callbackSuccess: (response) => {
                        if (response.success) {
                            toastr.success(response.message);
                            $('#modal-add-faq').modal('hide');
                            fetchFAQs()
                        }
                    }
                })
            }
        }
    }

    async function updateFAQStatus(productFAQId, status) {
        await postAPICall({
            endPoint: "/product-faq/update",
            payload: JSON.stringify({
                productFAQId: Number(productFAQId),
                status: status === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchProductCategories()
                } else {
                    toastr.success(`FAQ ${status === "inactive" ? "blocked" : "unblocked"} successfully`)
                }
            }
        })
    }

    function onClickUpdateFAQ(productFAQId) {
        const selectedFAQ = productFAQs.find((productFAQ) => Number(productFAQ.productFAQId) === Number(productFAQId))

        document.getElementById("add_faqId").value = productFAQId
        document.getElementById("add_faqQuestion").value = selectedFAQ.question
        document.getElementById("add_faqAnswer").value = selectedFAQ.answer
        $('#modal-add-faq').modal('show');
    }
</script>

<?= $this->endSection(); ?>