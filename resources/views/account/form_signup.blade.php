<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Kerjo | Register</title>
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
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 auth-content my-auto">
                                    <div class="text-center">
                                        <a href="index.html" class="d-block auth-logo mt-5">
                                            <img src="{{ url('proxy-image/src/Kerjo B2 1.png') }}" alt="" height="60"> <span class="logo-txt"></span>
                                        </a>
                                        <h3 class="mb-0">Register</h3>
                                        <p class="text-muted mt-2"></p>
                                    </div>
                                    <form id="signupForm" class="mt-4 pt-2" method="POST" action="{{ route('signup_save') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-1">
                                            <label for="nama"></label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ session('name') }}" placeholder="Masukkan Nama Lengkap" required>
                                        </div>
                                        <div class="mb-1">
                                            <label for="email"></label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ session('email') }}" placeholder="Masukkan Email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nomor_hp"></label>
                                            <input type="text" class="form-control" name="phone" id="phone" value="{{ session('phone') }}" placeholder="Masukkan Nomor HP" required>
                                        </div>

                                        <div class="form-floating mb-4 auth-pass-inputgroup mb-1 d-flex align-items-center position-relative">
                                            <input type="password" class="form-control" name="password" id="password-input" placeholder="Masukan Password" style="padding-right: 2.5rem;" required>
                                            <button type="button" class="btn btn-link position-absolute h-100 end-0 d-flex align-items-center" id="password-addon" style="top: 0;">
                                                <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                            </button>
                                            <label for="password-input">Masukan Password</label>
                                        </div>

                                        <div class="form-floating mb-4 auth-pass-inputgroup mb-1 d-flex align-items-center position-relative">
                                            <input type="password" class="form-control" name="password_confirmation" id="password-input1" placeholder="Masukan Password" style="padding-right: 2.5rem;" required>
                                            <button type="button" class="btn btn-link position-absolute h-100 end-0 d-flex align-items-center" id="password-addon1" style="top: 0;">
                                                <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                            </button>
                                            <label for="password-input1">Masukan Password Ulang</label>
                                        </div>

                                        <style>
                                            /*notif repassword*/
                                            .hidden {
                                                display: none;
                                            }

                                            .message {
                                                padding: 10px;
                                                margin-top: 10px;
                                                border-radius: 5px;
                                                font-weight: bold;
                                                animation: fadeIn 0.5s ease-in-out;
                                            }

                                            .message.success {
                                                background-color: #d4edda;
                                                color: #155724;
                                                border: 1px solid #c3e6cb;
                                            }

                                            .message.error {
                                                background-color: #f8d7da;
                                                color: #721c24;
                                                border: 1px solid #f5c6cb;
                                            }

                                            @keyframes fadeIn {
                                                from {
                                                    opacity: 0;
                                                }

                                                to {
                                                    opacity: 1;
                                                }
                                            }
                                        </style>
                                        <div id="message" class="hidden"></div>
                                        @if (session('notifRegister'))
                                        <div class="alert alert-danger">
                                            {{ session('notifRegister') }}
                                        </div>
                                        @endif
                                        <div class="col mb-3">
                                            <p class="text-muted mb-0">Dengan mengklik daftar, Anda menyetujui <a href="#" class="text-primary fw-semibold" data-bs-toggle="modal"
                                                    data-bs-target=".bs-syarat-modal-lg">syarat
                                                    dan ketentuan</a> yang berlaku di KERJO</p>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Daftar Sekarang</button>
                                        </div>
                                    </form>
                                    <!--  Large modal example -->
                                    <div class="modal fade bs-syarat-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myLargeModalLabel">Syarat dan Ketentuan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h3>Syarat dan Ketentuan Pendaftaran Akun</h3>

                                                    <ol>
                                                        <li><strong>Persetujuan Pengguna</strong>
                                                            <p>Dengan mendaftar akun, Anda menyetujui semua syarat dan ketentuan yang berlaku serta kebijakan privasi layanan ini. Jika Anda tidak menyetujui syarat-syarat ini, harap jangan melanjutkan proses pendaftaran.</p>
                                                        </li>

                                                        <li><strong>Kelayakan Pengguna</strong>
                                                            <p>Anda harus berusia minimal 18 tahun atau usia dewasa yang berlaku di wilayah hukum Anda untuk membuat akun. Pengguna di bawah usia tersebut harus mendapatkan persetujuan dari orang tua atau wali sebelum menggunakan layanan ini.</p>
                                                        </li>

                                                        <li><strong>Informasi Akun</strong>
                                                            <ol type="a">
                                                                <li>Semua informasi yang diberikan selama proses pendaftaran harus akurat, lengkap, dan terbaru. Jika informasi tersebut berubah, Anda harus memperbarui informasi akun Anda.</li>
                                                                <li>Pengguna bertanggung jawab atas keamanan informasi akun, termasuk kata sandi. Anda tidak boleh membagikan informasi akun kepada pihak ketiga.</li>
                                                            </ol>
                                                        </li>

                                                        <li><strong>Penggunaan Akun</strong>
                                                            <ol type="a">
                                                                <li>Akun yang didaftarkan hanya boleh digunakan oleh Anda dan tidak boleh dijual, dipindahkan, atau dialihkan kepada orang lain.</li>
                                                                <li>Anda bertanggung jawab atas semua aktivitas yang dilakukan menggunakan akun Anda.</li>
                                                                <li>Penyalahgunaan layanan melalui akun Anda dapat menyebabkan penangguhan atau penghapusan akun tanpa pemberitahuan terlebih dahulu.</li>
                                                            </ol>
                                                        </li>

                                                        <li><strong>Kebijakan Privasi</strong>
                                                            <p>Informasi pribadi yang Anda berikan saat pendaftaran akan dikelola sesuai dengan kebijakan privasi kami. Kami tidak akan membagikan informasi pribadi Anda tanpa persetujuan, kecuali jika diwajibkan oleh hukum.</p>
                                                        </li>

                                                        <li><strong>Perubahan Syarat dan Ketentuan</strong>
                                                            <p>Kami berhak untuk mengubah syarat dan ketentuan ini sewaktu-waktu tanpa pemberitahuan sebelumnya. Setiap perubahan akan diberlakukan segera setelah diumumkan di platform ini. Anda disarankan untuk memeriksa halaman ini secara berkala.</p>
                                                        </li>

                                                        <li><strong>Pengakhiran Akun</strong>
                                                            <p>Kami berhak mengakhiri atau menonaktifkan akun Anda jika Anda melanggar syarat dan ketentuan ini atau jika kami menganggap bahwa penggunaan akun Anda membahayakan layanan atau pengguna lain.</p>
                                                        </li>

                                                        <li><strong>Hukum yang Berlaku</strong>
                                                            <p>Syarat dan ketentuan ini diatur oleh hukum yang berlaku di wilayah operasi kami, dan segala perselisihan yang muncul akan diselesaikan melalui pengadilan yang berwenang.</p>
                                                        </li>
                                                    </ol>

                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <div class="mt-4 text-center">
                                        <p class="text-muted mb-0">Already have account ? <a href="{{ route('login') }}"
                                                class="text-primary fw-semibold"> Login </a> </p>
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
                    <div class="auth-bg-register pt-md-5 p-4 d-flex">
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


    <?php

    use Illuminate\Support\Facades\Hash;

    ?>

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
    <script src="{{ asset('assets/js/cusformSignup.js') }}"></script>

</body>

</html>