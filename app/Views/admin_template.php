<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sign Assign - Admin Panel' ?></title>
    <link rel="icon" type="image/jpg" href="<?= base_url('images/cropped-sign-assign_icon-32x32.jpg'); ?>">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/toastr/toastr.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Section for page-specific CSS -->
    <?= $this->renderSection('pageStyles'); ?>

    <link rel="stylesheet" href="<?= base_url('css/common-admin.css') . '?t=' . time(); ?>">
</head>

<body class="hold-transition sidebar-mini sidebar-fix">
    <div id="global-loader" class="loader-overlay">
        <div class="loader"></div>
    </div>

    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->include('partials/navbar'); ?>

        <!-- Sidebar -->
        <?= $this->include('partials/sidebar'); ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $page_heading ?? 'Dashboard' ?></h1>
                        </div>
                        <!-- Optional Button Section -->
                        <div class="col-sm-6 text-right">
                            <?= $this->renderSection('headerButtons'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?= $this->renderSection('content'); ?>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <?= $this->include('partials/footer'); ?>
    </div>

    <!-- AdminLTE JS -->
    <script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/toastr/toastr.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/dist/js/adminlte.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        const BASE_URL = '<?= base_url(); ?>'
        const BASE_URL_API = '<?= BASE_URL_API ?>'
    </script>

    <script src="<?= base_url('js/service-api-admin.js') . '?t=' . time(); ?>"></script>
    <script src="<?= base_url('js/common-admin.js') . '?t=' . time(); ?>"></script>
    <script src="<?= base_url('js/helper-file.js') . '?t=' . time(); ?>"></script>
    <script src="<?= base_url('js/helper-date.js') . '?t=' . time(); ?>"></script>
    <script src="<?= base_url('js/helper-text.js') . '?t=' . time(); ?>"></script>
    <script src="<?= base_url('js/helper-user.js') . '?t=' . time(); ?>"></script>

    <!-- Section for page-specific JS -->
    <?= $this->renderSection('pageScripts'); ?>
</body>

</html>