@include('admin/header_start')
@include('admin/header_end')
<style>
    .card-body{
        border-bottom: 2px solid #1c85ed;
    }
</style>
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
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="m-b-0">Total User</p>
                                <h2 class="m-b-0">
                                    <span>{{ $home['totalUser'] }}</span>
                                </h2>
                            </div>
                            <div class="avatar avatar-icon avatar-lg avatar-blue">
                                <i class="mdi mdi-account mdi-48px text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="m-b-0">Total Companies</p>
                                <h2 class="m-b-0">
                                    <span>{{ $home['totalCompanies'] }}</span>
                                </h2>
                            </div>
                            <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                <i class="mdi mdi-fridge-industrial mdi-48px text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="m-b-0">Total Job</p>
                                <h2 class="m-b-0">
                                    <span>{{ $home['totalUser'] }}</span>
                                </h2>
                            </div>
                            <div class="avatar avatar-icon avatar-lg avatar-red">
                                <i class="mdi mdi-hexagon-multiple mdi-48px text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="m-b-0">Total Pelamar</p>
                                <h2 class="m-b-0">
                                    <span>0</span>
                                </h2>
                            </div>
                            <div class="avatar avatar-icon avatar-lg avatar-gold">
                                <i class="mdi mdi-archive-arrow-down mdi-48px text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img style="max-height: 500px; width:auto;" src="{{ url('proxy-image/admin/welcome_a.png') }}" alt="" class="img-fluid mx-auto d-block">
        </div><!-- end row-->

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->
@include('admin/footer_start')
@include('admin/footer_end')