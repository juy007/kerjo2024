<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Kerjo | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kerjo - Aplikasi pencari kerja terpercaya yang menghubungkan pencari kerja dengan perusahaan terbaik. Temukan lowongan pekerjaan impian dan bangun karir cemerlang bersama Kerjo. Download sekarang!">
    <meta name="keywords" content="kerjo, rekrutmen, lowongan kerja, perusahaan, karir, pekerjaan, job portal">
    <meta name="author" content="Kerjo / CariKerjo.id">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://company.carikerjo.id">
    <meta property="og:title" content="Kerjo - Platform Rekrutmen untuk Perusahaan Terbaik">
    <meta property="og:description" content="Kerjo - Aplikasi pencari kerja terpercaya yang menghubungkan pencari kerja dengan perusahaan terbaik. Temukan lowongan pekerjaan impian dan bangun karir cemerlang bersama Kerjo. Download sekarang!">
    <meta property="og:image" content="https://company.carikerjo.id/proxy-image/src/Kerjo%20sm.png">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://company.carikerjo.id">
    <meta name="twitter:title" content="Kerjo - Platform Rekrutmen untuk Perusahaan Terbaik">
    <meta name="twitter:description" content="Kerjo - Aplikasi pencari kerja terpercaya yang menghubungkan pencari kerja dengan perusahaan terbaik. Temukan lowongan pekerjaan impian dan bangun karir cemerlang bersama Kerjo. Download sekarang!">
    <meta name="twitter:image" content="https://company.carikerjo.id/proxy-image/src/Kerjo%20sm.png">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/fav.png') }}">

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
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 auth-content my-auto">
                                    <div class="text-center">
                                        <a href="{{ url('/') }}" class="d-block auth-logo mt-5">
                                            <img src="{{ url('proxy-image/src/Kerjo B2 1.png') }}" alt="" height="60"> <span class="logo-txt"></span>
                                        </a>
                                        <h3 class="mb-0">Welcome Back</h3>
                                        <p class="text-muted mt-2"></p>
                                    </div>
                                    <form class="mt-4 pt-2" method="POST" action="{{ route('userValidation') }}" enctype="multipart/form-data"> @csrf
                                        <div class="mb-2">
                                            <input type="email" class="form-control" name="email" id="input-username" value="company@carikerjo.id" placeholder="Enter User Name">
                                            <label for="input-username"></label>
                                        </div>

                                        <div class="mb-2 auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5" name="password" id="password-input" value="AVERus04^^69" placeholder="Enter Password">
                                            <label for="input-password"></label>
                                        </div>
                                        <!--<div class="form-floating form-floating-custom mb-4">
                                                <input type="email" class="form-control" name="email" id="input-username" placeholder="Enter User Name">
                                                <label for="input-username"></label>
                                                <div class="form-floating-icon">
                                                   <i data-feather="users"></i>
                                                </div>
                                            </div>

                                            <div class="form-floating form-floating-custom mb-4 auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5" name="password" id="password-input" placeholder="Enter Password">
                                                
                                                <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                                    <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                </button>
                                                <label for="input-password"></label>
                                                <div class="form-floating-icon">
                                                    <i data-feather="lock"></i>
                                                </div>
                                            </div>-->
                                        @if (session('notifLogin'))
                                        <div class="alert alert-danger">
                                            {{ session('notifLogin') }}
                                        </div>
                                        @endif
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Login</button>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col left-bar">
                                                <div class="form-check font-size-15">
                                                    <input class="form-check-input" type="checkbox" id="remember-check" name="remember">
                                                    <label class="form-check-label font-size-13" for="remember-check">
                                                        Keep me login
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-check font-size-15 text-right">
                                                    <p class="text-muted mb-0 font-size-13"><a href="{{ route('password.request') }}"
                                                            class="text-primary fw-semibold"> Forget Password</a> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Don't have an account yet ? <a href="{{ route('signup') }}"
                                                class="text-primary fw-semibold"> Sign Up </a> </p>
                                    </div>
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