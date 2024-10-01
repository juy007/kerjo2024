@include('user/header_start')
@include('user/header_end')
<style>
    th {
        font-weight: bold !important;
    }
</style>

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
                    <div class="card-header">
                        <div class="row">

                            <div id="filter" class="col-md-3 mb-3">

                            </div>
                            <div class="col-md-3 mb-3">
                                <select id="statusFilter" class="form-select">
                                    <option value="">Status</option>
                                    <option value="">Semua</option>
                                    <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                                    <option value="diterima">diterima</option>
                                    <option value="diproses">diproses</option>
                                    <option value="ditolak">ditolak</option>
                                </select>
                            </div>
                            <div id="show_data" class="col-md-6 mb-3">

                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
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
                                    <tr valign="middle">
                                        <td><?php echo $i + 1; ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" class="avatar-md rounded-circle" alt="img" />
                                                <div class="flex-1 ms-4">
                                                    <h5 class="mb-2 font-size-15 text-primary"><a href="{{ route('detail_pelamar') }}">Nikola Hendra</a></h5>
                                                    <p class="text-muted">niko@gmail.com</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>081385417712</td>
                                        <td>Data Analyst</td>
                                        <td>4 Tahun</td>
                                        <td>Menunggu Konfirmasi</td>
                                        <td><a href="">Download</a></td>
                                        <td><a href="" class="btn btn-outline-danger">Tolak</a> <a href="" class="btn btn-primary">Proses</a></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" class="avatar-md rounded-circle" alt="img" />
                                            <div class="flex-1 ms-4">
                                                <h5 class="mb-2 font-size-15 text-primary"><a href="{{ route('detail_pelamar') }}">Arfa</a></h5>

                                                <p class="text-muted">arfa@gmail.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>081385417712</td>
                                    <td>Data Analyst</td>
                                    <td>4 Tahun</td>
                                    <td>diterima</td>
                                    <td><a href="">Download</a></td>
                                    <td><a href="" class="btn btn-outline-danger">Tolak</a> <a href="" class="btn btn-primary">Proses</a></td>
                                </tr>
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
</body>
</html>