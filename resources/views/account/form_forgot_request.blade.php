@include('account/header_start')
@include('account/header_end')

<div class="page-content" style="padding-bottom: 15%;">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12 pt-5">
                <div class="text-center">
                    <h4 class="font-size-18">Forgot Password</h4>
                    <p class="text-mute">Kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda ke email Anda.</p>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div><br><br>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <div class="row justify-content-center mb-5">
                        <div class="col-sm-8">
                            <div class="col-sm-5" style="margin-left:auto;margin-right:auto;">
                                <form action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="email" class="form-label">Masukkan Alamat Email Anda</label>
                                        <input type="email" id="email" name="email" class="form-control text-center" required>
                                    </div>

                                    @if (session('status'))
                                    <div class="alert alert-info">
                                        {{ session('status') }}
                                    </div>
                                    @endif
                                    @if (session('email'))
                                    <div class="alert alert-danger">
                                        {{ session('email') }}
                                    </div>
                                    @endif

                                    <button type="submit" class="btn btn-primary w-100 waves-effect waves-light">Kirim Tautan Reset</button>
                                    <br><br><a href="{{ route('login') }}">Kembali ke halaman login</a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@include('account/footer_start')
@include('account/footer_end')