@include('user/header_start')

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
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12">

                            @if (session('notifAPI'))
                            <div class="text-center">
                                <h5 class="text-primary">{{ session('notifAPI') }}</h5>
                            </div>
                            @endif

                            <div class="fade show px-4 mb-0 text-center" role="alert">
                                <img src="{{ url('proxy-image/src/no.jpg') }}" alt="" class="img-fluid mx-auto d-block">
                                <h5 class="text-primary">Periksa koneksi internet Anda</h5>
                                <p></p>
                                <div class="col-sm-3" style="margin-left:auto;margin-right:auto;margin-top:5px;">
                                    <button onclick="location.reload()" class="btn btn-primary w-100 waves-effect waves-light"><i class="mdi mdi-reload"></i> Coba lagi</button>
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
@include('user/footer')

</body>

</html>