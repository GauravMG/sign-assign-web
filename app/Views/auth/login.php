<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="icon" type="image/jpg" href="<?= base_url('images/cropped-sign-assign_icon-32x32.jpg'); ?>">

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

        .toggle-password {
            cursor: pointer;
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
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form id="loginForm">
                    <?= csrf_field() ?>
                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <!-- <span class="fas fa-lock"></span> -->
                                <span class="fas fa-eye toggle-password" onclick="togglePasswordVisibility(this, 'password')"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>

                    </div>
                </form>
                <div class="social-auth-links text-center mt-2 mb-3">
                    <!-- <a onclick="onClickSignInWithGoogle()" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a> -->
                    <!-- <a onclick="onClickSignInWithGoogle()" class="btn btn-block btn-danger">
                        <i class="fab fa-google mr-2"></i> Sign in using Google
                    </a> -->
                </div>

                <p class="mb-1 mt-2">
                    <a href="/admin/forgot-password">Forgot your password? Reset Password!</a>
                </p>
                <!-- <p class="mb-0">
                    <a href="/admin/register" class="text-center">Not yet registered? Register Now!</a>
                </p> -->
            </div>

        </div>

    </div>

    <script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte/dist/js/adminlte.min2167.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="<?= base_url('js/helper-validation.js'); ?>"></script>

    <script>
        const BASE_URL_API = '<?= BASE_URL_API ?>'
        const jwtToken = localStorage.getItem("jwtToken")
        if ((jwtToken ?? "").trim() !== "") {
            var userData = localStorage.getItem("userData") ?? null
            if (userData && typeof userData === "string") {
                userData = JSON.parse(userData)
            }
            setTimeout(() => {
                if ([1, 5].indexOf(parseInt(userData.roleId)) >= 0) {
                    window.location.href = "/admin/orders"
                }
            }, [1000])
        }

        const loader = {
            show: function() {
                document.getElementById('global-loader').style.display = 'flex';
            },
            hide: function() {
                document.getElementById('global-loader').style.display = 'none';
            }
        };

        function togglePasswordVisibility(el, inputId) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                el.classList.remove("fa-eye");
                el.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                el.classList.remove("fa-eye-slash");
                el.classList.add("fa-eye");
            }
        }

        $(document).ready(() => {
            $("#loginForm").on("submit", (e) => {
                e.preventDefault()

                const email = document.getElementById("email").value
                const password = document.getElementById("password").value

                if (!isValidEmail(email ?? "")) {
                    toastr.error('Please enter a valid email id!');
                    return
                }

                if ((password ?? "").trim() === "") {
                    toastr.error('Please enter a valid password!');
                    return
                }

                $.ajax({
                    url: `${BASE_URL_API}/v1/auth/sign-in`,
                    method: 'POST',
                    data: {
                        email,
                        password
                    },
                    beforeSend: function() {
                        loader.show()
                    },
                    complete: function() {},
                    success: function(response) {
                        const {
                            success,
                            message,
                            jwtToken,
                            data
                        } = response

                        if (success) {
                            loader.hide()

                            if ([1, 5].indexOf(parseInt(data.roleId)) >= 0) {
                                toastr.success(message);

                                localStorage.setItem("jwtToken", jwtToken)
                                localStorage.setItem("userData", JSON.stringify(data))
                            } else {
                                toastr.success("You are not authorized to access the admin panel. Please surf through the website to checkout our exciting products. Redirecting you to the website...");

                                localStorage.setItem("jwtTokenUser", jwtToken)
                                localStorage.setItem("userDataUser", JSON.stringify(data))
                            }

                            setTimeout(() => {
                                if ([1, 5].indexOf(parseInt(data.roleId)) >= 0) {
                                    window.location.href = "/admin/orders"
                                } else {
                                    window.location.href = "/"
                                }
                            }, [1500])
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

        function onClickSignInWithGoogle() {
            toastr.error("This feature is not yet available. Please try login with your registered email id and password.");
        }
    </script>
</body>

</html>