@include('admin/header_start')
<!-- DataTables -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@include('admin/header_end')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18"><i class="mdi mdi-fridge-industrial"></i> Company</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-4 center-vertical">
                                <h5 class="mb-sm-0 font-size-15"></h5>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <!--<button class="btn btn-primary waves-effect waves-light me-2" data-bs-toggle="modal" data-bs-target="#formTambah">Tambah Company</button>-->
                                    <div id="formTambah" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                        <div class="modal-dialog">
                                            <form class="modal-content" method="POST" action="{{ route('admin.companies.store') }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel">Tambah Company</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-4">
                                                        <label class="form-label" for="company"></label>
                                                        <input class="form-control" type="text" id="company" name="company" placeholder="Company">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                                                </div>
                                            </form><!-- /.modal-content -->
                                        </div>
                                    </div><!-- end col-->
                                </div>
                            </div>
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
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Company</th>
                                            <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach($company['list'] as $company)
                                        @if($company['name'] === 'Firdaus Wibowo')
                                            @continue
                                        @endif
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img class="rounded-circle header-profile-user" src="{{ url('proxy-image-admin/logo/'. str_replace(['../public/upload/logo/', './public/upload/logo/'], '', $company['logo'])) }}" alt="Header Avatar">&nbsp; {{ $company['name'] }}</td>
                                            <td>
                                                <a href="#{{-- route('admin.companies.show', $company['_id']) --}}" class="btn btn-soft-success btn-sm waves-effect waves-light"><i data-feather="eye"></i> View</a>
                                                <!--
                                                <a href="#" class="btn btn-soft-primary btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#formUpdate{{ $company['_id'] }}"><i data-feather="edit"></i> Edit</a>
                                                <div id="formUpdate{{ $company['_id'] }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                                    <div class="modal-dialog">
                                                        <form class="modal-content" method="POST" action="{{ route('admin.companies.update', $company['_id']) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myModalLabel">Update Company</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-4">
                                                                    <label class="form-label" for="company"></label>
                                                                    <input class="form-control" type="text" id="company" name="company" value="{{ $company['name'] }}" placeholder="company">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <form action="{{ route('admin.companies.destroy', $company['_id']) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-soft-danger btn-sm waves-effect waves-light"><i data-feather="trash-2"></i> Delete</button>
                                                </form>
                                                -->
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
        @include('admin/footer_start')
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
        @include('admin/footer_end')