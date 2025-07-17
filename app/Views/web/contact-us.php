<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/contact-us.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="subheader-area">
    <div class="container-fluid">
        <div class="caption-area">
            <h3>Talk To Us Today</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod consequatur vel repellat, ab, dolor ipsa nulla consequuntur ullam numquam facere totam quaerat, libero repudiandae praesentium? Nemo suscipit tempora dolorem neque.</p>
        </div>
    </div>
</div>

<div class="custom-banner-area py-5">
    <div class="container-fluid">
        <h3 class="text-center mb-3">Build your own custom banner and sign online</h3>
        <p class="text-center">Need Custom Banners, Car Signs, Outdoor Signs, Business Banners, Car Banners, Channel Letters, Frames & Signs, Monument & Pylon Signs, Printed Banners, Wide Format Printin, Vehicle Graphics, Window Graphics, or Safety Signs to meet your erquirements?</p>
        <p class="text-center">Please send ys your details requirement through our request a free quote and we will reploy with any further question or your quotation asap. Including your estimated quote and payment details.</p>
    </div>
</div>

<div class="contact-area py-5">
    <div class="container-fluid">
        <h4>Feel free to contact us for more information</h4>
        <div class="flex-area">
            <div class="inner">
                <div class="left-area">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="right-area">
                    <p>Phone Number:</p>
                    <h5><a href="tel:19724185253" style="text-decoration: none; color: unset;">972‐418‐5253</a></h5>
                </div>
            </div>
            <div class="inner">
                <div class="left-area">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <div class="right-area">
                    <p>Email Address:</p>
                    <h5><a href="mailto:orders@signassign.com" style="text-decoration: none; color: unset;">orders@signassign.com</a></h5>
                </div>
            </div>
            <div class="inner">
                <div class="left-area">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="right-area">
                    <p>Our Address:</p>
                    <h5>702 Shephar Dr, garland, TX 75042, US</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="connect-area py-5">
    <div class="container-fluid">
        <div class="flex-area">
            <div class="map-area">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3349.7023400400476!2d-96.6986154238037!3d32.90603737738053!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864c1fcff5275031%3A0x19bbbaf3ca36bbaa!2sSign%20Assign!5e0!3m2!1sen!2sin!4v1750951169209!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="form-area">
                <h4>Let's Connect</h4>
                <form action="#">
                    <div class="form-group mb-2">
                        <input type="name" placeholder="Enter Name" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="email" placeholder="Enter Email" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" placeholder="Enter Phone" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <select name="" id="" class="form-select">
                            <option value="">Option One</option>
                            <option value="">Option Two</option>
                            <option value="">Option Three</option>
                            <option value="">Option Four</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <textarea name="" rows="3" class="form-control" id="" placeholder="Please describe your situation"></textarea>
                    </div>
                    <div class="form-group">
                        <a href="#">Submit</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('js/about-us.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>