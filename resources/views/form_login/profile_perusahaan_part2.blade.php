@include('form_login/header')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<style>
    .page-content {
        margin-top: 0px !important;
    }

    .progress-t {
        margin-top: 75px;
    }
</style>
<div class="main-content">
    <div class="progress progress-sm progress-t">
        <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h4 class="font-size-18">Tentang Perusahaan Anda</h4>
                        <p class="text-mute">Masukkan identitas perusahaan Anda dengan lengkap dan akurat, agar<br>
                            Kerjo dapat memverifikasi akun Anda! Pasang logo agar kandidat tertarik melamar ke lowongan.</p>


                    </div>
                </div>
            </div><br><br>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="">
                        <div class="row justify-content-center mb-5">
                            <div class="col-lg-5">
                                <div>
                                    <form>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">Email</label>
                                                    <input type="email" class="form-control" id="formrow-email-input">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-password-input">Password</label>
                                                    <input type="password" class="form-control" id="formrow-password-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-email-input">Email</label>
                                                    <input type="email" class="form-control" id="formrow-email-input">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="formrow-password-input">Password</label>
                                                    <input type="password" class="form-control" id="formrow-password-input">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">

                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="formrow-customCheck">
                                                <label class="form-check-label" for="formrow-customCheck">Check me out</label>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                                        </div>
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
    @include('form_login/footer')