@include('account/header_start')
@include('account/header_end')

<div class="progress progress-sm progress-t">
    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h4 class="font-size-18">Pilih Industri Perusahaan Anda</h4>
                    <p class="text-mute">Pilih industri yang paling cocok untuk mendeskripsikan perusahaan Anda.</p>

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
                        <div class="col-sm-12">
                            <form method="POST" action="{{ route('submit_company_profile_part1') }}" class="col-sm-7" style="margin-left:auto;margin-right:auto;" id="industryForm" enctype="multipart/form-data">@csrf
                                <div class="flex-wrap gap-3 mb-3">
                                    @if($industries['list'] && count($industries) > 0)
                                    <div class="" role="group" aria-label="Basic checkbox toggle button group">
                                        @foreach($industries['list'] as $industry)
                                            <input type="checkbox" class="btn-check" id="btncheck{{ $industry['_id'] }}" name="industries[]" value="{{ $industry['_id'] }}" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="btncheck{{ $industry['_id'] }}">{{ $industry['name'] }}</label>
                                        @endforeach
                                    @else
                                        <p>No industries found.</p>
                                    @endif
                                    </div>
                                </div>
                               
                                <div id="message" class="message hidden"></div>
                                <button class="btn btn-primary w-25 waves-effect waves-light" type="submit">Lanjut</button>
                            </form>
                            <script>
                                // Validasi form checkbox industries
                                document.addEventListener('DOMContentLoaded', () => {
                                    const form = document.getElementById('industryForm');
                                    const message = document.getElementById('message');

                                    form.addEventListener('submit', (event) => {
                                        const checkboxes = document.querySelectorAll('input[name="industries[]"]');
                                        let isChecked = false;

                                        // Loop untuk mengecek apakah ada checkbox yang dipilih
                                        checkboxes.forEach(checkbox => {
                                            if (checkbox.checked) {
                                                isChecked = true;
                                            }
                                        });

                                        // Jika tidak ada checkbox yang dipilih
                                        if (!isChecked) {
                                            message.textContent = 'Please select at least one industry.';
                                            message.className = 'message error';
                                            message.classList.remove('hidden');
                                            event.preventDefault(); // Prevent form submission
                                            return; // Stop further execution
                                        } else {
                                            message.textContent = 'Validation successful, continue!';
                                            message.className = 'message success';
                                            message.classList.remove('hidden');
                                            // Tidak perlu memanggil event.preventDefault() karena validasi berhasil
                                        }
                                    });
                                });
                            </script>

                            <style>
                                /*notif repassword*/
                                .hidden {
                                    display: none;
                                }

                                .message {
                                    padding: 10px;
                                    margin-top: 10px;
                                    border-radius: 5px;
                                    font-weight: bold;
                                    animation: fadeIn 0.5s ease-in-out;
                                    width: 50%;
                                    margin-left: auto;
                                    margin-right: auto;
                                    margin-bottom: 10px;
                                }

                                .message.success {
                                    background-color: #d4edda;
                                    color: #155724;
                                    border: 1px solid #c3e6cb;
                                }

                                .message.error {
                                    background-color: #f8d7da;
                                    color: #721c24;
                                    border: 1px solid #f5c6cb;
                                }

                                @keyframes fadeIn {
                                    from {
                                        opacity: 0;
                                    }

                                    to {
                                        opacity: 1;
                                    }
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
@include('account/footer_start')
@include('account/footer_end')