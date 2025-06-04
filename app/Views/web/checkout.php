<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/checkout.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<h1>Checkout page</h1>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('js/checkout.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>