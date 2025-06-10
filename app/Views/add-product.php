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
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="sku">SKU</label>
                            <input type="text" class="form-control" id="sku" placeholder="Enter sku">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="price">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="price"
                                    placeholder="Enter price"
                                    oninput="validateDecimal(this)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Category</label>
                            <select class="form-control" id="productCategoryId" name="productCategoryId">
                                <option value="-">-- Select category --</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Sub-Category</label>
                            <select class="form-control" id="productSubCategoryId" name="productSubCategoryId">
                                <option value="-">-- Select sub-category --</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="shortDescription">Short Description</label>
                            <textarea class="form-control" id="shortDescription"></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="features">Key Features</label>
                            <textarea class="form-control" id="features"></textarea>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="section1Title">Section 1 Title</label>
                        <input type="text" class="form-control" id="section1Title" />
                    </div>
                    <div class="form-group">
                        <label for="section1Description">Section 1 Description</label>
                        <textarea class="form-control" id="section1Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="section2Title">Section 2 Title</label>
                        <input type="text" class="form-control" id="section2Title" />
                    </div>
                    <div class="form-group">
                        <label for="section2Description">Section 2 Description</label>
                        <textarea class="form-control" id="section2Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="section3Title">Section 3 Title</label>
                        <input type="text" class="form-control" id="section3Title" />
                    </div>
                    <div class="form-group">
                        <label for="section3Description">Section 3 Description</label>
                        <textarea class="form-control" id="section3Description"></textarea>
                    </div> -->
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
        $('#shortDescription').summernote({
            height: 200
        });
        // $('#section1Description').summernote({
        //     height: 150
        // });
        // $('#section2Description').summernote({
        //     height: 150
        // });
        // $('#section3Description').summernote({
        //     height: 150
        // });
        $('#features').summernote({
            height: 200
        });
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
                        document.getElementById("sku").value = product.sku;
                        document.getElementById("price").value = product.price;

                        $('#shortDescription').summernote('code', product.shortDescription);

                        // document.getElementById("section1Title").value = product.section1Title
                        // $('#section1Description').summernote('code', product.section1Description);
                        // document.getElementById("section2Title").value = product.section2Title
                        // $('#section2Description').summernote('code', product.section2Description);
                        // document.getElementById("section3Title").value = product.section3Title
                        // $('#section3Description').summernote('code', product.section3Description);

                        $('#features').summernote('code', product.features);
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
            const sku = document.getElementById("sku").value.trim();
            const price = document.getElementById("price").value.trim();

            const shortDescription = $('#shortDescription').summernote('code');

            // const section1Title = document.getElementById("section1Title").value.trim()
            // const section1Description = $('#section1Description').summernote('code');
            // const section2Title = document.getElementById("section2Title").value.trim()
            // const section2Description = $('#section2Description').summernote('code');
            // const section3Title = document.getElementById("section3Title").value.trim()
            // const section3Description = $('#section3Description').summernote('code');

            const features = $('#features').summernote('code');
            const description = $('#description').summernote('code');
            const specification = $('#specification').summernote('code');

            const productCategoryId = document.getElementById("productCategoryId").value;
            const productSubCategoryId = document.getElementById("productSubCategoryId").value;

            if (!name) return toastr.error("Please enter a valid name!");

            if (!sku) return toastr.error("Please enter a valid sku!");

            if (!price) return toastr.error("Please enter a valid price!");

            if ((shortDescription ?? "").trim() === "") return toastr.error("Please enter a valid short description!");

            // if ((section1Title ?? "").trim() === "") return toastr.error("Please enter a valid section 1 title!");
            // if ((section1Description ?? "").trim() === "") return toastr.error("Please enter a valid section 1 description!");
            // if ((section2Title ?? "").trim() === "") return toastr.error("Please enter a valid section 2 title!");
            // if ((section2Description ?? "").trim() === "") return toastr.error("Please enter a valid section 2 description!");
            // if ((section3Title ?? "").trim() === "") return toastr.error("Please enter a valid section 3 title!");
            // if ((section3Description ?? "").trim() === "") return toastr.error("Please enter a valid section 3 description!");

            if ((features ?? "").trim() === "") return toastr.error("Please enter a valid features!");

            if ((description ?? "").trim() === "") return toastr.error("Please enter a valid description!");

            if ((specification ?? "").trim() === "") return toastr.error("Please enter a valid specification!");

            if (productCategoryId === "-") return toastr.error("Please select a category!");

            if (productSubCategoryId === "-") return toastr.error("Please select a sub-category!");

            const payload = {
                name,
                sku,
                price,
                shortDescription,
                // section1Title,
                // section1Description,
                // section2Title,
                // section2Description,
                // section3Title,
                // section3Description,
                features,
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