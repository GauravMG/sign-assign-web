<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/blog-detail.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<h1>Blog details page</h1>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('js/blog-detail.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>