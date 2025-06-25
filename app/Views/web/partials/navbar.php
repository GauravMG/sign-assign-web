<header>
    <div class="container-fluid header">
        <div class="review-area">
            <div class="rating-area">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
            </div>
            <p>Google Reviews</p>
        </div>
        <div class="center-area">
            <p>Build your own sign online</p>
        </div>
        <div class="contact-area">
            <div class="phone">
                <a href="tel:19724185253" style="text-decoration: none; color: unset;">
                    <i class="fa-solid fa-phone-flip"></i>
                    972-418-5253</a>
            </div>
            <div class="email">
                <a href="mailto:order@signasign.com" style="text-decoration: none; color: unset;">
                    <i class="fa-solid fa-envelope"></i>
                    orders@signassign.com
                </a>
            </div>
        </div>
</header>

<nav class="container-fluid">
    <div class="desktop-top-menu">
        <div class="left-area">
            <div class="logo">
                <a href="/"><img src="<?= base_url('images/logo.png') . '?t=' . time(); ?>" alt=""></a>
            </div>
        </div>
        <div class="right-area">
            <div class="search-bar" style="display: flex; align-items: center; gap: 8px;">
                <input type="text" placeholder="Search here..." id="navbar-search" class="form-control" />
                <button id="search-button" style="border: none; background: none; cursor: pointer;">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="menu-links">
                <ul>
                    <li>
                        <a href="/about-us">About Us</a>
                    </li>
                    <li class="dropdown">
                        <a href="/services">Service</a>
                    </li>
                    <!-- <li>
                        <a href="#">Design Lab</a>
                    </li> -->
                    <!-- <li>
                        <a href="/learning-center">Learning Center</a>
                    </li> -->
                    <li>
                        <a href="/contact-us">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="auth-button" id="navbarAuthOptionsContainer">
                <a class="signup-button" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</a>
                <a class="login-button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
            </div>
            <a href="/checkout">
                <div class="cart-area">
                    <i class="fi fi-rr-shopping-cart"></i>
                    <span id="cartProductCount"></span>
                </div>
            </a>
        </div>
    </div>
    <div class="mobile-top-menu">
        <div class="left">
            <a href="/"><img src="<?= base_url('images/logo.png') . '?t=' . time(); ?>" alt=""></a>
        </div>
        <div class="right">
            <div class="navbar-wrapper hidden-md hidden-lg visible-xs visible-sm">
                <div class="navbar-wrapper-inner">
                    <div class="pure-container" data-effect="pure-effect-slide">
                        <input type="checkbox" id="pure-toggle-left" class="pure-toggle" data-toggle="left" />
                        <!--<div class="mob-toggle">-->
                        <label class="pure-toggle-label" for="pure-toggle-left" data-toggle-label="left"><span class="pure-toggle-icon"></span></label>
                        <label class="pure-overlay" for="pure-toggle-left" data-overlay="left"></label>
                        <!--</div>-->
                        <nav class="pure-drawer" data-position="left">
                            <div class="main-nav-mob" id="navbar-mob">
                                <div class="auto-scroll">
                                    <nav class="nav" role="navigation">
                                        <ul class="nav__list">
                                            <li>
                                                <a href="/about-us"> About Us</a>
                                            </li>
                                            <li>
                                                <a href="/services"> Services</a>
                                            </li>
                                            <li>
                                                <input id="group-2" type="checkbox" hidden />
                                                <label for="group-2"><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span> Products</label>
                                                <ul class="group-list" id="navbarCategoryMenuListContainerMobile">
                                                </ul>
                                            </li>
                                            <li>
                                                <!-- <a href="#"> Design Lab</a> -->
                                            </li>
                                            <li>
                                                <!-- <a href="/learning-center"> Learning Center</a> -->
                                            </li>
                                            <li>
                                                <a href="/contact-us"> Contact Us</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- <nav class="mega-menu">
    <div class="container-fluid">
        <ul id="navbarCategoryMenuListContainer"></ul>
    </div>
</nav> -->
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container-fluid custom-container">
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav flex-nowrap" id="categoryMenu">
                <!-- Dynamic categories inserted here -->
                <li class="nav-item dropdown d-none" id="moreDropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="moreDropdownLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        More
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="moreDropdownLink" id="moreDropdownMenu">
                        <!-- Overflow categories go here -->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>