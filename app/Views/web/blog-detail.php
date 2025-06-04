<?= $this->extend('web/web_template'); ?>

<?= $this->section('pageStyles'); ?>
<link rel="stylesheet" href="<?= base_url('css/blog-detail.css') . '?t=' . time(); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="blog-detail-area pt-5">
    <div class="container-fluid">
        <h1>Design, Customize, Promote: How Sign Assign Is Transforming DIY Marketing for Businesses</h1>
        <h6>by signassi | Mon, Jun 02, 2025 | Signage</h6>
        <img src="http://3.109.198.252/api/uploads/download-jpeg-1748865714876-973428608.jpeg" alt="">
        <div class="blog-content">
            <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusantium cum vel, quos sapiente nostrum totam laborum iure, quidem corporis explicabo necessitatibus commodi corrupti quaerat ducimus soluta enim distinctio, veritatis quae dolorem! Quam nobis recusandae, voluptates nulla nihil atque aspernatur eligendi impedit sapiente velit harum deleniti saepe consectetur reiciendis non. Ratione est, quam animi quia alias cum aspernatur amet deleniti harum placeat accusamus corrupti nesciunt dolore eveniet dolores quasi quae veniam obcaecati labore pariatur? Facilis asperiores, neque ea tempore vero <a href="#">libero suscipit voluptas</a>, eius ex deserunt unde dignissimos inventore. Vero, sed cumque. Reiciendis itaque adipisci veniam similique magnam molestiae quo, beatae sapiente odit, fugiat explicabo natus corrupti numquam voluptatem provident voluptates consectetur laudantium rem, fuga cupiditate mollitia animi. Blanditiis aliquid sunt magni officiis suscipit in similique autem praesentium necessitatibus asperiores numquam obcaecati dolorum officia, ad pariatur quo, architecto, dolor enim voluptatibus. Eveniet similique vero atque omnis adipisci, repudiandae sapiente exercitationem repellat?
            </p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium fugiat dolores fugit saepe perferendis ipsam necessitatibus excepturi, esse suscipit sunt voluptates officiis ipsa doloremque amet eos nihil! Ut vel aperiam, placeat numquam nesciunt quibusdam magni debitis esse hic architecto dolorem veniam inventore nostrum ipsum eum officiis. In cum magni labore dolorem eos velit, voluptas dolor delectus, earum ipsa officiis illo asperiores id eum! Repellendus, repudiandae. Magnam enim, <a href="#">libero suscipit voluptas</a> incidunt eveniet sit molestiae impedit ipsa ea distinctio deleniti tempore officiis a, neque voluptates iure laboriosam, expedita aut iste ratione facilis voluptate eius sequi. Facere et incidunt saepe vero culpa nisi quasi nulla ipsa eos temporibus iste ipsum ab laudantium totam, architecto labore quis distinctio quaerat eaque dicta animi porro optio esse eveniet. Molestiae quo nisi commodi alias iste repellendus sint, consectetur cum dolore itaque odit rerum maxime ut quod quia fugit ea iure voluptatum minus doloribus inventore modi praesentium. Quia, quis. Voluptas fuga tenetur rem esse expedita corporis maiores labore harum, distinctio est cumque obcaecati eveniet rerum autem dolore, officiis culpa libero nihil magnam vero assumenda. Ut iure molestias, impedit ex eaque dolor esse sit excepturi ducimus rem ea quas fugiat eveniet eius accusamus in quam quod. Fugiat, dolor! Debitis totam dolores tenetur dolor saepe numquam qui, voluptates corporis omnis officia voluptatum eveniet sequi eum quo veritatis vel quasi a? Ab explicabo molestias suscipit consequatur ullam provident ipsum cumque labore quasi esse obcaecati non, beatae impedit et, laudantium aliquam distinctio! Culpa ad qui deserunt rem doloremque a blanditiis at.
            </p>
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
<script src="<?= base_url('js/blog-detail.js') . '?t=' . time(); ?>"></script>
<?= $this->endSection(); ?>