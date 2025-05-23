@include('account/header_start')
<link rel="stylesheet" href="{{ asset('assets/css/formCam.css') }}" />
<!-- Select ====================================================================================== -->
<!-- choices css -->
<link href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />

<!-- color picker css -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" /> <!-- 'classic' theme -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" /> <!-- 'monolith' theme -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" /> <!-- 'nano' theme -->

@include('account/header_end')
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
                        <div class="col-lg-8">
                            <div>
                                <form method="POST" action="{{ route('submit_company_profile_step2') }}" enctype="multipart/form-data">@csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="nama_perusahaan">Nama Perusahaan</label>
                                                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama Perusahaan" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="nama_brand">Nama Brand</label>
                                                <input type="text" class="form-control" id="nama_brand" name="nama_brand" placeholder="Nama Brand" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="tanggal_berdiri_perusahaan">Tanggal Berdiri Perusahaan</label>
                                                <input type="date" class="form-control" id="tanggal_berdiri_perusahaan" name="tanggal_berdiri_perusahaan" placeholder="01/01/2000" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="lokasi_perusahaan">Lokasi Perusahaan</label>
                                                <select class="form-control" data-trigger name="lokasi_perusahaan" id="lokasi_perusahaan" required>
                                                    <option value="">Lokasi Perusahaan</option>
                                                    @foreach($provinces['list'] as $province)
                                                    <option value="{{ $province['_id'] }}">{{ $province['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="tentang_perusahaan">Tentang Perusahaan</label>
                                                <textarea class="form-control" id="tentang_perusahaan" name="tentang_perusahaan" rows="5" placeholder="Deskripsi tentang perusahaan" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-2 pt-4">
                                                    <img src="{{ asset('assets/icon/iupload.png') }}" class="avatar-md rounded-circle" alt="img" />
                                                </div>
                                                <div class="col-10 pt-4">
                                                    Upload logo perusahaan<br>
                                                    <style>
                                                        .custom-file-upload {
                                                            display: inline-block;
                                                            padding: 6px 12px;
                                                            cursor: pointer;
                                                            background-color: #FFF;
                                                            color: #1C84EE;
                                                            border: 1px solid #1C84EE;
                                                            border-radius: 15px;
                                                            width: 90px;
                                                            height: 30px;
                                                            text-align: center;
                                                            font-weight: bold;
                                                        }

                                                        #logo-perusahaan {
                                                            display: none;
                                                        }
                                                    </style>

                                                    <label class="custom-file-upload">
                                                        Upload
                                                        <input id="logo-perusahaan" type="file" name="logo_perusahaan" accept=".jpeg, .jpg, .png" required />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <!-- Tombol untuk membuka kamera -->
                                            <p class="text-mute">Photo profile perusahaan</p>
                                            <div class="hstack gap-3">
                                                <div class="">
                                                    <button type="button" id="openCamera" class="btn btn-outline-primary font-size-20"><i class="mdi mdi-camera"></i></button>
                                                    <button type="button" id="closeCamera" style="display:none;" class="btn btn-outline-danger font-size-20"><i class="mdi mdi-camera"></i></button>
                                                </div>
                                                <div class="pt-2">
                                                    <label class="btn btn-outline-primary font-size-20">
                                                        <i class="bx bx-plus-medical"></i>
                                                        <input type="file" id="fileInput" name="gallery[]" accept=".jpeg, .jpg, .png" multiple required>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Video Preview dari Kamera -->
                                            <video id="video" width="320" height="240" autoplay></video>
                                            <button type="button" id="snap" style="display:none;" class="btn btn-outline-primary"><i class="mdi mdi-camera"></i> Take</button>

                                            <!-- Gambar Preview -->
                                            <div id="previewContainer"></div>

                                        </div>
                                    </div>
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="mt-4 text-center">
                                        <a href="#" class="btn btn-outline-primary w-md">Kembali</a>
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@include('account/footer_start')
<!-- Select ============================================================================ -->
<!-- choices js -->
<script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

<!-- choices js -->
<script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<!-- color picker js -->
<script src="{{ asset('assets/libs/@simonwep/pickr/pickr.min.js') }}"></script>
<script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

<!-- datepicker js -->
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

<!-- init js -->
<script src="{{ asset('assets/js/pages/form-advanced.init.js') }}"></script>
<script src="{{ asset('assets/js/formCam.js') }}"></script>
@include('account/footer_end')