<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Kerjo | Administrator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('proxy-image/src/fav.png') }}">

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-topbar="dark">

    <!-- <body data-layout="horizontal"> -->
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-6 col-lg-6 col-md-6">
                    <div class="auth-full-page-content d-flex p-sm-6 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-90">
                                <div class="mb-4 mb-md-5 auth-content my-auto">
                                    <div class="text-center">
                                        <a href="{{ route('admin_login') }}" class="d-block auth-logo mt-5">
                                            <img src="{{ url('proxy-image/src/Kerjo B2 1.png') }}" alt="" height="60"> <span class="logo-txt"></span>
                                        </a>
                                        <h3 class="mb-0">Administrator</h3>
                                        <p class="text-muted mt-2"></p>
                                    </div>
                                    <form class="mt-4 pt-2" method="POST" action="{{ route('login_validation') }}">
                                        @csrf
                                        <div class="form-floating form-floating-custom mb-4">
                                            <input type="text" class="form-control" id="input-username" name="email" value="admin@carikerjo.id" placeholder="Enter User Name">
                                            <label for="input-username">Username</label> <!-- Placeholder ditambahkan -->
                                            <div class="form-floating-icon">
                                                <i data-feather="users"></i>
                                            </div>
                                        </div>

                                        <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5" id="password-input" name="password" value="AVERus04^^69" placeholder="Enter Password">

                                            <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                            </button>
                                            <label for="input-password">Password</label> <!-- Placeholder ditambahkan -->
                                            <div class="form-floating-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Login</button>
                                        </div>

                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        <div class="row mb-4">
                                            <div class="col left-bar">
                                               
                                            </div>

                                            <div class="col">
                                                <div class="form-check font-size-15 text-right">
                                                    <p class="text-muted mb-0 font-size-13">
                                                        <!--<a href="auth-register.html" class="text-primary fw-semibold"> Forget Password</a>-->
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <!-- <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Dason   . Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-6 col-lg-6 col-md-3">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <!-- <div class="bg-overlay"></div> -->
                        <!--<ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>-->
                        <!-- end bubble effect --><!--
                            <div class="row justify-content-center align-items-end">
                                <div class="col-xl-7">
                                    <div class="p-0 p-sm-4 px-xl-0">
                                        <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators auth-carousel carousel-indicators-rounded justify-content-center mb-0">
                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
                                                    <img src="assets/images/users/avatar-1.jpg" class="avatar-md img-fluid rounded-circle d-block" alt="...">
                                                </button>
                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2">
                                                    <img src="assets/images/users/avatar-2.jpg" class="avatar-md img-fluid rounded-circle d-block" alt="...">
                                                </button>
                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3">
                                                    <img src="assets/images/users/avatar-3.jpg" class="avatar-md img-fluid rounded-circle d-block" alt="...">
                                                </button>
                                            </div>
                                           
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>-->
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>




    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <!-- pace js -->
    <script src="{{ asset('assets/libs/pace-js/pace.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/pass-addon.init.js') }}"></script>

    <script src="{{ asset('assets/js/pages/feather-icon.init.js') }}"></script>

</body>

</html>