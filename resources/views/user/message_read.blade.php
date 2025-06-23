@include('user/header_start')
<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
<link href="{{ asset('assets/css/emojiPicker.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/message2.css') }}" rel="stylesheet" type="text/css" />
@include('user/header_end')

<div class="page-content" style="background-color:#F4F7FE !important;">
    <div class="container-fluid">
        <div class="mx-auto w-md-50 mt-0 mt-md-4 px-0 px-md-3">
            <div class="card" id="zonaChat">
                <div class="p-3 px-lg-4 border-bottom">
                    <div class="row">
                        <div class="col-xl-4 col-5">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 avatar-sm me-3 d-sm-block d-none">
                                    <img
                                        src="{{ url('proxy-image/avatar/' . str_replace(['../public/upload/avatar/', './public/upload/avatar/'], '', $userData['avatar'])) }}"
                                        alt=""
                                        class="img-fluid d-block rounded-circle" />
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-14 mb-1 text-truncate">
                                        <a href="#" class="text-dark">{{ $userData['name'] ?? 'Unknown User' }}</a>
                                    </h5>
                                    <p class="text-muted text-truncate mb-0"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-5">
                            <!--
                            <ul class="list-inline user-chat-nav text-end mb-0">
                                <li class="list-inline-item">
                                    <div class="dropdown">
                                        <button
                                            class="btn nav-btn dropdown-toggle"
                                            type="button"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="bx bx-search"></i>
                                        </button>
                                        <div
                                            class="dropdown-menu dropdown-menu-end dropdown-menu-md p-2">
                                            <form class="px-2">
                                                <div>
                                                    <input
                                                        type="text"
                                                        class="form-control border bg-light-subtle"
                                                        placeholder="Search..." />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-inline-item">
                                    <div class="dropdown">
                                        <button
                                            class="btn nav-btn dropdown-toggle"
                                            type="button"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Profile</a>
                                            <a class="dropdown-item" href="#">Archive</a>
                                            <a class="dropdown-item" href="#">Muted</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            -->
                        </div>
                    </div>
                </div>

                <div id="chat-box" class="p-3" style="height: 320px; overflow-y: auto;">
                    <ul id="messages" class="list-unstyled mb-0">
                        <li id="loader" class="chat-day-title text-center" style="display: none;">
                            <span class="title">Memuat...</span>
                        </li>

                        @foreach($filteredMessages as $msg)
                        <li class="{{ $msg['user'] == session('user_id') ? 'left' : 'right' }}">
                            <div class="">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <div class="ctext-wrap position-relative">
                                            <div class="ctext-wrap-content">
                                                <div class="conversation-name d-flex justify-content-between align-items-center">
                                                    <span class="time">{{ \Carbon\Carbon::parse($msg['createdAt'])->format('d M Y, H:i') }}</span>
                                                 
                                                    @if ($msg['user'] != session('user_id'))
                                                    <span class="read-status ms-2">
                                                        @if ($msg['status'] === 'read')
                                                            <i class='fas fa-check-double' title="Dibaca"></i>
                                                        @else
                                                       
                                                            <i class="fas fa-check text-muted" title="Terkirim, belum dibaca"></i>
                                                        @endif

                                                    </span>
                                                    @endif
                                                </div>
                                                <p class="mb-0">{{ $msg['content'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </ul>
                </div>

                <div class="p-3 border-top">
                    <form class="row" id="messageForm">
                        <div class="col-auto">
                            <button
                                class="btn btn-warning waves-effect waves-light"
                                type="button"
                                id="emoji-btn">
                                😊
                            </button>
                            <emoji-picker id="picker" class="emoji-msg-read"></emoji-picker>
                        </div>
                        <div class="col">
                            <input type="hidden" id="userId" name="toId" value="{{ $userData['_id'] }}">
                            <div class="position-relative" id="emoji-container">
                                <textarea class="form-control border bg-light-subtle" id="chatContent" placeholder="Enter Message..."></textarea>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" id="sendButton" class="btn btn-primary chat-send w-md waves-effect waves-light">
                                <span class="d-none d-sm-inline-block me-2">Send</span><i class="mdi mdi-send float-end"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="d-lg-flex ">
        </div>
        <!-- End d-lg-flex  -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@include('user/footer')
<script src="{{ asset('assets/js/emojiPicker.js') }}"></script>
<script>
    window.ChatConfig = {
        currentUserId: "{{ session('user_id') }}",
        toId: "{{ $userData['_id'] }}",
        detailMessageUrl: "{{ route('detail_message', $userData['_id']) }}",
    };
</script>
<script src="{{ asset('assets/js/msg.js') }}"></script>

</body>

</html>