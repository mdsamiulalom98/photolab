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
@push('css')
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/grt-youtube-popup.css') }}">
@endpush
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->

    <section class="contact-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="contact-map-form">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="contact-inner">
                                    <div class="contact-thumb">
                                        <i class="fa-solid fa-location-dot text-warning"></i>
                                        <h2>Address</h2>
                                        <p>{{ $contact->address }}</p>
                                    </div>
                                    <div class="contact-thumb">
                                        <i class="fa-solid fa-headphones text-success"></i>
                                        <h2>Call Us</h2>
                                        <p>{{ $contact->hotline }}</p>
                                    </div>
                                    <div class="contact-thumb">
                                        <i class="fa-solid fa-link text-primary"></i>
                                        <h2>Social Media</h2>
                                        <ul class="social-media">
                                            @foreach ($socialicons as $key => $value)
                                                <li>
                                                    <a href="{{ $value->link }}" style="background: {{ $value->color }};">
                                                        <i class="{{ $value->icon }}"></i>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="contact-thumb">
                                        <i class="fa-solid fa-envelope text-danger"></i>
                                        <h2>Mail</h2>
                                        <p>{{ $contact->email }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- contact item End -->
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="contact-item wow fadeInRight">
                                    <div class="contact-form">
                                        <h2>Get In Touch</h2>
                                        <form action="{{ route('contact.info') }}" method="POST">
                                            @csrf
                                            <div class="form-group mb-3">
                                                <input type="text" id="" class="form-control" name="name"
                                                    required="" placeholder="Your Name">
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="email" id="" class="form-control" name="email"
                                                    required="" placeholder="Your Email">
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="text" id="" class="form-control" name="phone"
                                                    required="" placeholder="Phone Number">
                                            </div>
                                            <div class="form-group mb-3">
                                                <textarea name="message" id="" rows="3" class="form-control" placeholder="Your Message"></textarea>
                                            </div>
                                            <div class="new">
                                                <button type="submit" class="btn-submit d-block">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- contact item End -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-12">
                    <div class="contact-map">
                        {!! $contact->google_map !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
