@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@push('seo')
    <meta name="app-url" content="" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="{{ $generalsetting->meta_description }}" />
    <meta name="keywords" content="{{ $generalsetting->meta_keyword }}" />
    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $generalsetting->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="{{ asset($generalsetting->white_logo) }}" />
    <meta property="og:description" content="{{ $generalsetting->meta_description }}" />
@endpush
@section('content')
    <!-- SLIDER SECTION START -->
    <section class="slider-section">
        <div class="main-slider owl-carousel">
            @foreach ($sliders as $key => $value)
                <div class="slider-item" style="background: url({{ asset($value->image) }})">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="slider-content">
                                    <p>{{ $value->sub_title }}</p>
                                    <h2>{{ $value->title }}</h2>
                                    <ul>
                                        <li><a href="" class="quote_btn">Get a quote</a></li>
                                        <li><a href="" class="trial_btn">Get free trial</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- SLIDER SECTION END -->

    <!-- HOW TO DO START -->
    <section class="section-padding work-process-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Here's How It Works</h2>
                        <p>We probably operate the best offshore Graphics design studio in Asia. To make sure we keep
                            delivering top quality we only employ the best DTP professionals.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="work-process">
                        <div class="wrok-process-item step-up">
                            <i class="fa-regular fa-envelope"></i>
                            <h3>Request Quote</h3>
                            <p>Get a quote in your inbox within 45 minutes.</p>
                        </div>
                        <!-- wrok-process-item -->
                        <div class="wrok-process-item step-down">
                            <i class="fa-solid fa-cart-plus"></i>
                            <h3>Place Order</h3>
                            <p>Get a quote in your inbox within 45 minutes.</p>
                        </div>
                        <!-- wrok-process-item -->
                        <div class="wrok-process-item  step-up">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <h3>Pay your bill</h3>
                            <p>Get a quote in your inbox within 45 minutes.</p>
                        </div>
                        <!-- wrok-process-item -->
                        <div class="wrok-process-item">
                            <i class="fa-solid fa-download"></i>
                            <h3>Download File</h3>
                            <p>Get a quote in your inbox within 45 minutes.</p>
                        </div>
                        <!-- wrok-process-item -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- HOW TO DO END -->
    <!-- SERVICE SECTION START -->
    <section class="service-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title white-title">
                        <h2>Our services</h2>
                        <p>We probably operate the best offshore Graphics design studio in Asia. To make sure we keep
                            delivering top quality we only employ the best DTP professionals.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($service_all as $key => $value)
                    <div class="col-sm-4">
                        <div class="service-item">
                            <div class="service-item-img">
                                <a href="{{ route('service.details', $value->slug) }}">
                                    <img src="{{ asset($value->image) }}" alt="">
                                </a>
                            </div>
                            <div class="service-item-content">
                                <a href="{{ route('service.details', $value->slug) }}">{{ $value->title }}</a>
                                <p>{!! $value->short_description !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- SERVICE SECTION END -->

    <!-- WHY CHOOSE US START -->
    <section class="section-padding why-choose-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Why Choose Us</h2>
                        <p>We probably operate the best offshore Graphics design studio in Asia. To make sure we keep
                            delivering top quality we only employ the best DTP professionals.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($whychoose as $key => $value)
                    <div class="col-sm-3">
                        <div class="why-choose-item">
                            <i class="{{ $value->icon }}"></i>
                            <h3>{{ $value->title }}</h3>
                            <p>{{ $value->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- WHY CHOOSE US END -->

    <!-- COUNTER START CSS-->
    <section class="counter-section section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-11">
                    <div class="row align-center">
                        <div class="col-sm-6">
                            <div class="counter-image">
                                <img src="{{ asset($counter_banner->image) }}" alt="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            @foreach ($counters as $key => $value)
                                <div class="counter-item">
                                    <div class="counter-icon">
                                        <i class="{{ $value->icon }}"></i>
                                    </div>
                                    <div class="counter-count">
                                        <h1>{{ $value->counter }}</h1>
                                        <p>{{ $value->title }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- COUNTER START END -->

    <!-- BLOG SECTION START -->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Recent Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($blogs as $key => $value)
                    <div class="col-sm-4">
                        <div class="blog-item">
                            <div class="blog-img">
                                <a href="{{ route('blog.details', $value->slug) }}">
                                    <img src="{{ asset($value->image) }}" alt="">
                                </a>
                                <div class="blog-time">
                                    <span
                                        class="date">{{ $value->created_at ? \Carbon\Carbon::parse($value->created_at)->format('d') : '' }}</span>
                                    <span
                                        class="month">{{ $value->created_at ? \Carbon\Carbon::parse($value->created_at)->format('M') : '' }}</span>
                                </div>
                            </div>

                            <div class="blog-content">
                                <a href="{{ route('blog.details', $value->slug) }}">
                                    <h4 class="blog-title">{{ $value->title }}</h4>
                                </a>
                                <a href="{{ route('blog.details', $value->slug) }}" class="read_more">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- BLOG SECTION END -->
    <div class="brand-carousel-area">
        <div class="brand-carousel-inner owl-carousel" id="brandCarousel">
            @foreach ($brands as $key => $value)
                <div class="brand-carousel-item">
                    <a href="">
                        <img src="{{ asset($value->image) }}" alt="">
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <section class="testimonial-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <span class="separator"></span>
                        <h2 class="title">Client Testimonials</h2>
                        <p>We probably operate the best offshore Graphics design studio in Asia. To make sure we keep
                            delivering top quality we only employ the best DTP professionals.<br></p>
                    </div>
                </div>
            </div>
            <!-- testimonial -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial-carousel owl-carousel" id="testimonialCarousel">
                        @foreach ($testimonials as $key => $value)
                            <div class="single-testimonial-item">
                                <div class="description">
                                    {!! $value->description !!}
                                </div>
                                <div class="author-details">
                                    <div class="thumb">
                                        <img src="{{ asset($value->image) }}" alt="{{ $value->name }}">
                                    </div>
                                    <div class="content">
                                        <h4 class="name">{{ $value->name }}</h4>
                                        <span class="post">{{ $value->designation }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- //.author details -->
            </div>
        </div>
    </section>
@endsection
