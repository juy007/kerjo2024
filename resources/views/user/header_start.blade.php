<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <title>Kerjo</title>
    <meta name="description" content="Kerjo - Aplikasi pencari kerja terpercaya yang menghubungkan pencari kerja dengan perusahaan terbaik. Temukan lowongan pekerjaan impian dan bangun karir cemerlang bersama Kerjo. Download sekarang!">
    <meta name="keywords" content="kerjo, rekrutmen, lowongan kerja, perusahaan, karir, pekerjaan, job portal">
    <meta name="author" content="Kerjo / CariKerjo.id">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://company.carikerjo.id">
    <meta property="og:title" content="Kerjo - Platform Rekrutmen untuk Perusahaan Terbaik">
    <meta property="og:description" content="Kerjo - Aplikasi pencari kerja terpercaya yang menghubungkan pencari kerja dengan perusahaan terbaik. Temukan lowongan pekerjaan impian dan bangun karir cemerlang bersama Kerjo. Download sekarang!">
    <meta property="og:image" content="https://company.carikerjo.id/proxy-image/company/src/Kerjo%20sm.png">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://company.carikerjo.id">
    <meta name="twitter:title" content="Kerjo - Platform Rekrutmen untuk Perusahaan Terbaik">
    <meta name="twitter:description" content="Kerjo - Aplikasi pencari kerja terpercaya yang menghubungkan pencari kerja dengan perusahaan terbaik. Temukan lowongan pekerjaan impian dan bangun karir cemerlang bersama Kerjo. Download sekarang!">
    <meta name="twitter:image" content="https://company.carikerjo.id/proxy-image/company/src/Kerjo%20sm.png">

    <meta name="theme-color" content="#1c85ed">

    <link rel="canonical" href="https://company.carikerjo.id">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('proxy-image/company/src/fav.png') }}">

    <!-- preloader css -->
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

     <!-- Preload critical fonts untuk performa lebih baik -->
     <link rel="preload" href="{{ asset('assets/fonts/materialdesignicons-webfont.woff2?v=5.9.55') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('assets/fonts/Nunito-Regular.ttf') }}" as="font" type="font/ttf" crossorigin>
    
    <!-- Preconnect untuk CDN jika menggunakan -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="{{ asset('assets/css/appfont.css') }}" rel="stylesheet" type="text/css" />

    
    @if(isset($loadFormAdvanced) && $loadFormAdvanced)
    <script src="{{ asset('assets/js/form-advanced.init.js') }}"></script>
    @endif

    <!-- notifikasi -->
    <!--<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js"></script>
    <script src="{{ asset('assets/js/firebase-notifications.js') }}" defer></script>-->
