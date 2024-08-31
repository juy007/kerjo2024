@include('form_login/header')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
 <style>
    .page-content{
        margin-top: 0px !important;
    }
    .progress-t{
        margin-top: 75px;
    }
 </style>
<div class="main-content">
    <div class="progress progress-sm progress-t">
        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="page-content" style="background-color:#F4F7FE !important;">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h4 class="font-size-18">Pilih Industri Perusahaan Anda</h4>
                        <p class="text-mute">Pilih industri yang paling cocok untuk mendeskripsikan perusahaan Anda.</p>

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
                            <div class="col-sm-12">
                                <div class="col-sm-7" style="margin-left:auto;margin-right:auto;">
                                    <div class="flex-wrap gap-3 mb-3">
                                        <div class="" role="group" aria-label="Basic checkbox toggle button group">
                                            <input type="checkbox" class="btn-check" id="btncheck4" autocomplete="off" checked>
                                            <label class="btn btn-outline-primary" for="btncheck4">Bahan Baku</label>

                                            <input type="checkbox" class="btn-check" id="btncheck5" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btncheck5">Jasa</label>

                                            <input type="checkbox" class="btn-check" id="btncheck6" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btncheck6">Keuangan</label>

                                            <input type="checkbox" class="btn-check" id="btncheck7" autocomplete="off" checked>
                                            <label class="btn btn-outline-primary" for="btncheck7">Investasi</label>

                                            <input type="checkbox" class="btn-check" id="btncheck8" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btncheck8">Pajak</label>

                                            <input type="checkbox" class="btn-check" id="btncheck9" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btncheck9">Kuliner</label>

                                            <input type="checkbox" class="btn-check" id="btncheck10" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btncheck10">Retail</label>
                                        </div>
                                    </div>
                                    <div class="flex-wrap gap-3 mb-4">
                                        <div class="" role="group" aria-label="Basic checkbox toggle button group">
                                            <input type="checkbox" class="btn-check" id="btncheck11" autocomplete="off" checked>
                                            <label class="btn btn-outline-primary" for="btncheck11">Teknologi</label>

                                            <input type="checkbox" class="btn-check" id="btncheck12" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btncheck12">Logistik</label>

                                            <input type="checkbox" class="btn-check" id="btncheck13" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btncheck13">Manufaktur</label>

                                            <input type="checkbox" class="btn-check" id="btncheck14" autocomplete="off" checked>
                                            <label class="btn btn-outline-primary" for="btncheck14">Data Center</label>

                                            <input type="checkbox" class="btn-check" id="btncheck15" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btncheck15">Fashion</label>

                                            <input type="checkbox" class="btn-check" id="btncheck16" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btncheck16">Kontraktor</label>

                                            <input type="checkbox" class="btn-check" id="btncheck17" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btncheck17">Lainnya</label>
                                        </div>
                                    </div>
                                    <a class="btn btn-primary w-25 waves-effect waves-light" href="{{ route('profile_perusahaan_part2') }}">Lanjut</a>
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