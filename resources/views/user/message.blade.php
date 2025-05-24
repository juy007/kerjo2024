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
                                <div class="search-box position-relative">{{-- session('user_id') --}}
                                    <input
                                        type="text"
                                        class="form-control rounded border"
                                        placeholder="Search..." />
                                    <i class="bx bx-search search-icon"></i>
                                </div>
                            </div>
                        </div>
                        <ul class="message-list">
                           @forelse($contacts as $contact)
                            <li  class="{{ $contact['from'] == session('user_id') ? 'read' : $contact['status'] }}">
                                <div class="col-mail col-mail-1">
                                    <a href="{{ route('detail_message', $contact['contact_id']) }}" class="title">
                                        <img src="{{ url('proxy-image/avatar/'. str_replace(['../public/upload/avatar/', './public/upload/avatar/'], '', $contact['sender_avatar'] )) }}" class="rounded-circle avatar-sm" alt="{{ $contact['sender_name'] }}">
                                        &nbsp;&nbsp;&nbsp;{{ $contact['sender_name'] }}
                                    </a>
                                </div>
                                <div class="col-mail col-mail-2">
                                    <a href="{{ route('detail_message', $contact['contact_id']) }}" class="subject"><span class="teaser">{{ Str::limit($contact['content'], 30, '...') }}</span>
                                    </a>
                                    <div class="date">{{ \Carbon\Carbon::parse($contact['createdAt'])->diffForHumans() }}</div>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                    </div> <!-- card -->

                    <div class="row">
                        <div class="col-7">
                            Showing 1 - 20 of 1,524
                        </div>
                        <div class="col-5">
                            <div class="btn-group float-end">
                                <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-left"></i></button>
                                <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-right"></i></button>
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
</body>

</html>