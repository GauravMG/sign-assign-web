<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/service.css'); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="subheader-area">
    <div class="container-fluid">
    </div>
</div>

<?= $this->include('web/partials/services-list'); ?>

<div class="business-growth-area py-5">
    <div class="container-fluid">
        <h3 class="text-center mb-3">Display solutions for business growth</h3>
        <p class="text-center">Effective displays do more than just look good - they serve as powerful tools to connect with your audience and support your business goals. From retail environments to trade shows and corporate spaces, the right display can increase visibility, reinforce your brand, and influence purchasing decisions.</p>

        <div class="solutions-list-area" id="catContainer">
        </div>
    </div>
</div>

<div class="exceptional-service-area py-5">
    <div class="container-fluid">
        <h3 class="text-center mb-3">Get Exceptional Sign Service</h3>
        <p class="text-center">As you may know that signage is crucial for your business promotion and advertisement. Custom channel letters, signs and banners from Sign Assign can help you convey your message to your audience. Let us help you with all your signage needs so that you can focus on improving the other aspects of your business.</p>
        <div class="border-div">
            <div class="flex-area">
                <div class="left-area">
                    <img src="/images/service-section1-image.png" alt="">
                </div>
                <div class="right-area">
                    <p>All businesses require a unique set of signage that can help them build a credible brand. Customized and personalized signs are the way to go, as a one-size-fits-all strategy won’t work. This is where Sign Assign can provide you with high-quality, customized, and impactful signage to help you achieve your goals. Our custom signs are ideal for various industries.</p>
                    <br>
                    <p>In saying that, you can get all the signs you want, but you need a helping hand in fixing those signs at appropriate places to get maximum exposure. The improper fitting can take the shine out of your signs. You need someone who can provide you with robust sign installation services. Sign Assign is the answer to your problems!</p>
                </div>
            </div>
            <div class="white-bg-area">
                <p>We can provide you with various services such as turnkey project management, sign installation, permitting, code review and compliance, sign engineering, sign service & repairs, and sign removal. All you need to do is get in touch with us, tell us what you need, and we will be there for you at every step!</p>
                <br>
                <p>Sign Assign is one of the best companies in Texas, specializing in creating custom banners, car signs, outdoor signs, business banners, car banners, and much more. We aim to go above and beyond in helping our customers with the very best personalized banners and signs. We operate all over the United States.</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('pageScripts'); ?>
<script src="<?= base_url('js/services.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>