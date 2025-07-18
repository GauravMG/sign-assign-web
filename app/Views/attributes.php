<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css'); ?>">
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
<div class="col-md-6 offset-md-6">
    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal-add-attribute">Add New Attribute</button>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">All Attributes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dtAttributesList" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Unit</th>
                            <th>Options</th>
                            <th>Is&nbsp;Filterable</th>
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
                <input type="hidden" id="add_attributeId">

                <div class="form-group">
                    <label for="add_attributeName">Name</label>
                    <input type="text" class="form-control" id="add_attributeName" placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label for="add_attributeType">Type</label>
                    <select class="form-control" id="add_attributeType" onchange="onAttributeTypeChange(this.value)">
                        <option value="">Select type</option>
                        <option value="text">Text</option>
                        <option value="number">Number</option>
                        <option value="boolean">Boolean</option>
                        <option value="select">Select</option>
                        <option value="multi_select">Multi Select</option>
                        <option value="dimension">Dimension</option>
                    </select>
                </div>

                <div class="form-group d-none" id="attributeOptionsGroup">
                    <label for="add_attributeOptions">Options (for Select / Multi-Select)</label>
                    <textarea class="form-control" id="add_attributeOptions" rows="3" placeholder='Enter options as comma separated values, e.g. "Small, Medium, Large"'></textarea>
                </div>

                <div class="form-group">
                    <label for="add_attributeUnit">Unit</label>
                    <input type="text" class="form-control" id="add_attributeUnit" placeholder="e.g. cm, inch">
                </div>

                <!-- <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="add_isFilterable">
                    <label class="form-check-label" for="add_isFilterable">Is Filterable</label>
                </div> -->
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark" onclick="onClickSubmitAddAttribute()">Save</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-fixedheader/js/dataTables.fixedHeader.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-fixedheader/js/fixedHeader.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>

