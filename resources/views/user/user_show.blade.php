@include('user/header_start')
<link href="{{ asset('assets/css/customUser.css') }}" rel="stylesheet" type="text/css" />
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
                                <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-end mt-0 mt-sm-0 px-3 px-sm-4">

                                    <!-- Avatar wrapper -->
                                    <div class="mb-3 mb-sm-0 me-sm-4">
                                        <div class="avatar-wrapper mx-auto mx-sm-0">
                                            <img src="{{ url('proxy-image/avatar/' . str_replace(['../public/upload/avatar/','./public/upload/avatar/','public/upload/avatar/'], '', $userData['avatar'])) }}"
                                                alt="avatar"
                                                class="img-fluid profile-avatar">
                                        </div>
                                    </div>

                                    <!-- Info -->
                                    <div class="profile-info text-center text-sm-start">
                                        <h5 class="font-size-16 mb-1">{{ $userData['name'] }}</h5>
                                        <div class="text-muted font-size-13">
                                            <div><i class="mdi mdi-email-outline"></i> {{ $userData['email'] }}</div>
                                            <div><i class="mdi mdi-phone-outline"></i> {{ $userData['phone'] ?? '-' }}</div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-auto">
                                <!-- Optional button -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row me-2 ms-2 mb-4 mt-3">
                    <div class="col-xl-2 col-md-2 pt-3">
                        <div>
                            <h4 class="mb-sm-0 font-size-18 mt-3">Informasi Detail :</h4>
                            <h4 class="mb-sm-0 font-size-18 mt-3">Jabatan</h4>
                            <p class="text-muted font-size-16">{{ $userData['title'] }}</p>
                            <h4 class="mb-sm-0 font-size-18 mt-4">CV</h4>
                            <p class="text-muted font-size-16">
                                @if (!empty($userData['cvs']) && isset($userData['cvs'][0]['link']))
                                <a href="{{ url('proxy-cv/' . str_replace(['../public/upload/cv/', './public/upload/cv/', 'public/upload/cv/'], '', $userData['cvs'][0]['link'])) }}" class="" target="_blank">
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

                            <h4 class="mb-sm-0 font-size-18 mt-4">Lokasi</h4>
                            <p class="text-muted font-size-16">{{ $provinces }}</p>
                        </div>
                    </div>
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