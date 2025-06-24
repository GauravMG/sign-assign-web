<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/search.css'); ?>">
<link rel="stylesheet" href="<?= base_url('css/banner-page.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="breadcrumbs-area">
    <div class="container-fluid">
        <div class="flex-inner">
            <div class="left">
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <span>
                            <i class="fa-solid fa-angle-right"></i>
                        </span>
                    </li>
                    <li>Search</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="banner-product-area py-5">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Search</h3>
            <a href="#" class="filter-button" data-bs-toggle="modal" data-bs-target="#filterModal">Filters</a>
        </div>
        <div class="filter-divider">
            <div class="left-area">
                <div class="banner-inner" id="dataList"></div>
            </div>
            <div class="right-area">
                <div class="main-filter-area">
                    <div class="filters-inner">
                        <div class="filter-dropdown-area">
                            <h6>Category</h6>
                            <span>
                                <i class="fa-solid fa-caret-up"></i>
                            </span>
                        </div>
                        <ul id="filterByCategoriesContainer">
                        </ul>
                    </div>
                    <div id="dynamicAttributeFilters"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="custom-banner-area py-5">
    <div class="container-fluid" id="categoryDescription">
    </div>
</div>

<div class="form-area py-5">
    <div class="container-fluid">
        <div class="form-inner-area">
            <div class="text-area">
                <h4 class="mb-3">Trade Partners Can Get Up to 30% Off!</h4>
                <p>
                    We are offering exclusive discounts for trade partners. All you need to do is provide us with
                    your name and email, we'll
                    ask for some further details and upon confirmation you can enjoy
                    up to 30% discount on your orders!
                </p>
            </div>
            <div class="form-card">
                <form action="#">
                    <div class="form-group">
                        <input type="name" placeholder="First Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="name" placeholder="Last Name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Email Address" class="form-control" required>
                    </div>
                    <a href="#">Submit Now</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('js/search.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>