@include('user/header')

<div class="progress progress-sm progress-t">
    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h4 class="font-size-18">Tentang Perusahaan Anda</h4>
                    <p class="text-mute">Masukkan identitas perusahaan Anda dengan lengkap dan akurat, agar<br>
                        Kerjo dapat memverifikasi akun Anda! Pasang logo agar kandidat tertarik melamar ke lowongan.</p>


                </div>
            </div>
        </div><br><br>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-8">
                            <div>
                                <form method="POST" action="#" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="nama_perusahaan">Nama Perusahaan</label>
                                                <input type="text" class="form-control" id="nama_perusahaan" placeholder="Nama Perusahaan">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="nama_brand">Nama Brand</label>
                                                <input type="text" class="form-control" id="nama_brand" placeholder="Nama Brand">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="tanggal_berdiri_perusahaan">Tanggal Berdiri Perusahaan</label>
                                                <input type="date" class="form-control" id="tanggal_berdiri_perusahaan" placeholder="01/01/2000">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="lokasi_perusahaan">Lokasi Perusahaan</label>
                                                <input type="text" class="form-control" id="lokasi_perusahaan" placeholder="Lokasi Perusahaan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="tentang_perusahaan">Tentang Perusahaan</label>
                                                <textarea class="form-control" name="tentang_perusahaan" id="tentang_perusahaan" rows="5" placeholder="Deskripsi tentang perusahaan"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-2 pt-4">
                                                    <img src="{{ asset('assets/icon/iupload.png') }}" class="avatar-md rounded-circle" alt="img" />
                                                </div>
                                                <div class="col-10 pt-4">
                                                    Upload logo perusahaan<br>
                                                    <style>
                                                        .custom-file-upload {
                                                            display: inline-block;
                                                            padding: 6px 12px;
                                                            cursor: pointer;
                                                            background-color: #FFF;
                                                            color: #1C84EE;
                                                            border: 1px solid #1C84EE;
                                                            border-radius: 15px;
                                                            width: 90px;
                                                            height: 30px;
                                                            text-align: center;
                                                            font-weight: bold;
                                                        }

                                                        #logo-perusahaan {
                                                            display: none;
                                                        }
                                                    </style>

                                                    <label class="custom-file-upload">
                                                        Upload
                                                        <input id="logo-perusahaan" type="file" />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <style>
                                                #previewContainer img {
                                                    max-width: 100px;
                                                    max-height: 100px;
                                                    margin: 5px;
                                                }

                                                #video {
                                                    display: none;
                                                    margin-bottom: 10px;
                                                }

                                                #openCamera {
                                                    /*height: 50px;*/
                                                }

                                                #closeCamera {
                                                    /*height: 50px;*/
                                                }

                                                .custom-file-upload2 {
                                                    display: inline-block;
                                                    padding: 6px 12px;
                                                    cursor: pointer;
                                                    background-color: #FFF;
                                                    color: #1C84EE;
                                                    border: 1px solid #1C84EE;
                                                    border-radius: 8px;
                                                    width: 90px;
                                                    height: 30px;
                                                    text-align: center;
                                                    font-weight: bold;
                                                }

                                                #fileInput {
                                                    display: none;
                                                }
                                            </style>

                                            <!-- Tombol untuk membuka kamera -->
                                            <p class="text-mute">Photo profile perusahaan</p>
                                            <div class="hstack gap-3">
                                                <div class="">
                                                    <button type="button" id="openCamera" class="btn btn-outline-primary font-size-20"><i class="mdi mdi-camera"></i></button>
                                                    <button type="button" id="closeCamera" style="display:none;" class="btn btn-outline-danger font-size-20"><i class="mdi mdi-camera"></i></button>
                                                </div>
                                                <div class="pt-2">
                                                    <label class="btn btn-outline-primary font-size-20">
                                                        <i class="bx bx-plus-medical"></i>
                                                        <input type="file" id="fileInput" accept="image/*" multiple>
                                                    </label>
                                                </div>
                                            </div>

                                            <!-- Video Preview dari Kamera -->
                                            <video id="video" width="320" height="240" autoplay></video>
                                            <button type="button" id="snap" style="display:none;" class="btn btn-outline-primary"><i class="mdi mdi-camera"></i> Take</button>

                                            <!-- Gambar Preview -->
                                            <div id="previewContainer"></div>

                                            <!-- Input File untuk memilih multiple gambar -->

                                            <script>
                                                const openCameraButton = document.getElementById('openCamera');
                                                const closeCameraButton = document.getElementById('closeCamera');
                                                const video = document.getElementById('video');
                                                const snapButton = document.getElementById('snap');
                                                const previewContainer = document.getElementById('previewContainer');
                                                const fileInput = document.getElementById('fileInput');
                                                const canvas = document.createElement('canvas');
                                                const context = canvas.getContext('2d');
                                                let stream;

                                                // Buka kamera saat tombol ditekan
                                                openCameraButton.addEventListener('click', () => {
                                                    navigator.mediaDevices.getUserMedia({
                                                            video: true
                                                        })
                                                        .then(mediaStream => {
                                                            stream = mediaStream;
                                                            video.srcObject = stream;
                                                            video.style.display = 'block';
                                                            snapButton.style.display = 'block';
                                                            openCameraButton.style.display = 'none'; // Sembunyikan tombol "Buka Kamera" setelah kamera dibuka
                                                            closeCameraButton.style.display = 'block'; // Tampilkan tombol "Matikan Kamera"
                                                        })
                                                        .catch(err => {
                                                            console.log("Terjadi kesalahan: " + err);
                                                        });
                                                });

                                                // Ambil gambar dari video dan tampilkan di canvas
                                                snapButton.addEventListener('click', () => {
                                                    canvas.width = video.videoWidth;
                                                    canvas.height = video.videoHeight;
                                                    context.drawImage(video, 0, 0, canvas.width, canvas.height);

                                                    const imageDataURL = canvas.toDataURL('image/png');

                                                    // Tampilkan preview gambar
                                                    const img = document.createElement('img');
                                                    img.src = imageDataURL;
                                                    previewContainer.appendChild(img);

                                                    // Buat objek File dari Data URL dan tambahkan ke input file
                                                    fetch(imageDataURL)
                                                        .then(res => res.blob())
                                                        .then(blob => {
                                                            const file = new File([blob], `image_${Date.now()}.png`, {
                                                                type: 'image/png'
                                                            });
                                                            const dataTransfer = new DataTransfer();
                                                            Array.from(fileInput.files).forEach(f => dataTransfer.items.add(f));
                                                            dataTransfer.items.add(file);
                                                            fileInput.files = dataTransfer.files;
                                                        });
                                                });

                                                // Tampilkan preview gambar yang dipilih dari file
                                                fileInput.addEventListener('change', event => {
                                                    const files = event.target.files;
                                                    previewContainer.innerHTML = ''; // Kosongkan preview container
                                                    Array.from(files).forEach(file => {
                                                        const reader = new FileReader();
                                                        reader.onload = function(e) {
                                                            const img = document.createElement('img');
                                                            img.src = e.target.result;
                                                            previewContainer.appendChild(img);
                                                        };
                                                        reader.readAsDataURL(file);
                                                    });
                                                });

                                                // Fungsi untuk menghentikan stream video
                                                function stopCamera() {
                                                    if (stream) {
                                                        stream.getTracks().forEach(track => track.stop());
                                                        video.style.display = 'none';
                                                        snapButton.style.display = 'none';
                                                        openCameraButton.style.display = 'block'; // Tampilkan tombol "Buka Kamera" lagi
                                                        closeCameraButton.style.display = 'none'; // Sembunyikan tombol "Matikan Kamera"
                                                    }
                                                }

                                                // Hentikan kamera ketika tombol "Matikan Kamera" ditekan
                                                closeCameraButton.addEventListener('click', stopCamera);

                                                // Hentikan kamera ketika halaman ditutup atau dimuat ulang
                                                window.addEventListener('beforeunload', stopCamera);
                                            </script>


                                        </div>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <a href="#" class="btn btn-outline-primary w-md">Kembali</a>
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                    </div>

                                </form>

                            </div>
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