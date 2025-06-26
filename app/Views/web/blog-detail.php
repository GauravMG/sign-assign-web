<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/blog-detail.css') . '?t=' . time(); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="blog-detail-area pt-5">
    <div class="container-fluid">
        <h1 id="blogTitle"></h1>
        <h6>by signassi | <span id="blogDate"></span> | Signage</h6>
        <div id="blogMedia"></div>
        <div class="blog-content" id="blogDescription">
        </div>
    </div>
</div>

<div class="form-area py-5">
    <div class="container-fluid">
        <div class="form-inner-area">
            <div class="text-area">
                <h4 class="mb-3">Trade Partners Can Get Up to 30% Off!</h4>
                <p>
                    We are offering exclusive discounts for trade partners. All you need to do is provide us with
                    your name and email, we'll
                    ask for some further details and upon confirmation you can enjoy
                    up to 30% discount on your orders!
                </p>
            </div>
            <div class="form-card">
                <form action="#">
                    <div class="form-group">
                        <input type="name" placeholder="First Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="name" placeholder="Last Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Email Address" class="form-control" required>
                    </div>
                    <a href="#">Submit Now</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script>
    const blogId = Number('<?= $data["blogId"]; ?>')
</script>
<script src="<?= base_url('js/blog-detail.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>