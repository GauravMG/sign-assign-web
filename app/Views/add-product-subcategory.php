<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/summernote/summernote-bs4.min.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title"><?php if (isset($data["productSubCategoryId"])) {
                                            echo "Edit Product Sub-category";
                                        } else {
                                            echo "Add New Product Sub-category";
                                        } ?></h3>
            </div>
            <!-- /.card-header -->
            <form>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" accept="image/*">
                        <div id="imagePreview" class="mt-2"></div>
                        <button type="button" class="btn btn-danger mt-2 d-none" id="removeImage">Remove Image</button>
                    </div>
                    <div class="form-group">
                        <label for="shortDescription">Short Description</label>
                        <textarea class="form-control" id="shortDescription" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-dark"><?php if (isset($data["productSubCategoryId"])) {
                                                                                        echo "Update";
                                                                                    } else {
                                                                                        echo "Create";
                                                                                    } ?></h3> Product Sub-category</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
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
<script src="<?= base_url('assets/adminlte/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
<script>
    let productCategoryId = '<?php if (isset($data["productCategoryId"])) {
                                    echo $data["productCategoryId"];
                                } else {
                                    echo "";
                                } ?>'
    let productSubCategoryId = '<?php if (isset($data["productSubCategoryId"])) {
                                    echo $data["productSubCategoryId"];
                                } else {
                                    echo "";
                                } ?>'

    document.addEventListener("DOMContentLoaded", function() {
        $('#description').summernote({
            height: 350
        })

        if (productSubCategoryId !== "") {
            fetchProductSubCategory()
        }

        document.getElementById("image").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    uploadedImage = e.target.result;
                    document.getElementById("imagePreview").innerHTML = `<img src="${uploadedImage}" class="img-fluid" width="150" alt="Image">`;
                    document.getElementById("removeImage").classList.remove("d-none");
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById("removeImage").addEventListener("click", function() {
            uploadedImage = "";
            document.getElementById("image").value = "";
            document.getElementById("imagePreview").innerHTML = "";
            this.classList.add("d-none");
        });

        async function fetchProductSubCategory() {
            await postAPICall({
                endPoint: "/product-subcategory/list",
                payload: JSON.stringify({
                    "filter": {
                        productSubCategoryId: Number(productSubCategoryId)
                    },
                    "range": {
                        "all": true
                    },
                    "sort": [{
                        "orderBy": "createdAt",
                        "orderDir": "asc"
                    }]
                }),
                callbackComplete: () => {},
                callbackSuccess: (response) => {
                    if (response.success) {
                        const data = response.data[0]
                        document.getElementById("name").value = data.name
                        document.getElementById("shortDescription").value = data.shortDescription
                        $('#description').summernote('code', data.description)
                        uploadedImage = data.image

                        productCategoryId = data.productCategoryId
                    }

                    loader.hide()
                }
            })
        }

        async function onClickSubmit() {
            const name = document.getElementById("name").value;
            const shortDescription = document.getElementById("shortDescription").value;
            const description = document.getElementById("description").value;

            let image = uploadedImage

            const fileInput = document.getElementById("image");

            if ((name ?? "").trim() === "") {
                toastr.error("Please enter a valid name!");
                return;
            }

            if ((shortDescription ?? "").trim() === "") {
                toastr.error("Please enter a valid short description!");
                return;
            }

            if ((description ?? "").trim() === "") {
                toastr.error("Please enter a valid description!");
                return;
            }

            if ((image ?? "").trim() === "") {
                toastr.error("Please upload an image!");
                return;
            }

            if (fileInput.files.length > 0) {
                image = await uploadImage(fileInput.files[0]);
            }

            let payload = {
                name,
                shortDescription,
                description
            }
            if ((image ?? "").trim() !== "") {
                payload = {
                    ...payload,
                    image
                }
            }

            if (productSubCategoryId !== "") {
                if (confirm("Are you sure you want to update this product sub-category?")) {
                    await postAPICall({
                        endPoint: "/product-subcategory/update",
                        payload: JSON.stringify({
                            productSubCategoryId: Number(productSubCategoryId),
                            ...payload
                        }),
                        callbackSuccess: (response) => {
                            if (response.success) {
                                toastr.success(response.message);
                                window.location.href = `/admin/product-categories/view/${productCategoryId}`;
                            }
                        }
                    })
                }
            } else {
                if (confirm("Are you sure you want to create this product sub-category?")) {
                    await postAPICall({
                        endPoint: "/product-subcategory/create",
                        payload: JSON.stringify({
                            ...payload,
                            productCategoryId
                        }),
                        callbackSuccess: (response) => {
                            if (response.success) {
                                toastr.success(response.message);
                                window.location.href = `/admin/product-categories/view/${productCategoryId}`;
                            }
                        }
                    })
                }
            }
        }

        document.querySelector(".btn-dark").addEventListener("click", onClickSubmit);
    });
</script>

<?= $this->endSection(); ?>