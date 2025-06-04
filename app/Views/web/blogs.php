<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/blogs.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<h1>Blogs page</h1>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('js/blogs.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>