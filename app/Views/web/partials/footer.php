<footer>
    <div class="container-fluid">
        <div class="footer-inner">
            <div class="footer-col">
                <div class="footer-logo">
                    <img src="<?= base_url('images/footer-logo.png') . '?t=' . time(); ?>" alt="">
                </div>
                <h5><span><i class="fa-solid fa-phone-volume"></i></span><span>972-418-5253</span></h5>
                <h6><span><i class="fa-solid fa-envelope-open"></i></span><span>orders@signassign.com</span></h6>
                <h6>
                    <span><i class="fa-solid fa-location-dot"></i></span>
                    <span>702 Shepherd Dr, Garland, TX 75042, United States</span>
                </h6>
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-square-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Choose from</h5>
                <ul id="footerCategoryMenuListContainer">
                </ul>
            </div>
            <div class="footer-col">
                <h5>Information</h5>
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>Order Tracking</span>
                        </a>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>Sign Assign Wallet</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>International Shipping</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>Customer Reviews</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>Special Offers</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>Sitemap</span>
                        </a>
                    </li>
                    <li>
                        <a href="/learning-center">
                            <i class="fa-solid fa-arrow-right"></i><span>Blog</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>Sign Assign Catalog</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>Banner for a Cause</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Customer Service</h5>
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>About Us</span>
                        </a>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>Contact Us</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>Privacy Policy</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>Terms of Use</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>Affiliate Program</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-arrow-right"></i><span>Areas of Service</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Help Station</h5>
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i><span>FAQs</span>
                        </a>
                    <li>
                        <a href="#">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i><span>Return Policy</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i><span>Free Design Proofs</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i><span>Shipping</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i><span>Sample Kit</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i><span>Vectorization</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i><span>Instant Quote</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i><span>Business Inquiries</span>
                        </a>
                    </li>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<div class="copyright-area">
    <div class="container-fluid">
        <h6>Sign Assign Company copyright (©) 2025 </h6>
    </div>
</div>

