@include('user/header_start')
        <!-- Select ====================================================================================== -->
        <!-- choices css -->
        <link href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- color picker css -->
        <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" /> <!-- 'classic' theme -->
        <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" /> <!-- 'monolith' theme -->
        <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" /> <!-- 'nano' theme -->
        <!-- ckeditor -->
        <script src="{{ asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.jss') }}"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

        <!-- init js -->

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
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4 col-md-4 ps-4">
                                <p class="text-muted mb-2">
                                <h4 class="mb-sm-0 font-size-18">Deskripsi Pekerjaan</h4>
                                </p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <div class="mb-3">
                                                <label for="form-lowongan" class="form-label">Nama Lowongan</label>
                                                <input class="form-control" type="text" value="" placeholder="Nama Lowongan" id="form-lowongan">
                                            </div>
                                            <div class="row">
                                                <label class="form-label" for="formrow-email-input1">Gaji</label>
                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-text">Rp.</div>
                                                        <input type="text" class="form-control" oninput="formatCurrency(this)" id="formrow-email-input1" placeholder="Gaji Min">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-text">Rp.</div>
                                                        <input type="text" class="form-control" oninput="formatCurrency(this)" id="formrow-password-input2" placeholder="Gaji Max">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-lokasi" class="form-label font-size-13">Lokasi</label>
                                                <select class="form-control" data-trigger name="choices-single-groups" id="form-lokasi">
                                                    <option value="">Pilih Lokasi</option>
                                                    <option value="Ambon, Maluku">Ambon, Maluku</option>
                                                    <option value="Balikpapan, Kalimantan Timur">Balikpapan, Kalimantan Timur</option>
                                                    <option value="Banda Aceh, Aceh">Banda Aceh, Aceh</option>
                                                    <option value="Bandar Lampung, Lampung">Bandar Lampung, Lampung</option>
                                                    <option value="Bandung, Jawa Barat">Bandung, Jawa Barat</option>
                                                    <option value="Banjar, Jawa Barat">Banjar, Jawa Barat</option>
                                                    <option value="Banjarmasin, Kalimantan Selatan">Banjarmasin, Kalimantan Selatan</option>
                                                    <option value="Batam, Kepulauan Riau">Batam, Kepulauan Riau</option>
                                                    <option value="Batu, Jawa Timur">Batu, Jawa Timur</option>
                                                    <option value="Bau-Bau, Sulawesi Tenggara">Bau-Bau, Sulawesi Tenggara</option>
                                                    <option value="Bekasi, Jawa Barat">Bekasi, Jawa Barat</option>
                                                    <option value="Bengkulu, Bengkulu">Bengkulu, Bengkulu</option>
                                                    <option value="Bima, Nusa Tenggara Barat">Bima, Nusa Tenggara Barat</option>
                                                    <option value="Binjai, Sumatera Utara">Binjai, Sumatera Utara</option>
                                                    <option value="Bitung, Sulawesi Utara">Bitung, Sulawesi Utara</option>
                                                    <option value="Blitar, Jawa Timur">Blitar, Jawa Timur</option>
                                                    <option value="Bogor, Jawa Barat">Bogor, Jawa Barat</option>
                                                    <option value="Bontang, Kalimantan Timur">Bontang, Kalimantan Timur</option>
                                                    <option value="Bukittinggi, Sumatera Barat">Bukittinggi, Sumatera Barat</option>
                                                    <option value="Cilegon, Banten">Cilegon, Banten</option>
                                                    <option value="Cimahi, Jawa Barat">Cimahi, Jawa Barat</option>
                                                    <option value="Cirebon, Jawa Barat">Cirebon, Jawa Barat</option>
                                                    <option value="Denpasar, Bali">Denpasar, Bali</option>
                                                    <option value="Depok, Jawa Barat">Depok, Jawa Barat</option>
                                                    <option value="Dumai, Riau">Dumai, Riau</option>
                                                    <option value="Gorontalo, Gorontalo">Gorontalo, Gorontalo</option>
                                                    <option value="Gunungsitoli, Sumatera Utara">Gunungsitoli, Sumatera Utara</option>
                                                    <option value="Jambi, Jambi">Jambi, Jambi</option>
                                                    <option value="Jayapura, Papua">Jayapura, Papua</option>
                                                    <option value="Kediri, Jawa Timur">Kediri, Jawa Timur</option>
                                                    <option value="Kendari, Sulawesi Tenggara">Kendari, Sulawesi Tenggara</option>
                                                    <option value="Kotamobagu, Sulawesi Utara">Kotamobagu, Sulawesi Utara</option>
                                                    <option value="Kupang, Nusa Tenggara Timur">Kupang, Nusa Tenggara Timur</option>
                                                    <option value="Langsa, Aceh">Langsa, Aceh</option>
                                                    <option value="Lhokseumawe, Aceh">Lhokseumawe, Aceh</option>
                                                    <option value="Lubuklinggau, Sumatera Selatan">Lubuklinggau, Sumatera Selatan</option>
                                                    <option value="Madiun, Jawa Timur">Madiun, Jawa Timur</option>
                                                    <option value="Magelang, Jawa Tengah">Magelang, Jawa Tengah</option>
                                                    <option value="Makassar, Sulawesi Selatan">Makassar, Sulawesi Selatan</option>
                                                    <option value="Malang, Jawa Timur">Malang, Jawa Timur</option>
                                                    <option value="Manado, Sulawesi Utara">Manado, Sulawesi Utara</option>
                                                    <option value="Mataram, Nusa Tenggara Barat">Mataram, Nusa Tenggara Barat</option>
                                                    <option value="Medan, Sumatera Utara">Medan, Sumatera Utara</option>
                                                    <option value="Metro, Lampung">Metro, Lampung</option>
                                                    <option value="Mojokerto, Jawa Timur">Mojokerto, Jawa Timur</option>
                                                    <option value="Padang, Sumatera Barat">Padang, Sumatera Barat</option>
                                                    <option value="Padangpanjang, Sumatera Barat">Padangpanjang, Sumatera Barat</option>
                                                    <option value="Padangsidempuan, Sumatera Utara">Padangsidempuan, Sumatera Utara</option>
                                                    <option value="Pagar Alam, Sumatera Selatan">Pagar Alam, Sumatera Selatan</option>
                                                    <option value="Palangkaraya, Kalimantan Tengah">Palangkaraya, Kalimantan Tengah</option>
                                                    <option value="Palembang, Sumatera Selatan">Palembang, Sumatera Selatan</option>
                                                    <option value="Palopo, Sulawesi Selatan">Palopo, Sulawesi Selatan</option>
                                                    <option value="Palu, Sulawesi Tengah">Palu, Sulawesi Tengah</option>
                                                    <option value="Pangkalpinang, Kepulauan Bangka Belitung">Pangkalpinang, Kepulauan Bangka Belitung</option>
                                                    <option value="Parepare, Sulawesi Selatan">Parepare, Sulawesi Selatan</option>
                                                    <option value="Pariaman, Sumatera Barat">Pariaman, Sumatera Barat</option>
                                                    <option value="Pasuruan, Jawa Timur">Pasuruan, Jawa Timur</option>
                                                    <option value="Payakumbuh, Sumatera Barat">Payakumbuh, Sumatera Barat</option>
                                                    <option value="Pekalongan, Jawa Tengah">Pekalongan, Jawa Tengah</option>
                                                    <option value="Pekanbaru, Riau">Pekanbaru, Riau</option>
                                                    <option value="Pematangsiantar, Sumatera Utara">Pematangsiantar, Sumatera Utara</option>
                                                    <option value="Pontianak, Kalimantan Barat">Pontianak, Kalimantan Barat</option>
                                                    <option value="Prabumulih, Sumatera Selatan">Prabumulih, Sumatera Selatan</option>
                                                    <option value="Probolinggo, Jawa Timur">Probolinggo, Jawa Timur</option>
                                                    <option value="Sabang, Aceh">Sabang, Aceh</option>
                                                    <option value="Salatiga, Jawa Tengah">Salatiga, Jawa Tengah</option>
                                                    <option value="Samarinda, Kalimantan Timur">Samarinda, Kalimantan Timur</option>
                                                    <option value="Sawahlunto, Sumatera Barat">Sawahlunto, Sumatera Barat</option>
                                                    <option value="Semarang, Jawa Tengah">Semarang, Jawa Tengah</option>
                                                    <option value="Serang, Banten">Serang, Banten</option>
                                                    <option value="Sibolga, Sumatera Utara">Sibolga, Sumatera Utara</option>
                                                    <option value="Singkawang, Kalimantan Barat">Singkawang, Kalimantan Barat</option>
                                                    <option value="Solok, Sumatera Barat">Solok, Sumatera Barat</option>
                                                    <option value="Sorong, Papua Barat">Sorong, Papua Barat</option>
                                                    <option value="Subulussalam, Aceh">Subulussalam, Aceh</option>
                                                    <option value="Sukabumi, Jawa Barat">Sukabumi, Jawa Barat</option>
                                                    <option value="Sungai Penuh, Jambi">Sungai Penuh, Jambi</option>
                                                    <option value="Surabaya, Jawa Timur">Surabaya, Jawa Timur</option>
                                                    <option value="Surakarta, Jawa Tengah">Surakarta, Jawa Tengah</option>
                                                    <option value="Tangerang, Banten">Tangerang, Banten</option>
                                                    <option value="Tangerang Selatan, Banten">Tangerang Selatan, Banten</option>
                                                    <option value="Tanjungbalai, Sumatera Utara">Tanjungbalai, Sumatera Utara</option>
                                                    <option value="Tanjungpinang, Kepulauan Riau">Tanjungpinang, Kepulauan Riau</option>
                                                    <option value="Tarakan, Kalimantan Utara">Tarakan, Kalimantan Utara</option>
                                                    <option value="Tasikmalaya, Jawa Barat">Tasikmalaya, Jawa Barat</option>
                                                    <option value="Tebing Tinggi, Sumatera Utara">Tebing Tinggi, Sumatera Utara</option>
                                                    <option value="Tegal, Jawa Tengah">Tegal, Jawa Tengah</option>
                                                    <option value="Ternate, Maluku Utara">Ternate, Maluku Utara</option>
                                                    <option value="Tidore Kepulauan, Maluku Utara">Tidore Kepulauan, Maluku Utara</option>
                                                    <option value="Tomohon, Sulawesi Utara">Tomohon, Sulawesi Utara</option>
                                                    <option value="Tual, Maluku">Tual, Maluku</option>
                                                    <option value="Yogyakarta, DI Yogyakarta">Yogyakarta, DI Yogyakarta</option>

                                                    @foreach($provinces as $province)
                                                    <!--<option value="{{ $province['_id'] }}">{{ $province['name'] }}</option>-->
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--
                                            <div class="mb-3">
                                                <label for="choices-single-groups-kab" class="form-label font-size-13">Kabupaten/Kota</label>
                                                <select class="form-control" data-trigger name="choices-single-groups" id="choices-single-groups-kab">
                                                    <option value="">Pilih</option>
                                                </select>
                                            </div>
                                            -->
                                            <div class="mb-3">
                                                <label for="form-tipe-pekerjaan" class="form-label font-size-13">Tipe Pekerjaan</label>
                                                <select class="form-control" data-trigger name="choices-single-groups" id="form-tipe-pekerjaan">
                                                    <option value="">Pilih Tipe Pekerjaan</option>
                                                    <option value="Full Time">Full Time</option>
                                                    <option value="Part Time">Part Time</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-tipe-status-karyawan" class="form-label font-size-13">Status Karyawan</label>
                                                <select class="form-control" data-trigger name="choices-single-groups" id="form-tipe-status-karyawan">
                                                    <option value="">Pilih Status Karyawan</option>
                                                    <option value="Tetap">Tetap</option>
                                                    <option value="Kontrak">Kontrak</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="expired" class="form-label">Expired Date</label>
                                                <input class="form-control" type="date" value="" id="form-expired">
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-posisi-level" class="form-label font-size-13">Posisi Level</label>
                                                <select class="form-control" data-trigger name="choices-single-groups" id="form-posisi-level">
                                                    <option value="">Pilih Posisi Level</option>
                                                    <option value="Analyst">Analyst</option>
                                                    <option value="Assistant">Assistant</option>
                                                    <option value="Finance Manager">Finance Manager</option>
                                                    <option value="Finance Officer">Finance Officer</option>
                                                    <option value="Finance Supervisor">Finance Supervisor</option>
                                                    <option value="HR Manager">HR Manager</option>
                                                    <option value="HR Officer">HR Officer</option>
                                                    <option value="HR Supervisor">HR Supervisor</option>
                                                    <option value="Intern">Intern</option>
                                                    <option value="IT Manager">IT Manager</option>
                                                    <option value="IT Officer">IT Officer</option>
                                                    <option value="IT Supervisor">IT Supervisor</option>
                                                    <option value="Junior Staff">Junior Staff</option>
                                                    <option value="Marketing Manager">Marketing Manager</option>
                                                    <option value="Marketing Officer">Marketing Officer</option>
                                                    <option value="Marketing Supervisor">Marketing Supervisor</option>
                                                    <option value="Operations Manager">Operations Manager</option>
                                                    <option value="Operations Officer">Operations Officer</option>
                                                    <option value="Operations Supervisor">Operations Supervisor</option>
                                                    <option value="Sales Manager">Sales Manager</option>
                                                    <option value="Sales Officer">Sales Officer</option>
                                                    <option value="Sales Supervisor">Sales Supervisor</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-deskripsi-pekerjaan" class="form-label">Deskripsi Pekerjaan</label>
                                                <textarea class="form-control" name="deskripsi" id="form-deskripsi-pekerjaan" rows="5"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-kualifikasi" class="form-label">Kualifikasi</label>
                                                <textarea class="form-control" name="kualifikasi" id="form-kualifikasi" rows="5"></textarea>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-md-8">
                                <div>
                                    <style>
                                        .screen {
                                            /*width: 100%;
                                            height: 100%;*/
                                            width: 340px;
                                            height: 692px;
                                            overflow-y: scroll;
                                            -webkit-overflow-scrolling: touch;
                                            border-radius: 50px;

                                            position: absolute;
                                            z-index: 1;
                                            top: 0;
                                            margin-top: 95px;
                                            left: 50%;
                                            transform: translate(-52%, 0%);
                                        }

                                        .screen1 {
                                            width: 340px;
                                            height: 690px;
                                            overflow-y: scroll;
                                            -webkit-overflow-scrolling: touch;
                                            border-radius: 50px;

                                            position: absolute;
                                            z-index: 1;
                                            top: 0;
                                            margin-top: 115px;
                                            left: 50%;
                                            transform: translate(-52%, 0%);
                                        }

                                        .containerx {
                                            padding: 20px;
                                        }

                                        .job-header {
                                            display: flex;
                                            align-items: center;
                                            margin-bottom: 20px;
                                        }

                                        .job-header img {
                                            width: 50px;
                                            height: 50px;
                                            border-radius: 8px;
                                            margin-right: 15px;
                                        }

                                        .job-header .job-title {
                                            font-size: 14px;
                                            font-weight: bold;
                                        }

                                        .job-header .job-company {
                                            font-size: 10px;
                                            color: #6c757d;
                                        }

                                        .job-header .job-posted {
                                            font-size: 10px;
                                            color: #6c757d;
                                            margin-left: auto;
                                        }

                                        .job-details {
                                            margin-bottom: 20px;
                                        }

                                        .job-details .row {
                                            margin-bottom: 10px;
                                        }

                                        .job-details {
                                            font-size: 13px;
                                        }

                                        .job-details .label {
                                            font-weight: bold;
                                        }

                                        .job-description {
                                            font-size: 14px;
                                            margin-bottom: 20px;
                                        }

                                        .job-description .section-title {
                                            font-weight: bold;
                                            margin-bottom: 10px;
                                        }

                                        .job-description p {
                                            margin-bottom: 10px;
                                        }

                                        .job-description ul {
                                            padding-left: 20px;
                                        }

                                        .job-description ul li {
                                            margin-bottom: 5px;
                                        }

                                        .divider {
                                            margin-top: 10px;
                                            border-top: 1px solid #e0e0e0;
                                        }

                                        .phonePreview {
                                            width: 375px;
                                            height: 812px;
                                            position: relative;
                                            /* box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);*/
                                            margin-left: auto;
                                            margin-right: auto;
                                            margin-top: 30px;
                                            border-radius: 50px;
                                            display: block;
                                        }
                                    </style>
                                    <img class="phonePreview" src="{{ asset('assets/images/logo/phone.png') }}" alt="">
                                    <div class="screen">
                                        <div class="containerx">
                                            <h5><i class="mdi mdi-arrow-left"></i> Deskripsi Pekerjaan</h5>
                                            <div class="divider"></div><br>
                                            <div class="job-header">

                                                <img alt="Company Logo" height="30" src="{{ url('proxy-image/logo/img-1727799480936.png') }}" width="50" />
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
                                    <a href="#" class="btn btn-outline-primary w-md">Cancel</a>
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
                                                <div>
                                                    <img class="phonePreview" src="{{ asset('assets/images/logo/phone.png') }}" alt="">
                                                    <div class="screen1">
                                                        <div class="containerx">
                                                            <h5><i class="mdi mdi-arrow-left"></i> Deskripsi Pekerjaan</h5>
                                                            <div class="divider"></div><br>
                                                            <div class="job-header">

                                                                <img alt="Company Logo" height="30" src="{{ url('proxy-image/logo/img-1727799480936.png') }}" width="50" />
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
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

