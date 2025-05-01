<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/banner-page.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div id="carouselExampleSlidesOnly" class="carousel slide hero-section" data-bs-ride="carousel">
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
</div>

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
                    <li>Banners</li>
                </ul>
            </div>
            <div class="right">
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
            </div>
        </div>
    </div>
</div>

<div class="banner-product-area py-5">
    <div class="container-fluid">
        <div class="filter-divider">
            <div class="left-area">
                <h3>Banners</h3>
                <div class="banner-inner">
                    <div class="inner-card">
                        <div class="p-3 m-0">
                            <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                        </div>
                        <div class="px-3 mt-0">
                            <h5>Banner Stands</h5>
                            <h6>Size (W X H): 34” x 84”)</h6>
                            <div class="rating-area">
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </div>
                            <h6>Starts at: <span class="text-green">$22.47</span></h6>
                        </div>
                        <a href="/product/banner-stands">Customize</a>
                    </div>
                    <div class="inner-card">
                        <div class="p-3 m-0">
                            <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                        </div>
                        <div class="px-3 mt-0">
                            <h5>Banner Stands</h5>
                            <h6>Size (W X H): 34” x 84”)</h6>

                            <div class="rating-area">
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </div>
                            <h6>Starts at: <span class="text-green">$22.47</span></h6>
                        </div>
                        <a href="/product/banner-stands">Customize</a>
                    </div>
                    <div class="inner-card">
                        <div class="p-3 m-0">
                            <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                        </div>
                        <div class="px-3 mt-0">
                            <h5>Banner Stands</h5>
                            <h6>Size (W X H): 34” x 84”)</h6>

                            <div class="rating-area">
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </div>
                            <h6>Starts at: <span class="text-green">$22.47</span></h6>
                        </div>
                        <a href="/product/banner-stands">Customize</a>
                    </div>
                    <div class="inner-card">
                        <div class="p-3 m-0">
                            <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                        </div>
                        <div class="px-3 mt-0">
                            <h5>Banner Stands</h5>
                            <h6>Size (W X H): 34” x 84”)</h6>

                            <div class="rating-area">
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </div>
                            <h6>Starts at: <span class="text-green">$22.47</span></h6>
                        </div>
                        <a href="/product/banner-stands">Customize</a>
                    </div>
                    <div class="inner-card">
                        <div class="p-3 m-0">
                            <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                        </div>
                        <div class="px-3 mt-0">
                            <h5>Banner Stands</h5>
                            <h6>Size (W X H): 34” x 84”)</h6>

                            <div class="rating-area">
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </div>
                            <h6>Starts at: <span class="text-green">$22.47</span></h6>
                        </div>
                        <a href="/product/banner-stands">Customize</a>
                    </div>
                    <div class="inner-card">
                        <div class="p-3 m-0">
                            <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                        </div>
                        <div class="px-3 mt-0">
                            <h5>Banner Stands</h5>
                            <h6>Size (W X H): 34” x 84”)</h6>

                            <div class="rating-area">
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </div>
                            <h6>Starts at: <span class="text-green">$22.47</span></h6>
                        </div>
                        <a href="/product/banner-stands">Customize</a>
                    </div>
                    <div class="inner-card">
                        <div class="p-3 m-0">
                            <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                        </div>
                        <div class="px-3 mt-0">
                            <h5>Banner Stands</h5>
                            <h6>Size (W X H): 34” x 84”)</h6>

                            <div class="rating-area">
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </div>
                            <h6>Starts at: <span class="text-green">$22.47</span></h6>
                        </div>
                        <a href="/product/banner-stands">Customize</a>
                    </div>
                    <div class="inner-card">
                        <div class="p-3 m-0">
                            <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                        </div>
                        <div class="px-3 mt-0">
                            <h5>Banner Stands</h5>
                            <h6>Size (W X H): 34” x 84”)</h6>

                            <div class="rating-area">
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </div>
                            <h6>Starts at: <span class="text-green">$22.47</span></h6>
                        </div>
                        <a href="/product/banner-stands">Customize</a>
                    </div>
                    <div class="inner-card">
                        <div class="p-3 m-0">
                            <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                        </div>
                        <div class="px-3 mt-0">
                            <h5>Banner Stands</h5>
                            <h6>Size (W X H): 34” x 84”)</h6>

                            <div class="rating-area">
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </div>
                            <h6>Starts at: <span class="text-green">$22.47</span></h6>
                        </div>
                        <a href="/product/banner-stands">Customize</a>
                    </div>
                    <div class="inner-card">
                        <div class="p-3 m-0">
                            <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                        </div>
                        <div class="px-3 mt-0">
                            <h5>Banner Stands</h5>
                            <h6>Size (W X H): 34” x 84”)</h6>

                            <div class="rating-area">
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </div>
                            <h6>Starts at: <span class="text-green">$22.47</span></h6>
                        </div>
                        <a href="/product/banner-stands">Customize</a>
                    </div>
                    <div class="inner-card">
                        <div class="p-3 m-0">
                            <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                        </div>
                        <div class="px-3 mt-0">
                            <h5>Banner Stands</h5>
                            <h6>Size (W X H): 34” x 84”)</h6>

                            <div class="rating-area">
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </div>
                            <h6>Starts at: <span class="text-green">$22.47</span></h6>
                        </div>
                        <a href="/product/banner-stands">Customize</a>
                    </div>
                    <div class="inner-card">
                        <div class="p-3 m-0">
                            <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                        </div>
                        <div class="px-3 mt-0">
                            <h5>Banner Stands</h5>
                            <h6>Size (W X H): 34” x 84”)</h6>

                            <div class="rating-area">
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </div>
                            <h6>Starts at: <span class="text-green">$22.47</span></h6>
                        </div>
                        <a href="/product/banner-stands">Customize</a>
                    </div>
                    <div class="inner-card">
                        <div class="p-3 m-0">
                            <img src="<?= base_url('images/slide-image.jpg') . '?t=' . time(); ?>" alt="">
                        </div>
                        <div class="px-3 mt-0">
                            <h5>Banner Stands</h5>
                            <h6>Size (W X H): 34” x 84”)</h6>

                            <div class="rating-area">
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                                <svg class="svg-inline--fa fa-star checked" aria-hidden="true" focusable="false"
                                    data-prefix="fas" data-icon="star" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z">
                                    </path>
                                </svg>
                            </div>
                            <h6>Starts at: <span class="text-green">$22.47</span></h6>
                        </div>
                        <a href="/product/banner-stands">Customize</a>
                    </div>
                </div>
            </div>
            <div class="right-area">
                <div class="dropdown-area">
                    <p>Sort By</p>
                    <div class="custom-select" id="customSelect">
                        <div class="selected">Choose a Category</div>
                        <div class="options">
                            <div class="option" data-value="a">A</div>
                            <div class="option" data-value="b">B</div>
                        </div>
                    </div>
                </div>
                <div class="main-filter-area">
                    <div class="filters-inner">
                        <div class="filter-dropdown-area">
                            <h6>Category</h6>
                            <span>
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                        </div>
                        <ul>
                            <li>
                                <a href="#">Vinyl Banners</a>
                            </li>
                            <li>
                                <a href="#">Heavy Duty Banners</a>
                            </li>
                            <li>
                                <a href="#">Mesh Banners</a>
                            </li>
                            <li>
                                <a href="#">Banner Stand</a>
                            </li>
                        </ul>
                    </div>
                    <div class="filters-inner">
                        <div class="filter-dropdown-area">
                            <h6 class="if-inactive">Use</h6>
                            <span>
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                        </div>

                        <ul class="d-none">
                            <li>
                                <a href="#">Vinyl Banners</a>
                            </li>
                            <li>
                                <a href="#">Heavy Duty Banners</a>
                            </li>
                            <li>
                                <a href="#">Mesh Banners</a>
                            </li>
                            <li>
                                <a href="#">Banner Stand</a>
                            </li>
                        </ul>
                    </div>
                    <div class="filters-inner">
                        <div class="filter-dropdown-area">
                            <h6 class="if-inactive">Height</h6>
                            <span>
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                        </div>

                        <ul class="d-none">
                            <li>
                                <a href="#">Vinyl Banners</a>
                            </li>
                            <li>
                                <a href="#">Heavy Duty Banners</a>
                            </li>
                            <li>
                                <a href="#">Mesh Banners</a>
                            </li>
                            <li>
                                <a href="#">Banner Stand</a>
                            </li>
                        </ul>
                    </div>
                    <div class="filters-inner">
                        <div class="filter-dropdown-area">
                            <h6 class="if-inactive">Stand Type</h6>
                            <span>
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                        </div>

                        <ul class="d-none">
                            <li>
                                <a href="#">Vinyl Banners</a>
                            </li>
                            <li>
                                <a href="#">Heavy Duty Banners</a>
                            </li>
                            <li>
                                <a href="#">Mesh Banners</a>
                            </li>
                            <li>
                                <a href="#">Banner Stand</a>
                            </li>
                        </ul>
                    </div>
                    <div class="filters-inner">
                        <div class="filter-dropdown-area">
                            <h6 class="if-inactive">Print Type</h6>
                            <span>
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                        </div>

                        <ul class="d-none">
                            <li>
                                <a href="#">Vinyl Banners</a>
                            </li>
                            <li>
                                <a href="#">Heavy Duty Banners</a>
                            </li>
                            <li>
                                <a href="#">Mesh Banners</a>
                            </li>
                            <li>
                                <a href="#">Banner Stand</a>
                            </li>
                        </ul>
                    </div>
                    <div class="filters-inner">
                        <div class="filter-dropdown-area">
                            <h6 class="if-inactive">Graphic Material</h6>
                            <span>
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                        </div>

                        <ul class="d-none">
                            <li>
                                <a href="#">Vinyl Banners</a>
                            </li>
                            <li>
                                <a href="#">Heavy Duty Banners</a>
                            </li>
                            <li>
                                <a href="#">Mesh Banners</a>
                            </li>
                            <li>
                                <a href="#">Banner Stand</a>
                            </li>
                        </ul>
                    </div>
                    <div class="filters-inner">
                        <div class="filter-dropdown-area">
                            <h6 class="if-inactive">Adjustable Hardware</h6>
                            <span>
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                        </div>

                        <ul class="d-none">
                            <li>
                                <a href="#">Vinyl Banners</a>
                            </li>
                            <li>
                                <a href="#">Heavy Duty Banners</a>
                            </li>
                            <li>
                                <a href="#">Mesh Banners</a>
                            </li>
                            <li>
                                <a href="#">Banner Stand</a>
                            </li>
                        </ul>
                    </div>
                    <div class="filters-inner">
                        <div class="filter-dropdown-area">
                            <h6 class="if-inactive">Product Type</h6>
                            <span>
                                <i class="fa-solid fa-caret-down"></i>
                            </span>
                        </div>

                        <ul class="d-none">
                            <li>
                                <a href="#">Vinyl Banners</a>
                            </li>
                            <li>
                                <a href="#">Heavy Duty Banners</a>
                            </li>
                            <li>
                                <a href="#">Mesh Banners</a>
                            </li>
                            <li>
                                <a href="#">Banner Stand</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="custom-banner-area py-5">
    <div class="container-fluid">
        <h3 class="mb-4">High-Quality Custom Banners</h3>
        <p>
            At Sign Assign, our commitment extends beyond just providing a range of banner options. We pride
            ourselves on delivering
            excellence in every aspect of our service, ensuring that each banner we produce reflects not just
            superior quality but
            also a reflection of your brand’s essence. Our custom vinyl banners stand as a testament to durability
            and vibrancy.
            Crafted with precision and using high-quality materials, these banners are weather-resistant and perfect
            for both indoor
            and outdoor use. Whether it’s a grand opening, a promotional event, or advertising your services, our
            vinyl banners
            withstand the elements while maintaining their visual appeal.
        </p>
        <p>
            For more heavy-duty needs, our heavy-duty banners offer enhanced durability, making them ideal for
            prolonged outdoor use
            in various conditions. These banners are engineered to endure harsh weather, ensuring longevity without
            compromising on
            the vividness of your design or message. Looking for a solution that combines visibility with
            permeability? Our mesh
            banners provide an excellent balance. Designed with micro punctures that allow wind and light to pass
            through, these
            banners are perfect for outdoor settings where wind resistance is crucial, such as building wraps or
            fencing
            advertisements.
        </p>
        <p>
            And don’t forget our stands! Easy to assemble and sturdy in design, our banner stands offer a
            hassle-free way to display
            your customized banners, ensuring maximum visibility and impact at events or within your establishment.
            What sets Sign
            Assign apart is our dedication to customer satisfaction. With our online customization tool, you have
            the freedom to
            design your banner with ease, selecting from various sizes, colors, fonts, and graphics. Once you’ve
            finalized your
            design, we take care of the rest, delivering your personalized banner directly to your doorstep.
        </p>
        <p>
            Our team at Sign Assign is not just about selling banners; we’re about empowering your message with
            quality visuals that
            leave a lasting impression. Trust us to transform your vision into a striking reality with our
            comprehensive range of
            customizable banners and stands.
        </p>
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