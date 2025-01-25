<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', '') - {{ $generalsetting->name }} </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset($generalsetting->favicon) }}">
    @stack('seo')
    @stack('css')
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/toastr.min.css">
    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/style.css">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/responsive.css">
    <!-- responsive css -->
</head>

<body>
    @php
        $member = Auth::guard('member')->user();
        $my_messasges = \App\Models\Message::where([
            'status' => 0,
            'recipient_id' => $member->id,
            'username' => 'admin',
        ])
            ->get();
    @endphp
    <div class="user-panel">
        <div class="user-sidebar">
            <div class="website-logo">
                <a href="{{ route('member.dashboard') }}">
                    <img src="{{ asset($generalsetting->dark_logo) }}" alt="">
                </a>
            </div>
            <div class="user-info">
                <div class="user-img">
                    <a href="{{ route('member.dashboard') }}">
                        <img src="{{ asset($member->image) }}" alt="">
                    </a>
                </div>
                <div class="merchant-bio">
                    <h5>{{ Str::limit($member->name, 15) }}
                        <br>({{ $member->type }})
                    </h5>
                    <p>ID: {{ $member->id }}</p>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="{{ route('member.dashboard') }}"
                            class="{{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-gauge"></i>
                            Dashboard
                        </a>
                    </li>
                    @if ($member->type == 'seller')
                        <li class="d-none">
                            <a href="{{ route('member.parcel.payment') }}"
                                class="{{ request()->is('parcel/payment') ? 'active' : '' }}">
                                <i class="fa-solid fa-sack-dollar"></i>
                                Payment
                            </a>
                        </li>
                    @endif
                    @if ($member->type == 'buyer')
                        <li>
                            <a href="{{ route('member.order.create') }}"
                                class="{{ request()->is('order') ? 'active' : '' }}"><i
                                    class="fa-solid fa-shopping-cart"></i>
                                Order Create</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('member.orders', ['slug' => 'pending']) }}"
                            class="{{ request()->is('orders') ? 'active' : '' }}"><i
                                class="fa-solid fa-shopping-cart"></i>
                            Orders</a>
                    </li>
                    <li>
                        <a href="{{ route('member.settings') }}"
                            class="{{ request()->is('settings') ? 'active' : '' }}">
                            <i class="fa-solid fa-cog"></i>
                            Settings</a>
                    </li>
                    <li>
                        <a href="{{ route('member.change_pass') }}"
                            class="{{ request()->is('change-password') ? 'active' : '' }}">
                            <i class="fa-solid fa-key"></i>
                            Change Password</a>
                    </li>
                    <li>
                        <a href="{{ route('member.logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i
                                class="fa-solid fa-right-from-bracket"></i> Logout</a>
                    </li>
                    <form id="logout-form" action="{{ route('member.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
        <!-- sidebar end -->
        <div class="user-container">
            <div class="user-header">
                <div class="user-toggole">
                    <button><i class="fa-solid fa-bars"></i></button>
                </div>
                <div class="user-search">
                    <form>
                        <input type="text" placeholder="Search Parcel" class="search_click keyword">
                        <button><i class="fa-solid fa-search"></i></button>
                    </form>
                    <div class="search_result"></div>
                </div>

                <div class="user-header-right d-flex">
                    <ul class="user-header-menu">
                        <li><a href="" class="notify-icon"><i class="fa-solid fa-file-invoice"></i>
                                <span>0</span></a></li>
                        <li class="dropdown"><a class="notify-icon" role="button" data-bs-toggle="dropdown"><i
                                    class="fa-solid fa-bell"></i><span>{{ $my_messasges->count() }}</span></a>
                            <ul class="dropdown-menu nofity-dropdown dropdown-menu-end">
                                @foreach ($my_messasges as $order)

                                <li class="d-block py-2">
                                    <a href="{{ route('member.order.details', $order->order_id) }}" class="fw-bold"><i class="fa-solid fa-bell"></i>
                                        <p>{{ $order->message }} </p>
                                    </a></li>
                                    @endforeach

                            </ul>
                        </li>
                    </ul>
                    <div class="user-login-info d-flex dropdown">
                        <div class="dropdown">
                            <div class="user-quick d-flex" href="#" role="button" data-bs-toggle="dropdown">
                                <img src="{{ asset($member->image) }}" alt="">
                                <p>{{ Str::limit($member->shop_name, 15) }} <i class="fa-solid fa-caret-down"></i></p>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('member.profile') }}"><i class="fa-solid fa-home"></i> My
                                        Account</a></li>
                                <li><a href="{{ route('member.settings') }}"><i class="fa-solid fa-cog"></i>
                                        Setting</a></li>
                                <li><a href="{{ route('member.change_pass') }}"><i class="fa-solid fa-key"></i>
                                        Change
                                        Password</a></li>
                                <li><a href="{{ route('member.logout') }}"
                                        onclick="event.preventDefault();
                        document.getElementById('logout-form2').submit();"><i
                                            class="fa-solid fa-sign-out"></i> Logout <form id="logout-form2"
                                            action="{{ route('member.logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form></a></li>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header end -->
            <div class="user-mheader">
                <div class="user-toggle">
                    <button><i class="fa-solid fa-bars"></i></button>
                </div>
                <div class="user-logo">
                    <a href="{{ route('member.dashboard') }}">
                        <img src="{{ asset($generalsetting->white_logo) }}" alt="">
                    </a>
                </div>
                {{--
            <div class="mobile-search">
                <a href="{{route('member.notification')}}">
                    <i class="fa-solid fa-bell"></i>
                </a>
            </div>
            --}}
            </div>
            <div class="consignment_msearch">
                <div class="user-search">
                    <i class="fa-solid fa-times"></i>
                    <form>

                        <input type="text" placeholder="Search Parcel" class="msearch_click mkeyword">
                        <button><i class="fa-solid fa-search"></i></button>
                    </form>
                    <div class="search_result"></div>
                </div>
            </div>
            <div class="user-content">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="user-footer">
        <ul>
            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('member.dashboard') }}">
                    <i class="fa-solid fa-home"></i>
                    <p>Home</p>
                </a>
            </li>

            <li class="{{ request()->is('profile') ? 'active' : '' }}">
                <a href="{{ route('member.profile') }}">
                    <i class="fa-solid fa-user"></i>
                    <p>Profile</p>
                </a>
            </li>
        </ul>
    </div>
    <div id="page-overlay"></div>

    <script src="{{ asset('public/frontEnd/') }}/js/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/popper.min.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/select2.min.js"></script>
    <script src="{{ asset('public/frontEnd/') }}/js/bootstrap.min.js"></script>
    <!-- custom script -->
    <script src="{{ asset('public/frontEnd/') }}/js/toastr.min.js"></script>
    <!-- Toastr -->
    {!! Toastr::message() !!}
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        $(document).ready(function() {
            $('.user-toggle').on('click', function() {
                $('.user-sidebar').addClass('active');
                $('#page-overlay').addClass('active');
            });
            $('.search_toggle').on('click', function() {
                $('.consignment_msearch').addClass('active');
                $('#page-overlay').addClass('active');
            });
            $("#page-overlay,.fa-times").on("click", function() {
                $("#page-overlay").removeClass('active');
                $(".user-sidebar").removeClass("active");
                $(".consignment_msearch").removeClass("active");
            });
        });
    </script>

    <script>
        // district to area
        $('.service_id').on('change', function() {
            var id = $(this).find('option:selected').val();
            $.ajax({
                type: "GET",
                data: {
                    'id': id
                },
                url: "{{ route('ajax.zones') }}",
                success: function(res) {
                    if (res) {
                        $(".zone").empty();
                        $(".zone").append('<option value="">Select..</option>');
                        $.each(res, function(key, value) {
                            $(".zone").append('<option value="' + value.id + '" >' + value
                                .name + '</option>');
                        });

                    } else {
                        $(".zone").empty();
                    }
                }
            });
        });
        $('#zone_id').on('change', function() {
            var id = $(this).find('option:selected').val();
            $.ajax({
                type: "GET",
                data: {
                    'id': id
                },
                url: "{{ route('ajax.districts') }}",
                success: function(res) {
                    if (res) {
                        $(".district").empty();
                        $(".area").empty();
                        $(".district").append('<option value="">Select..</option>');
                        $.each(res, function(key, value) {
                            $(".district").append('<option value="' + key + '" >' + value +
                                '</option>');
                        });

                    } else {
                        $(".district").empty();
                        $(".area").empty();
                    }
                }
            });
        });
        $('.district').on('change', function() {
            var id = $(this).find('option:selected').val();
            var zone_id = $('#zone_id').find('option:selected').val();
            $.ajax({
                type: "GET",
                data: {
                    id,
                    zone_id
                },
                url: "{{ route('ajax.areas') }}",
                success: function(res) {
                    if (res) {
                        $(".area").empty();
                        $(".area").append('<option value="">Select..</option>');
                        $.each(res, function(key, value) {
                            $(".area").append('<option value="' + key + '" >' + value +
                                '</option>');
                        });

                    } else {
                        $(".area").empty();
                    }
                }
            });
        });

        $(".search_click").on("input", function() {
            var keyword = $(".keyword").val();
            $.ajax({
                type: "GET",
                data: {
                    keyword: keyword
                },
                url: "{{ route('member.consignment.search') }}",
                success: function(res) {
                    if (res) {
                        $(".search_result").html(res);
                    } else {
                        $(".search_result").empty();
                    }
                },
            });
        });
        $(".msearch_click").on("input", function() {
            var keyword = $(".mkeyword").val();
            $.ajax({
                type: "GET",
                data: {
                    keyword: keyword
                },
                url: "{{ route('member.consignment.search') }}",
                success: function(res) {
                    if (res) {
                        $(".search_result").html(res);
                    } else {
                        $(".search_result").empty();
                    }
                },
            });
        });
    </script>
    @stack('script')

</body>

</html>
