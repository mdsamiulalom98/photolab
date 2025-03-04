<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <title>@yield('title') - {{ $generalsetting->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset($generalsetting->favicon) }}" />

    <!-- Bootstrap css -->
    <link href="{{ asset('public/backEnd/') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('public/backEnd/') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/all.min.css') }}" />
    <!-- icons -->
    <link href="{{ asset('public/backEnd/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backEnd/') }}/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet"
        type="text/css" />
    <!-- toastr css -->
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/assets/css/toastr.min.css" />
    <!-- custom css -->
    <link href="{{ asset('public/backEnd/') }}/assets/css/custom.css?v=1.0.1" rel="stylesheet" type="text/css" />
    <!-- Head js -->
    @yield('css')
    <script src="{{ asset('public/backEnd/') }}/assets/js/head.js"></script>
</head>

<!-- body start -->

<body data-layout-mode="default" data-theme="light" data-layout-width="fluid" data-topbar-color="dark"
    data-menu-position="fixed" data-leftbar-color="light" data-leftbar-size="default" data-sidebar-user="false">
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-end mb-0">
                    <li class="dropdown d-inline-block d-lg-none">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <i class="fe-search noti-icon"></i>
                        </a>
                        <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                            <form class="p-3">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username" />
                            </form>
                        </div>
                    </li>

                    <li class="dropdown d-none d-lg-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                            href="#">
                            <i class="fe-maximize noti-icon"></i>
                        </a>
                    </li>

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fe-bell noti-icon"></i>
                            <span class="badge bg-danger rounded-circle noti-icon-badge">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-end">
                                        <a href="" class="text-dark">
                                            <small>View All</small>
                                        </a>
                                    </span>
                                    Orders
                                </h5>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fe-message-square noti-icon"></i>
                            <span
                                class="badge bg-danger rounded-circle noti-icon-badge">{{ $pending_messages->count() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-end">
                                        <a href="" class="text-dark">
                                            <small>View All</small>
                                        </a>
                                    </span>
                                    Orders
                                </h5>
                            </div>

                            <div class="noti-scroll" data-simplebar>
                                @foreach ($pending_messages as $pending)
                                    <!-- item-->
                                    <a href="{{ route('admin.order.details', ['id' => $pending->order_id]) }}"
                                        class="dropdown-item notify-item active">
                                        <div class="notify-icon">
                                            <img src="{{ asset($pending->member->image ?? '') }}"
                                                class="img-fluid rounded-circle" alt="" />
                                        </div>
                                        <p class="notify-details">{{ $pending->member->name ?? '' }}
                                        </p>
                                        <p class="text-muted mb-0 user-msg">
                                            <small>Message : {{ $pending->message }}</small>
                                        </p>
                                    </a>
                                @endforeach

                                <!-- item-->
                            </div>
                        </div>
                    </li>

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <img src="{{ asset(Auth::user()->image) }}" alt="user-image" class="rounded-circle" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="{{ route('dashboard') }}" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>Dashboard</span>
                            </a>

                            <!-- item-->
                            <a href="{{ route('change_password') }}" class="dropdown-item notify-item">
                                <i class="fe-settings"></i>
                                <span>Change Password</span>
                            </a>

                            <!-- item-->
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"
                                class="dropdown-item notify-item">
                                <i class="fe-lock"></i>
                                <span>Lock Screen</span>
                            </a>
                            <!-- item-->

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"
                                class="dropdown-item notify-item">
                                <i class="fe-log-out me-1"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>

                <!-- LOGO -->
                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        <!-- Mobile menu toggle (Horizontal Layout)-->
                        <a class="navbar-toggle nav-link" data-bs-toggle="collapse"
                            data-bs-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                    <li class="dropdown d-none d-xl-block">
                        <a class="nav-link dropdown-toggle waves-effect waves-light " href="{{ route('home') }}"
                            target="_blank"> <span class="btn btn-success waves-effect waves-light  rounded-pill"> <i
                                    data-feather="airplay"></i> Visit Site</span> </a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">
            <div class="h-100" data-simplebar>
                <!-- User box -->
                <div class="user-box text-center">
                    <img src="{{ asset('public/backEnd/') }}/assets/images/users/user-1.jpg" alt="user-img"
                        class="rounded-circle avatar-md" />
                    <div class="dropdown">
                        <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                            data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu user-pro-dropdown">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-user me-1"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings me-1"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-lock me-1"></i>
                                <span>Lock Screen</span>
                            </a>

                            <!-- item-->
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                                class="dropdown-item notify-item">
                                <i class="fe-log-out me-1"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <p class="text-muted">Admin Head</p>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <div class="main-logo">
                        <a href="{{ url('admin/dashboard') }}">
                            <img src="{{ asset($generalsetting->white_logo) }}" alt="">
                        </a>
                    </div>
                    <ul id="side-menu">
                        @php
                            $trial_orders = \App\Models\TrialOrder::select('id', 'type');
                            $free_trial_count = (clone $trial_orders)
                                ->where(['type' => 'free-trial', 'seen' => 0])
                                ->count();
                            $get_quote_count = (clone $trial_orders)
                                ->where(['type' => 'get-quote', 'seen' => 0])
                                ->count();
                        @endphp
                        <li>
                            <a href="{{ url('admin/dashboard') }}">
                                <i data-feather="home"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.trial', 'get-quote') }}" class="d-flex align-items-center">
                                <i class="fa-quote-left fa-solid"></i>
                                <span>Get Quote</span>
                                <span class="badge bg-danger ms-auto mt-0"
                                    style="padding: 4px 6px 2px;">{{ $get_quote_count }} </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.trial', 'free-trial') }}" class="d-flex align-items-center">
                                <i class="fa-solid fa-gift"></i>
                                <span> Free Trial </span>
                                <span class="badge bg-danger ms-auto mt-0"
                                    style="padding: 4px 6px 2px;">{{ $free_trial_count }} </span>
                            </a>
                        </li>

                        <!-- nav items -->
                        @php
                            $sellerorders = \App\Models\Order::select('id', 'order_type', 'order_status');
                        @endphp
                        <li>
                            <a href="#sidebar-createOrders" data-bs-toggle="collapse">
                                <i data-feather="shopping-cart"></i>
                                <span> Seller Orders </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-createOrders">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('admin.order.create', ['type' => 'seller']) }}"><i
                                                data-feather="minus"></i> Seller Order</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.orders', ['slug' => 'all', 'type' => 'seller']) }}"
                                            class="d-flex align-items-center">
                                            <i data-feather="minus"></i>
                                            <span>All Order </span>
                                            <span class="badge bg-danger ms-auto mt-0" style="padding: 4px 6px 2px;">
                                                {{ $sellerorders->where('order_type', 'seller')->count() }}
                                            </span>
                                        </a>
                                    </li>
                                    @foreach ($orderstatus as $value)
                                        @php
                                            $order_count = $value->orders()->where('order_type', 'seller')->count();
                                        @endphp
                                        <li>
                                            <a href="{{ route('admin.orders', ['slug' => $value->slug, 'type' => 'seller']) }}"
                                                class="d-flex align-items-center">
                                                <i data-feather="minus"></i>
                                                <span>{{ $value->name }}</span>
                                                <span class="badge bg-info ms-auto mt-0"
                                                    style="padding: 4px 6px 2px;">
                                                    {{ $order_count }}
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                    <li>
                                        <a href="{{ route('admin.orders.invoice_generate', 'seller') }}"
                                            class="d-flex align-items-center">
                                            <i data-feather="minus"></i>
                                            <span>Invoice Generate </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.orders.payment', 'seller') }}"
                                            class="d-flex align-items-center">
                                            <i data-feather="minus"></i>
                                            <span>Payment</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items -->
                        @php
                            $buyerorders = \App\Models\Order::select('id', 'order_type', 'order_status');
                        @endphp
                        <li>
                            <a href="#sidebar-orders" data-bs-toggle="collapse">
                                <i data-feather="shopping-cart"></i>
                                <span> Buyer Orders </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-orders">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('admin.orders', ['slug' => 'all', 'type' => 'buyer']) }}"
                                            class="d-flex align-items-center">
                                            <i data-feather="minus"></i>
                                            <span>All Order </span>
                                            <span class="badge bg-danger ms-auto mt-0" style="padding: 4px 6px 2px;">
                                                {{ $buyerorders->where('order_type', 'buyer')->count() }}
                                            </span>
                                        </a>
                                    </li>
                                    @foreach ($orderstatus as $value)
                                        <li>
                                            @php
                                                $order_count = $value->orders()->where('order_type', 'buyer')->count();
                                            @endphp

                                            <a href="{{ route('admin.orders', ['slug' => $value->slug, 'type' => 'buyer']) }}"
                                                class="d-flex align-items-center">
                                                <i data-feather="minus"></i>
                                                <span>{{ $value->name }}</span>
                                                <span class="badge bg-info ms-auto mt-0"
                                                    style="padding: 4px 6px 2px;">
                                                    {{ $order_count }}
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                    <li>
                                        <a href="{{ route('admin.orders.invoice_generate', 'buyer') }}"
                                            class="d-flex align-items-center">
                                            <i data-feather="minus"></i>
                                            <span>Invoice Generate </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.orders.payment', 'buyer') }}"
                                            class="d-flex align-items-center">
                                            <i data-feather="minus"></i>
                                            <span>Payment</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items -->

                        <li>
                            <a href="#sidebar-users" data-bs-toggle="collapse">
                                <i data-feather="user"></i>
                                <span> Admin & Permission </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-users">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('users.index') }}"><i data-feather="minus"></i>
                                            User</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('roles.index') }}"><i data-feather="minus"></i>
                                            Roles</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('permissions.index') }}"><i data-feather="minus"></i>
                                            Permissions</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items -->

                        <li>
                            <a href="#sidebar-sellers" data-bs-toggle="collapse">
                                <i data-feather="users"></i>
                                <span> Sellers </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-sellers">
                                <ul class="nav-second-level">
                                    <li>
                                        <a
                                            href="{{ route('admin.members.index', ['member' => 'seller', 'status' => 'pending']) }}"><i
                                                data-feather="minus"></i>
                                            Pending Sellers</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('admin.members.index', ['member' => 'seller', 'status' => 'active']) }}"><i
                                                data-feather="minus"></i>
                                            All Sellers</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items -->

                        <li>
                            <a href="#sidebar-buyers" data-bs-toggle="collapse">
                                <i data-feather="users"></i>
                                <span> Buyers </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-buyers">
                                <ul class="nav-second-level">
                                    <li>
                                        <a
                                            href="{{ route('admin.members.index', ['member' => 'buyer', 'status' => 'pending']) }}"><i
                                                data-feather="minus"></i>
                                            Pending Buyers</a>
                                    </li>
                                    <li>
                                        <a
                                            href="{{ route('admin.members.index', ['member' => 'buyer', 'status' => 'active']) }}"><i
                                                data-feather="minus"></i>
                                            All Buyers</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items -->
                        <li>
                            <a href="#sidebar-slider" data-bs-toggle="collapse">
                                <i data-feather="image"></i>
                                <span> Slider </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-slider">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('slider.create') }}"><i data-feather="minus"></i>
                                            Create</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('slider.index') }}"><i data-feather="minus"></i>
                                            Manage</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->
                        <li>
                            <a href="#sidebar-service" data-bs-toggle="collapse">
                                <i data-feather="list"></i>
                                <span> Service </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-service">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('service.create') }}"><i data-feather="minus"></i>
                                            Create</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('service.index') }}"><i data-feather="minus"></i>
                                            Manage</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->
                        <li>
                            <a href="#sidebar-work" data-bs-toggle="collapse">
                                <i data-feather="list"></i>
                                <span> Work Name </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-work">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('worknames.create') }}"><i data-feather="minus"></i>
                                            Create</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('worknames.index') }}"><i data-feather="minus"></i>
                                            Manage</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->
                        <li>
                            <a href="#sidebar-whychoose" data-bs-toggle="collapse">
                                <i data-feather="check-circle"></i>
                                <span> Why Choose </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-whychoose">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('whychoose.create') }}"><i data-feather="minus"></i>
                                            Create</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('whychoose.index') }}"><i data-feather="minus"></i>
                                            Manage</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->
                        <li>
                            <a href="#sidebar-counter" data-bs-toggle="collapse">
                                <i data-feather="package"></i>
                                <span> Counter </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-counter">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('counter.create') }}"><i data-feather="minus"></i>
                                            Create</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('counter.index') }}"><i data-feather="minus"></i>
                                            Manage</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->
                        <li>
                            <a href="#sidebar-company" data-bs-toggle="collapse">
                                <i data-feather="package"></i>
                                <span> About Company </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-company">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('abouts.index') }}"><i data-feather="minus"></i> About
                                            Us</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('missionvission.index') }}"><i data-feather="minus"></i>
                                            Mission & Vision</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('teams.index') }}"><i data-feather="minus"></i>
                                            Team</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sectiondescriptions.index') }}"><i
                                                data-feather="minus"></i>
                                            Section Description</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->
                        <li>
                            <a href="#sidebar-blog" data-bs-toggle="collapse">
                                <i data-feather="edit"></i>
                                <span> BLog </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-blog">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('blog_category.index') }}"><i data-feather="minus"></i>
                                            Blog Category</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blogs.index') }}"><i data-feather="minus"></i>
                                            Blog</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->

                        <li>
                            <a href="#sidebar-brand" data-bs-toggle="collapse">
                                <i data-feather="book"></i>
                                <span> Brand </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-brand">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('brands.create') }}"><i data-feather="minus"></i>
                                            Create</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('brands.index') }}"><i data-feather="minus"></i> Manage</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->
                        <li>
                            <a href="#sidebar-testimonial" data-bs-toggle="collapse">
                                <i data-feather="book"></i>
                                <span> Testimonial </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-testimonial">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('testimonials.create') }}"><i data-feather="minus"></i>
                                            Create</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('testimonials.index') }}"><i data-feather="minus"></i>
                                            Manage</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->
                        <li>
                            <a href="#sidebar-faq" data-bs-toggle="collapse">
                                <i data-feather="book"></i>
                                <span> FAQ </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-faq">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('faqs.create') }}"><i data-feather="minus"></i>
                                            Create</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('faqs.index') }}"><i data-feather="minus"></i> Manage</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->
                        <li>
                            <a href="#sidebar-howitwork" data-bs-toggle="collapse">
                                <i data-feather="book"></i>
                                <span> How It Works </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-howitwork">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('howitworks.create') }}"><i data-feather="minus"></i>
                                            Create</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('howitworks.index') }}"><i data-feather="minus"></i>
                                            Manage</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->
                        <li>
                            <a href="#sidebar-portfolio" data-bs-toggle="collapse">
                                <i data-feather="book"></i>
                                <span> Portfolio </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-portfolio">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('portfolios.index') }}"><i data-feather="minus"></i>
                                            Portfolio</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('portfolio_category.index') }}"><i
                                                data-feather="minus"></i>
                                            Portfolio Category</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->

                        <li>
                            <a href="#sidebar-banner" data-bs-toggle="collapse">
                                <i data-feather="image"></i>
                                <span> Banner & Ads </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-banner">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('banner_category.index') }}"><i data-feather="minus"></i>
                                            Banner Category</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('banners.index') }}"><i data-feather="minus"></i>
                                            Banner & Ads</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->

                        <li>
                            <a href="#sidebar-sitesetting" data-bs-toggle="collapse">
                                <i data-feather="settings"></i>
                                <span> Website Setting </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-sitesetting">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('settings.index') }}"><i data-feather="minus"></i>
                                            General Setting</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('socialmedias.index') }}"><i data-feather="minus"></i>
                                            Social Media</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact.index') }}"><i data-feather="minus"></i>
                                            Contact</a>
                                    </li>

                                    <li>
                                        <a href="{{ route('pages.index') }}"><i data-feather="minus"></i> Create
                                            Page</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('menu_setup.index') }}"><i data-feather="minus"></i> Menu
                                            Setup</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->
                        <li>
                            <a href="#sidebar-contactinfo" data-bs-toggle="collapse">
                                <i data-feather="settings"></i>
                                <span> Contact Data </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebar-contactinfo">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('contactdatas.index') }}"><i data-feather="minus"></i>
                                            Contact Data</a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <!-- nav items end -->
                        <li>
                            <a href="{{ url('cc') }}">
                                <i data-feather="trash"></i>
                                <span> Cache Clear </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -left -->
        </div>
        <!-- Left Sidebar End -->

        <div class="content-page">
            <div class="content">
                @yield('content')
            </div>
            <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 text-end">&copy; {{ $generalsetting->name }} <a
                                href="https://websolutionit.com" target="_blank">Websolution IT</a></div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->
        </div>
    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link py-2" data-bs-toggle="tab" href="#chat-tab" role="tab">
                        <i class="mdi mdi-message-text d-block font-22 my-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-2" data-bs-toggle="tab" href="#tasks-tab" role="tab">
                        <i class="mdi mdi-format-list-checkbox d-block font-22 my-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-2 active" data-bs-toggle="tab" href="#settings-tab" role="tab">
                        <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content pt-0">
                <div class="tab-pane" id="chat-tab" role="tabpanel">
                    <form class="search-bar p-3">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search..." />
                            <span class="mdi mdi-magnify"></span>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" id="tasks-tab" role="tabpanel">
                    <h6 class="fw-medium p-3 m-0 text-uppercase">Working Tasks</h6>
                </div>
                <div class="tab-pane active" id="settings-tab" role="tabpanel">
                    <h6 class="fw-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                        <span class="d-block py-1">Theme Settings</span>
                    </h6>

                    <div class="p-3">
                        <div class="alert alert-warning" role="alert"><strong>Customize </strong> the overall color
                            scheme, sidebar menu, etc.</div>

                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-color" value="light"
                                id="light-mode-check" checked />
                            <label class="form-check-label" for="light-mode-check">Light Mode</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-color" value="dark"
                                id="dark-mode-check" />
                            <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                        </div>

                        <!-- Width -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Width</h6>
                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-width" value="fluid"
                                id="fluid-check" checked />
                            <label class="form-check-label" for="fluid-check">Fluid</label>
                        </div>
                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-width" value="boxed"
                                id="boxed-check" />
                            <label class="form-check-label" for="boxed-check">Boxed</label>
                        </div>

                        <!-- Menu positions -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="menu-position" value="fixed"
                                id="fixed-check" checked />
                            <label class="form-check-label" for="fixed-check">Fixed</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="menu-position" value="scrollable"
                                id="scrollable-check" />
                            <label class="form-check-label" for="scrollable-check">Scrollable</label>
                        </div>

                        <!-- Left Sidebar-->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Color</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="light"
                                id="light-check" />
                            <label class="form-check-label" for="light-check">Light</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="dark"
                                id="dark-check" checked />
                            <label class="form-check-label" for="dark-check">Dark</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="brand"
                                id="brand-check" />
                            <label class="form-check-label" for="brand-check">Brand</label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="gradient"
                                id="gradient-check" />
                            <label class="form-check-label" for="gradient-check">Gradient</label>
                        </div>

                        <!-- size -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Size</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-size" value="default"
                                id="default-size-check" checked />
                            <label class="form-check-label" for="default-size-check">Default</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-size" value="condensed"
                                id="condensed-check" />
                            <label class="form-check-label" for="condensed-check">Condensed <small>(Extra Small
                                    size)</small></label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-size" value="compact"
                                id="compact-check" />
                            <label class="form-check-label" for="compact-check">Compact <small>(Small
                                    size)</small></label>
                        </div>

                        <!-- User info -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="sidebar-user" value="fixed"
                                id="sidebaruser-check" />
                            <label class="form-check-label" for="sidebaruser-check">Enable</label>
                        </div>

                        <!-- Topbar -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Topbar</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="topbar-color" value="dark"
                                id="darktopbar-check" checked />
                            <label class="form-check-label" for="darktopbar-check">Dark</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="topbar-color" value="light"
                                id="lighttopbar-check" />
                            <label class="form-check-label" for="lighttopbar-check">Light</label>
                        </div>

                        <div class="d-grid mt-4">
                            <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
                            <a href="https://1.envato.market/uboldadmin" class="btn btn-danger mt-3"
                                target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="{{ asset('public/backEnd/') }}/assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('public/backEnd/') }}/assets/js/app.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/toastr.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/libs/flatpickr/flatpickr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="{{ asset('public/backEnd/') }}/assets/js/sweetalert.min.js"></script>
    <script type="text/javascript">
        $(".delete-confirm").click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
        $(".change-confirm").click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();
            swal({
                title: `Are you sure you want to change this record?`,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
        flatpickr(".flatpickr", {});
    </script>
    <script>
        $(document).ready(function() {
            $('.button-menu-mobile').on('click', function(e) {
                e.preventDefault();
                // Toggle between collapsed and expanded states
                if ($('body').hasClass('sidebar-collapsed')) {
                    $('body').removeClass('sidebar-collapsed').addClass('sidebar-enable');
                } else {
                    $('body').removeClass('sidebar-enable').addClass('sidebar-collapsed');
                }
                console.log('Toggled sidebar state:', $('body').attr('class'));
            });
        });
    </script>
    @yield('script')
</body>

</html>
