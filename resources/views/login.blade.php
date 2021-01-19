<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard

* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Hello Covid - Login</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/img/brand/favicon.png')}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}"
        type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/argon.css?v=1.2.0')}}" type="text/css">
</head>

<body class="bg-default">
    <!-- Navbar -->

    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7">
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0">
                    <div class="card-header bg-transparent">
                        <h2 class="text-center" style="color: black">Hello Covid Admin</h2>
                    </div>
                    <div class="card-body">
                        <form role="form" id="form">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Email" type="email" name="email" id="email">
                                </div>
                                <small id="email_alert" class="form-text text-danger"></small>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" onclick="showpassword()" style="color: gray;cursor: pointer;"><i class="fa fa-eye-slash" id="iconpassword"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Password" type="password" id="password" name="password">
                                </div>
                                <small id="password_alert" class="form-text text-danger"></small>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="exampleCheck1">keep me login</label>
                              </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4" onclick="validasi()">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <footer class="py-5" id="footer-main">
        <div class="container">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                        &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1"
                            target="_blank">Hello Covid</a>
                    </div>
                </div>
                <div class="col-xl-6">
                </div>
            </div>
        </div>
    </footer>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/js-cookie/js.cookie.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
    <!-- Argon JS -->
    <script src="{{asset('assets/js/argon.js?v=1.2.0')}}"></script>
    <script src="{{asset('assets/js/validation.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function () {

        });

        const data = {
            create: {
                url: "{{url('admin/login')}}",
                method: "post"
            }
        }

        const validation = new valbon(data);

        validasi = () => {
            $('.is-invalid').removeClass('is-invalid');
            $('.text-danger').empty();
            let data = $('#form').serializeArray();
            let result = validation.loopingValidasi(data);
            if (result == 0) {
                login();
            } else {
                validation.loopingErrorEmpty(result);
            }
        }

        login = () => {
            console.log(data.create.method)
            $.ajax({
                url: data.create.url,
                type: data.create.method,
                data: $('#form').serialize(),
                success: (res) => {
                    successRedirect(res.message);
                },
                error: (response) => {
                    if (response.responseJSON.errors == null) {
                        $(`#${response.responseJSON.data}_alert`).text(response.responseJSON.message)
                        validation.sweetError(response.responseJSON.message)
                    } else {
                        let fail = response.responseJSON.errors;
                        let key = Object.keys(fail)
                        validation.loopingError(fail, key)
                    }
                }
            })
        }

        showpassword = () => {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
                $('#iconpassword').removeClass('fa fa-eye-slash');
                $('#iconpassword').addClass('fa fa-eye');
            } else {
                x.type = "password";
                $('#iconpassword').removeClass('fa fa-eye');
                $('#iconpassword').addClass('fa fa-eye-slash');
            }
        }

        successRedirect = (message) => {
            Swal.fire(
                'Good job!',
                message,
                'success'
            ).then((result) => {
                window.location = "{{route('dashboard')}}";
            })
        }

    </script>
</body>

</html>