<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/banner-page.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- <div id="carouselExampleSlidesOnly" class="carousel slide hero-section" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url('images/banner-page-image.jpg') . '?t=' . time(); ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('images/banner-page-image.jpg') . '?t=' . time(); ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('images/banner-page-image.jpg') . '?t=' . time(); ?>" class="d-block w-100" alt="...">
        </div>
    </div>
</div> -->

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
                    <li><?= $data['subCategoryName']; ?></li>
                </ul>
            </div>
            <!-- <div class="right">
                <div class="dropdown-area">
                    <p>Sort By</p>
                    <div class="custom-select" id="customSelect">
                        <div class="selected">Select your Product</div>
                        <div class="options">
                            <div class="option" data-value="aa">Vinyl Window Decals</div>
                            <div class="option" data-value="bb">Vinyl Flex Boards</div>
                        </div>
                    </div>
                </div>
                <div class="dropdown-area">
                    <p>Size (W X H)</p>
                    <div class="custom-select" id="customSelect">
                        <div class="selected">8.4</div>
                        <div class="options">
                            <div class="option" data-value="aaa">8.4</div>
                            <div class="option" data-value="bbb">12.6</div>
                        </div>
                    </div>
                    <div class="custom-select" id="customSelect">
                        <div class="selected">Ft.</div>
                        <div class="options">
                            <div class="option" data-value="aaa">Ft.</div>
                            <div class="option" data-value="bbb">Mtr.</div>
                        </div>
                    </div>
                </div>
                <div class="dropdown-area">
                    <p>Qty</p>
                    <div class="custom-select" id="customSelect">
                        <div class="selected">10</div>
                        <div class="options">
                            <div class="option" data-value="aa">10</div>
                            <div class="option" data-value="bb">20</div>
                            <div class="option" data-value="cc">30</div>
                            <div class="option" data-value="dd">40</div>

                        </div>
                    </div>
                </div>
                <div class="price-area">
                    <div>
                        <p>Price</p>
                    </div>
                    <div>
                        <span>$50.52</span>
                        <h6>$25.50</h6>
                    </div>
                </div>
                <a href="#" class="btn">Add to Cart</a>
            </div> -->
        </div>
    </div>
</div>

<div class="banner-product-area py-5">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h3><?= $data['subCategoryName']; ?></h3>
            <a href="#" class="filter-button" data-bs-toggle="modal" data-bs-target="#filterModal">Filters</a>
        </div>
        <div class="filter-divider">
            <div class="left-area">
                <div class="banner-inner" id="dataList"></div>
            </div>
            <div class="right-area">
                <div class="main-filter-area">
                    <div id="dynamicAttributeFilters"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="custom-banner-area py-5">
    <div class="container-fluid" id="subCategoryDescription"></div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script>
    const productSubCategoryId = Number('<?= $data['productSubCategoryId']; ?>')
</script>
<script src="<?= base_url('js/subcategory.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>