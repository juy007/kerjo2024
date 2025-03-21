@include('user/header_start')
<!-- DataTables -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@5.2.2/dist/emoji-button.min.css">
<script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@5.2.2/dist/emoji-button.min.js"></script>

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
                    <h4 class="mb-sm-0 font-size-18">Data User</h4>

                    <div class="page-title-right">

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



                            <h3 class="mb-sm-0 font-size-18"><i class="mdi mdi-filter"></i> Filter</h3>
                            <hr>
                            <div id="filter" class="col-md-3 mb-3">
                            </div>

                            <div class="col-md-3 mb-3">
                                <input type="text" class="form-control" id="lokasiFilter" name="lokasi" placeholder="Lokasi">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" class="form-control" id="gajiFilter" name="gaji" oninput="formatCurrency(this)" placeholder="Gaji">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" class="form-control" id="pekerjaanFilter" name="pekerjaan" placeholder="Pekerjaan">
                            </div>
                            <div class="col-md-12 d-flex justify-content-center">
                                <button id="applyFilters" type="button" class="btn btn-secondary me-1"><i class="fa fas fa-search"></i> Cari</button>
                                <button id="resetFilters" type="button" class="btn btn-danger"><i class="mdi mdi-close-circle"></i> Reset</button>
                            </div>


                            <div id="show_data" class="col-md-6">

                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Gaji</th>
                                    <th>Pekerjaan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($users['findQuery'] as $dataUser)
                                <tr valign="middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <img src="{{ url('proxy-image/avatar/'. str_replace(['../public/upload/avatar/', './public/upload/avatar/'], '', $dataUser['avatar'] )) }}" class="avatar-md rounded-circle" alt="img" />
                                            <div class="flex-1 ms-4">
                                                <h5 class="mb-2 font-size-15 text-primary"><a href="">{{ $dataUser['name'] }}</a></h5>
                                                <p class="text-muted">{{ $dataUser['email'] }} | {{ $dataUser['phone'] ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $dataUser['location'] ?? '-' }}</td>
                                    <td></td>
                                    <td>{{ $dataUser['title'] ?? '-' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">Detail</a>

                                        <button type="button" class="btn btn-warning btn-sm openMessageModal"
                                            data-id="{{ $dataUser['_id'] }}"
                                            data-name="{{ $dataUser['name'] }}"
                                            data-avatar="{{ url('proxy-image/avatar/'. str_replace('../public/upload/avatar/', '', $dataUser['avatar'] )) }}">
                                            Message
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="messageModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <img id="modalAvatar" src="" alt="Avatar" class="rounded-circle avatar-md me-2">
                                            <span id="modalName"></span>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Alert Container -->
                                        <div id="modalAlertContainer"></div>

                                        <!-- Form -->
                                        <form id="messageForm">
                                            <input type="hidden" id="modalUserId" name="userId" value="{{ $dataUser['_id'] }}">
                                            <div class="mb-3">
                                                <textarea class="form-control mb-3" name="content" id="chatContent" rows="5" placeholder="Type your message..."></textarea>
                                            </div>

                                            <!-- Emoji Button & Submit Button -->
                                            <div class="d-flex gap-2 justify-content-end">
                                            <!--<button type="button" id="emojiPickerButton" class="btn btn-secondary">😀</button>-->
                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

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
<script src="{{ asset('assets/js/formCurrency.js') }}"></script>
<script src="{{ asset('assets/js/dataUser.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
        const modalUserId = document.getElementById('modalUserId');
        const modalName = document.getElementById('modalName');
        const modalAvatar = document.getElementById('modalAvatar');
        const chatContent = document.getElementById('chatContent');
        const alertContainer = document.getElementById('modalAlertContainer'); // Container untuk alert di dalam modal

        // Event listener untuk tombol membuka modal
        document.querySelectorAll('.openMessageModal').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                const userAvatar = this.getAttribute('data-avatar');

                modalUserId.value = userId;
                modalName.textContent = userName;
                modalAvatar.src = userAvatar;

                // Clear previous message dan alert
                chatContent.value = '';
                alertContainer.innerHTML = '';

                // Show the modal
                messageModal.show();
            });
        });

        // Event listener untuk form submit
        document.getElementById('messageForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const chatMessage = chatContent.value.trim(); // Trim untuk menghapus spasi berlebih

            // Validasi jika form kosong
            if (chatMessage === '') {
                showModalAlert('danger', 'Pesan tidak boleh kosong!');
                return; // Stop pengiriman jika kosong
            }

            // Ubah tombol menjadi "Mengirim..."
            submitButton.textContent = 'Mengirim...';
            submitButton.disabled = true;

            // Simulasi AJAX (ganti dengan endpoint API sebenarnya)
            fetch('{{ route("message_send") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        userId: modalUserId.value,
                        content: chatMessage
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showModalAlert('success', 'Pesan berhasil dikirim!');
                        chatContent.value = ''; // Reset textarea setelah sukses
                    } else {
                        showModalAlert('danger', 'Terjadi kesalahan, silakan coba lagi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showModalAlert('danger', 'Terjadi kesalahan jaringan, silakan coba lagi.');
                })
                .finally(() => {
                    // Kembalikan tombol ke teks awal
                    submitButton.textContent = 'Kirim';
                    submitButton.disabled = false;
                });
        });

        // Fungsi untuk menampilkan alert di dalam modal
        function showModalAlert(type, message) {
            const alertHTML = `
            <div class="alert alert-${type} alert-border-left alert-dismissible fade show" role="alert">
                <i class="mdi ${type === 'success' ? 'mdi-check-all' : 'mdi-block-helper'} me-3 align-middle"></i>
                <strong>${type === 'success' ? 'Success' : 'Error'}</strong> - ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;
            alertContainer.innerHTML = alertHTML;
        }
    });
</script>
</body>

</html>