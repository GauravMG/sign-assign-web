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
                        <a class="nav-link active" id="attribute-list-tab" data-toggle="pill"
                            href="#attribute-list" role="tab"
                            aria-controls="attribute-list" aria-selected="true">Attributes</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-five-tabContent">
                    <div class="tab-pane fade show active" id="attribute-list"
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

                            <table id="dtProductAttributeList" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Additional Price</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="dataProductAttributeList">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Additional Price</th>
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

                <!-- Boolean Input -->
                <div class="form-group d-none" id="booleanInputGroup">
                    <label>
                        <input type="checkbox" id="booleanInput" />
                        Yes / No
                    </label>
                </div>

                <!-- Select Input -->
                <div class="form-group d-none" id="selectInputGroup">
                    <label for="selectInput">Choose Option</label>
                    <select class="form-control" id="selectInput">
                        <!-- options will be populated dynamically -->
                    </select>
                </div>

                <!-- Multi Select Input -->
                <div class="form-group d-none" id="multiSelectInputGroup">
                    <label for="multiSelectInput">Choose Multiple Options</label>
                    <select multiple class="form-control" id="multiSelectInput">
                        <!-- options will be populated dynamically -->
                    </select>
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

                <!-- Additional Price Input -->
                <div class="form-group" id="additionalPriceGroup">
                    <label for="additionalPrice">Additional Price (optional)</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input
                            type="text"
                            class="form-control"
                            id="additionalPrice"
                            placeholder="Enter price"
                            oninput="validateDecimal(this)">
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="onClickSubmitAddProductAttribute()">Save</button>
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

    let allAttributes = []

    function initializeDTProductAttributeList() {
        $("#dtProductAttributeList").DataTable({
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
            fetchAttributes()
        }

        // Handle tab switching and show the loader for the active tab
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            // Get the target tab ID
            var targetTabId = $(e.target).attr('href') // This will give #lead-details, #manage-accounts, etc.

            // Hide all loaders
            $('.overlay').show()

            if (targetTabId.replace("#", "") === "attribute-list") {
                fetchAttributes()
            }
        })

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

        fetchProductAttributes()
    }

    async function fetchProductAttributes() {
        await postAPICall({
            endPoint: "/product-attribute/list",
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
                $('#attribute-list-loader').fadeIn()
                if ($.fn.DataTable.isDataTable("#dtProductAttributeList")) {
                    $('#dtProductAttributeList').DataTable().destroy()
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
                        let value = ''
                        if (data[i].value) {
                            if (Array.isArray(data[i].value)) {
                                value = data[i].value.join(',');
                            } else if (typeof data[i].value === "string") {
                                try {
                                    const parsed = JSON.parse(data[i].value);
                                    if (Array.isArray(parsed)) {
                                        value = parsed.join(',');
                                    } else {
                                        // fallback: treat the string as plain text
                                        value = data[i].value;
                                    }
                                } catch (e) {
                                    // If JSON parsing fails, treat as plain comma-separated string
                                    value = data[i].value;
                                }
                            }
                        }

                        html += `<tr>
                            <td>${data[i].attribute?.name ?? ""}</td>
                            <td>${value ?? ""}</td>
                            <td>${(data[i].additionalPrice ?? "").toString().trim() !== "" ? `$${data[i].additionalPrice ?? ""}` : "-"}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-product-id="${data[i].productAttributeId}" ${data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>`;
                    }

                    // Insert the generated table rows
                    document.getElementById("dataProductAttributeList").innerHTML = html;

                    // Add event listeners to all toggle switches after rendering
                    document.querySelectorAll(".toggle-status").forEach((toggle) => {
                        toggle.addEventListener("change", function() {
                            let productId = this.getAttribute("data-product-id");
                            let newStatus = this.checked ? "active" : "inactive";

                            // Call API to update status
                            updateProductAttributeStatus(productId, newStatus);
                        });
                    });


                    initializeDTProductAttributeList()
                }

                loader.hide()
            }
        })
    }

    function populateAttributeDropdown() {
        const dropdown = document.getElementById('attributeSelect');
        dropdown.innerHTML = '<option value="" disabled selected>Select Attribute</option>';

        allAttributes.forEach(attr => {
            const option = document.createElement('option');
            option.value = attr.attributeId;
            option.text = attr.name;
            dropdown.appendChild(option);
        });
    }

    function onAttributeChange() {
        const selectedId = parseInt(document.getElementById('attributeSelect').value);
        const selectedAttr = allAttributes.find(attr => parseInt(attr.attributeId) === parseInt(selectedId));

        // Hide all input groups first
        ['textInputGroup', 'numberInputGroup', 'booleanInputGroup', 'selectInputGroup', 'multiSelectInputGroup', 'dimensionGroup'].forEach(id => {
            document.getElementById(id).classList.add('d-none');
        });

        if (!selectedAttr) return;

        document.getElementById('selectedAttributeId').value = selectedAttr.attributeId;

        switch (selectedAttr.type) {
            case 'text':
                document.getElementById('textInputGroup').classList.remove('d-none');
                break;
            case 'number':
                document.getElementById('numberInputGroup').classList.remove('d-none');
                break;
            case 'boolean':
                document.getElementById('booleanInputGroup').classList.remove('d-none');
                break;
            case 'select':
                const selectInput = document.getElementById('selectInput');
                selectInput.innerHTML = '';
                try {
                    const options = JSON.parse(selectedAttr.options || '[]');
                    options.forEach(opt => {
                        const option = document.createElement('option');
                        option.value = opt;
                        option.text = opt;
                        selectInput.appendChild(option);
                    });
                } catch (err) {
                    console.error('Invalid JSON in select options');
                }
                document.getElementById('selectInputGroup').classList.remove('d-none');
                break;
            case 'multi_select':
                const multiSelectInput = document.getElementById('multiSelectInput');
                multiSelectInput.innerHTML = '';
                try {
                    const options = JSON.parse(selectedAttr.options || '[]');
                    options.forEach(opt => {
                        const option = document.createElement('option');
                        option.value = opt;
                        option.text = opt;
                        multiSelectInput.appendChild(option);
                    });
                } catch (err) {
                    console.error('Invalid JSON in multi_select options');
                }
                document.getElementById('multiSelectInputGroup').classList.remove('d-none');
                break;
            case 'dimension':
                document.getElementById('dimensionGroup').classList.remove('d-none');
                break;
        }
    }

    async function onClickSubmitAddProductAttribute() {
        const selectedAttributeId = document.getElementById('selectedAttributeId').value?.trim();
        let value = null;

        if (!selectedAttributeId) {
            alert("Please select an attribute!");
            return;
        }

        const selectedAttribute = allAttributes.find((attribute) => parseInt(attribute.attributeId) === parseInt(selectedAttributeId));
        if (!selectedAttribute) {
            alert("Invalid attribute selected!");
            return;
        }

        switch (selectedAttribute.type) {
            case 'text':
                value = document.getElementById('textInput').value.trim();
                if (!value) {
                    alert("Text value required.");
                    return;
                }
                break;

            case 'number':
                const num = document.getElementById('numberInput').value.trim();
                if (!num || isNaN(num)) {
                    alert("Valid number required.");
                    return;
                }
                value = parseFloat(num);
                break;

            case 'boolean':
                value = document.getElementById('booleanInput').checked;
                break;

            case 'select':
                value = document.getElementById('selectInput').value;
                if (!value) {
                    alert("Please select an option.");
                    return;
                }
                break;

            case 'multi_select':
                const selectedOptions = Array.from(document.getElementById('multiSelectInput').selectedOptions);
                value = selectedOptions.map(opt => opt.value);
                if (value.length === 0) {
                    alert("Please select at least one option.");
                    return;
                }
                value = JSON.stringify(value); // Optional: store as JSON
                break;

            case 'dimension':
                const width = document.getElementById('dimensionWidth').value.trim();
                const height = document.getElementById('dimensionHeight').value.trim();
                if (!width || !height) {
                    alert("Both width and height required.");
                    return;
                }
                value = JSON.stringify({
                    width,
                    height
                });
                break;

            default:
                alert("Unsupported attribute type.");
                return;
        }

        // Get optional additional price
        const additionalPriceInput = document.getElementById('additionalPrice').value.trim();
        let additionalPrice = null;
        if (additionalPriceInput !== "") {
            if (isNaN(additionalPriceInput) || parseFloat(additionalPriceInput) < 0) {
                return toastr.error("Additional price must be a positive number.");
            }
            additionalPrice = parseFloat(additionalPriceInput);
        }

        const payload = {
            attributeId: selectedAttributeId,
            productId,
            value,
            ...(additionalPrice !== null && {
                additionalPrice
            }) // only include if set
        };

        await postAPICall({
            endPoint: "/product-attribute/create",
            payload: JSON.stringify(payload),
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                const {
                    success,
                    message
                } = response;
                if (success) {
                    toastr.success(message);
                    fetchProductAttributes();
                    $('#modal-add-attribute').modal('hide');
                } else {
                    toastr.error(message);
                }
                loader.hide();
            }
        });
    }

    async function updateProductAttributeStatus(productAttributeId, status) {
        await postAPICall({
            endPoint: "/product-attribute/update",
            payload: JSON.stringify({
                productAttributeId: Number(productAttributeId),
                status: status === "inactive" ? false : true
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchProductCategories()
                } else {
                    toastr.success(`Product attribute ${status === "inactive" ? "blocked" : "unblocked"} successfully`)
                }
            }
        })
    }
</script>

<?= $this->endSection(); ?>