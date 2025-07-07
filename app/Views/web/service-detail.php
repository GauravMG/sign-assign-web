<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/service-detail.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="business-growth-area py-5">
    <div class="container-fluid">
        <h3 class="text-center mb-3"><?= $data["serviceData"]["fullTitle"]; ?></h3>
        <p class="text-center"><?= $data["serviceData"]["description"]; ?></p>
    </div>
</div>

<?= $this->include('web/partials/services-list'); ?>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('js/services.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>