@include('account/header_start')
@include('account/header_end')

<div class="page-content" style="padding-bottom: 15%;">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12 pt-5">
                <div class="text-center">
                    <h4 class="font-size-18">Atur Ulang Kata Sandi</h4>
                    <p class="text-mute">Silakan masukkan kata sandi baru Anda.</p>

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
                                <form id="formReset" action="{{ route('password.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="userId" name="userId" value="{{ $id }}">
                                    <input type="hidden" id="token" name="token" value="{{ $token }}">

                                    <div class="mb-4">
                                        <input type="password" id="password-input" name="password" class="form-control" placeholder="Kata Sandi Baru" required>
                                    </div>

                                    <div class="mb-4">
                                        <input type="password" id="password-input1" name="password_confirmation" class="form-control" placeholder="Konfirmasi Kata Sandi" required>
                                    </div>


                                    @if (session('notif'))
                                    <div class="alert alert-danger">
                                        {{ session('notif') }}
                                    </div>
                                    @endif
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
                                    <div id="message" class="hidden"></div><br>
                                    <button type="submit" class="btn btn-primary w-100 waves-effect waves-light">Atur Ulang Kata Sandi</button>
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
<script src="{{ asset('assets/js/cusFormPass.js') }}"></script>
@include('account/footer_end')