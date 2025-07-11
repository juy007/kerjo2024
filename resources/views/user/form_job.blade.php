@include('user/header_start')
<meta name="route-categories-detail-json" content="{{ route('categories_detail_json') }}">
<meta name="route-provinces-detail-json" content="{{ route('provinces_detail_json') }}">

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
                                                <label for="form_lowongan" class="form-label">Nama Lowongan</label>
                                                <input class="form-control" type="text" value="" placeholder="Nama Lowongan" id="form_lowongan" name="lowongan">
                                            </div>
                                            <div class="mb-3">
                                                <label for="kategori" class="form-label font-size-13">Kategori</label>
                                                <select class="form-control" data-trigger name="kategori" id="kategori">
                                                    <option selected value="">Pilih Kategori</option>
                                                    @foreach(collect($categories['list'])->sortBy('name') as $category)
                                                    <option value="{{ $category['_id'] }}">{{ $category['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="sub_kategori" class="form-label font-size-13">Sub Kategori</label>
                                                <select class="form-select" name="sub_kategori" id="sub_kategori">
                                                    <option selected value="">Pilih Sub Kategori</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="mata-uang" class="form-label font-size-13">Mata Uang</label>
                                                <select class="form-control" data-trigger name="mata_uang" id="mata-uang">
                                                    <option value="">Pilih Mata Uang</option>
                                                    @foreach($currencies['list'] as $currencies)
                                                    <option value="{{ $currencies['_id'] }}">({{ $currencies['symbol'] }}){{ $currencies['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="form-label" for="gaji-min">Gaji</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" oninput="formatCurrency(this)" id="gaji_min" name="gaji_min" placeholder="Gaji Min">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" oninput="formatCurrency(this)" id="gaji_max" name="gaji_max" placeholder="Gaji Max">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="form_status" class="form-label font-size-13">Frekuensi Pembayaran</label>
                                                <select class="form-control" data-trigger name="frekuensi_pembayaran" id="form_frekuensi_pembayaran">
                                                    <option selected value="">Pilih Frekuensi Pembayaran</option>
                                                    <option value="jam">Jam</option>
                                                    <option value="hari">Hari</option>
                                                    <option value="bulan">Bulan</option>
                                                    <option value="tahun">Tahun</option>
                                                    <option value="proyek">Proyek</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="form_provinsi" class="form-label font-size-13">Provinsi</label>
                                                <select class="form-control" data-trigger name="provinsi" id="form_provinsi">
                                                    <option value="">Pilih Lokasi</option>
                                                    @foreach($provinces['list'] as $province)
                                                    <option value="{{ $province['_id'] }}">{{ $province['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form_kota" class="form-label font-size-13">Kota/Kabupaten</label>
                                                <select class="form-select" name="kota" id="form_kota">
                                                    <option value="">Pilih Kota/Kabupaten</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form_tipe-pekerjaan" class="form-label font-size-13">Tipe Pekerjaan</label>
                                                <select class="form-control" data-trigger name="tipe_pekerjaan" id="form_tipe_pekerjaan">
                                                    <option value="">Pilih Tipe Pekerjaan</option>
                                                    @foreach($jobTypes['list'] as $jobTypes)
                                                    <option value="{{ $jobTypes['_id'] }}">{{ $jobTypes['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form_tipe-status-karyawan" class="form-label font-size-13">Status Karyawan</label>
                                                <select class="form-control" data-trigger name="status_karyawan" id="form_tipe_status_karyawan">
                                                    <option value="">Pilih Status Karyawan</option>
                                                    @foreach($jobStatuses['list'] as $jobStatuses)
                                                    <option value="{{ $jobStatuses['_id'] }}">{{ $jobStatuses['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="form-label" for="formrow-email-input1">Expired Date</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="date" value="" name="date_start" id="form_expired_start">
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="date" value="" name="date_end" id="form_expired_end">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form_posisi-level" class="form-label font-size-13">Posisi Level</label>
                                                <select class="form-control" data-trigger name="posisi_level" id="form_posisi_level">
                                                    <option value="">Pilih Posisi Level</option>
                                                    @foreach($jobLevels['list'] as $jobLevels)
                                                    <option value="{{ $jobLevels['_id'] }}">{{ $jobLevels['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3" id="editor1">
                                                <label for="form_deskripsi-pekerjaan" class="form-label">Deskripsi Pekerjaan</label>
                                                <textarea class="form-control" name="deskripsi" id="form_deskripsi_pekerjaan" rows="5"></textarea>
                                            </div>
                                            <div class="mb-3" id="editor2">
                                                <label for="form_detail" class="form-label">Detail</label>
                                                <textarea class="form-control" name="detail" id="form_detail" rows="5"></textarea>
                                            </div>
                                            <div class="mb-3" id="editor3">
                                                <label for="form_kualifikasi" class="form-label">Kualifikasi</label>
                                                <textarea class="form-control" name="kualifikasi" id="form_kualifikasi" rows="5"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form_status" class="form-label font-size-13">Status</label>
                                                <select class="form-control" data-trigger name="status" id="form_status">
                                                    <option selected value="">Pilih Status</option>
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
                                                    Posting 2 hari
                                                    <h5><span class="badge bg-primary">publish</span></h5>
                                                </div>
                                            </div>
                                            <div class="job-details">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="label">
                                                            Lokasi
                                                        </div>
                                                        Sudirman, Jakarta Selatan
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="label">
                                                            Tipe Pekerjaan
                                                        </div>
                                                        Full time
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="label">
                                                            Status Karyawan
                                                        </div>
                                                        Karyawan Tetap
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="label">
                                                            Posisi Level
                                                        </div>
                                                        Staff
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="label">
                                                            Kategori Pekerjaan
                                                        </div>
                                                        IT Komputer - Software
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="label">
                                                            Gaji
                                                        </div>
                                                        Rp 5 Jt - 12 Jt/Bulan
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

                                                                <img alt="Company Logo" height="30" src="{{ url('proxy-image/logo/'. str_replace(['../public/upload/logo/', './public/upload/avatar/'], '', session('company_logo') )) }}" width="50" />
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
                                                                    <h5><span id="status_pre" class="badge bg-primary"></span></h5>
                                                                </div>
                                                            </div>
                                                            <div class="job-details">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="label">
                                                                            Lokasi
                                                                        </div>
                                                                        <span id="lokasi_pre">Sudirman, Jakarta Selatan</span>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="label">
                                                                            Tipe Pekerjaan
                                                                        </div>
                                                                        <span id="tipe_pekerjaan_pre">Full time</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="label">
                                                                            Status Karyawan
                                                                        </div>
                                                                        <span id="status_karyawan_pre">Karyawan Tetap</span>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="label">
                                                                            Posisi Level
                                                                        </div>
                                                                        <span id="posisi_level_pre">Staff</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="label">
                                                                            Kategori Pekerjaan
                                                                        </div>
                                                                        <span id="kategori_pekerjaan_pre">IT Komputer - Software</span>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="label">
                                                                            Gaji
                                                                        </div>
                                                                       <span id="gaji_pre"></span>
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
<script src="{{ asset('assets/js/prePhone.js') }}"></script>
<script src="{{ asset('assets/js/dynamic-select2.js') }}"></script>
</body>

</html>