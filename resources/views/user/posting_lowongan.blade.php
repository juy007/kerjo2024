@include('user/header')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content" style="background-color:#F4F7FE !important;">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Lowongan</h4>

                        <div class="page-title-right">

                        </div>

                    </div>
                </div>
            </div><br>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" style="padding:10px !important;">
                            <div class="row">
                                <div class="col-sm-4 center-vertical">
                                    <h5 class="mb-sm-0 font-size-15">List Lowongan</h5>
                                </div>
                                <div class="col-sm-8">
                                    <div class="text-sm-end">
                                        <button type="button" class="btn btn-primary waves-effect waves-light me-2">Buat Postingan Pekerjaan</button>
                                    </div>
                                </div><!-- end col-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div>
                                        <div class="d-flex">
                                            <div class="flex-1">
                                                <p class="text-muted mb-2">
                                                    <a href="{{ route('detail_lowongan') }}"><h4 class="mb-sm-0 font-size-18">Data Analyst</h4></a>
                                                </p>
                                                <p class="text-muted">Sebagai Data Analis di perusahaan kami, Anda akan menjadi bagian penting dalam tim yang bertanggung jawab untuk mengumpulkan, menganalisis, dan menginterpretasi data untuk mendukung pengambilan keputusan bisnis.</p>
                                                <p class="text-muted">last update 15/11/2023</p>
                                                <p class="text-muted">Expired date 08/12/2023</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3">
                                    <div class="text-center">
                                        <p class="text-muted mb-2">
                                            <h4 class="mb-sm-0 font-size-18 text-center">Total Lamaran</h4>
                                        </p>
                                        <h1 class="mt-5">20</h1>
                                      
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3">
                                    <div>
                                        <ul class="list-inline float-sm-end mb-sm-0">
                                            <li class="list-inline-item">
                                                <button class="btn btn-soft-primary"><i class="mdi mdi-pencil font-size-18"></i></button>
                                            </li>
                                            <li class="list-inline-item">
                                            <button class="btn btn-soft-danger"><i class="mdi mdi-delete font-size-18"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div>
                                        <div class="d-flex">
                                            <div class="flex-1">
                                                <p class="text-muted mb-2">
                                                <a href="{{ route('detail_lowongan') }}"><h4 class="mb-sm-0 font-size-18">Data Analyst</h4></a>
                                                </p>
                                                <p class="text-muted">Sebagai Data Analis di perusahaan kami, Anda akan menjadi bagian penting dalam tim yang bertanggung jawab untuk mengumpulkan, menganalisis, dan menginterpretasi data untuk mendukung pengambilan keputusan bisnis.</p>
                                                <p class="text-muted">last update 15/11/2023</p>
                                                <p class="text-muted">Expired date 08/12/2023</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3">
                                    <div class="text-center">
                                        <p class="text-muted mb-2">
                                            <h4 class="mb-sm-0 font-size-18 text-center">Total Lamaran</h4>
                                        </p>
                                        <h1 class="mt-5">20</h1>
                                      
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3">
                                    <div>
                                        <ul class="list-inline float-sm-end mb-sm-0">
                                            <li class="list-inline-item">
                                                <button class="btn btn-soft-primary"><i class="mdi mdi-pencil font-size-18"></i></button>
                                            </li>
                                            <li class="list-inline-item">
                                            <button class="btn btn-soft-danger"><i class="mdi mdi-delete font-size-18"></i></button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

 @include('user/footer')
 