@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>About Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->

    <!-- COUNTER START CSS-->
    <section class="section-padding">
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
                                <div class="counter-item dark-bg">
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
    <!-- COUNTER START -->
    <!-- ABOUT US START -->
    <section class="section-padding about-section">
        <div class="container">
            @foreach ($about as $key => $value)
                <div class="row">
                    <div class="col-sm-6">
                        <div class="about-content">
                            <h3>{{ $value->title }}</h3>
                            <div>{!! $value->description !!}</div>
                        </div>
                    </div>
                    <!-- col end -->
                    <div class="col-sm-6">
                        <div class="about-image">
                            <img src="{{ asset($value->image) }}" alt="">
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
                @foreach ($mission as $key => $value)
                    <div class="col-sm-6">
                        <div class="mission-vision">
                            <h3>{{ $value->title }}</h3>
                            <div>{!! $value->description !!}</div>
                        </div>
                    </div>
                @endforeach
                @foreach ($vision as $key => $value)
                    <div class="col-sm-6">
                        <div class="mission-vision">
                            <h3>{{ $value->title }}</h3>
                            <div>{!! $value->description !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ABOUT US END -->
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
                        @php
                            $lastKey = $allhowitworks->keys()->last(); // Get the last index/key of the collection
                        @endphp
                        @foreach ($allhowitworks as $key => $value)
                            <div
                                class="wrok-process-item {{ $key % 2 == 0 ? 'step-up' : ($key == $lastKey ? 'final-step' : 'step-down') }}">
                                <i class="{{ $value->icon }}"></i>
                                <h3>{{ $value->name }}</h3>
                                <p>{{ $value->description }}</p>
                            </div>
                            <!-- wrok-process-item -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- HOW TO DO END -->

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
@endsection
