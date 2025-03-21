@include('user/header_start')
<!-- Select ====================================================================================== -->
<!-- choices css -->
<link href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />

<!-- color picker css -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" /> <!-- 'classic' theme -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" /> <!-- 'monolith' theme -->
<link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" /> <!-- 'nano' theme -->
<!-- ckeditor -->
<script src="{{ asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<!--<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>-->

@include('user/header_end')

<div class="page-content" style="background-color:#F4F7FE !important;">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18"></h4>
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
                        <div class="col-sm-12">
                            <!--
                            @if (session('notifAPI'))
                            <div class="alert alert-warning text-center">
                                <h5 class="text-warning">{{ session('notifAPI') }}</h5>
                            </div>
                            @endif
                            -->
                            <div class="alert alert-primary alert-dismissible fade show px-4 mb-0 text-center" role="alert">
                                <i class="mdi mdi-alert-outline d-block display-4 mt-2 mb-3 text-primary"></i>
                                <h5 class="text-primary">Periksa koneksi internet Anda</h5>
                                <p></p>
                            </div>
                        </div>
                        <div class="col-sm-3" style="margin-left:auto;margin-right:auto;margin-top:5px;">
                            <button onclick="location.reload()" class="btn btn-primary w-100 waves-effect waves-light"><i class="mdi mdi-reload"></i> Coba lagi</button>
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
                // alert("Semua field harus terisi.");
                // return; // Hentikan eksekusi jika ada field yang kosong
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