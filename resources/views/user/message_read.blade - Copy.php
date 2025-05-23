@include('user/header_start')
<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
<link href="{{ asset('assets/css/emojiPicker.css') }}" rel="stylesheet" type="text/css" />
@include('user/header_end')

<div class="page-content" style="background-color:#F4F7FE !important;">
    <div class="container-fluid">



        <style>
            .w-md-50 {
                width: 100%;
                /* Default untuk mobile (di bawah 768px) */
            }

            @media (min-width: 768px) {
                .w-md-50 {
                    width: 75%;
                    margin-top: 1.5rem;
                    /* opsional, jika ingin seperti mt-4 */
                    padding-left: 1rem;
                    padding-right: 1rem;
                }
            }
        </style>
        <div class="mx-auto w-md-50 mt-0 mt-md-4 px-0 px-md-3">
            <div class="card" id="zonaChat">
                <div class="p-3 px-lg-4 border-bottom">
                    <div class="row">
                        <div class="col-xl-4 col-5">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 avatar-sm me-3 d-sm-block d-none">
                                    <img
                                        src="{{ url('proxy-image/avatar/' . str_replace(['../public/upload/avatar/', './public/upload/avatar/'], '', $rUser['avatar'])) }}"
                                        alt=""
                                        class="img-fluid d-block rounded-circle" />
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-14 mb-1 text-truncate">
                                        <a href="#" class="text-dark">{{ $rUser['name'] ?? 'Unknown User' }}</a>
                                    </h5>
                                    <p class="text-muted text-truncate mb-0"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-5">
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
                        </div>
                    </div>
                </div>

                <div id="chat-box" class="chat-conversation p-3" data-simplebar style="height: 130px">
                    <ul id="messages" class="list-unstyled mb-0">
                        <li class="chat-day-title">
                            <span class="title">Today</span>
                        </li>

                        @foreach($filteredMessages->reverse() as $msg)
                        <li class="{{ $msg['from'] == session('user_id') ? 'right' : 'left' }}">
                            <div class="conversation-list">
                                <div class="d-flex">
                                    <div class="flex-1">
                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content">
                                                <div class="conversation-name">
                                                    <span class="time">{{ \Carbon\Carbon::parse($msg['createdAt'])->format('d M Y, H:i') }}</span>
                                                </div>
                                                <p class="mb-0">{{ $msg['content'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        @endforeach
                        <li id="loader" class="chat-day-title">
                            <span class="title">Memuat...</span>
                        </li>
                    </ul>
                </div>

                <div class="p-3 border-top">
                    <div class="row" id="messageForm">
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
                            <div class="position-relative" id="emoji-container">
                                <textarea
                                    class="form-control border bg-light-subtle"
                                    id="chatContent"
                                    placeholder="Enter Message..."></textarea>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button
                                type="submit"
                                class="btn btn-primary chat-send w-md waves-effect waves-light">
                                <span class="d-none d-sm-inline-block me-2">Send</span>
                                <i class="mdi mdi-send float-end"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const currentUserId = "{{ session('user_id') }}";
                let page = 1;
                let hasMore = true;
                const chatBox = document.getElementById('chat-box');
                const messagesContainer = document.getElementById('messages');
                const loader = document.getElementById('loader');

                // Simpan tinggi scroll sebelum menambah pesan baru
                function loadMoreMessages() {
                    loader.style.display = 'block';
                    const previousScrollHeight = chatBox.scrollHeight;

                    page++;

                    fetch(`{{ route('detail_message', $rUser['_id']) }}?page=${page}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            loader.style.display = 'none';
                            if (!data.messages || data.messages.length === 0) {
                                hasMore = false;
                                return;
                            }

                            data.messages.reverse().forEach(msg => {
                                const li = document.createElement('li');
                                li.className = (msg.from === currentUserId ? 'right' : 'left');
                                li.innerHTML = `
                        <div class="conversation-list">
                            <div class="d-flex">
                                <div class="flex-1">
                                    <div class="ctext-wrap">
                                        <div class="ctext-wrap-content">
                                            <div class="conversation-name">
                                                <span class="time">${new Date(msg.createdAt).toLocaleString('id-ID')}</span>
                                            </div>
                                            <p class="mb-0">${msg.content}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                                messagesContainer.insertBefore(li, messagesContainer.firstChild);
                            });

                            // Kembalikan posisi scroll seperti semula
                            chatBox.scrollTop = chatBox.scrollHeight - previousScrollHeight;
                        })
                        .catch(err => {
                            console.error('Gagal memuat pesan:', err);
                            loader.style.display = 'none';
                        });
                }

                // Scroll event listener
                chatBox.addEventListener('scroll', function() {
                    if (chatBox.scrollTop <= 50 && hasMore) {
                        loadMoreMessages();
                    }
                });

                // Scroll ke bawah saat awal
                chatBox.scrollTop = chatBox.scrollHeight;
            });
        </script>
        <div class="d-lg-flex ">
        </div>
        <!-- End d-lg-flex  -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@include('user/footer')
<script src="{{ asset('assets/js/emojiPicker.js') }}"></script>
</body>

</html>