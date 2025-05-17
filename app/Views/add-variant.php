<?= $this->extend('admin_template'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title"><?php if (isset($data["variantId"])) {
                                            echo "Edit Variant";
                                        } else {
                                            echo "Add New Variant";
                                        } ?></h3>
            </div>
            <!-- /.card-header -->
            <form>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-dark"><?php if (isset($data["variantId"])) {
                                                                                        echo "Update";
                                                                                    } else {
                                                                                        echo "Create";
                                                                                    } ?> Variant</button>
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
<script>
    let productId = '<?php if (isset($data["productId"])) {
                            echo $data["productId"];
                        } else {
                            echo "";
                        } ?>'
    let variantId = '<?php if (isset($data["variantId"])) {
                            echo $data["variantId"];
                        } else {
                            echo "";
                        } ?>'

    document.addEventListener("DOMContentLoaded", function() {
        if (variantId !== "") {
            fetchVariant()
        }

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
                callbackComplete: () => {},
                callbackSuccess: (response) => {
                    if (response.success) {
                        const data = response.data[0]
                        document.getElementById("name").value = data.name

                        productId = data.productId
                    }

                    loader.hide()
                }
            })
        }

        async function onClickSubmit() {
            const name = document.getElementById("name").value;

            if ((name ?? "").trim() === "") {
                toastr.error("Please enter a valid name!");
                return;
            }

            let payload = {
                name
            }

            if (variantId !== "") {
                if (confirm("Are you sure you want to update this variant?")) {
                    await postAPICall({
                        endPoint: "/variant/update",
                        payload: JSON.stringify({
                            variantId: Number(variantId),
                            ...payload
                        }),
                        callbackSuccess: (response) => {
                            if (response.success) {
                                toastr.success(response.message);
                                window.location.href = `/admin/products/view/${productId}`;
                            }
                        }
                    })
                }
            } else {
                if (confirm("Are you sure you want to create this variant?")) {
                    await postAPICall({
                        endPoint: "/variant/create",
                        payload: JSON.stringify({
                            ...payload,
                            productId
                        }),
                        callbackSuccess: (response) => {
                            if (response.success) {
                                toastr.success(response.message);
                                window.location.href = `/admin/products/view/${productId}`;
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