</head>

    <body data-topbar="dark" class="pace-done pace-done sidebar-enable" data-sidebar-size="lg">

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo/Kerjo B2 1.png') }}" alt="" height="30">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo/Kerjo B2 1.png') }}" alt="" height="24"> <span class="logo-txt">Dason</span>
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo/Kerjo B2 1.png') }}" alt="" height="30">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo/Kerjo B2 1.png') }}" alt="" height="24"> <span class="logo-txt">Dason</span>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block">
                            <!--
                            <button type="button" class="btn header-item right-bar-toggle me-2">
                                <i data-feather="settings" class="icon-lg"></i>
                            </button>
                            -->
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium">Administrator</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                 <!--
                                <a class="dropdown-item" href="apps-contacts-profile.html"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                                <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> Lock screen</a>
                                <div class="dropdown-divider"></div>
                                -->
                                <form action="{{ route('admin_logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100 simplebar-scrollable-y">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" data-key="t-menu">Menu</li>

                            <li>
                                <a href="{{ route('admin_dashboard') }}">
                                    <i data-feather="home"></i>
                                    <span data-key="t-dashboard">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.companies.index') }}">
                                    <i class="mdi mdi-fridge-industrial"></i>
                                    <span data-key="t-chat">Company</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i data-feather="crosshair"></i>
                                    <span data-key="t-ecommerce">Job</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('admin.job-statuses.index') }}" key="t-products">Job Statuses</a></li>
                                    <li><a href="{{ route('admin.job-levels.index') }}" data-key="t-product-detail">Job Levels</a></li>
                                    <li><a href="{{ route('admin.job-types.index') }}" data-key="t-customers">Job Types</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('admin.industries.index') }}">
                                    <i class="mdi mdi-robot-industrial"></i>
                                    <span data-key="t-chat">Industries</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.categories.index') }}">
                                    <i class="mdi mdi-apps"></i>
                                    <span data-key="t-chat">Categories</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.provinces.index') }}">
                                    <i class="mdi mdi-map-marker-radius"></i>
                                    <span data-key="t-chat">Provinces</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.currencies.index') }}">
                                    <i class="mdi mdi-currency-usd-circle"></i>
                                    <span data-key="t-chat">Currencies</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">