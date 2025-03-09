@extends('frontEnd.layouts.member.master')
@section('title', 'Customer Account')
@section('content')
@php
    $member = Auth::guard('member')->user();
@endphp
    <div class="page-header">
        <h5>My Order</h5>
    </div>
    <div class="page-content sm-order-1">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Order No</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Order Placed</th>
                                <th>Delivery Time</th>
                                <th>Prefer Delivery</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $value)
                                <tr  class="{{$value->order_status == 4 ? 'complete' : (\Carbon\Carbon::parse($value->prefer_delivery)->subHour() <= Carbon\Carbon::now() ? 'coundown' : '') }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ route('member.order.details', $value->id) }}">{{ $value->order_name }}</a></td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->phone }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ date('d M Y, h:i A', strtotime($value->created_at)) }}</td>
                                    <td>{{ date('d M Y, h:i A', strtotime($value->delivery_time)) }}</td>
                                    {{-- <td>{{ $value->prefer_delivery }}</td> --}}
                                    <td class="text-capitalize">{{ $value->prefer_time }} {{ $value->prefer_time > 1 ? $value->time_frame . 's' : $value->time_frame . '' }}</td>
                                    <td>{{$value->currency == 'usd' ? '$' : '৳'}} {{ $value->amount }}</td>
                                    <td>{{ $value->status ? $value->status->name : '' }}</td>
                                    <td>
                                        <a href="{{ route('member.order.details', ['id' => $value->id]) }}"
                                            class="btn btn-primary btn-sm invoice_btn">
                                            <i class="fa-solid fa-desktop"></i>
                                            Details
                                        </a>
                                        {{--
                                        <form onsubmit="return alert('Are you sure?')" method="post" action="{{ route('member.order.destroy') }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" value="{{ $value->id }}" name="id">
                                            <button type="submit"  title="Delete" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                        --}}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
