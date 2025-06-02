<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/about-us.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<h1>About us page</h1>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('js/about-us.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>