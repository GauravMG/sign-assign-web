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
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('js/search.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>