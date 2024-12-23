@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@push('seo')
<meta name="app-url" content="" />
<meta name="robots" content="index, follow" />
<meta name="description" content="{{$generalsetting->meta_description}}" />
<meta name="keywords" content="{{$generalsetting->meta_keyword}}" />
<!-- Open Graph data -->
<meta property="og:title" content="{{$generalsetting->meta_title}}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="" />
<meta property="og:image" content="{{ asset($generalsetting->white_logo) }}" />
<meta property="og:description" content="{{$generalsetting->meta_description}}" />
@endpush

@section('content')
<section class="contact-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="contact-map-form">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h3 class="h1 mb-5">
                                {{ $pageinfo->title }}
                            </h3>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            {!! $pageinfo->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </section>
@endsection
