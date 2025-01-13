@extends('frontEnd.layouts.member.master')
@section('title', 'Dashboard')
@section('content')
    <style>
        body {
            font-family: "Open Sans", sans-serif;
            font-size: 14px;
            overflow-x: hidden;
            line-height: 1.5;
            background: #e8f6fc !important;
        }
    </style>
    <div class="page-header">
        <h5>Dashboard</h5>
    </div>
    <div class="page-content sm-order-1">
        <div class="row">
            <div class="col-sm-12">
                <div class="parcel-counter">
                    @foreach ($orderstatus as $key => $value)
                    <div class="counter-item">
                        <a href="{{ route('member.orders', ['slug' => $value->slug]) }}">
                            <div class="icon">
                                <i class="{{ $value->icon }}"></i>
                            </div>
                            <div class="info">
                                <h6>{{ $value->orders()->where('member_id', Auth::guard('member')->user()->id)->count() }}</h6>
                                <p>{{ $value->name }}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
@endpush
