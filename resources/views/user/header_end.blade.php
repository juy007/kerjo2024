</head>
    <body  data-layout="horizontal" data-topbar="dark">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar" style="box-shadow: 0px 3px 5px #B8B7B7;">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{ route('dashboard_user') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ url('proxy-image/company/src/Kerjo sm.png') }}" alt="" height="27"><span class="logo-txt">ok</span>
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ url('proxy-image/company/src/Kerjo B2 1.png') }}" alt="" height="27"> <span class="logo-txt"></span>
                                </span>
                            </a>
                            <a href="{{ route('dashboard_user') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ url('proxy-image/company/src/Kerjo sm.png') }}" alt="" height="27"><span class="logo-txt">ok</span>
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ url('proxy-image/company/src/Kerjo B2 1.png') }}" alt="" height="27"> <span class="logo-txt"></span>
                                </span>
                            </a>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-inline-block">
                            <span><a class="text-dark" href="{{ route('index_job') }}">Lowongan</a></span>
                            <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="bell" class="icon-lg"></i>
                               
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <!--<a href="#!" class="small text-reset text-decoration-underline"> Unread (3)</a>-->
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/images/users/avatar-3.jpg') }}"
                                                class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">James Lemire</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">It will seem like simplified English.</p>
                                                   <!-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hours ago</span></p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-sm me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bx-cart"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your order is placed</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <!-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hours ago</span></p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-sm me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your item is shipped</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <!-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hours ago</span></p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/images/users/avatar-6.jpg') }}"
                                                class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Salena Layfield</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                    <!-- <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hours ago</span></p>-->
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!--
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span> 
                                    </a>
                                </div>-->
                            </div>
                        </div>

        
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{ url('proxy-image/logo/'. str_replace('../public/upload/logo/', '', session('company_logo') )) }}" alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium"></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                 
                                <a class="dropdown-item" href="{{ route('index_user') }}"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> User</a>
                                <a class="dropdown-item" href="{{ route('index_message') }}"><i class="mdi mdi-message font-size-16 align-middle me-1"></i> Message</a>
                                <!--<a class="dropdown-item" href="apps-contacts-profile.html"><i class="mdi mdi-image-multiple font-size-16 align-middle me-1"></i> Galeri</a>
                                <a class="dropdown-item" href="apps-contacts-profile.html"><i class="mdi mdi-fridge-industrial font-size-16 align-middle me-1"></i> Industri</a>
                                <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock screen</a>-->
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('user_logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</button>
                                </form>
                                
                            </div>
                        </div>
            
                    </div>
                </div>
            </header>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
             
            <div class="main-content">