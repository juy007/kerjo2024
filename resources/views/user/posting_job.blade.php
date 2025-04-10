@include('user/header_start')
@include('user/header_end')
<div class="page-content" style="background-color:#F4F7FE !important;">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Lowongan</h4>

                    <div class="page-title-right">

                    </div>

                </div>
            </div>
        </div><br>
        <!-- end page title -->
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="padding:10px !important;">
                        <div class="row">
                            <div class="col-sm-4 center-vertical">
                                <h5 class="mb-sm-0 font-size-15">List Lowongan</h5>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <a href="{{ route('form_job') }}" class="btn btn-primary waves-effect waves-light me-2">Buat Postingan Pekerjaan</a>
                                </div>
                            </div><!-- end col-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @if(count($dataJob['list']) > 0)
                @foreach($dataJobob['list'] as $jobs)
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div>
                                        <div class="d-flex">
                                            <div class="flex-1">
                                                <p class="text-muted mb-2">
                                                    <a href="{{ route('detail_job', $jobs['_id']) }}">
                                                        <h4 class="mb-sm-0 font-size-18">{{ $jobs['title'] }}</h4>
                                                    </a>
                                                </p>
                                                <p class="text-muted">{{ strip_tags($jobs['description']) }}</p>
                                                <p class="text-muted">Last update {{ \Carbon\Carbon::parse($jobs['updatedAt'])->format('d/m/Y') }}</p>
                                                <p class="text-muted">Expired date {{ \Carbon\Carbon::parse($jobs['endDate'])->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3">
                                    <div class="text-center">
                                        <p class="text-muted mb-2">
                                        <h4 class="mb-sm-0 font-size-18 text-center">Total Lamaran</h4>
                                        </p>
                                        <h1 class="mt-5">{{ count($jobs['applications']) }}</h1>

                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-3">
                                    <div>
                                        <ul class="list-inline float-sm-end mb-sm-0">
                                            <li class="list-inline-item">
                                                <a href="{{ route('edit_job', $jobs['_id']) }}" class="btn btn-soft-primary"><i class="mdi mdi-pencil font-size-18"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <form action="{{ route('delete_job', $jobs['_id']) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-soft-danger"><i class="mdi mdi-delete font-size-18"></i></button>
                                                </form>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                @endforeach
            @else
                <img style="max-height: 500px; width:auto;" src="{{ url('proxy-image/src/nodata.png') }}" alt="" class="img-fluid mx-auto d-block">
            @endif
        </div>
       
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@include('user/footer')
</body>

</html>