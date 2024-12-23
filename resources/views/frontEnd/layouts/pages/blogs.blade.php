@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Blogs</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->

    <section class="blog-page-section">
        <div class="container">
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


@endsection
