@include('user/header_start')
@include('user/header_end')
<style>
    .profile-user {
        height: 50px !important;
    }
</style>
<div class="page-content" style="background-color:#F4F7FE !important;">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <div class="page-title-left">
                        <ol class="breadcrumb font-size-18">
                            <li class="breadcrumb-item active">Detail</li>
                            <li class="breadcrumb-item">Detail Pelamar</li>
                        </ol>
                    </div>
                    <h4 class="mb-sm-0 font-size-18"></h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="card">
                <div class="col-12">
                    <div class="col-xl-12">
                        <div class="profile-user" style="height: 20px;"></div>
                    </div>
                    <div class="profile-content">
                        <div class="row align-items-end">
                            <div class="col-sm">
                                <div class="d-flex align-items-end mt-0 mt-sm-0" style="padding-left: 20px;">
                                    <div class="col-lg-2">
                                        <div class="me-3">
                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="" class="img-fluid rounded">
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <h5 class="font-size-16 mb-1">Niko Hendra</h5>
                                        <span class="text-muted font-size-13 mb-2 pb-2 pe-3"><i class="mdi mdi-email-outline"></i> niko@gmail.com</span><span class="text-muted font-size-13 mb-2 pb-2"><i class="mdi mdi-phone"></i>0813773917265</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-auto">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row me-2 ms-2 mb-4 mt-3">
                    <div class="col-xl-2 col-md-2 pt-3">
                        <div>
                            <h4 class="mb-sm-0 font-size-18 mt-3">Informasi Detail :</h4>
                            <h4 class="mb-sm-0 font-size-18 mt-3">Jabatan</h4>
                            <p class="text-muted font-size-16">Data Analyst</p>
                            <h4 class="mb-sm-0 font-size-18 mt-4">CV</h4>
                            <p class="text-muted font-size-16"><a href="#">Download</a></p>
                            <h4 class="mb-sm-0 font-size-18 mt-4">Lokasi</h4>
                            <p class="text-muted font-size-16">Jakarta, Indonesia</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-2 pt-lg-5">
                        <div>
                            <h4 class="mb-sm-0 font-size-18 mt-4">Pengalaman Kerja</h4>
                            <p class="text-muted font-size-16">4 Tahun</p>
                            <h4 class="mb-sm-0 font-size-18 mt-4">Bahasa Inggris</h4>
                            <p class="text-muted font-size-16">Fasih</p>
                            <h4 class="mb-sm-0 font-size-18 mt-4">Status</h4>
                            <p class="text-muted font-size-16">Menunggu Konfirmasi</p>
                        </div>
                    </div>
                    <style>
                        .timeline-A {
                            padding-left: 15px;
                            height: 100%;
                        }

                        .timeline-B {
                            border-left: 3px solid #1B8CDD;
                            height: 100%;
                        }

                        .timeline-C {}

                        .timelineRounded {
                            background-color: #1B8CDD;
                            border-radius: 100%;
                            margin-top: -10px;
                            margin-left: -49px;
                            height: 47px;
                            width: 47px;
                        }

                        .timeline-D {
                            margin-top: -35px;
                        }

                        .timeline-text-justify {
                            text-align: justify;
                        }
                    </style>
                    <div class="col-xl-8 col-md-8 pt-3">
                        <div class="col-md-12 timeline-A">
                            <div class="timeline-B">
                                <div class="col-md-12 timeline-C ps-4 pb-4">
                                    <div class="timelineRounded"></div>
                                    <div class="timeline-D">
                                        <h4>PT. IT Digital Solution</h4>
                                        <h4 class="mt-3">Senior Data Analyst </h4>
                                        <p class="text-mute font-size-18">Agustus 2023 - Sekarang</p>
                                        <p class="text-mute font-size-18 timeline-text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                    </div>
                                </div>
                                <div class="col-md-12 timeline-C ps-4 pb-4">
                                    <div class="timelineRounded"></div>
                                    <div class="timeline-D">
                                        <h4>PT. IT Digital Solution</h4>
                                        <h4 class="mt-3">Senior Data Analyst </h4>
                                        <p class="text-mute font-size-18">Agustus 2023 - Sekarang</p>
                                        <p class="text-mute font-size-18 timeline-text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@include('user/footer')
</body>

</html>