<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/fonts/fonts.googleapis.com/css24b9.css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/dist/css/adminlte.min2167.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        /* Loader container (hidden by default) */
        .loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none;
            /* Initially hidden */
        }

        /* Loader animation */
        .loader {
            width: 50px;
            height: 50px;
            border: 5px solid #fff;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Keyframes for rotation animation */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #verifyAndSetPasswordContainer,
        #businessDetailsContainer {
            display: none;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div id="global-loader" class="loader-overlay">
        <div class="loader"></div>
    </div>

    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1"><b>Sign Assign</b></a>
            </div>
            <div class="card-body" id="registerContainer">
                <p class="login-box-msg">Create your account today!</p>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form id="registerForm">
                    <?= csrf_field() ?>
                    <div class="input-group mb-3">
                        <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <label class="form-label">Register as -</label>
                    <div class="input-group">
                        <div class="form-check" style="margin-right: 30px; margin-bottom: 10px;">
                            <label class="form-check-label"><input class="form-check-input" type="radio" name="roleId" value="2" checked> Individual</label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label"><input class="form-check-input" type="radio" name="roleId" value="3"> Business</label>
                        </div>
                    </div>
                    <div id="businessDetailsContainer">
                        <div class="input-group mb-3">
                            <input type="text" id="businessName" name="businessName" class="form-control" placeholder="Business name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-briefcase"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>

                    </div>
                </form>
                <div class="social-auth-links text-center">
                    <!-- <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a> -->
                    <a onclick="onClickSignUpWithGoogle()" class="btn btn-block btn-danger">
                        <i class="fab fa-google mr-2"></i>
                        Sign up using Google
                    </a>
                </div>
                <a href="/login" class="text-center">Already have an account? Login Now!</a>
            </div>

            <div class="card-body" id="verifyAndSetPasswordContainer">
                <p class="login-box-msg">Create your account today!</p>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form id="setPasswordForm">
                    <?= csrf_field() ?>
                    <div class="input-group mb-3">
                        <input type="text" id="otp" name="otp" class="form-control" placeholder="******">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="button" onclick="resendOTP()" class="btn btn-primary btn-block">Resend OTP</button>
                        </div>

                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>

    </div>

    <script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/dist/js/adminlte.min2167.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="<?= base_url('js/helper-validation.js'); ?>"></script>

    <script>
        const jwtToken = localStorage.getItem("jwtToken")
        if ((jwtToken ?? "").trim() !== "") {
            window.location.href = "/users"
        }

        const verificationType = "registration"
        let userEmail = null

        const loader = {
            show: function() {
                document.getElementById('global-loader').style.display = 'flex';
            },
            hide: function() {
                document.getElementById('global-loader').style.display = 'none';
            }
        };

        $(document).ready(() => {
            document.querySelectorAll('input[name="roleId"]').forEach(radio =>
                radio.addEventListener('change', () => {
                    const selectedValue = document.querySelector('input[name="roleId"]:checked').value;
                    console.log("Selected Role ID:", selectedValue);
                    if (parseInt(selectedValue) === 3) {
                        document.getElementById("businessDetailsContainer").style.display = "block"
                    } else {
                        document.getElementById("businessDetailsContainer").style.display = "none"
                    }
                })
            );

            $("#registerForm").on("submit", (e) => {
                e.preventDefault()

                const firstName = document.getElementById("firstName").value
                const lastName = document.getElementById("lastName").value
                const email = document.getElementById("email").value

                let roleId = document.querySelector('input[name="roleId"]:checked').value;
                roleId = parseInt(roleId)

                if ((firstName ?? "").trim() === "") {
                    toastr.error('Please enter a valid first name!');
                    return
                }

                if ((lastName ?? "").trim() === "") {
                    toastr.error('Please enter a valid last name!');
                    return
                }

                if (!isValidEmail(email ?? "")) {
                    toastr.error('Please enter a valid email id!');
                    return
                }

                let business = {}
                if (roleId === 3) {
                    const businessName = document.getElementById("businessName").value

                    if ((businessName ?? "").trim() === "") {
                        toastr.error('Please enter a valid business name!');
                        return
                    }

                    business = {
                        ...business,
                        name: businessName
                    }
                }

                $.ajax({
                    url: `http://3.109.198.252/api/v1/auth/register`,
                    method: 'POST',
                    data: {
                        verificationType,
                        firstName,
                        lastName,
                        email,
                        roleId: parseInt(roleId),
                        business
                    },
                    beforeSend: function() {
                        loader.show()
                    },
                    complete: function() {},
                    success: function(response) {
                        if (response.success) {
                            document.getElementById("registerContainer").style.display = "none"
                            document.getElementById("verifyAndSetPasswordContainer").style.display = "block"
                            userEmail = email

                            loader.hide()
                            toastr.success(response.message);
                        }
                    },
                    error: function(xhr, status, error, message) {
                        let errorMessage = "Something went wrong";

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            try {
                                let parsedResponse = JSON.parse(xhr.responseText);
                                errorMessage = parsedResponse.message || errorMessage;
                            } catch (e) {
                                errorMessage = xhr.responseText;
                            }
                        }

                        loader.hide();
                        toastr.error(errorMessage);
                    }
                })
            })

            $("#setPasswordForm").on("submit", (e) => {
                e.preventDefault()

                const otp = document.getElementById("otp").value
                const password = document.getElementById("password").value
                const confirmPassword = document.getElementById("confirmPassword").value

                if ((otp ?? "").trim() === "") {
                    toastr.error('Please enter a valid OTP!');
                    return
                }

                if ((password ?? "").trim() === "") {
                    toastr.error('Please enter a valid password!');
                    return
                }

                if ((confirmPassword ?? "").trim() === "") {
                    toastr.error('Please enter a valid confirm password!');
                    return
                }

                if (password !== confirmPassword) {
                    toastr.error('Password and Retyped password does not match!');
                    return
                }

                $.ajax({
                    url: `http://3.109.198.252/api/v1/auth/reset-password`,
                    method: 'POST',
                    data: {
                        verificationType,
                        email: userEmail,
                        hash: parseInt(otp),
                        newPassword: password
                    },
                    beforeSend: function() {
                        loader.show()
                    },
                    complete: function() {},
                    success: function(response) {
                        if (response.success) {
                            loader.hide()
                            toastr.success(response.message);

                            setTimeout(() => {
                                window.location.href = "/login"
                            }, [1000])
                        }
                    },
                    error: function(xhr, status, error, message) {
                        let errorMessage = "Something went wrong";

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            try {
                                let parsedResponse = JSON.parse(xhr.responseText);
                                errorMessage = parsedResponse.message || errorMessage;
                            } catch (e) {
                                errorMessage = xhr.responseText;
                            }
                        }

                        loader.hide();
                        toastr.error(errorMessage);
                    }
                })
            })
        })

        function resendOTP() {
            $.ajax({
                url: `http://3.109.198.252/api/v1/auth/send-otp`,
                method: 'POST',
                data: {
                    verificationType,
                    email: userEmail
                },
                beforeSend: function() {
                    loader.show()
                },
                complete: function() {},
                success: function(response) {
                    if (response.success) {
                        loader.hide()
                        toastr.success(response.message);
                    }
                },
                error: function(xhr, status, error, message) {
                    let errorMessage = "Something went wrong";

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        try {
                            let parsedResponse = JSON.parse(xhr.responseText);
                            errorMessage = parsedResponse.message || errorMessage;
                        } catch (e) {
                            errorMessage = xhr.responseText;
                        }
                    }

                    loader.hide();
                    toastr.error(errorMessage);
                }
            })
        }

        function onClickSignUpWithGoogle() {
            toastr.error("This feature is not yet available. Please try login with your registered email id and password.");
        }
    </script>
</body>

</html>