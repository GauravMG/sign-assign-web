<?= $this->extend('admin_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/summernote/summernote-bs4.min.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title"><?= isset($data["blogId"]) ? "Edit Blog" : "Add New Blog" ?></h3>
            </div>
            <form>
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description"></textarea>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-dark">
                            <?= isset($data["blogId"]) ? "Update" : "Create" ?> Blog
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
    const blogId = '<?= isset($data) ? $data["blogId"] : "" ?>';

    document.addEventListener("DOMContentLoaded", function() {
        $('#description').summernote({
            height: 350
        });

        if (blogId !== "") {
            fetchBlog();
        }

        document.querySelector(".btn-dark").addEventListener("click", onClickSubmit);

        async function fetchBlog() {
            await postAPICall({
                endPoint: "/blog/list",
                payload: JSON.stringify({
                    filter: {
                        blogId: Number(blogId)
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
                        const blog = data[0];

                        document.getElementById("title").value = blog.title;

                        $('#description').summernote('code', blog.description);
                    }
                }
            });
        }
        async function onClickSubmit() {
            const title = document.getElementById("title").value.trim();

            const description = $('#description').summernote('code');

            if (!title) return toastr.error("Please enter a valid title!");

            if ((description ?? "").trim() === "") return toastr.error("Please enter a valid description!");

            const payload = {
                title,
                description
            };

            const endpoint = blogId ? "/blog/update" : "/blog/create";
            const confirmMsg = blogId ? "Are you sure you want to update this blog?" : "Are you sure you want to create this blog?";

            if (confirm(confirmMsg)) {
                await postAPICall({
                    endPoint: endpoint,
                    payload: JSON.stringify({
                        ...(blogId && {
                            blogId: Number(blogId)
                        }),
                        ...payload
                    }),
                    callbackSuccess: (response) => {
                        if (response.success) {
                            toastr.success(response.message);
                            window.location.href = "/admin/blogs";
                        }
                    }
                });
            }
        }
    });
</script>
<?= $this->endSection(); ?>