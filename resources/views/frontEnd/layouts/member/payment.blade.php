@extends('frontEnd.layouts.member.master')
@section('title', 'Payment')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h6><strong>Payment</strong></h6>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive ">
                    <table id="datatable-buttons" class="table   w-100">
                        <thead>
                            <tr>
                                <th class="white-space-nowrap">SL</th>
                                <th class="white-space-nowrap">Payment ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($show_data as $key => $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="{{ route('member.order.invoice',$value->id) }}">#{{ $value->id }}</a> </td>
                                    <td class="white-space-nowrap">
                                        {{ $value->member->name ?? '' }}
                                        <p>{{ $value->member->address ?? '' }}</p>
                                    </td>
                                    <td>{{ $value->member->phone ?? '' }}</td>
                                    <td>{{ $value->member->email ?? '' }}</td>
                                    <td>{{$value->currency == 'usd' ? '$' : '৳'}} {{ $value->amount }}</td>
                                    <td>{{ $value->payment_status }}</td>
                                    <td class="white-space-nowrap">
                                        <div class="button-list">
                                            <a href="{{ route('member.order.invoice',$value->id) }}" class="btn btn-primary text-white btn-xs" title="Invoice"><i class="fa-solid fa-eye"></i> Invoice</a>
                                           
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="custom-paginate">
                    {{ $show_data->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