<script>
    let attributes = []

    $(document).ready(function() {
        fetchAttributes()

        $('#modal-add-attribute').on('hidden.bs.modal', function() {
            document.getElementById("add_attributeName").value = "";
            document.getElementById("add_attributeType").value = "";
            document.getElementById("add_attributeOptions").value = "";
            document.getElementById("add_attributeUnit").value = "";
            // document.getElementById("add_isFilterable").value = "";
        });
    })

    function initializeDTAttributesList() {
        $("#dtAttributesList").DataTable({
            "paging": true,
            "lengthChange": true,
            "lengthMenu": [ [10, 25, 50, 100], [10, 25, 50, 100] ],
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "fixedHeader": true,
        })
    }

    function onAttributeTypeChange(value) {
        const optionsGroup = document.getElementById('attributeOptionsGroup');
        if (value === 'select' || value === 'multi_select') {
            optionsGroup.classList.remove('d-none');
        } else {
            optionsGroup.classList.add('d-none');
        }
    }

    async function fetchAttributes() {
        if ($.fn.DataTable.isDataTable("#dtAttributesList")) {
            $('#dtAttributesList').DataTable().destroy()
        }

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
            callbackComplete: () => {},
            callbackSuccess: (response) => {
                if (response.success) {
                    attributes = response.data

                    var html = ""

                    for (let i = 0; i < response.data?.length; i++) {
                        let options = ''
                        if (response.data[i]?.options) {
                            options = typeof response.data[i].options === "string" ? JSON.parse(response.data[i].options).join(",") : response.data[i].options.join(",")
                        }

                        html += `<tr>
                            <td>${response.data[i].name ?? ""}</td>
                            <td>${response.data[i].type ?? ""}</td>
                            <td>${response.data[i].unit ?? ""}</td>
                            <td>${options}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status" data-attribute-id="${response.data[i].attributeId}" ${response.data[i].status ? "checked" : ""}>
                                    <span class="slider"></span>
                                </label>
                            </td>
                            <td>
                                <div class="project-actions text-right d-flex justify-content-end" style="gap: 0.5rem;">
                                    <a class="btn btn-info btn-sm d-flex align-items-center" onclick="onClickUpdateAttribute(${response.data[i].attributeId})">
                                        <i class="fas fa-pencil-alt mr-1">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm d-flex align-items-center" onclick="onClickDeleteAttribute(${response.data[i].attributeId})">
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
                            let attributeId = this.getAttribute("data-attribute-id");
                            let isFilterable = this.checked ? true : false;

                            console.log(`Attribute ID: ${attributeId}, Filterable: ${isFilterable}`);

                            // Call API to update status
                            updateAttributeIsFilterable(attributeId, isFilterable);
                        });
                    });


                    initializeDTAttributesList()
                }
                loader.hide()
            }
        })
    }

    async function onClickSubmitAddAttribute() {
        // Get values from form inputs
        const attributeId = document.getElementById('add_attributeId').value.trim();
        const name = document.getElementById('add_attributeName').value.trim();
        const type = document.getElementById('add_attributeType').value;
        const options = document.getElementById('add_attributeOptions').value.trim();
        const unit = document.getElementById('add_attributeUnit').value.trim();
        // const isFilterable = document.getElementById('add_isFilterable').checked;

        // ============================
        // VALIDATIONS
        // ============================
        if (!name) {
            alert("Attribute name is required.");
            return;
        }

        if (!type) {
            alert("Attribute type is required.");
            return;
        }

        const validTypes = ['text', 'number', 'boolean', 'select', 'multi_select', 'dimension'];
        if (!validTypes.includes(type)) {
            alert("Invalid attribute type selected.");
            return;
        }

        if ((type === 'select' || type === 'multi_select') && !options) {
            alert("Options are required for select or multi_select type.");
            return;
        }

        // Optional: Validate options are valid comma-separated values
        let parsedOptions = null;
        if (options) {
            const optionArray = options.split(',').map(opt => opt.trim()).filter(opt => opt !== '');
            if (optionArray.length === 0 && (type === 'select' || type === 'multi_select')) {
                alert("Please enter at least one valid option.");
                return;
            }
            parsedOptions = JSON.stringify(optionArray); // store as JSON string
        }

        // Optional: Validate unit only if type is "dimension"
        if (type === 'dimension' && !unit) {
            alert("Unit is required for dimension type.");
            return;
        }

        // ============================
        // BUILD PAYLOAD
        // ============================
        const payload = {
            name: name,
            type: type,
            options: parsedOptions || null,
            unit: unit || null,
            // isFilterable: isFilterable,
        };

        if (attributeId) {
            payload.attributeId = Number(attributeId);
        }

        const endPoint = attributeId ? "/attribute/update" : "/attribute/create";
        const successMessage = attributeId ?
            "Attribute updated successfully" :
            "Attribute created successfully";

        await postAPICall({
            endPoint,
            payload: JSON.stringify(payload),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                } else {
                    toastr.success(successMessage)
                    $('#modal-add-attribute').modal('hide');
                    fetchAttributes()
                }
            }
        })
    }

    async function updateAttributeIsFilterable(attributeId, isFilterable) {
        await postAPICall({
            endPoint: "/attribute/update",
            payload: JSON.stringify({
                attributeId: Number(attributeId),
                isFilterable
            }),
            callbackSuccess: (response) => {
                if (!response.success) {
                    toastr.error(response.message)
                    fetchAttributes()
                } else {
                    toastr.success(`Attribute updated successfully`)
                }
            }
        })
    }

    function onClickUpdateAttribute(attributeId) {
        const selectedAttributeToEdit = attributes.find((attribute) => attribute.attributeId === attributeId)

        let options = ''
        if (selectedAttributeToEdit?.options) {
            options = typeof selectedAttributeToEdit.options === "string" ? JSON.parse(selectedAttributeToEdit.options).join(",") : selectedAttributeToEdit.options.join(",")
        }

        document.getElementById('add_attributeId').value = selectedAttributeToEdit?.attributeId || '';
        document.getElementById('add_attributeName').value = selectedAttributeToEdit?.name || '';
        document.getElementById('add_attributeType').value = selectedAttributeToEdit?.type || '';
        document.getElementById('add_attributeOptions').value = options;
        document.getElementById('add_attributeUnit').value = selectedAttributeToEdit?.unit || '';
        // document.getElementById('add_isFilterable').checked = selectedAttributeToEdit?.isFilterable || false;

        // Trigger any dependent UI behavior
        document.getElementById('add_attributeType').dispatchEvent(new Event('change'));

        $('#modal-add-attribute').modal('show');
    }

    async function onClickDeleteAttribute(attributeId) {
        if (confirm("Are you sure you want to delete this item?")) {
            await postAPICall({
                endPoint: "/attribute/delete",
                payload: JSON.stringify({
                    attributeIds: [Number(attributeId)]
                }),
                callbackSuccess: (response) => {
                    if (!response.success) {
                        toastr.error(response.message)
                    } else {
                        toastr.success(`Attribute deleted successfully`)
                    }
                    fetchAttributes()
                }
            })
        }
    }
</script>
<?= $this->endSection(); ?>