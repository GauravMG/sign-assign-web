<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Add New Banner</h3>
            </div>
            <!-- /.card-header -->
            <form>
                <div class="card-body">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" accept="image/*">
                        <div id="imagePreview" class="mt-2"></div>
                        <button type="button" class="btn btn-danger mt-2 d-none" id="removeImage">Remove Image</button>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-dark">Add Banner</button>
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
<script src="<?= base_url('assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
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

        async function onClickSubmit() {
            let url = uploadedImage
            let mediaType = null
            let name = null
            let size = null

            const fileInput = document.getElementById("image");

            if ((url ?? "").trim() === "") {
                toastr.error("Please upload an image!");
                return;
            }

            if (fileInput.files.length > 0) {
                ({
                    mediaType,
                    name,
                    size,
                    url
                } = await uploadImage(fileInput.files[0]));
            }

            let payload = {
                name,
                mediaType,
                mediaUrl: url,
                size,
            }

            if (confirm("Are you sure you want to add this banner?")) {
                await postAPICall({
                    endPoint: "/banner/create",
                    payload: JSON.stringify({
                        ...payload
                    }),
                    callbackSuccess: (response) => {
                        if (response.success) {
                            toastr.success(response.message);
                            window.location.href = "/admin/banners";
                        }
                    }
                })
            }
        }

        document.querySelector(".btn-dark").addEventListener("click", onClickSubmit);
    });
</script>

<?= $this->endSection(); ?>