@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@section('content')
    <!-- PAGE TITLE START -->
    <section class="custom-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title">
                        <h2>Pricing</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- PAGE TITLE END -->
    <section class="pricing-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pricing-table-inner">
                        <div class="row remove-col-padding">
                            @foreach ($services as $key => $value)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="single-pricing-table">
                                        <div class="header">
                                            <span class="name">{{ $value->title }}</span>
                                            @php
                                                $minPrice = 0;
                                                $maxPrice = 0;
                                            @endphp
                                            @foreach ($value->pricings as $pricing)
                                                @php
                                                    $minPrice = $value->pricings->min('new_price');
                                                    $maxPrice = $value->pricings->max('new_price');
                                                @endphp
                                            @endforeach
                                            <span class="price">${{ number_format($minPrice, 2) }} - ${{ number_format($maxPrice, 2) }}
                                            </span>
                                            <span class="label">Image</span>
                                            <div class="thumb">
                                                <img src="{{ asset($value->image) }}" class="img-fluid" alt="Pricing">
                                            </div>
                                        </div>
                                        <div class="body pricing-table-rules">
                                            <ul>
                                                @foreach ($value->pricings as $index => $price)
                                                    <li>{{ $price->name }} (${{ $price->new_price }})</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div><!-- //. single pricing table -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
