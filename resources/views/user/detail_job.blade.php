@include('user/header_start')
<!-- DataTables -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

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
                            <!-- Bagian Kiri -->
                            <div class="col-xl-6 col-md-6 col-12">
                                <div class="d-flex flex-column">
                                    <div class="flex-1">
                                        <h4 class="mb-sm-3 font-size-18">{{ $jobs['title'] }}</h4>
                                        <p class="text-muted">Posted By Kerjo</p>
                                        <p class="text-muted">{!! $jobs['description'] !!}</p>
                                        <p class="text-muted mt-4"><span class="mdi mdi-bookmark"></span> Bookmark: {{ count($jobs['bookmarks']) }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Lokasi dan Status Karyawan -->
                            <div class="col-xl-2 col-md-2 col-6 pt-4 pt-md-5">
                                <div>
                                    <h4 class="mb-sm-0 font-size-18 mt-3">Lokasi</h4>
                                    <p class="text-muted">{{ $jobs['province']['name'] }}</p>
                                    <h4 class="mb-sm-0 font-size-18 mt-4">Status Karyawan</h4>
                                    <p class="text-muted">{{ $jobs['jobStatus']['name'] }}</p>
                                </div>
                            </div>

                            <!-- Tipe Pekerjaan dan Level -->
                            <div class="col-xl-2 col-md-2 col-6 pt-4 pt-md-5">
                                <div>
                                    <h4 class="mb-sm-0 font-size-18 mt-3">Tipe Pekerjaan</h4>
                                    <p class="text-muted">{{ $jobs['jobType']['name'] }}</p>
                                    <h4 class="mb-sm-0 font-size-18 mt-4">Posisi Level</h4>
                                    <p class="text-muted">{{ isset($jobs['jobLevel']['name']) ? $jobs['jobLevel']['name'] : '-' }}</p>
                                </div>
                            </div>

                            <!-- Kategori Pekerjaan -->
                            <div class="col-xl-2 col-md-2 col-12 pt-4 pt-md-5">
                                <div>
                                    <h4 class="mb-sm-0 font-size-18 mt-3">Kategori Pekerjaan</h4>
                                    <p class="text-muted">{{ $subCategoriesShow['name'] }}</p>
                                </div>
                            </div>

                            <!-- Expiry Date -->
                            <div class="col-xl-12 col-md-12 col-12">
                                <p class="text-muted text-end">Expired date {{ \Carbon\Carbon::parse($jobs['endDate'])->format('d/m/Y') }}</p>
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
                            <div id="filter" class="col-md-3 mb-3">
                            </div>
                            <div class="col-md-3 mb-3">
                                <select id="statusFilter" class="form-select">
                                    <option value="">Status</option>
                                    <option value="">Semua</option>
                                    <option value="Submitted">Submitted</option>
                                    <option value="Reviewed">Reviewed</option>
                                    <option value="Interview">Interview</option>
                                    <option value="Rejected">Rejected</option>
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
                                    <th>Handphone</th><!--
                                    <th>Jabatan</th>
                                    <th>Pengalaman Kerja</th>-->
                                    <th>Status</th>
                                    <th>CV</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($applications as $applications)
                                <tr valign="middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <img src="{{ url('proxy-image/avatar/'. str_replace('../public/upload/avatar/', '', $applications['user']['avatar'] )) }}" class="avatar-md rounded-circle" alt="img" />
                                            <div class="flex-1 ms-4">
                                                <h5 class="mb-2 font-size-15 text-primary"><a href="{{ route('detail_pelamar',  ['id' => $applications['_id'], 'jobId' => $applications['job']]) }}">{{ $applications['user']['name'] }}</a></h5>
                                                <p class="text-muted">{{ $applications['user']['email'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $applications['user']['phone'] }}</td><!--
                                    <td>{{ $experiences[0]['position'] }}</td>
                                    <td align="center">
                                        @php
                                        $startYear = (int) $experiences[0]['startYear'];
                                        $endYear = (int) $experiences[0]['endYear'];
                                        $yearsWorked = $endYear - $startYear;
                                        @endphp
                                        {{ $yearsWorked }} Tahun
                                    </td>-->
                                    <td>{{ $applications['status'] }}</td>
                                    <td><a href="{{ url('proxy-cv/' . str_replace('../public/upload/cv/', '', $applications['cv']['link'])) }}">Download</a></td>
                                    <td>
                                        <form method="POST" action="{{ route('save_update_status', $applications['_id']) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="userId" value="{{ $applications['user']['_id'] }}">
                                            <input type="hidden" name="status" value="Rejected">
                                            <input type="hidden" name="jobId" value="{{ $applications['job'] }}">
                                            <button type="submit" class="btn btn-outline-danger">Tolak</button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formUpdate{{ $applications['_id'] }}">Proses</button>
                                        </form>
                                        <div id="formUpdate{{ $applications['_id'] }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                            <div class="modal-dialog">
                                                <form class="modal-content" method="POST" action="{{  route('save_update_status', $applications['_id']) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel">Pilih Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-4">
                                                        <input type="hidden" name="userId" value="{{ $applications['user']['_id'] }}">
                                                        <input type="hidden" name="jobId" value="{{ $applications['job'] }}">
                                                            <select id="statusFilter" class="form-select" name="status" required>
                                                                <option value="">Pilih Status</option>
                                                                <option value="Submitted">Submitted</option>
                                                                <option value="Reviewed">Reviewed</option>
                                                                <option value="Interview">Interview</option>
                                                                <option value="Rejected">Rejected</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                                                    </div>
                                                </form><!-- /.modal-content -->
                                            </div>
                                        </div><!-- end col-->
                                    </td>
                                </tr>
                                @endforeach
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
<!-- Required datatable js -->
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Responsive examples -->
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

<script>
    $(document).ready(function() {
        let tagfilter = document.getElementById('filter');
        let tagsearch = document.querySelector('#datatable_filter input[type="search"]');

        if (tagfilter && tagsearch) {
            tagfilter.appendChild(tagsearch);
        } else {
            console.error("Elemen tidak ditemukan!");
        }
        $('input[type="search"]').attr('placeholder', 'Search');
        $('input[type="search"]').removeClass('form-control-sm');
        document.getElementById('datatable_filter').innerHTML = "";

        let show_data = document.getElementById('show_data');
        let f_show_data = document.querySelector('#dataTables_length');
        show_data.appendChild(f_show_data);
        console.log(f_show_data);
    });
</script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        const table = $('#datatable').DataTable();

        // Mendapatkan elemen dropdown
        const statusEl = document.querySelector('#statusFilter');

        // Fungsi pencarian kustom
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                // Mendapatkan nilai filter
                var status = statusEl.value;
                var rowStatus = data[5]; // Asumsi kolom status ada di index ke-5

                // Mengembalikan true jika baris harus ditampilkan
                if (status === '' || rowStatus === status) {
                    return true;
                }

                // Mengembalikan false jika baris harus disembunyikan
                return false;
            }
        );

        // Event listener untuk filter
        statusEl.addEventListener('change', function() {
            table.draw(); // Redraw tabel untuk menerapkan filter
        });
    });
</script>
<script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>