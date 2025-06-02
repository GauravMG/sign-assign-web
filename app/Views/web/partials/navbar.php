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
                <a href="#">
                    <i class="fa-solid fa-phone-flip"></i>
                    972-418-5253</a>
            </div>
            <div class="email">
                <a href="#">
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
            <div class="search-bar">
                <input type="text" placeholder="Search here..." class="form-control">
            </div>
            <div class="menu-links">
                <ul>
                    <li>
                        <a href="/about-us">About Us</a>
                    </li>
                    <li class="dropdown">
                        <a href="#">Service</a>
                        <ul class="dropdown-content">
                            <li class="dropdown-lists"><a href="#">Sign Installation</a></li>
                            <li class="dropdown-lists"><a href="#">Sign Installation</a></li>
                            <li class="dropdown-lists"><a href="#">Sign Installation</a></li>
                            <li class="dropdown-lists"><a href="#">Sign Installation</a></li>
                            <li class="dropdown-lists"><a href="#">Sign Installation</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Design Lab</a>
                    </li>
                    <li>
                        <a href="/blogs">Learning Center</a>
                    </li>
                    <li>
                        <a href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="auth-button" id="navbarAuthOptionsContainer">
                <a href="#" class="signup-button" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</a>
                <a href="#" class="login-button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
            </div>
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
                                                <a href="#"> About Us</a>
                                            </li>
                                            <li>
                                                <input id="group-1" type="checkbox" hidden />
                                                <label for="group-1"><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span> Services</label>
                                                <ul class="group-list">
                                                    <li>
                                                        <input id="sub-group-1" type="checkbox" hidden />
                                                        <label for="sub-group-1"> Sign Installation</label>
                                                    </li>
                                                    <li>
                                                        <input id="sub-group-2" type="checkbox" hidden />
                                                        <label for="sub-group-2">Sign Installation</label>
                                                    </li>
                                                    <li>
                                                        <input id="sub-group-3" type="checkbox" hidden />
                                                        <label for="sub-group-3"> Sign Installation</label>
                                                    </li>
                                                    <li>
                                                        <input id="sub-group-4" type="checkbox" hidden />
                                                        <label for="sub-group-4"> Sign Installation</label>
                                                    </li>
                                                    <li>
                                                        <input id="sub-group-5" type="checkbox" hidden />
                                                        <label for="sub-group-5"> Sign Installation </label>
                                                    </li>
                                                    <li>
                                                        <input id="sub-group-6" type="checkbox" hidden />
                                                        <label for="sub-group-6"> Sign Installation</label>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <input id="group-2" type="checkbox" hidden />
                                                <label for="group-2"><span><i class="fa fa-chevron-right" aria-hidden="true"></i></span> Products</label>
                                                <ul class="group-list">
                                                    <li>
                                                        <input id="sub-group-1" type="checkbox" hidden />
                                                        <label for="sub-group-1"> Banner</label>
                                                    </li>
                                                    <li>
                                                        <input id="sub-group-2" type="checkbox" hidden />
                                                        <label for="sub-group-2">Window Products</label>
                                                    </li>
                                                    <li>
                                                        <input id="sub-group-3" type="checkbox" hidden />
                                                        <label for="sub-group-3"> Vehicle Products</label>
                                                    </li>
                                                    <li>
                                                        <input id="sub-group-4" type="checkbox" hidden />
                                                        <label for="sub-group-4"> Marketing Tools</label>
                                                    </li>
                                                    <li>
                                                        <input id="sub-group-5" type="checkbox" hidden />
                                                        <label for="sub-group-5"> Event Signs</label>
                                                    </li>
                                                    <li>
                                                        <input id="sub-group-6" type="checkbox" hidden />
                                                        <label for="sub-group-6"> Indoor Signs</label>
                                                    </li>
                                                    <li>
                                                        <input id="sub-group-6" type="checkbox" hidden />
                                                        <label for="sub-group-6"> Hardwares</label>
                                                    </li>
                                                    <li>
                                                        <input id="sub-group-6" type="checkbox" hidden />
                                                        <label for="sub-group-6"> Direct Printing on Material</label>
                                                    </li>
                                                    <li>
                                                        <input id="sub-group-6" type="checkbox" hidden />
                                                        <label for="sub-group-6"> Direct Printing on Material</label>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#"> Design Lab</a>
                                            </li>
                                            <li>
                                                <a href="#"> Learning Center</a>
                                            </li>
                                            <li>
                                                <a href="#"> Contact Us</a>
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

<nav class="mega-menu">
    <div class="container-fluid">
        <ul id="navbarCategoryMenuListContainer"></ul>
    </div>
</nav>