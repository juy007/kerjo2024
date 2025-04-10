@include('user/header_start')
@include('user/header_end')
<div class="page-content" style="background-color:#F4F7FE !important;">
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Lowongan</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="354.5">0</span>k
                                </h4>
                                <!--
                                <div class="text-nowrap">
                                    <span class="badge bg-success-subtle text-success">+$20.9k</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                                -->
                            </div>

                            <div class="flex-shrink-0 text-end dash-widget">
                                <div id="mini-chart1" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts"></div>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Pelamar</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="1256">0</span>
                                </h4>
                                <div class="text-nowrap">
                                    <span class="badge bg-danger-subtle text-danger">-29 Trades</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div>
                            <div class="flex-shrink-0 text-end dash-widget">
                                <div id="mini-chart2" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts"></div>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col-->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Pelamar Diterima</span>
                                <h4 class="mb-3">
                                    $<span class="counter-value" data-target="7.54">0</span>M
                                </h4>
                                <div class="text-nowrap">
                                    <span class="badge bg-success-subtle text-success">+ $2.8k</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div>
                            <div class="flex-shrink-0 text-end dash-widget">
                                <div id="mini-chart3" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts"></div>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Pelamar Ditolak</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="18.34">0</span>%
                                </h4>
                                <div class="text-nowrap">
                                    <span class="badge bg-success-subtle text-success">+5.32%</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div>
                            <div class="flex-shrink-0 text-end dash-widget">
                                <div id="mini-chart4" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts"></div>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row-->

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Lowongan</h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <div class="row justify-content-center mb-5">
                        <div class="col-sm-7">
                            <div class="maintenance-img">
                                <img src="{{ url('proxy-image/src/image_home.png') }}" alt="" class="img-fluid mx-auto d-block">
                            </div><br>
                            <p>Anda belum membuat postingan lowongan kerja sama sekali, yuk<br>
                                posting lowongan kerja untuk perusahaan anda agar bisa mendapatkan karyawan baru</p>
                            <div class="col-sm-5" style="margin-left:auto;margin-right:auto;">
                                <a class="btn btn-primary w-100 waves-effect waves-light" href="{{ route('form_job') }}">BUAT POSTINGAN PEKERJAAN</a>
                            </div>
                            @if(session('xxx'))
                            <div class="alert alert-danger">
                                {{ session('xxx') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@include('user/footer')
</body>

</html>