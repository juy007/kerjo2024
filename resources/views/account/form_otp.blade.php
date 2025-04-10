@include('account/header_start')
@include('account/header_end')

<div class="page-content" style="padding-bottom: 15%;">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12 pt-5">
                <div class="text-center">
                    <h4 class="font-size-18">Verifikasi OTP</h4>
                    <p class="text-mute">Kami telah mengirimkan kode OTP ke e-mail ponsel Anda.</p>

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
                                <form action="{{ route('verify_otp') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="otp" class="form-label">Masukkan Kode OTP</label>
                                        <input type="hidden" id="user_id" name="user_id" value="{{ session('user_id') }}">
                                        <input type="text" id="otp" name="otp" class="form-control text-center" value="{{ session('otp') }}" maxlength="6" required>
                                    </div>

                                    @if (session('notifOtp'))
                                    <div class="alert alert-danger">
                                        {{ session('notifOtp') }}
                                    </div>
                                    @endif

                                    <button type="submit" class="btn btn-primary w-100 waves-effect waves-light">Verifikasi</button>
                                </form>

                                <p class="mt-3">Tidak menerima kode OTP? <a href="#">Kirim Ulang</a></p>
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