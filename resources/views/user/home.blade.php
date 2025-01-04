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
        </div><br><br>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <div class="row justify-content-center mb-5">
                        <div class="col-sm-7">
                            <div class="maintenance-img">
                                <img src="{{ asset('assets/images/logo/image_home.png') }}" alt="" class="img-fluid mx-auto d-block">
                            </div><br>
                            <p>Anda belum membuat postingan lowongan kerja sama sekali, yuk<br>
                                posting lowongan kerja untuk perusahaan anda agar bisa mendapatkan karyawan baru</p>
                            <div class="col-sm-5" style="margin-left:auto;margin-right:auto;">
                                <a class="btn btn-primary w-100 waves-effect waves-light" href="{{ route('form_job') }}">BUAT POSTINGAN PEKERJAAN</a>
                            </div>
                            @if(session('xxx'))
                            <div class="alert alert-danger">
                                {{ session('xxx') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@include('user/footer')
</body>

</html>