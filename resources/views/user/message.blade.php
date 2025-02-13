@include('user/header_start')
@include('user/header_end')

<div class="page-content" style="background-color:#F4F7FE !important;">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Message</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="d-lg-flex">
            <div class="chat-leftsidebar card">
                <div class="p-3 px-4 border-bottom">
                    <div class="d-flex align-items-start ">
                        <div class="flex-grow-1">
                            <h5 class="font-size-16 mb-1">User</h5>
                            <p class="text-muted mb-0"></p>
                        </div>
                    </div>
                </div>
                <div class="chat-leftsidebar-nav">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="chat">
                            <div class="chat-message-list" data-simplebar style="max-height: 900px;">
                                <ul class="list-unstyled chat-list">
                                    @foreach ($groupedMessages as $fromId => $messages)
                                    @php
                                    // Ambil pesan terbaru dari setiap pengirim
                                    $latestMessage = $messages->sortByDesc('createdAt')->first();
                                    @endphp
                                    <li class="{{ $latestMessage['status'] }}">
                                        <a href="{{ route('detail_message', $latestMessage['from']) }}">
                                            <div class="d-flex align-items-start">
                                                <!-- Avatar Pengirim -->
                                                <div class="flex-shrink-0 user-img online align-self-center me-3">
                                                    <img src="{{ url('proxy-image/avatar/'. str_replace(['../public/upload/avatar/', './public/upload/avatar/'], '', $latestMessage['sender_avatar'] )) }}" class="rounded-circle avatar-sm" alt="{{ $latestMessage['sender_name'] }}">
                                                    <span class="user-status"></span>
                                                </div>

                                                <!-- Informasi Pesan -->
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-13 mb-1">{{ $latestMessage['sender_name'] }}</h5>
                                                    <p class="text-truncate mb-0">{{ Str::limit($latestMessage['content'], 30, '...') }}</p>
                                                </div>

                                                <!-- Waktu Pesan -->
                                                <div class="flex-shrink-0">
                                                    <div class="font-size-11">{{ \Carbon\Carbon::parse($latestMessage['createdAt'])->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end chat-leftsidebar -->

            <div class="w-100 user-chat mt-4 mt-sm-0 ms-lg-1">
                <div class="card" id="zonaChat">
                    <div style="width:100%; height: 500px;">
                        <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
                            <img src="{{ url('proxy-image/src/ichat.png') }}" class="img-fluid w-50" alt="Responsive image">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end user chat -->
        </div>
        <!-- End d-lg-flex  -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

@include('user/footer')
</body>

</html>