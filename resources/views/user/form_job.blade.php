@include('user/header_start')
<!-- Select ====================================================================================== -->
<!-- choices css -->
<link href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/previewPhone.css') }}" rel="stylesheet" type="text/css" />

<!-- color picker css -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" /> <!-- 'classic' theme -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" /> <!-- 'monolith' theme -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" /> <!-- 'nano' theme -->
<!-- ckeditor -->
<script src="{{ asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

@include('user/header_end')

<div class="page-content" style="background-color:#F4F7FE !important;">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Tambah Lowongan Baru</h4>
                    <div class="page-title-right">

                    </div>
                </div>
            </div>
        </div><br>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('save_job') }}" class="row" enctype="multipart/form-data">@csrf
                            <div class="col-xl-4 col-md-4 ps-4">
                                <p class="text-muted mb-2">
                                <h4 class="mb-sm-0 font-size-18">Deskripsi Pekerjaan</h4>
                                </p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <div class="mb-3">
                                                <label for="form-lowongan" class="form-label">Nama Lowongan</label>
                                                <input class="form-control" type="text" value="" placeholder="Nama Lowongan" id="form-lowongan" name="lowongan">
                                            </div>
                                            <div class="mb-3">
                                                <label for="kategori" class="form-label font-size-13">Kategori</label>
                                                <select class="form-control" data-trigger name="kategori" id="kategori">
                                                    <option value="">Pilih Kategori</option>
                                                    @foreach($subCategories as $subCategories)
                                                    <option value="{{ $subCategories['_id'] }}">{{ $subCategories['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="mata-uang" class="form-label font-size-13">Mata Uang</label>
                                                <select class="form-control" data-trigger name="mata_uang" id="mata-uang">
                                                    <option value="">Pilih Mata Uang</option>
                                                    @foreach($currencies as $currencies)
                                                    <option value="{{ $currencies['_id'] }}">{{ $currencies['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="form-label" for="gaji-min">Gaji</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" oninput="formatCurrency(this)" id="gaji-min" name="gaji_min" placeholder="Gaji Min">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" oninput="formatCurrency(this)" id="gaji-max" name="gaji_max" placeholder="Gaji Max">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-lokasi" class="form-label font-size-13">Lokasi</label>
                                                <select class="form-control" data-trigger name="lokasi" id="form-lokasi">
                                                    <option value="">Pilih Lokasi</option>
                                                    @foreach($provinces as $province)
                                                    <option value="{{ $province['_id'] }}">{{ $province['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-tipe-pekerjaan" class="form-label font-size-13">Tipe Pekerjaan</label>
                                                <select class="form-control" data-trigger name="tipe_pekerjaan" id="form-tipe-pekerjaan">
                                                    <option value="">Pilih Tipe Pekerjaan</option>
                                                    @foreach($jobTypes as $jobTypes)
                                                    <option value="{{ $jobTypes['_id'] }}">{{ $jobTypes['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-tipe-status-karyawan" class="form-label font-size-13">Status Karyawan</label>
                                                <select class="form-control" data-trigger name="status_karyawan" id="form-tipe-status-karyawan">
                                                    <option value="">Pilih Status Karyawan</option>
                                                    @foreach($jobStatuses as $jobStatuses)
                                                    <option value="{{ $jobStatuses['_id'] }}">{{ $jobStatuses['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="form-label" for="formrow-email-input1">Expired Date</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="date" value="" name="date_start" id="form-expired-start">
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="date" value="" name="date_end" id="form-expired-end">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-posisi-level" class="form-label font-size-13">Posisi Level</label>
                                                <select class="form-control" data-trigger name="posisi_level" id="form-posisi-level">
                                                    <option value="">Pilih Posisi Level</option>
                                                    @foreach($jobLevels as $jobLevels)
                                                    <option value="{{ $jobLevels['_id'] }}">{{ $jobLevels['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3" id="editor1">
                                                <label for="form-deskripsi-pekerjaan" class="form-label">Deskripsi Pekerjaan</label>
                                                <textarea class="form-control" name="deskripsi" id="form-deskripsi-pekerjaan" rows="5"></textarea>
                                            </div>
                                            <div class="mb-3" id="editor2">
                                                <label for="form-detail" class="form-label">Detail</label>
                                                <textarea class="form-control" name="detail" id="form-detail" rows="5"></textarea>
                                            </div>
                                            <div class="mb-3" id="editor3">
                                                <label for="form-kualifikasi" class="form-label">Kualifikasi</label>
                                                <textarea class="form-control" name="kualifikasi" id="form-kualifikasi" rows="5"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-status" class="form-label font-size-13">Status</label>
                                                <select class="form-control" data-trigger name="status" id="form-status">
                                                    <option value="">Pilih Status</option>
                                                    <option value="publish">Publish</option>
                                                    <option value="draft">Draft</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-8 col-md-8">
                                <div class="phonePreview">
                                    <img class="img-fluid" style="max-width:100%;" src="{{ url('proxy-image/src/phone.png') }}" alt="">
                                    <div class="screen">
                                        <div class="containerx">
                                            <h5><i class="mdi mdi-arrow-left"></i> Deskripsi Pekerjaan</h5>
                                            <div class="divider"></div><br>
                                            <div class="job-header">

                                                <img alt="Company Logo" height="30" src="{{ url('proxy-image/src/fav.png') }}" width="50" />
                                                <div>
                                                    <div class="job-title">
                                                        Data Analyst
                                                    </div>
                                                    <div class="job-company">
                                                        <?php echo session('company_name'); ?>
                                                    </div>
                                                </div>
                                                <div class="job-posted">
                                                    Posting 2 hari lalu
                                                </div>
                                            </div>
                                            <div class="job-details">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <div class="label">
                                                            Lokasi
                                                        </div>
                                                        Sudirman, Jakarta Selatan
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="label">
                                                            Tipe Pekerjaan
                                                        </div>
                                                        Full time
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-7">
                                                        <div class="label">
                                                            Status Karyawan
                                                        </div>
                                                        Karyawan Tetap
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="label">
                                                            Posisi Level
                                                        </div>
                                                        Staff
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="label">
                                                            Kategori Pekerjaan
                                                        </div>
                                                        IT Komputer - Software
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="job-description">
                                                <div class="section-title">
                                                    Deskripsi Pekerjaan
                                                </div>
                                                <p>
                                                    Sebagai Data Analis di perusahaan kami, Anda akan menjadi bagian penting dalam tim yang bertanggung jawab untuk mengumpulkan, menganalisis, dan menginterpretasi data untuk mendukung pengambilan keputusan bisnis.
                                                </p>
                                                <div class="section-title">
                                                    Tanggung Jawab Utama
                                                </div>
                                                <ul>
                                                    <li>
                                                        <strong>
                                                            Pengumpulan Data:
                                                        </strong>
                                                        Mengumpulkan data dari berbagai sumber internal dan eksternal, termasuk basis data, spreadsheet, dan sumber data lainnya.
                                                    </li>
                                                    <li>
                                                        <strong>
                                                            Pembersihan dan Preprocessing Data:
                                                        </strong>
                                                        Membersihkan dan memproses data mentah untuk memastikan kualitas dan konsistensi data yang baik.
                                                    </li>
                                                    <li>
                                                        <strong>
                                                            Analisis Data:
                                                        </strong>
                                                        Menganalisis data untuk mengidentifikasi tren, pola, dan wawasan yang dapat digunakan untuk mendukung keputusan bisnis.
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12">
                                <div class="mt-4 text-end">
                                    <a href="{{ route('index_job') }}" class="btn btn-outline-primary w-md">Cancel</a>
                                    <button type="button" class="btn btn-primary w-md" id="preview" onclick="previewPhone();">Submit</button>
                                </div>
                                <div class="modal fade modal-preview" id="modal-preview" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myExtraLargeModalLabel">Preview</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="phonePreview2">
                                                    <img class="img-fluid" style="max-width:100%;" src="{{ url('proxy-image/src/phone.png') }}" alt="">
                                                    <div class="screen1">
                                                        <div class="containerx">
                                                            <h5><i class="mdi mdi-arrow-left"></i> Deskripsi Pekerjaan</h5>
                                                            <div class="divider"></div><br>
                                                            <div class="job-header">

                                                                <img alt="Company Logo" height="30" src="{{ url('proxy-image/logo/'. str_replace('public/upload/logo/', '', session('company_logo') )) }}" width="50" />
                                                                <div>
                                                                    <div id="job_title_pre" class="job-title">
                                                                        Data Analyst
                                                                    </div>
                                                                    <div class="job-company">
                                                                        <?php echo session('company_name'); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="job-posted">
                                                                    Posting Baru
                                                                </div>
                                                            </div>
                                                            <div class="job-details">
                                                                <div class="row">
                                                                    <div class="col-7">
                                                                        <div class="label">
                                                                            Lokasi
                                                                        </div>
                                                                        <span id="lokasi_pre">Sudirman, Jakarta Selatan</span>
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <div class="label">
                                                                            Tipe Pekerjaan
                                                                        </div>
                                                                        <span id="tipe_pekerjaan_pre">Full time</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-7">
                                                                        <div class="label">
                                                                            Status Karyawan
                                                                        </div>
                                                                        <span id="status_karyawan_pre">Karyawan Tetap</span>
                                                                    </div>
                                                                    <div class="col-5">
                                                                        <div class="label">
                                                                            Posisi Level
                                                                        </div>
                                                                        <span id="posisi_level_pre">Staff</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-8">
                                                                        <div class="label">
                                                                            Kategori Pekerjaan
                                                                        </div>
                                                                        <span id="kategori_pekerjaan_pre">IT Komputer - Software</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="job-description">
                                                                <div class="section-title">
                                                                    Deskripsi Pekerjaan
                                                                </div>
                                                                <p id="job_description_pre">
                                                                    Sebagai Data Analis di perusahaan kami, Anda akan menjadi bagian penting dalam tim yang bertanggung jawab untuk mengumpulkan, menganalisis, dan menginterpretasi data untuk mendukung pengambilan keputusan bisnis.
                                                                </p>

                                                            </div>
                                                            <div class="job-description">
                                                                <div class="section-title">
                                                                    Detail
                                                                </div>
                                                                <p id="job_detail_pre">
                                                                    Sebagai Data Analis di perusahaan kami, Anda akan menjadi bagian penting dalam tim yang bertanggung jawab untuk mengumpulkan, menganalisis, dan menginterpretasi data untuk mendukung pengambilan keputusan bisnis.
                                                                </p>
                                                            </div>
                                                            <div class="job-description">
                                                                <div class="section-title">
                                                                    Kualifikasi
                                                                </div>
                                                                <p id="job_kualifikasi_pre">
                                                                    Sebagai Data Analis di perusahaan kami, Anda akan menjadi bagian penting dalam tim yang bertanggung jawab untuk mengumpulkan, menganalisis, dan menginterpretasi data untuk mendukung pengambilan keputusan bisnis.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-primary w-md" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@include('user/footer')
<script src="{{ asset('assets/js/formCurrency.js') }}"></script>
<!-- Select ============================================================================ -->
<!-- choices js -->
<script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
<script src="{{ asset('assets/js/previewPhone.js') }}"></script>

<!--<br data-cke-filler="true">-->
</body>

</html>