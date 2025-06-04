<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<style>
    #owlSection3 img {
        height: 220px;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div id="carouselExampleSlidesOnly" class="carousel slide hero-section" data-bs-ride="carousel">
    <div class="carousel-inner" id="coverBannerContainer">
    </div>
</div>

<div class="container-slide-area pt-5">
    <div class="container-fluid">
        <div class="view-all-area">
            <div class="left">
                <h3 class="mb-0">Most Loved Brand Visionaries</h3>
            </div>
            <div class="right">
                <div class="owl-nav">
                    <button type="button" role="presentation" class="owl-prev">
                        <i class="fa-solid fa-arrow-left-long"></i>
                    </button>
                    <button type="button" role="presentation" class="owl-next">
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </button>
                </div>
            </div>
        </div>
        <div id="owlSection1" class="owl-carousel owl-theme">
        </div>
    </div>
</div>

<div class="bestseller-area pt-5">
    <div class="container-fluid">
        <h3>Curated Bestsellers to Wow Your Customers</h3>
        <div class="products-grid" id="curatedBestSellersContainer">
        </div>
    </div>
</div>

<div class="container-slide-area py-5">
    <div class="container-fluid">
        <div class="view-all-area">
            <div class="left">
                <h3 class="mb-0">Get Exceptional Sign Services</h3>
            </div>
            <div class="right">
                <div class="owl-nav">
                    <button type="button" role="presentation" class="owl-prev"><i
                            class="fa-solid fa-arrow-left-long"></i></button>
                    <button type="button" role="presentation" class="owl-next"><i
                            class="fa-solid fa-arrow-right-long"></i></button>
                </div>
            </div>
        </div>
        <div id="owlSection2" class="owl-carousel owl-theme">
        </div>
    </div>
</div>

<div class="off-slider-area py-5 bg-gray">
    <div class="container-fluid">
        <div class="view-all-area">
            <div class="left">
                <h3 class="mb-0">Get Exceptional Sign Services</h3>
            </div>
            <div class="right">
                <a href="#">View All <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
            </div>
        </div>
    </div>
    <div class="container-fluid//">
        <div id="owlSection3" class="owl-carousel owl-theme">
        </div>
    </div>
</div>

<div class="container-slide-area py-5">
    <div class="container-fluid">
        <div class="view-all-area">
            <div class="left">
                <h3 class="mb-0">Transform Your Business with the Right Display Solutions</h3>
            </div>
            <div class="right">
                <a href="#">View All <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
                <div class="owl-nav">
                    <button type="button" role="presentation" class="owl-prev"><i
                            class="fa-solid fa-arrow-left-long"></i></button>
                    <button type="button" role="presentation" class="owl-next"><i
                            class="fa-solid fa-arrow-right-long"></i></button>
                </div>
            </div>
        </div>
        <div id="owlSection4" class="owl-carousel owl-theme">
        </div>
    </div>
</div>

<div class="container-slide-area py-5 bg-gray">
    <div class="container-fluid">
        <div class="view-all-area">
            <div class="left">
                <h3 class="mb-0">Elevate Your Brand with Our Latest Collections</h3>
            </div>
            <div class="right">
                <div class="owl-nav">
                    <button type="button" role="presentation" class="owl-prev"><i
                            class="fa-solid fa-arrow-left-long"></i></button>
                    <button type="button" role="presentation" class="owl-next"><i
                            class="fa-solid fa-arrow-right-long"></i></button>
                </div>
            </div>
        </div>
        <div id="owlSection5" class="owl-carousel owl-theme">
        </div>
    </div>
</div>

<div class="order-area py-5">
    <div class="container-fluid">
        <div class="inner-area">
            <div class="card-area">
                <img src="<?= base_url('images/sign-board.jpg') . '?t=' . time(); ?>" alt="">
                <h5>High-Quality Traffic & Safety Signs</h5>
                <a href="#">Order Now</a>
            </div>
            <div class="card-area">
                <img src="<?= base_url('images/sign-board.jpg') . '?t=' . time(); ?>" alt="">
                <h5>High-Quality Traffic & Safety Signs</h5>
                <a href="#">Order Now</a>
            </div>
            <div class="card-area">
                <img src="<?= base_url('images/sign-board.jpg') . '?t=' . time(); ?>" alt="">
                <h5>High-Quality Traffic & Safety Signs</h5>
                <a href="#">Order Now</a>
            </div>
            <div class="card-area">
                <img src="<?= base_url('images/sign-board.jpg') . '?t=' . time(); ?>" alt="">
                <h5>High-Quality Traffic & Safety Signs</h5>
                <a href="#">Order Now</a>
            </div>
        </div>
    </div>
