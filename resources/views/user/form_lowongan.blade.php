@include('user/header_start')
<!-- Select ====================================================================================== -->
<!-- choices css -->
<link href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />

<!-- color picker css -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" /> <!-- 'classic' theme -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" /> <!-- 'monolith' theme -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" /> <!-- 'nano' theme -->

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
                                                <label for="example-text-input1" class="form-label">Nama Lowongan</label>
                                                <input class="form-control" type="text" value="" placeholder="Nama Lowongan" id="example-text-input1">
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
                                                <label for="choices-single-groups-provinsi" class="form-label font-size-13">Provinsi</label>
                                                <select class="form-control" data-trigger name="choices-single-groups" id="choices-single-groups-provinsi" onchange="populateCities()">
                                                    <option value="">Pilih</option>
                                                    <option value="Aceh">Aceh</option>
                                                    <option value="Sumatera Utara">Sumatera Utara</option>
                                                    <option value="Sumatera Barat">Sumatera Barat</option>
                                                    <option value="Riau">Riau</option>
                                                    <option value="Kepulauan Riau">Kepulauan Riau</option>
                                                    <option value="Jambi">Jambi</option>
                                                    <option value="Sumatera Selatan">Sumatera Selatan</option>
                                                    <option value="Bengkulu">Bengkulu</option>
                                                    <option value="Lampung">Lampung</option>
                                                    <option value="Bangka Belitung">Bangka Belitung</option>
                                                    <option value="DKI Jakarta">DKI Jakarta</option>
                                                    <option value="Banten">Banten</option>
                                                    <option value="Jawa Barat">Jawa Barat</option>
                                                    <option value="Jawa Tengah">Jawa Tengah</option>
                                                    <option value="DI Yogyakarta">DI Yogyakarta</option>
                                                    <option value="Jawa Timur">Jawa Timur</option>
                                                    <option value="Bali">Bali</option>
                                                    <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                                    <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                                    <option value="Kalimantan Barat">Kalimantan Barat</option>
                                                    <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                                    <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                                    <option value="Kalimantan Timur">Kalimantan Timur</option>
                                                    <option value="Kalimantan Utara">Kalimantan Utara</option>
                                                    <option value="Sulawesi Utara">Sulawesi Utara</option>
                                                    <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                                    <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                                    <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                                    <option value="Gorontalo">Gorontalo</option>
                                                    <option value="Sulawesi Barat">Sulawesi Barat</option>
                                                    <option value="Maluku">Maluku</option>
                                                    <option value="Maluku Utara">Maluku Utara</option>
                                                    <option value="Papua">Papua</option>
                                                    <option value="Papua Barat">Papua Barat</option>
                                                    <option value="Papua Tengah">Papua Tengah</option>
                                                    <option value="Papua Pegunungan">Papua Pegunungan</option>
                                                    <option value="Papua Selatan">Papua Selatan</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="choices-single-groups-kab" class="form-label font-size-13">Kabupaten/Kota</label>
                                                <select class="form-control" data-trigger name="choices-single-groups" id="choices-single-groups-kab">
                                                    <option value="">Pilih</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="choices-single-groups-tipe" class="form-label font-size-13">Tipe Pekerjaan</label>
                                                <select class="form-control" data-trigger name="choices-single-groups" id="choices-single-groups-tipe">
                                                    <option value="">Pilih</option>
                                                    <option value="London">London</option>
                                                    <option value="Manchester">Manchester</option>
                                                    <option value="Liverpool">Liverpool</option>
                                                    <option value="Paris">Paris</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="choices-single-groups-status-karyawan" class="form-label font-size-13">Status Karyawan</label>
                                                <select class="form-control" data-trigger name="choices-single-groups" id="choices-single-groups-status-karyawan">
                                                    <option value="">Pilih</option>
                                                    <option value="London">London</option>
                                                    <option value="Manchester">Manchester</option>
                                                    <option value="Liverpool">Liverpool</option>
                                                    <option value="Paris">Paris</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="expired" class="form-label">Expired Date</label>
                                                <input class="form-control" type="date" value="" id="expired">
                                            </div>
                                            <div class="mb-3">
                                                <label for="choices-single-groups-posisi-level" class="form-label font-size-13">Posisi Level</label>
                                                <select class="form-control" data-trigger name="choices-single-groups" id="choices-single-groups-posisi-level">
                                                    <option value="">Pilih</option>
                                                    <option value="London">London</option>
                                                    <option value="Manchester">Manchester</option>
                                                    <option value="Liverpool">Liverpool</option>
                                                    <option value="Paris">Paris</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi-pekerjaan" class="form-label">Deskripsi Pekerjaan</label>
                                                <textarea class="form-control" name="deskripsi" id="deskripsi-pekerjaan" rows="5"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kualifikasi" class="form-label">Kualifikasi</label>
                                                <textarea class="form-control" name="kualifikasi" id="kualifikasi" rows="5"></textarea>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-md-8">
                                <div class="text-center">
                                    <style>
                                        iframe {
                                            border-top: 15px solid #000;
                                            border-right: 15px solid #000;
                                            border-left: 15px solid #000;
                                            border-bottom: 15px solid #000;
                                            border-radius: 15px;
                                        }
                                    </style>
                                    <iframe width="340" height="600" style="" src="http://127.0.0.1:8000/" frameborder="0" allowfullscreen></iframe>

                                </div>
                            </div>
                            <hr>
                            <div class="col-lg-12">
                                <div class="mt-4 text-end">
                                    <a href="#" class="btn btn-outline-primary w-md">Cancel</a>
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
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
<Script>
    const cities = {
        "Aceh": [
            "Kabupaten Aceh Barat", "Kabupaten Aceh Barat Daya", "Kabupaten Aceh Besar",
            "Kabupaten Aceh Jaya", "Kabupaten Aceh Selatan", "Kabupaten Aceh Singkil",
            "Kabupaten Aceh Tamiang", "Kabupaten Aceh Tengah", "Kabupaten Aceh Tenggara",
            "Kabupaten Aceh Timur", "Kabupaten Aceh Utara", "Kota Banda Aceh",
            "Kota Langsa", "Kota Lhokseumawe", "Kota Sabang", "Kota Subulussalam"
        ],
        "Sumatera Utara": [
            "Kabupaten Asahan", "Kabupaten Batubara", "Kabupaten Dairi",
            "Kabupaten Deli Serdang", "Kabupaten Humbang Hasundutan", "Kabupaten Karo",
            "Kabupaten Labuhanbatu", "Kabupaten Langkat", "Kota Binjai",
            "Kota Medan", "Kota Pematangsiantar", "Kota Sibolga", "Kota Tanjungbalai",
            "Kota Tebing Tinggi"
        ],
        "Sumatera Barat": [
            "Kabupaten Agam", "Kabupaten Dharmasraya", "Kabupaten Kepulauan Mentawai",
            "Kabupaten Lima Puluh Kota", "Kabupaten Padang Pariaman",
            "Kabupaten Pasaman", "Kabupaten Pasaman Barat", "Kabupaten Sijunjung",
            "Kabupaten Solok", "Kabupaten Solok Selatan", "Kabupaten Tanah Datar",
            "Kota Bukittinggi", "Kota Padang", "Kota Padang Panjang",
            "Kota Pariaman", "Kota Payakumbuh", "Kota Sawahlunto", "Kota Solok"
        ],
        // Lanjutkan untuk semua provinsi
    };

    function populateCities() {
        const provinsiSelect = document.getElementById("choices-single-groups-provinsi");
        const kotaSelect = document.getElementById("choices-single-groups-kab");
        const selectedProvinsi = provinsiSelect.value;

        console.log("Provinsi yang dipilih:", selectedProvinsi); // Untuk memastikan provinsi terdeteksi

        // Hapus semua opsi kota/kabupaten sebelumnya
        kotaSelect.innerHTML = '<option value="">Pilih</option>';

        // Jika provinsi dipilih, tampilkan kota/kabupaten yang sesuai
        if (selectedProvinsi in cities) {
            console.log("Mengisi kota/kabupaten untuk provinsi:", selectedProvinsi); // Debugging
            const kotaKabupaten = cities[selectedProvinsi];

            kotaKabupaten.forEach(function(kota) {
                const option = document.createElement("option");
                option.value = kota;
                option.textContent = kota;
                kotaSelect.appendChild(option);
            });
        } else {
            console.log("Provinsi tidak ditemukan dalam data."); // Untuk cek jika provinsi tidak ada di list
        }
    }
</Script>
@include('user/footer')
<!-- Select ============================================================================ -->
<!-- choices js -->
<script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

<!-- choices js -->
<script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
</body>

</html>