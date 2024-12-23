<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') - {{ $generalsetting->name }}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset($generalsetting->favicon) }}" alt="Websolution IT" />
    <meta name="author" content="Websolution IT" />
    <link rel="canonical" href="" />
    @stack('seo') @stack('css')
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/backEnd/') }}/assets/css/toastr.min.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/') }}/css/twentytwenty.css" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/responsive.css') }}" />
    <script src="{{ asset('public/frontEnd/js/jquery-3.7.1.min.js') }}"></script>

</head>

<body class="gotop">
    <header>
        <!-- HEADER TOP START -->
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="header-contact">
                            <ul>
                                <li><a href=""><i class="fa-solid fa-envelope"></i> {{ $contact->hotmail }}</a>
                                </li>
                                <li><a href=""><i class="fa-solid fa-phone"></i> {{ $contact->hotline }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="header-social">
                            <ul>
                                @foreach ($socialicons as $social)
                                    <li><a href="{{ $social->link }}"><i class="{{ $social->icon }}"></i></a></li>
                                @endforeach
                                <li><a href=""><i class="fa-solid fa-user"></i> Login</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- HEADER TOP END -->

        <!-- LOGO & MENU  START -->
        <div class="logo-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="logo-menu">
                            <div class="logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset($generalsetting->dark_logo) }}" alt="">
                                </a>
                            </div>
                            <div class="main-menu">
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('about_us') }}">About Us</a></li>
                                    <li>
                                        <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">Services</a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            @foreach ($allservices as $key => $value)
                                            <li><a class="dropdown-item" href="{{ route('service.details', $value->slug) }}">{{ $value->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('portfolios') }}">Portfolios</a></li>
                                    <li><a href="{{ route('pricings') }}">Pricing</a></li>
                                    <li><a href="{{ route('faqs') }}">FAQs</a></li>
                                    <li><a href="{{ route('home') }}">Get a quoat</a></li>
                                    <li><a href="{{ route('home') }}">free trial</a></li>
                                    <li><a href="{{ route('home') }}" class="order_btn"> <i
                                                class="fa-solid fa-shopping-cart"></i> Order</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- LOGO & MENU  END -->
    </header>

    <div class="mobile-header">
        <div class="mobile-logo">
            <div class="menu-logo">
                <a href="{{ route('home') }}"><img src="{{ asset($generalsetting->white_logo) }}" alt=""></a>
            </div>
            <div class="menu-bar">
                <a class="toggle" id="toggle">
                    <span class="bar-one"></span>
                    <span class="bar-two"></span>
                    <span class="bar-three"></span>
                </a>
            </div>
        </div>
    </div>

    <div class="mobile-menu ">
        <div class="mobile-menu-wrap">
            <div class="user-and-notification">
                <div class="mobile-auth">
                    <ul>
                        <li><a href="{{ route('home') }}/login"><i class="fa-solid fa-right-to-bracket"></i>
                                Order</a></li>
                    </ul>
                </div>
            </div>
            <ul class="mobile-nav">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about_us') }}">About Us</a></li>
                <li><a href="{{ route('services') }}">Services</a></li>
                <li><a href="{{ route('portfolios') }}">Portfolios</a></li>
                <li><a href="{{ route('pricings') }}">Pricing</a></li>
                <li><a href="{{ route('faqs') }}">FAQs</a></li>
                <li><a href="{{ route('home') }}">Get a quoat</a></li>
                <li><a href="{{ route('home') }}">free trial</a></li>
                <li><a href="{{ route('home') }}" class="order_btn"> <i class="fa-solid fa-shopping-cart"></i>
                        Order</a></li>
            </ul>
        </div>
    </div>
    @yield('content')

    <footer class="footer-area">
        <div class="footer-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="footer-widget subscribe">
                            <!-- footer widget subscribe -->
                            <div class="widget-title">
                                <h4 class="title">Suscribe Us</h4>
                            </div>
                            <div class="widget-body">
                                <form method="post" action="">

                                    <div class="form-element">
                                        <input type="text" class="input-field" name="name"
                                            placeholder="Type Your Name" required="">
                                    </div>
                                    <div class="form-element">
                                        <input type="email" class="input-field" name="email"
                                            placeholder="Type Email Address" required="">
                                    </div>
                                    <input type="submit" class="submit-btn btn-rounded" value="Subscribe">
                                </form>
                            </div>
                        </div>
                        <!-- //.footer widget subscribe  -->
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="footer-widget pages">
                            <!-- instagram widget subscribe -->
                            <div class="widget-title">
                                <h4 class="title">Top Services</h4>
                            </div>
                            <div class="widget-body">
                                <ul>
                                    @foreach ($allservices as $key => $value)
                                        <li>
                                            <a
                                                href="{{ route('service.details', $value->slug) }}">{{ $value->title }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <!-- //.instagram widget subscribe  -->
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="footer-widget blog-feeds">
                            <div class="widget-title">
                                <h4 class="title">Recent Posts</h4>
                            </div>
                            <div class="widget-body">
                                @foreach ($recentblogs as $key => $value)
                                    <div class="single-blog-feed-item">
                                        <!-- single blog feed item -->
                                        <div class="thumb">
                                            <a href="{{ route('blog.details', $value->slug) }}">
                                                <img src="{{ asset($value->image) }}" alt="{{ $value->title }}">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <a href="{{ route('blog.details', $value->slug) }}">
                                                <h4 class="title">{{ $value->title }}</h4>
                                            </a>
                                            <span class="date">
                                                <i class="far fa-clock"></i>
                                                {{ $value->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                    <!-- //.single blog feed item -->
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-6 col-md-6">
                        <div class="footer-widget pages">
                            <!-- instagram widget subscribe -->
                            <div class="widget-title">
                                <h4 class="title">More Pages</h4>
                            </div>
                            <div class="widget-body">
                                <ul>
                                    <li><a href="">About Us</a></li>
                                    <li><a href="">Portfolios</a></li>
                                    <li><a href="{{ route('pricings') }}">Pricing</a></li>
                                    <li><a href="{{ route('faqs') }}">Faqs</a></li>
                                    <li><a href="">Get A Quate</a></li>
                                    <li><a href="">Free Trial</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">© {{ date('Y') }} all right reserved By
                        {{ $generalsetting->name }} | Developed By <a href="https://websolutionit.com/"
                            target="_blank">Websolution IT</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- //.copyright area -->
    </footer>
    <script src="{{ asset('public/frontEnd/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/jquery.twentytwenty.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/frontEnd/js/script.js') }}"></script>
    @stack('script')
    <script>
        $(".toggle").on("click", function(event) {
            event.stopPropagation();
            $(".mobile-menu").toggleClass("active");
            $(this).toggleClass('show');
        });
    </script>
    <script>
        $('#portfolio').imagesLoaded(function() {
            var $grid = $('.grid').isotope({
                // options
            });
            $('.portfolio-isotop-btn').on('click', 'button', function() {
                $('button').removeClass("active");
                $(this).addClass("active");
                var filterValue = $(this).attr('data-filter');
                $grid.isotope({
                    filter: filterValue
                });
            });
            var $grid = $('.portfolio-inner').isotope({
                // set itemSelector so .grid-sizer is not used in layout
                itemSelector: '.single-portfolio',
                percentPosition: true,
                masonry: {
                    // use element for option
                    columnWidth: '.single-portfolio'
                }
            })
        });
        // portfolio js end
    </script>
</body>

</html>
