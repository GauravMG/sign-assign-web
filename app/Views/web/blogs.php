<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/blogs.css') . '?t=' . time(); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="subheader-area">
    <div class="container-fluid">
    </div>
</div>
<div class="container-fluid py-5">
    <h3>Learning Center</h3>
    <div class="blog-list-area" id="blogsList">
    </div>
    <div class="view-all-btn-area d-none" id="load-more-container">
        <a onclick="loadMore()" class="btn btn-primary">Load More <i class="fa-solid fa-circle-arrow-down"></i></a>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('js/blogs.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>