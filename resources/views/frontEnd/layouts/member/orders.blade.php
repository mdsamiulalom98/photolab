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
                                <th>Prefer Delivery</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ route('member.order.details', $value->id) }}">{{ $value->order_name }}</a></td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->phone }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $value->created_at->format('d-m-y') }}</td>
                                    <td>{{ $value->prefer_delivery }}</td>
                                    <td>{{ $value->status ? $value->status->name : '' }}</td>
                                    <td>{{ $value->payment->payment_status ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('member.order.details', ['id' => $value->id]) }}"
                                            class="btn btn-outline-secondary btn-sm invoice_btn">
                                            <i class="fa-solid fa-desktop"></i>
                                            Details
                                        </a>
                                        <form onsubmit="return alert('Are you sure?')" method="post" action="{{ route('member.order.destroy') }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" value="{{ $value->id }}" name="id">
                                            <button type="submit"  title="Delete" class="btn btn-outline-danger btn-sm"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>

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