<script>
    function formatCurrency(input) {
        // Hapus semua karakter selain angka
        let value = input.value.replace(/[^0-9]/g, '');

        // Tambahkan tanda pemisah ribuan
        value = new Intl.NumberFormat('id-ID', {
            /*style: 'currency',
            currency: 'IDR',*/
            minimumFractionDigits: 0
        }).format(value);

        // Tampilkan hasil format di dalam input
        input.value = value;
    }
</script>

@include('user/footer')
<!-- Select ============================================================================ -->
<!-- choices js -->
<script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script>
<script>
    function previewPhone() {
        var fields = ['form-lowongan', 'form-lokasi', 'form-tipe-pekerjaan', 'form-tipe-status-karyawan',
            'form-posisi-level', 'form-deskripsi-pekerjaan', 'form-kualifikasi'
        ];

        var previews = ['job_title_pre', 'lokasi_pre', 'tipe_pekerjaan_pre', 'status_karyawan_pre',
            'posisi_level_pre', 'job_description_pre', 'kategori_pekerjaan_pre'
        ];

        for (var field of fields) {
        if (document.getElementById(field).value.trim() === "") {
            alert("Semua field harus terisi.");
            return; // Hentikan eksekusi jika ada field yang kosong
        }
    }
        // Isi data ke preview
        fields.forEach(function(field, index) {
            document.getElementById(previews[index]).innerHTML = document.getElementById(field).value || "";
        });

        // Menampilkan modal
        new bootstrap.Modal(document.getElementById('modal-preview'), {
            keyboard: false
        }).show();
    }
</script>

</body>

</html>