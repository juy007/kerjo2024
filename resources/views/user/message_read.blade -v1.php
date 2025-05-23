@include('user/header_start')
<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
<link href="{{ asset('assets/css/emojiPicker.css') }}" rel="stylesheet" type="text/css" />
@include('user/header_end')

<div class="page-content" style="background-color:#F4F7FE !important;">
    <div class="container-fluid">

        <div class="d-lg-flex "><!--
            <div class="chat-leftsidebar card">
                <div class="p-3 px-4 border-bottom">
                    <div class="d-flex align-items-start ">
                        <div class="flex-grow-1">
                            <h5 class="font-size-16 mb-1">Message</h5>
                            <p class="text-muted mb-0"></p>
                        </div>
                    </div>
                </div>
                <div class="chat-leftsidebar-nav">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="chat">
                            <div class="chat-message-list" data-simplebar style="max-height: 500px;">
                                <ul class="list-unstyled chat-list">
                                    @foreach ($groupedMessages as $fromId => $messages)
                                    @php
                                    // Ambil pesan terbaru dari setiap pengirim
                                    $latestMessage = $messages->sortByDesc('createdAt')->first();
                                    @endphp
                                    <li class="{{ $latestMessage['status'] }}">
                                        <a href="{{ route('detail_message', $latestMessage['from']) }}">
                                            <div class="d-flex align-items-start">
                                              
                                                <div class="flex-shrink-0 user-img online align-self-center me-3">
                                                    <img src="{{ url('proxy-image/avatar/' . str_replace(['../public/upload/avatar/', './public/upload/avatar/'], '', $latestMessage['sender_avatar'])) }}" class="rounded-circle avatar-sm" alt="{{ $latestMessage['sender_name'] }}">
                                                    <span class="user-status"></span>
                                                </div>

                                              
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-13 mb-1">{{ $latestMessage['sender_name'] }}</h5>
                                                    <p class="text-truncate mb-0">{{ Str::limit($latestMessage['content'], 30, '...') }}</p>
                                                </div>

                                              
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

            </div>-->
            <!-- end chat-leftsidebar -->

            <div class="w-100 user-chat mt-4 mt-sm-0 ms-lg-1">
                <div class="card" id="zonaChat">
                    <div class="p-3 px-lg-4 border-bottom">
                        <div class="row">
                            <div class="col-xl-4 col-7">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 avatar-sm me-3 d-sm-block d-none">
                                        <img src="{{ url('proxy-image/avatar/' . str_replace(['../public/upload/avatar/', './public/upload/avatar/'], '', $latestMessage['sender_avatar'])) }}" alt="" class="img-fluid d-block rounded-circle">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-14 mb-1 text-truncate"><a href="#" class="text-dark">{{ $rUser['name'] ?? 'Unknown User' }}</a></h5>
                                        <p class="text-muted text-truncate mb-0"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-5">
                                <ul class="list-inline user-chat-nav text-end mb-0">
                                    <li class="list-inline-item">
                                        <div class="dropdown">
                                            <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-search"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-2">
                                                <form class="px-2">
                                                    <div>
                                                        <input type="text" class="form-control border bg-light-subtle" placeholder="Search...">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="list-inline-item">
                                        <div class="dropdown">
                                            <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

                    <div class="chat-conversation p-3" data-simplebar style="max-height: 550px;">
                        <ul class="list-unstyled mb-0">
                            <li class="chat-day-title">
                                <span class="title">Today</span>
                            </li>
                            <li>
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <img src="assets/images/users/avatar-3.jpg" class="rounded-circle avatar-sm" alt="">
                                        <div class="flex-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <div class="conversation-name"><span class="time">10:00 AM</span></div>
                                                    <p class="mb-0">Good Morning</p>
                                                </div>
                                                <div class="dropdown align-self-start">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Copy</a>
                                                        <a class="dropdown-item" href="#">Save</a>
                                                        <a class="dropdown-item" href="#">Forward</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </li>

                            <li class="right">
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <div class="flex-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <div class="conversation-name"><span class="time">10:02 AM</span></div>
                                                    <p class="mb-0">Good morning</p>
                                                </div>
                                                <div class="dropdown align-self-start">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Copy</a>
                                                        <a class="dropdown-item" href="#">Save</a>
                                                        <a class="dropdown-item" href="#">Forward</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="assets/images/users/avatar-6.jpg" class="rounded-circle avatar-sm" alt="">
                                    </div>

                                </div>

                            </li>

                            <li>
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <img src="assets/images/users/avatar-3.jpg" class="rounded-circle avatar-sm" alt="">
                                        <div class="flex-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <div class="conversation-name"><span class="time">10:04 AM</span></div>
                                                    <p class="mb-0">
                                                        Hi there, How are you?
                                                    </p>
                                                </div>
                                                <div class="dropdown align-self-start">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Copy</a>
                                                        <a class="dropdown-item" href="#">Save</a>
                                                        <a class="dropdown-item" href="#">Forward</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <img src="assets/images/users/avatar-3.jpg" class="rounded-circle avatar-sm" alt="">
                                        <div class="flex-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <div class="conversation-name"><span class="time">10:04 AM</span></div>
                                                    <p class="mb-0">
                                                        Waiting for your reply.As I heve to go back soon. i have to travel long distance.
                                                    </p>
                                                </div>
                                                <div class="dropdown align-self-start">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Copy</a>
                                                        <a class="dropdown-item" href="#">Save</a>
                                                        <a class="dropdown-item" href="#">Forward</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </li>

                            <li class="right">
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <div class="flex-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <div class="conversation-name"><span class="time">10:08 AM</span></div>
                                                    <p class="mb-0">
                                                        Hi, I am coming there in few minutes. Please wait!! I am in taxi right now.
                                                    </p>
                                                </div>
                                                <div class="dropdown align-self-start">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Copy</a>
                                                        <a class="dropdown-item" href="#">Save</a>
                                                        <a class="dropdown-item" href="#">Forward</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="assets/images/users/avatar-6.jpg" class="rounded-circle avatar-sm" alt="">
                                    </div>
                                </div>

                            </li>

                            <li>
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <img src="assets/images/users/avatar-3.jpg" class="rounded-circle avatar-sm" alt="">
                                        <div class="flex-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <div class="conversation-name"><span class="time">10:06 AM</span></div>
                                                    <p class="mb-0">
                                                        Thank You very much, I am waiting here at StarBuck cafe.
                                                    </p>
                                                </div>
                                                <div class="dropdown align-self-start">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Copy</a>
                                                        <a class="dropdown-item" href="#">Save</a>
                                                        <a class="dropdown-item" href="#">Forward</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </li>


                            <li>
                                <div class="conversation-list">
                                    <div class="d-flex">
                                        <img src="assets/images/users/avatar-3.jpg" class="rounded-circle avatar-sm" alt="">
                                        <div class="flex-1">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <div class="conversation-name"><span class="time">10:09 AM</span></div>
                                                    <p class="mb-0">
                                                        img-1.jpg & img-2.jpg images for a New Projects
                                                    </p>

                                                    <ul class="list-inline message-img mt-3  mb-0">
                                                        <li class="list-inline-item message-img-list">
                                                            <a class="d-inline-block m-1" href="">
                                                                <img src="assets/images/small/img-1.jpg" alt="" class="rounded img-thumbnail">
                                                            </a>
                                                        </li>

                                                        <li class="list-inline-item message-img-list">
                                                            <a class="d-inline-block m-1" href="">
                                                                <img src="assets/images/small/img-2.jpg" alt="" class="rounded img-thumbnail">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="dropdown align-self-start">
                                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#">Copy</a>
                                                        <a class="dropdown-item" href="#">Save</a>
                                                        <a class="dropdown-item" href="#">Forward</a>
                                                        <a class="dropdown-item" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="p-3 border-top">
                        <div class="row" id="messageForm">
                            <div class="col-auto">
                                <button class="btn btn-warning waves-effect waves-light" type="button" id="emoji-btn">😊</button>
                                <emoji-picker id="picker" class="emoji-msg-read"></emoji-picker>
                            </div>
                            <div class="col">
                                <div class="position-relative" id="emoji-container">
                                    <textarea class="form-control border bg-light-subtle" id="chatContent" placeholder="Enter Message..."></textarea>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary chat-send w-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send float-end"></i></button>
                            </div>
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
<script src="{{ asset('assets/js/emojiPicker.js') }}"></script>
</body>

</html>