<!-- Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="auth-inner signup">
                    <div class="left-area">
                        <h1>Sign Up</h1>
                        <p>
                            Sign up today and enjoy 25% OFF your first purchase! Whether you're just getting started or looking to take things to the next level, this is the perfect time to jump in and save. Don’t miss out—this special offer won’t last forever!
                        </p>
                    </div>

                    <div class="right-area" id="registerFormContainer">
                        <form>
                            <div class="form-group">
                                <div class="flex-inner">
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                            </div>
                            <!-- <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password (Min 6 Characters Allowed)">
                            </div> -->
                            <div class="form-group">
                                <div class="flex-inner">
                                    <!-- <select name="" id="" class="form-select" style="flex: 1 1 25%">
                                        <option value="">
                                            <div>
                                                <span>+91</span>
                                            </div>
                                        </option>
                                        <option value="">
                                            <div>
                                                <span>+91</span>
                                            </div>
                                        </option>
                                        <option value="">
                                            <div>
                                                <span>+91</span>
                                            </div>
                                        </option>
                                    </select> -->
                                    <input type="tel" class="form-control" style="flex: 1 1 75%" id="mobile" name="mobile" placeholder="Mobile Number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Register as -</label>
                                <div class="flex-radiobtn">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="roleId" value="2" checked> Individual
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="roleId" value="3"> Business
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="businessDetailsContainer" class="form-group">
                                <input type="text" id="businessName" name="businessName" class="form-control" placeholder="Business name">
                            </div>
                            <div class="form-group">
                                <label for="terms">
                                    <input type="checkbox" id="terms" />
                                    By agreeing, you'll receive the latest promotional offers,
                                    updates, and creative ideas from us via SMS, WhatsApp, or
                                    Email. You can opt out anytime you wish to.
                                </label>
                            </div>
                            <div class="form-group mt-3">
                                <a onclick="register()" class="submit-btn">Create Account</a>
                            </div>
                        </form>

                        <!-- <div class="sso-area mt-4">
                            <p>Or sign up with</p>
                            <div class="social-icons-inner">
                                <a href="#">
                                    <img src="<?= base_url('images/login-page/facebook.png') . '?t=' . time(); ?>" alt="" width="100%">
                                    Facebook
                                </a>
                                <a href="#">
                                    <img src="<?= base_url('images/login-page/google.png') . '?t=' . time(); ?>" alt="" width="100%">
                                    Google
                                </a>
                                <a href="#">
                                    <img src="<?= base_url('images/login-page/social.png') . '?t=' . time(); ?>" alt="" width="100%">
                                    Amazon
                                </a>
                            </div>
                        </div> -->

                        <p>Already have an account? <a onclick="onClickOpenModalLogin()">Log in</a></p>
                        <p>Read Our <a href="#">Terms And Conditions</a> And <a href="#">Privacy Policy</a></p>
                    </div>

                    <div class="right-area" id="verifyAndSetPasswordContainer" style="display: none;">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" id="otp" name="otp" placeholder="OTP">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                            </div>
                            <div class="form-group mt-3">
                                <a onclick="resendOTP('registration')" class="submit-btn">Resend OTP</a>
                            </div>
                            <div class="form-group mt-3">
                                <a onclick="verifyAndSetPassword('registration')" class="submit-btn">Complete Setup</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="auth-inner login">
                    <div class="left-area">
                        <h1>Login</h1>
                        <p>
                            Welcome back! Please log in to your account to view your order history, track shipments, and enjoy a faster checkout experience. If you’re new here, create an account to access exclusive deals, manage your wishlist, and stay updated on the latest products.
                        </p>
                    </div>
                    <div class="right-area">
                        <form onsubmit="return false;">
                            <div class="form-group">
                                <input type="email" id="loginEmail" name="loginEmail" class="form-control" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="password" id="loginPassword" name="loginPassword" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group mt-3">
                                <div class="flex-inner">
                                    <!-- <a href="#">Get Email OTP</a> -->
                                    <a onclick="onClickOpenModalForgotPassword()">Forget Password?</a>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="submit-btn" onclick="login()">Login</button>
                            </div>
                        </form>

                        <!-- <div class="sso-area mt-4">
                            <p>Or login with</p>
                            <div class="login-social-icons-inner">
                                <a href="#">
                                    <img src="<?= base_url('images/login-page/facebook.png') . '?t=' . time(); ?>" alt="" width="100%">
                                    Facebook
                                </a>
                                <a href="#">
                                    <img src="<?= base_url('images/login-page/google.png') . '?t=' . time(); ?>" alt="" width="100%">
                                    Google
                                </a>
                                <a href="#">
                                    <img src="<?= base_url('images/login-page/social.png') . '?t=' . time(); ?>" alt="" width="100%">
                                    Amazon
                                </a>
                            </div>
                        </div> -->

                        <p>Don't have an account? <a onclick="onClickOpenModalSignUp()">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="auth-inner forgot-password">
                    <div class="left-area">
                        <h1>Forgot Password</h1>
                        <p>
                            Enter the email associated with your account, and we'll send you an OTP to reset your password securely.
                        </p>
                    </div>

                    <div class="right-area" id="forgotPasswordRequestContainer">
                        <form>
                            <div class="form-group">
                                <input type="email" class="form-control" id="forgotEmail" name="forgotEmail" placeholder="Enter your Email">
                            </div>
                            <div class="form-group mt-3">
                                <a onclick="resendOTP('forgot_password')" class="submit-btn">Send OTP</a>
                            </div>
                        </form>
                        <p>Remembered your password? <a onclick="onClickOpenModalLogin()">Log in</a></p>
                    </div>

                    <div class="right-area" id="forgotPasswordVerifyContainer" style="display: none;">
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" id="forgotOTP" name="forgotOTP" placeholder="Enter OTP">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password">
                            </div>
                            <div class="form-group mt-3">
                                <a onclick="resendOTP('forgot_password')" class="submit-btn">Resend OTP</a>
                            </div>
                            <div class="form-group mt-3">
                                <a onclick="verifyAndSetPassword('forgot_password')" class="submit-btn">Reset Password</a>
                            </div>
                        </form>
                        <p>Go back to <a onclick="onClickOpenModalLogin()">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade right" id="filterModal" tabindex="-1" aria-labelledby="filterModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Filters</strong></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="main-filter-area">
                    <div id="dynamicAttributeFilters">
                        <div class="filters-inner">
                            <div class="filter-dropdown-area">
                                <h6>Finish</h6>
                                <span><svg class="fa-caret-down svg-inline--fa" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"></path>
                                    </svg><!-- <i class="fa-solid fa-caret-down"></i> Font Awesome fontawesome.com --></span>
                            </div>
                            <ul class="d-none d-block">
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(4, 'Gloss')">Gloss</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(4, 'Matt')">Matt</a>
                                </li>
                            </ul>
                        </div>
                        <div class="filters-inner">
                            <div class="filter-dropdown-area">
                                <h6>Lamination</h6>
                                <span><svg class="fa-caret-down svg-inline--fa" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"></path>
                                    </svg><!-- <i class="fa-solid fa-caret-down"></i> Font Awesome fontawesome.com --></span>
                            </div>
                            <ul class="d-none d-block">
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(7, 'Gloss')">Gloss</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(7, 'Matte')">Matte</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(7, 'Dry Erase')">Dry Erase</a>
                                </li>
                            </ul>
                        </div>
                        <div class="filters-inner">
                            <div class="filter-dropdown-area">
                                <h6>Material</h6>
                                <span><svg class="svg-inline--fa fa-caret-down" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"></path>
                                    </svg><!-- <i class="fa-solid fa-caret-down"></i> Font Awesome fontawesome.com --></span>
                            </div>
                            <ul class="d-none d-block">
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(10, '13 oz (standard)')">13 oz (standard)</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(10, '20 oz (heavy duty)')">20 oz (heavy duty)</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(10, '08 oz (standard)')">08 oz (standard)</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(10, '09 oz (premium)')">09 oz (premium)</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(10, '12 oz (heavy duty)')">12 oz (heavy duty)</a>
                                </li>
                            </ul>
                        </div>
                        <div class="filters-inner">
                            <div class="filter-dropdown-area">
                                <h6>Options:</h6>
                                <span><svg class="svg-inline--fa fa-caret-down" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"></path>
                                    </svg><!-- <i class="fa-solid fa-caret-down"></i> Font Awesome fontawesome.com --></span>
                            </div>
                            <ul class="d-none d-block">
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(11, 'Hem (standard – Included)')">Hem (standard – Included)</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(11, 'Grommets (4 corners – included)')">Grommets (4 corners – included)</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(11, 'Additional Grommets (1 set of 4)')">Additional Grommets (1 set of 4)</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(11, 'Reinforced Corners')">Reinforced Corners</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(11, 'Pole Pocket (Top)')">Pole Pocket (Top)</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(11, 'Pole Pocket (Top @ Bottom)')">Pole Pocket (Top @ Bottom)</a>
                                </li>
                            </ul>
                        </div>
                        <div class="filters-inner">
                            <div class="filter-dropdown-area">
                                <h6>Pole Pocket</h6>
                                <span><svg class="svg-inline--fa fa-caret-down" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"></path>
                                    </svg><!-- <i class="fa-solid fa-caret-down"></i> Font Awesome fontawesome.com --></span>
                            </div>
                            <ul class="d-none d-block">
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(8, 'Top')">Top</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(8, 'Top @ Bottom')">Top @ Bottom</a>
                                </li>
                            </ul>
                        </div>
                        <div class="filters-inner">
                            <div class="filter-dropdown-area">
                                <h6>Printing</h6>
                                <span><svg class="svg-inline--fa fa-caret-down" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"></path>
                                    </svg><!-- <i class="fa-solid fa-caret-down"></i> Font Awesome fontawesome.com --></span>
                            </div>
                            <ul class="d-none d-block">
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(6, 'Single sided')">Single sided</a>
                                </li>
                                <li style="cursor: pointer;">
                                    <a onclick="onFilterAttribute(6, 'Double Sided')">Double Sided</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Chat Icon -->
<div id="chat-icon">💬</div>

<!-- Chat Window -->
<div id="chat-box" style="display:none;">
    <div id="chat-header">Support Bot</div>
    <div id="chat-content"></div>
    <form id="grievance-form" style="display:none;" class="grievance-form">
        <div class="form-group">
            <input type="text" name="grievance-form-name" id="grievance-form-name" placeholder="Your Name" required />
        </div>
        <div class="form-group">
            <input type="email" name="grievance-form-email" id="grievance-form-email" placeholder="Your Email" required />
        </div>
        <div class="form-group">
            <input type="tel" name="grievance-form-mobile" id="grievance-form-mobile" placeholder="Mobile Number" required />
        </div>
        <div class="form-group">
            <input type="text" name="grievance-form-subject" id="grievance-form-subject" placeholder="Subject" required />
        </div>
        <div class="form-group">
            <textarea name="grievance-form-message" id="grievance-form-message" rows="3" placeholder="Your Message" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>
    <input type="text" id="chat-input" placeholder="Type here..." />
</div>