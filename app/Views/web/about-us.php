<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/about-us.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="subheader-area" onclick="window.location.href = '/services'">
    <div class="container-fluid">
    </div>
</div>
<div class="counter-area">
    <div class="container-fluid">
        <div class="grid-area">
            <div class="inner">
                <h2>5 Million</h2>
                <p>Happy Customers</p>
            </div>
            <div class="inner">
                <h2>1100+</h2>
                <p>Team Members</p>
            </div>
            <div class="inner">
                <h2>10,000+</h2>
                <p>Products</p>
            </div>
            <div class="inner">
                <h2>20</h2>
                <p>Countries</p>
            </div>
        </div>
    </div>
</div>

<div class="journey-area py-5">
    <div class="container-fluid">
        <h3 class="text-center">From humble beginnings to big dreams</h3>
        <div class="flex-area">
            <div class="left-area">
                <img src="/images/about-us-section1-image.png" alt="">
            </div>
            <div class="right-area">
                <p>Our journey began in 2003, when Tahir and Mubaraka, a passionate duo, embarked on an entrepreneurial adventure. Back then, it was a mailing and shipping business in California. But their ambition had bigger plans. Fast forward to 2011, and Sign Assign was born in Texas, driven by a commitment to exceptional service and unparalleled craftsmanship.</p>
                <p>Today, we stand tall in a 9,000 sq. ft. facility in Garland, Texas, equipped with state-of-the-art technology and a team of dedicated artisans. We’re not just another sign company; we’re a family bound by a shared passion: to bring your vision to life, exceeding expectations at every turn.</p>
            </div>
        </div>
        <div class="grid-area">
            <div class="inner">
                <img src="<?= base_url('images/check.png') . '?t=' . time(); ?>" alt="">
                <p>Countless Product Choices</p>
            </div>
            <div class="inner">
                <img src="<?= base_url('images/check.png') . '?t=' . time(); ?>" alt="">
                <p>Easy-To-Use Design Tool</p>
            </div>
            <div class="inner">
                <img src="<?= base_url('images/check.png') . '?t=' . time(); ?>" alt="">
                <p>Customized to Perfection</p>
            </div>
            <div class="inner">
                <img src="<?= base_url('images/check.png') . '?t=' . time(); ?>" alt="">
                <p>Cutting Edge Printing Process</p>
            </div>
            <div class="inner">
                <img src="<?= base_url('images/check.png') . '?t=' . time(); ?>" alt="">
                <p>High Quality Inks</p>
            </div>
            <div class="inner">
                <img src="<?= base_url('images/check.png') . '?t=' . time(); ?>" alt="">
                <p>Highest Quality Guaranteed</p>
            </div>
        </div>
    </div>
</div>

<div class="beyond-area pt-5">
    <div class="container-fluid">
        <div class="flex-inner">
            <div class="left-area">
                <h2>Beyond the sign</h2>
                <p>We offer a comprehensive suite of signage solutions, from eye-catching channel letters and dazzling LED signs to bold banners and captivating vehicle wraps. Whether you need a monumental entrance sign that commands attention or a retractable banner for your next event, we have the expertise and creativity to deliver.</p>
                <p>But it’s not just about the products. It’s about the partnership. We take the time to understand your unique needs, brand identity, and target audience. We collaborate closely, ensuring every detail resonates and tells your story authentically.</p>
            </div>
            <div class="right-area">
                <img src="<?= base_url('images/billboard.png') . '?t=' . time(); ?>" alt="">
            </div>
        </div>
    </div>
</div>

<div class="why-choose-area py-5 my-5">
    <div class="container-fluid">
        <h3 class="text-center mb-2">Why choose sign assign?</h3>
        <p class="text-center">At Sign Assign, we make it easy to bring your vision to life. With our user-friendly online design tool, you can create custom signs in just<br>minutes - no design experience needed! We combine top-quality materials, fast turnaround times, and competitive pricing to<br>deliver signs that make an impact.</p>
        <div class="flex-inner">
            <div class="left-area">
                <div class="inner">
                    <div class="img-area">
                        <img src="<?= base_url('images/check.png') . '?t=' . time(); ?>" alt="">
                    </div>
                    <div class="text-area">
                        <h4>Experience</h4>
                        <p>Over a decade of crafting impactful signage for businesses of all sizes.</p>
                    </div>
                </div>
                <div class="inner">
                    <div class="img-area">
                        <img src="<?= base_url('images/check.png') . '?t=' . time(); ?>" alt="">
                    </div>
                    <div class="text-area">
                        <h4>Quality</h4>
                        <p>Unwavering commitment to using the finest materials and cutting-edge technology.</p>
                    </div>
                </div>
                <div class="inner">
                    <div class="img-area">
                        <img src="<?= base_url('images/check.png') . '?t=' . time(); ?>" alt="">
                    </div>
                    <div class="text-area">
                        <h4>Customization</h4>
                        <p>Bespoke solutions tailored to your specific needs and brand identity.</p>
                    </div>
                </div>
                <div class="inner">
                    <div class="img-area">
                        <img src="<?= base_url('images/check.png') . '?t=' . time(); ?>" alt="">
                    </div>
                    <div class="text-area">
                        <h4>Dedication</h4>
                        <p>A team passionate about exceeding your expectations and building lasting relationships</p>
                    </div>
                </div>
                <div class="inner">
                    <div class="img-area">
                        <img src="<?= base_url('images/check.png') . '?t=' . time(); ?>" alt="">
                    </div>
                    <div class="text-area">
                        <h4>Experience</h4>
                        <p>Proudly supporting the local community and championing small businesses.</p>
                    </div>
                </div>
            </div>
            <div class="right-area">
                <img src="/images/about-us-section3-image.png" alt="">
                <h4>Get world class products</h4>
                <p>Our impeccable product range has everything you need. Check it out today!</p>
                <!-- <a href="#">Order Now</a> -->
            </div>
        </div>
    </div>
</div>

<!-- <div class="our-story-area">
    <div class="container-fluid">
        <div class="flex-area">
            <div class="left-area">
                <img src="https://png.pngtree.com/png-vector/20220607/ourmid/pngtree-person-gray-photo-placeholder-man-silhouette-on-white-background-png-image_4853539.png" alt="">
            </div>
            <div class="right-area">
                <h6>Owner Name</h6>
                <h3>Our Story</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis mollitia delectus saepe repellat repudiandae deleniti nihil totam, explicabo, porro facere hic eius sint corporis accusamus commodi fugiat debitis quis libero architecto similique? Necessitatibus, error aperiam saepe laboriosam nihil voluptates quidem iusto nostrum praesentium, alias deserunt quam nulla voluptatem officiis? Hic sit eum rem, accusantium voluptate, doloremque quos ut quam quas assumenda, ab laudantium maiores nam neque harum nesciunt soluta nostrum id. Consequuntur ullam iusto nesciunt harum nam quia laboriosam minima.</p>
            </div>
        </div>
    </div>
</div> -->

<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('js/about-us.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>