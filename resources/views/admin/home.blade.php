@include('admin/header_start')
@include('admin/header_end')
<div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Welcome !</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Welcome !</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total User</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="354.5">0</span>k
                                                </h4>
                                                <div class="text-nowrap">
                                                    <span class="badge bg-success-subtle text-success">20.9k</span>
                                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                                </div>
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
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Company</span>
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
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Job</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="7.54">0</span>
                                                </h4>
                                                <div class="text-nowrap">
                                                    <span class="badge bg-success-subtle text-success">2.8k</span>
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
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Pelamar</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="18.34">0</span>
                                                </h4>
                                                <div class="text-nowrap">
                                                    <span class="badge bg-success-subtle text-success">5.32</span>
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

                      
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
@include('admin/footer_start')
@include('admin/footer_end')