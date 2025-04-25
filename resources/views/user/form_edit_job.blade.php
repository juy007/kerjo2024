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
                    <h4 class="mb-sm-0 font-size-18">Edit Lowongan</h4>
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
                        <form method="POST" action="{{ route('save_update_job', $jobs['data']['_id']) }}" class="row" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-xl-4 col-md-4 ps-4">
                                <p class="text-muted mb-2">
                                <h4 class="mb-sm-0 font-size-18">Deskripsi Pekerjaan</h4>
                                </p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <div class="mb-3">
                                                <label for="form-lowongan" class="form-label">Nama Lowongan</label>
                                                <input class="form-control" type="text" value="{{ $jobs['data']['title'] }}" placeholder="Nama Lowongan" id="form_lowongan" name="lowongan">
                                            </div>
                                            <div class="mb-3">
                                                <label for="kategori" class="form-label font-size-13">Kategori</label>
                                                <select class="form-control" data-trigger name="kategori" id="kategori">
                                                    <option selected value="{{ $jobs['data']['subCategory']['category']['_id'] }}">{{ $jobs['data']['subCategory']['category']['name'] }}</option>
                                                    @foreach(collect($categories['list'])->sortBy('name') as $category)
                                                    <option value="{{ $category['_id'] }}">{{ $category['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="sub_kategori" class="form-label font-size-13">Sub Kategori</label>
                                                <select class="form-select" name="sub_kategori" id="sub_kategori">
                                                    <option selected value="{{ $jobs['data']['subCategory']['_id'] }}">{{ $jobs['data']['subCategory']['name'] }}</option>
                                                    @foreach($categoriesDetail['data']['subCategories'] as $subCategory)
                                                    <option value="{{ $subCategory['_id'] }}">{{ $subCategory['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>                                                  
                                                   
                                            <div class="mb-3">
                                                <label for="mata_uang" class="form-label font-size-13">Mata Uang</label>
                                                <select class="form-control" data-trigger name="mata_uang" id="mata_uang">
                                                <option selected value="{{ $jobs['data']['currency']['_id'] ?? '' }}">{{ $jobs['data']['currency']['name'] ?? 'Pilih Currency' }}</option>

                                                    @foreach($currencies['data']['list'] as $currencies)
                                                    <option value="{{ $currencies['_id'] }}">{{ $currencies['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="form-label" for="gaji_min">Gaji</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" oninput="formatCurrency(this)" id="gaji_min" name="gaji_min" value="{{ number_format($jobs['data']['salaryStart'], 0, ',', '.') }}" placeholder="Gaji Min">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" oninput="formatCurrency(this)" id="gaji_max" name="gaji_max" value="{{ number_format($jobs['data']['salaryEnd'], 0, ',', '.') }}" placeholder="Gaji Max">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form_provinsi" class="form-label font-size-13">Provinsi</label>
                                                <select class="form-control" data-trigger name="provinsi" id="form_provinsi">
                                                    <option selected value="{{ $jobs['data']['province']['_id'] ?? '' }}">{{ $jobs['data']['province']['name'] ?? 'Pilih Provinsi' }}</option>
                                                    @foreach($provinces['data']['list'] as $province)
                                                    <option value="{{ $province['_id'] }}">{{ $province['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form_kota" class="form-label font-size-13">Kota/Kabupaten</label>
                                                <select class="form-select" name="kota" id="form_kota">
                                                    @foreach($provinceDetail['data']['regencies'] as $regency)
                                                    <option value="{{ $regency['_id'] }}">{{ $regency['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form_tipe_pekerjaan" class="form-label font-size-13">Tipe Pekerjaan</label>
                                                <select class="form-control" data-trigger name="tipe_pekerjaan" id="form_tipe_pekerjaan">
                                                    <option selected value="{{ $jobs['data']['jobType']['_id'] ?? '' }}">{{ $jobs['data']['jobType']['name'] ?? 'Pilih Tipe Pekerjaan'}}</option>
                                                    @foreach($jobTypes['data']['list'] as $jobTypes)
                                                    <option value="{{ $jobTypes['_id'] }}">{{ $jobTypes['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form_tipe_status_karyawan" class="form-label font-size-13">Status Karyawan</label>
                                                <select class="form-control" data-trigger name="status_karyawan" id="form_tipe_status_karyawan">
                                                    <option selected value="{{ $jobs['data']['jobStatus']['_id'] ?? ''}}">{{ $jobs['data']['jobStatus']['name'] ?? 'Pilih Status Karyawan' }}</option>
                                                    @foreach($jobStatuses['data']['list'] as $jobStatuses)
                                                    <option value="{{ $jobStatuses['_id'] }}">{{ $jobStatuses['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="form-label" for="form_expired_start">Expired Date</label>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="date" value="{{ \Carbon\Carbon::parse($jobs['data']['startDate'])->format('Y-m-d') }}" name="date_start" id="form_expired_start">
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" type="date" value="{{ \Carbon\Carbon::parse($jobs['data']['endDate'])->format('Y-m-d') }}" name="date_end" id="form_expired_end">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form_posisi_level" class="form-label font-size-13">Posisi Level</label>
                                                <select class="form-control" data-trigger name="posisi_level" id="form_posisi_level">
                                                    <option selected value="{{ $jobs['data']['jobLevel']['_id'] ?? '' }}">{{ $jobs['data']['jobLevel']['name'] ?? 'Pilih Posisi Level' }}</option>
                                                    @foreach($jobLevels['data']['list'] as $jobLevels)
                                                    <option value="{{ $jobLevels['_id'] }}">{{ $jobLevels['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3" id="editor1">
                                                <label for="form_deskripsi_pekerjaan" class="form-label">Deskripsi Pekerjaan</label>
                                                <textarea class="form-control" name="deskripsi" id="form_deskripsi_pekerjaan" rows="5">{{ $jobs['data']['description'] }}</textarea>
                                            </div>
                                            <div class="mb-3" id="editor2">
                                                <label for="form_detail" class="form-label">Detail</label>
                                                <textarea class="form-control" name="detail" id="form_detail" rows="5">{{ $jobs['data']['detail'] }}</textarea>
                                            </div>
                                            <div class="mb-3" id="editor3">
                                                <label for="form_kualifikasi" class="form-label">Kualifikasi</label>
                                                <textarea class="form-control" name="kualifikasi" id="form_kualifikasi" rows="5">{{ $jobs['data']['qualification'] }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-_tatus" class="form-label font-size-13">Status</label>
                                                <select class="form-control" data-trigger name="status" id="form_status">
                                                    <option selected value="{{ $jobs['data']['status'] }}">{{ ucfirst($jobs['data']['status']) }}</option>
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
                                    <img class="img-fluid" style="max-width: 100%;" src="{{ asset('assets/images/logo/phone.png') }}" alt="">
                                    <div class="screen">
                                        <div class="containerx">
                                            <h5><i class="mdi mdi-arrow-left"></i> Deskripsi Pekerjaan</h5>
                                            <div class="divider"></div><br>
                                            <div class="job-header">

                                                <img alt="Company Logo" height="30" src="{{ url('proxy-image/logo/'. str_replace(['../public/upload/logo/', './public/upload/logo/'], '', $jobs['data']['company']['logo'] )) }}" width="50" />
                                                <div>
                                                    <div class="job-title">
                                                        {{ $jobs['data']['title'] }}
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
                                                        <div class="label">Lokasi</div>
                                                        {{ $jobs['data']['province']['name'] ?? '-' }}
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="label">Tipe Pekerjaan</div>
                                                        {{ $jobs['data']['jobType']['name'] ?? '-' }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-7">
                                                        <div class="label">Status Karyawan</div>
                                                        {{ $jobs['data']['jobStatus']['name'] ?? '-' }}
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="label">Posisi Level</div>
                                                        {{ $jobs['data']['jobLevel']['name'] ?? '-' }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="label">Kategori Pekerjaan</div>
                                                        {{ $jobs['data']['subCategory']['name'] ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="job-description">
                                                <div class="section-title">
                                                    Deskripsi Pekerjaan
                                                </div>
                                                {!! $jobs['data']['description'] !!}

                                            </div>
                                            <div class="job-description">
                                                <div class="section-title">Detail</div>
                                                <p id="job_detail">{!! $jobs['data']['detail'] !!}</p>
                                            </div>
                                            <div class="job-description">
                                                <div class="section-title">Kualifikasi</div>
                                                <p id="job_kualifikasi">{!! $jobs['data']['qualification'] !!}</p>
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
                                                    <img class="img-fluid" style="max-width:100%;" src="{{ asset('assets/images/logo/phone.png') }}" alt="">
                                                    <div class="screen1">
                                                        <div class="containerx">
                                                            <h5><i class="mdi mdi-arrow-left"></i> Deskripsi Pekerjaan</h5>
                                                            <div class="divider"></div><br>
                                                            <div class="job-header">

                                                                <img alt="Company Logo" height="30" src="{{ url('proxy-image/logo/'. str_replace(['../public/upload/logo/', './public/upload/logo/'], '', $jobs['data']['company']['logo'] )) }}" width="50" />
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
                                                                <div class="section-title">Detail</div>
                                                                <p id="job_detail_pre">
                                                                    Sebagai Data Analis di perusahaan kami, Anda akan menjadi bagian penting dalam tim yang bertanggung jawab untuk mengumpulkan, menganalisis, dan menginterpretasi data untuk mendukung pengambilan keputusan bisnis.
                                                                </p>
                                                            </div>
                                                            <div class="job-description">
                                                                <div class="section-title">Kualifikasi</div>
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

<!-- choices js -->
<script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
<script src="{{ asset('assets/js/previewPhone.js') }}"></script>
<script src="{{ asset('assets/js/formCurrency.js') }}"></script>
<script src="{{ asset('assets/js/dynamic-select.js') }}"></script>

</body>

</html>