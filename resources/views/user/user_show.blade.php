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
                            <li class="breadcrumb-item active">User</li>
                            <li class="breadcrumb-item">Detail User</li>
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
                                            <img src="{{ url('proxy-image/avatar/'. str_replace('../public/upload/avatar/', '', $userData['avatar'] )) }}" alt="" class="img-fluid rounded">
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <h5 class="font-size-16 mb-1">{{ $userData['name'] }}</h5>
                                        <span class="text-muted font-size-13 mb-2 pb-2 pe-3"><i class="mdi mdi-email-outline"></i> {{ $userData['email'] }}</span>

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
                            <p class="text-muted font-size-16">
                                @if (!empty($userData['cvs']) && isset($userData['cvs'][0]['link']))
                                <a href="{{ url('proxy-cv/' . str_replace('../public/upload/cv/', '', $userData['cvs'][0]['link'])) }}" class="" target="_blank">
                                    Download
                                </a>
                                @else
                                <button class="btn btn-sm btn-secondary" disabled>CV Tidak Tersedia</button>
                                @endif

                            </p>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-2 pt-lg-5">
                        <div><!--
                            <h4 class="mb-sm-0 font-size-18 mt-4">Pengalaman Kerja</h4>
                            <p class="text-muted font-size-16">4 Tahun</p>
                            <h4 class="mb-sm-0 font-size-18 mt-4">Bahasa Inggris</h4>
                            <p class="text-muted font-size-16">Fasih</p>-->
                            <h4 class="mb-sm-0 font-size-18 mt-4">Status</h4>
                            <p class="text-muted font-size-16"></p>
                            <h4 class="mb-sm-0 font-size-18 mt-4">Lokasi</h4>
                            <p class="text-muted font-size-16">Jakarta</p>
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
                                @foreach($userData['experiences'] AS $exp)
                                <div class="col-md-12 timeline-C ps-4 pb-4">
                                    <div class="timelineRounded"></div>
                                    <div class="timeline-D">
                                        <h4 class="font-size-18">{{ $exp['name'] }}</h4>
                                        <h4 class="mt-3 font-size-17">{{ $exp['position'] }} </h4>
                                        <p class="text-mute font-size-15">{{ $exp['startYear'] }} - {{ $exp['endYear'] }}</p>
                                        <p class="text-mute font-size-15 timeline-text-justify">{{ $exp['description'] }}</p>
                                    </div>
                                </div>
                                @endforeach
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