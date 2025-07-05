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
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script>
    const blogId = Number('<?= $data["blogId"]; ?>')
</script>
<script src="<?= base_url('js/blog-detail.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>