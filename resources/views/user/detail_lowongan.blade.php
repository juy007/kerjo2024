@include('user/header')
<style>
        .dataTables_wrapper .dataTables_filter {
            float: left;
            margin-bottom: 10px;
        }
    </style>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content" style="background-color:#F4F7FE !important;">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Detail</h4>

                        <div class="page-title-right">

                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div>
                                        <div class="d-flex">
                                            <div class="flex-1">
                                                <p class="text-muted mb-2">
                                                <h4 class="mb-sm-0 font-size-18">Data Analyst</h4>
                                                </p>
                                                <p class="text-muted">Posted By Kerjo</p>
                                                <p class="text-muted">Sebagai Data Analis di perusahaan kami, Anda akan menjadi bagian penting dalam tim yang bertanggung jawab untuk mengumpulkan, menganalisis, dan menginterpretasi data untuk mendukung pengambilan keputusan bisnis.</p>
                                                <p class="text-muted mt-2"><span class="mdi mdi-bookmark"></span> Bookmart : 24</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-2 pt-5">
                                    <div>
                                        <h4 class="mb-sm-0 font-size-18 mt-3">Lokasi</h4>
                                        <p class="text-muted">Sudriman, Jakarta Selatan</p>
                                        <h4 class="mb-sm-0 font-size-18 mt-4">Status Karyawan</h4>
                                        <p class="text-muted">Karyawan Tetap</p>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-2 pt-5">
                                    <div>
                                        <h4 class="mb-sm-0 font-size-18 mt-3">Tipe Pekerjaan</h4>
                                        <p class="text-muted">Full Time</p>
                                        <h4 class="mb-sm-0 font-size-18 mt-4">Posisi Level</h4>
                                        <p class="text-muted">Staff</p>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-md-2 pt-5">
                                    <div>
                                        <h4 class="mb-sm-0 font-size-18 mt-3">Kategori Pekerjaan</h4>
                                        <p class="text-muted">IT Komputer - Software</p>

                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12">
                                    <p class="text-muted text-end">Expired date 08/12/2023</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>


            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <th>No</th>
                                        <th>Pelamar</th>
                                        <th>Handphone</th>
                                        <th>Jabatan</th>
                                        <th>Pengalaman Kerja</th>
                                        <th>Status</th>
                                        <th>CV</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    for ($i = 0; $i < 40; $i++) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?></td>
                                            <td><a href="{{ route('detail_pelamar') }}">Nikola Hendra</a></td>
                                            <td>081385417712</td>
                                            <td>Data Analyst</td>
                                            <td>4 Tahun</td>
                                            <td>Menunggu Konfirmasi</td>
                                            <td><a href="">Download</a></td>
                                            <td><a href="" class="btn btn-outline-danger">Tolak</a> <a href="" class="btn btn-primary">Proses</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    @include('user/footer')

    <script>
    $(document).ready(function() {
            $('#datatable').DataTable({
                dom: '<"top"f>rt<"bottom"lpi><"clear">'
            });
        });
    </script>