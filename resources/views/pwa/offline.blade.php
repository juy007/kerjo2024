<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerjo - Offline</title>

    <!-- Meta -->
    <meta name="theme-color" content="#4CAF50">
    <link rel="manifest" href="{{ asset('pwa/manifest.json') }}">
    <link rel="shortcut icon" href="{{ asset('proxy-image/offline/src/fav.png') }}">

    <!-- CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" />
</head>

<body style="background-color: #F4F7FE;">
    <div class="container text-center py-5">
        <!-- Logo -->
        <a href="{{ url('/') }}">
            <div class="mb-4">
                <span class="logo-sm d-inline-block d-md-none">
                    <img src="{{ asset('proxy-image/offline/src/Kerjo sm.png') }}" alt="Kerjo" height="40">
                </span>
                <span class="logo-lg d-none d-md-inline-block">
                    <img src="{{ asset('proxy-image/offline/src/Kerjo B2 1.png') }}" alt="Kerjo" height="40">
                </span>
            </div>
        </a>

        <!-- Offline Content -->
        <h1 class="text-danger mb-3">Anda Sedang Offline</h1>

        <!-- Gambar Offline -->
        <img src="{{ asset('proxy-image/offline/src/no.jpg') }}" alt="Offline" class="img-fluid mb-4" style="max-width: 300px;">

        <!-- Tombol Coba Lagi -->
        <div class="mt-3">
            <a href="{{ url()->current() }}" class="btn btn-primary">Muat Ulang Halaman</a>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
