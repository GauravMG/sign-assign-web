<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/service-detail.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="subheader-area">
    <div class="container-fluid">
    </div>
</div>

<div class="business-growth-area py-5">
    <div class="container-fluid">
        <h3 class="text-center mb-3"><?= $data["serviceData"]["fullTitle"]; ?></h3>
        <p class="text-center"><?= $data["serviceData"]["description"]; ?></p>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="grid-inner">
        <div class="inner" onclick="window.location.href = '/services/turnkey-project-management';">
            <h5>Turnkey Project Management</h5>
        </div>
        <div class="inner" onclick="window.location.href = '/services/sign-services-and-installation';">
            <h5>Sign Services & Installation</h5>
        </div>
        <div class="inner" onclick="window.location.href = '/services/permitting';">
            <h5>Permitting</h5>
        </div>
        <div class="inner" onclick="window.location.href = '/services/code-review-and-compliance';">
            <h5>Code Review and Compliance</h5>
        </div>
        <div class="inner" onclick="window.location.href = '/services/sign-engineering';">
            <h5>Sign Engineering</h5>
        </div>
        <div class="inner" onclick="window.location.href = '/services/sign-repairs';">
            <h5>Sign Repairs</h5>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('js/services.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>