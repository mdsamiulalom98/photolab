@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Portfolios</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->

    <section id="portfolio" class="portfolio-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-right wow zoomIn">
                    <div class="button-group portfolio-isotop-btn">
                        <button data-filter="*" class="active" >all</button>
                        @foreach ($pcategories as $key => $value)
                            <button data-filter=".{{ $value->slug }}" >{{ $value->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="portfolio-inner">
                        <div class="row">

                            @foreach ($portfolios as $key => $value)
                                <div class=" col-sm-3 single-portfolio {{ $value->category->slug ?? '' }} " style="">
                                    <div class="portfolio-item">
                                        <img src="{{ asset($value->image_one) }}" alt="">
                                        <img src="{{ asset($value->image_two) }}" alt="">
                                    </div>
                                </div>
                                <!-- portfolio col end  -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