</div>

<div class="testimonial-area pt-5">
    <div class="container-fluid">
        <h6>Testimonials</h6>
        <h3>Approved By Thousands of Happy Customers</h3>
        <div id="owlTestimonials" class="owl-carousel owl-theme">
            <div class="testimonial-card">
                <p>
                    If you are looking for an excellent sign company at an affordable price, I highly recommend Sign
                    Assign.
                    They are creative and extremely knowledgeable about all aspects of sign design, installation,
                    approval requirements and
                    process. They even negotiated on our behalf with the shopping center's property manager for
                    their agreement to a design
                    giving us optimum visibility. In addition, They secured approval from the City of Carrollton in
                    a timely manner
                    resulting in ample time for installation.
                    Sign Assign is a reliable, patient, helpful and affordable resource.
                </p>
                <div class="testimonial-details-area">
                    <div class="name-area">
                        <h6>Vetsavers Pet Hospital Carrollton, TX</h6>
                    </div>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <p>
                    If you are looking for an excellent sign company at an affordable price, I highly recommend Sign
                    Assign.
                    They are creative and extremely knowledgeable about all aspects of sign design, installation,
                    approval requirements and
                    process. They even negotiated on our behalf with the shopping center's property manager for
                    their agreement to a design
                    giving us optimum visibility. In addition, They secured approval from the City of Carrollton in
                    a timely manner
                    resulting in ample time for installation.
                    Sign Assign is a reliable, patient, helpful and affordable resource.
                </p>
                <div class="testimonial-details-area">
                    <div class="name-area">
                        <h6>Vetsavers Pet Hospital Carrollton, TX</h6>
                    </div>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <p>
                    If you are looking for an excellent sign company at an affordable price, I highly recommend Sign
                    Assign.
                    They are creative and extremely knowledgeable about all aspects of sign design, installation,
                    approval requirements and
                    process. They even negotiated on our behalf with the shopping center's property manager for
                    their agreement to a design
                    giving us optimum visibility. In addition, They secured approval from the City of Carrollton in
                    a timely manner
                    resulting in ample time for installation.
                    Sign Assign is a reliable, patient, helpful and affordable resource.
                </p>
                <div class="testimonial-details-area">
                    <div class="name-area">
                        <h6>Vetsavers Pet Hospital Carrollton, TX</h6>
                    </div>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <p>
                    If you are looking for an excellent sign company at an affordable price, I highly recommend Sign
                    Assign.
                    They are creative and extremely knowledgeable about all aspects of sign design, installation,
                    approval requirements and
                    process. They even negotiated on our behalf with the shopping center's property manager for
                    their agreement to a design
                    giving us optimum visibility. In addition, They secured approval from the City of Carrollton in
                    a timely manner
                    resulting in ample time for installation.
                    Sign Assign is a reliable, patient, helpful and affordable resource.
                </p>
                <div class="testimonial-details-area">
                    <div class="name-area">
                        <h6>Vetsavers Pet Hospital Carrollton, TX</h6>
                    </div>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <p>
                    If you are looking for an excellent sign company at an affordable price, I highly recommend Sign
                    Assign.
                    They are creative and extremely knowledgeable about all aspects of sign design, installation,
                    approval requirements and
                    process. They even negotiated on our behalf with the shopping center's property manager for
                    their agreement to a design
                    giving us optimum visibility. In addition, They secured approval from the City of Carrollton in
                    a timely manner
                    resulting in ample time for installation.
                    Sign Assign is a reliable, patient, helpful and affordable resource.
                </p>
                <div class="testimonial-details-area">
                    <div class="name-area">
                        <h6>Vetsavers Pet Hospital Carrollton, TX</h6>
                    </div>
                    <div class="rating-area">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog-area pt-5">
    <div class="container-fluid">
        <h6>The Ultimate Signage Guide</h6>
        <h3>Learning Center</h3>
        <div id="owlLearningCenter" class="owl-carousel owl-theme">
        </div>
        <div class="view-all-btn-area">
            <a href="/blogs">View All <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
        </div>
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
<script src="<?= base_url('js/home.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>