<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/summernote/summernote-bs4.min.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title"><?= isset($data["productId"]) ? "Edit Product" : "Add New Product" ?></h3>
            </div>
            <form>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" id="productCategoryId" name="productCategoryId">
                            <option value="-">-- Select category --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sub-Category</label>
                        <select class="form-control" id="productSubCategoryId" name="productSubCategoryId">
                            <option value="-">-- Select sub-category --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="specification">Specification</label>
                        <textarea class="form-control" id="specification"></textarea>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-dark">
                            <?= isset($data["productId"]) ? "Update" : "Create" ?> Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('assets/adminlte/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
<script>
    const productId = '<?= isset($data) ? $data["productId"] : "" ?>';
    let productCategories = [];
    document.addEventListener("DOMContentLoaded", function() {
        $('#description').summernote({
            height: 350
        });
        $('#specification').summernote({
            height: 350
        });
        fetchMasterData();
        document.getElementById("productCategoryId").addEventListener("change", function() {
            const selectedCatId = this.value;
            updateSubCategoryOptions(selectedCatId);
        });
        document.querySelector(".btn-dark").addEventListener("click", onClickSubmit);
        async function fetchMasterData() {
            await postAPICall({
                endPoint: "/product-category/list",
                payload: JSON.stringify({
                    filter: {},
                    range: {
                        all: true
                    },
                    sort: [{
                        orderBy: "name",
                        orderDir: "asc"
                    }],
                    linkedEntities: true
                }),
                callbackSuccess: (response) => {
                    const {
                        success,
                        data
                    } = response;
                    if (success) {
                        productCategories = data;
                        let categoryHtml = `<option value="-">-- Select category --</option>`;
                        data.forEach(cat => {
                            categoryHtml += `<option value="${cat.productCategoryId}">${cat.name}</option>`;
                        });
                        document.getElementById("productCategoryId").innerHTML = categoryHtml;
                        if (productId !== "") {
                            fetchProduct();
                        }
                    }
                }
            });
        }

        function updateSubCategoryOptions(categoryId, selectedSubId = null) {
            let subCategoryHtml = `<option value="-">-- Select sub-category --</option>`;
            const selectedCategory = productCategories.find(cat => cat.productCategoryId == categoryId);
            if (selectedCategory?.productSubCategories?.length) {
                selectedCategory.productSubCategories.forEach(sub => {
                    subCategoryHtml += `<option value="${sub.productSubCategoryId}" ${sub.productSubCategoryId == selectedSubId ? 'selected' : ''}>${sub.name}</option>`;
                });
            }
            document.getElementById("productSubCategoryId").innerHTML = subCategoryHtml;
        }
        async function fetchProduct() {
            await postAPICall({
                endPoint: "/product/list",
                payload: JSON.stringify({
                    filter: {
                        productId: Number(productId)
                    },
                    range: {
                        all: true
                    },
                    sort: [{
                        orderBy: "createdAt",
                        orderDir: "asc"
                    }]
                }),
                callbackSuccess: (response) => {
                    const {
                        success,
                        data
                    } = response;
                    if (success && data.length > 0) {
                        const product = data[0];
                        document.getElementById("name").value = product.name;
                        $('#description').summernote('code', product.description);
                        $('#specification').summernote('code', product.specification);
                        document.getElementById("productCategoryId").value = product.productCategoryId;
                        updateSubCategoryOptions(product.productCategoryId, product.productSubCategoryId);
                    }
                }
            });
        }
        async function onClickSubmit() {
            const name = document.getElementById("name").value.trim();
            const description = $('#description').summernote('code');
            const specification = $('#specification').summernote('code');
            const productCategoryId = document.getElementById("productCategoryId").value;
            const productSubCategoryId = document.getElementById("productSubCategoryId").value;
            if (!name) return toastr.error("Please enter a valid name!");
            if ((description ?? "").trim() === "") return toastr.error("Please enter a valid description!");
            if ((specification ?? "").trim() === "") return toastr.error("Please enter a valid specification!");
            if (productCategoryId === "-") return toastr.error("Please select a category!");
            if (productSubCategoryId === "-") return toastr.error("Please select a sub-category!");
            const payload = {
                name,
                description,
                specification,
                productCategoryId: Number(productCategoryId),
                productSubCategoryId: Number(productSubCategoryId)
            };
            const endpoint = productId ? "/product/update" : "/product/create";
            const confirmMsg = productId ? "Are you sure you want to update this product?" : "Are you sure you want to create this product?";
            if (confirm(confirmMsg)) {
                await postAPICall({
                    endPoint: endpoint,
                    payload: JSON.stringify({
                        ...(productId && {
                            productId: Number(productId)
                        }),
                        ...payload
                    }),
                    callbackSuccess: (response) => {
                        if (response.success) {
                            toastr.success(response.message);
                            window.location.href = "/admin/products";
                        }
                    }
                });
            }
        }
    });
</script>
<?= $this->endSection(); ?>