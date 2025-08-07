@include('user/header_start')
@include('user/header_end')

<div class="page-content" style="background-color:#F4F7FE !important;">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12 col-lg-8 mx-auto">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Message</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>

                </div>
            </div>

            <div class="col-12 col-lg-8 mx-auto">

                <div class="mb-3">

                    <div class="card">
                        <div class="btn-toolbar gap-2 p-3" role="toolbar">
                            <div class="p-3">
                                <div class="search-box position-relative">
                                    <input type="text" id="searchInput" class="form-control rounded border" placeholder="Search..." />
                                    <i class="bx bx-search search-icon"></i>
                                </div>
                            </div>
                        </div>

                        <ul class="message-list" id="contactList">
                            @forelse($contacts as $contact)
                            @if($contact['_id'] === session('user_id'))
                            @continue
                            @endif
                            <li class="{{ $contact['lastMessage']['isSender'] ? $contact['lastMessage']['status'] : 'read' }}">
                                <div class="col-mail col-mail-1">
                                    <a href="{{ route('detail_message', $contact['_id']) }}" class="title"  style="margin-left:-50px;">
                                        <img src="{{ url('proxy-image/avatar/' . str_replace(['../public/upload/avatar/', './public/upload/avatar/'], '', $contact['avatar'])) }}"
                                            class="rounded-circle avatar-sm" alt="{{ $contact['userName'] }}">
                                        &nbsp;&nbsp;&nbsp;{{ $contact['userName'] }}
                                    </a>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <a href="{{ route('detail_message', $contact['_id']) }}" class="subject">
                                        <span class="teaser">{{ Str::limit($contact['lastMessage']['content'], 30, '...') }}</span>
                                    </a>
                                    <div class="date">
                                        <span class="badge bg-secondary">
                                            {{ \Carbon\Carbon::parse($contact['lastMessage']['createdAt'])->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                            @empty
                            <li class="text-muted text-center p-3">Tidak ada pesan ditemukan</li>
                            @endforelse
                        </ul>
                    </div>

                    {{-- Pagination --}}
                    <div class="row mt-3 align-items-center">
                        <div class="col-md-6">
                            <p class="text-muted mb-0">
                                <!--Menampilkan {{-- $contacts->count() --}} dari {{-- $pagination['totalItem'] ?? 0 --}} pesan -->
                            </p>
                        </div>
                        <div class="col-md-6">
                            @php
                            $currentPage = $pagination['currentPage'] ?? 1;
                            $totalPages = $pagination['totalPages'] ?? 1;
                            @endphp

                            <div class="btn-group float-end">
                                <a href="{{ $currentPage > 1 ? route('index_message', ['page' => $currentPage - 1]) : '#' }}"
                                    class="btn btn-sm btn-primary waves-effect {{ $currentPage == 1 ? 'disabled' : '' }}">
                                    <i class="fa fa-chevron-left"></i>
                                </a>

                                <span class="btn btn-sm btn-light disabled">
                                    Halaman {{ $currentPage }} dari {{ $totalPages }}
                                </span>

                                <a href="{{ $currentPage < $totalPages ? route('index_message', ['page' => $currentPage + 1]) : '#' }}"
                                    class="btn btn-sm btn-primary waves-effect {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div> <!-- end Col-9 -->
            </div>
        </div>
        <!-- end page title -->

        <!--<div class="d-lg-flex">

            <div class="chat-leftsidebar card">
                <div class="p-3">
                    <div class="search-box position-relative">{{-- session('user_id') --}}
                        <input
                            type="text"
                            class="form-control rounded border"
                            placeholder="Search..." />
                        <i class="bx bx-search search-icon"></i>
                    </div>
                </div>

                <div class="chat-leftsidebar-nav">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="chat">
                            <div class="chat-message-list" data-simplebar style="max-height: 500px">
                                <div class="pt-3">
                                    

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="groups">
                            <div
                                class="chat-message-list"
                                data-simplebar
                                style="max-height: 500px">
                                <div class="pt-3">
                                    <div class="px-3">
                                        <h5 class="font-size-14 mb-3">Groups</h5>
                                    </div>
                                    <ul class="list-unstyled chat-list">
                                        <li>
                                            <a href="#">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-sm me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                            G
                                                        </span>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-13 mb-0">General</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-sm me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                            R
                                                        </span>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-13 mb-0">Reporting</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-sm me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                            M
                                                        </span>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-13 mb-0">Meeting</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-sm me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                            A
                                                        </span>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-13 mb-0">Project A</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-sm me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                            B
                                                        </span>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="font-size-13 mb-0">Project B</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="$contacts">
                            <div
                                class="chat-message-list"
                                data-simplebar
                                style="max-height: 500px">
                                <div class="pt-3">
                                    <div class="px-3">
                                        <h5 class="font-size-14 mb-3">$contacts</h5>
                                    </div>

                                    <div>
                                        <div>
                                            <div class="px-3 $contact-list">A</div>

                                            <ul class="list-unstyled chat-list">
                                                <li>
                                                    <a href="#">
                                                        <h5 class="font-size-13 mb-0">Adam Miller</h5>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <h5 class="font-size-13 mb-0">Alfonso Fisher</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mt-4">
                                            <div class="px-3 $contact-list">B</div>

                                            <ul class="list-unstyled chat-list">
                                                <li>
                                                    <a href="#">
                                                        <h5 class="font-size-13 mb-0">Bonnie Harney</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mt-4">
                                            <div class="px-3 $contact-list">C</div>

                                            <ul class="list-unstyled chat-list">
                                                <li>
                                                    <a href="#">
                                                        <h5 class="font-size-13 mb-0">Charles Brown</h5>
                                                    </a>
                                                    <a href="#">
                                                        <h5 class="font-size-13 mb-0">Carmella Jones</h5>
                                                    </a>
                                                    <a href="#">
                                                        <h5 class="font-size-13 mb-0">Carrie Williams</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="mt-4">
                                            <div class="px-3 $contact-list">D</div>

                                            <ul class="list-unstyled chat-list">
                                                <li>
                                                    <a href="#">
                                                        <h5 class="font-size-13 mb-0">Dolores Minter</h5>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 user-chat mt-4 mt-sm-0 ms-lg-1">
                <div class="card" id="zonaChat">
                    <div style="width:100%; height: 500px;">
                        <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
                            <img src="{{ url('proxy-image/company/src/ichat.png') }}" class="img-fluid w-50" alt="Responsive image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->
        <!-- End d-lg-flex  -->


        <!-- End d-lg-flex  -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@include('user/footer')
<script src="{{ asset('assets/js/cusMessage.js') }}"></script>
</body>

</html>