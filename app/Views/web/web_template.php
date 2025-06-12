<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sign Assign - Admin Panel' ?></title>
    <link rel="icon" type="image/jpg" href="<?= base_url('images/cropped-sign-assign_icon-32x32.jpg'); ?>">

    <!-- Title font family cdn -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <!-- paragraph font family cdn -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- flatIcon cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@flaticon/flaticon-uicons@3.3.1/css/all/all.min.css">
    <!-- swiper carousel cdn -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- owl carousel cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="<?= base_url('css/common.css') . '?t=' . time(); ?>">
    <link rel="stylesheet" href="<?= base_url('css/navbar.css') . '?t=' . time(); ?>">
    <link rel="stylesheet" href="<?= base_url('css/home-page.css') . '?t=' . time(); ?>">
    <link rel="stylesheet" href="<?= base_url('css/footer.css') . '?t=' . time(); ?>">
    <link rel="stylesheet" href="<?= base_url('css/auth.css') . '?t=' . time(); ?>">
    <?= $this->renderSection('pageStyles'); ?>
    <!-- responsive css -->
    <link rel="stylesheet" href="<?= base_url('css/responsive-navbar.css') . '?t=' . time(); ?>">
    <link rel="stylesheet" href="<?= base_url('css/responsive.css') . '?t=' . time(); ?>">

    <style>
        #verifyAndSetPasswordContainer,
        #businessDetailsContainer {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?= $this->include('web/partials/navbar'); ?>

    <!-- Content Wrapper -->
    <?= $this->renderSection('content'); ?>

    <!-- Footer -->
    <?= $this->include('web/partials/footer'); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"
        integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@flaticon/flaticon-uicons@3.3.1/license.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const BASE_URL = '<?= base_url(); ?>'
        const BASE_URL_API = '<?= BASE_URL_API ?>'
        const BASE_URL_USER_DASHBOARD = '<?= BASE_URL_USER_DASHBOARD ?>'
        const BASE_URL_EDITOR = '<?= BASE_URL_EDITOR ?>'
    </script>

    <script src="<?= base_url('js/utils/alert.js') . '?t=' . time(); ?>"></script>
    <script src="<?= base_url('js/service-api-web.js') . '?t=' . time(); ?>"></script>
    <script src="<?= base_url('js/common.js') . '?t=' . time(); ?>"></script>
    <script src="<?= base_url('js/helper-url.js') . '?t=' . time(); ?>"></script>
    <script src="<?= base_url('js/helper-text.js') . '?t=' . time(); ?>"></script>
    <script src="<?= base_url('js/helper-date.js') . '?t=' . time(); ?>"></script>
    <script src="<?= base_url('js/helper-user.js') . '?t=' . time(); ?>"></script>

    <!-- Section for page-specific JS -->
    <?= $this->renderSection('pageScripts'); ?>
</body>

</html>