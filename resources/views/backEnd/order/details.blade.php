@extends('backEnd.layouts.master')
@section('title', 'Customer Account')
@section('css')
<link rel="stylesheet" href="{{ asset('public/frontEnd/css/lightcase.css') }}" />
@endsection
@section('content')
    <div class="page-header">
        <h5>My Order</h5>
    </div>
    <div class="page-content sm-order-1">
        <div class="row">
            <div class="col-xl-6 col-md-6 mb-30">
                <div class="card b-radius--10 box--shadow1 mb-4 overflow-hidden">
                    <div class="card-header">
                        <h5 class="">Details</h5>

                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Date <span class="fw-bold">{{ $order->created_at->format('Y-m-d h:m A') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Order ID <span class="fw-bold">{{ $order->order_name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                username <span class="fw-bold"><a
                                        href="https://script.viserlab.com/cliplab/admin/users/detail/208">{{ $order->member->name ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Services <span class="fw-bold">
                                    @foreach ($order->orderdetails as $index => $details)
                                        {{ $index > 0 ? ', ' : '' }}{{ $details->product_name }}
                                    @endforeach
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Plan <span class="fw-bold">Medium</span>
                            </li>
                            {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                Minimum image quantity <span class="fw-bold">4</span>
                            </li> --}}
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Images <span class="fw-bold">{{ $order->orderimages->count() }}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total Price <span class="fw-bold">${{ $order->amount }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Status <span class="fw-bold"><span
                                        class="badge bg-warning">{{ $order->status->name ?? '' }}</span></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Payment Status <span class="fw-bold"><span
                                        class="badge bg-warning">{{ $order->payment->payment_status ?? '' }}</span></span>
                            </li>

                        </ul>

                        {{-- <div class="d-flex justify-content-end mt-4">
                            <button class="btn btn-outline--success btn-sm ms-1 confirmationBtn"
                                data-action="https://script.viserlab.com/cliplab/admin/order/165/approve"
                                data-question="Are you sure to approve this order?"><i
                                    class="las la-check-double"></i>Approve</button>

                            <button class="btn btn-outline--warning btn-sm ms-1 changePlanBtn" data-action=""
                                data-question=""><i class="las la-cog"></i>Change Plan</button>

                            <button class="btn btn-outline--danger btn-sm ms-1 confirmationBtn"
                                data-action="https://script.viserlab.com/cliplab/admin/order/165/reject"
                                data-question="Are you sure you want to reject/cancel this order? "><i
                                    class="las la-ban"></i>
                                Cancel</button>
                        </div> --}}
                    </div>
                </div>
                <div class="card custom--card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="">Images </h5>
                            <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.image.zip', ['id' => $order->id]) }}">
                                <i class="fa fa-download"></i> Download Images</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row order-images-row">
                            @foreach ($order->orderimages as $key => $value)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <a href="{{ asset($value->image) }}" data-rel="lightcase:orderImages">
                                                    <div class=" order-images"
                                                        style="background-image: url({{ asset($value->image) }})">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- status change --}}
                <div class="card custom--card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="">Change Status </h5>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row order-images-row">
                            <div class="col-sm-12">
                                <form action="{{ route('admin.order.status_change') }}" method="POST" >
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <div class="form-group mb-3">
                                        <label for="order_status" class="form-label">Order Status</label>
                                        <select
                                            class="form-control form-select  @error('order_status') is-invalid @enderror"
                                            name="order_status" data-placeholder="Choose ...">

                                            <option value="">Select..</option>
                                            @foreach ($orderstatus as $value)
                                                <option value="{{ $value->id }}" {{ $value->id <= $order->order_status ? 'disabled' : '' }} {{ $value->id == $order->order_status ? 'selected' : ''  }}>{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('order_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Submit" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                            <!-- col end -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-30">
                <div class="chat-widget height--fix">
                    <div class="chat-widget-header">
                        <div class="left">
                            <h4 class="title mb-0 text-white">
                                Chat </h4>
                        </div>
                        <div class="right">
                            <button class="btn btn--primary chat-reload rounded text-white" type="button">
                                <i class="fa fa-rotate"></i>
                            </button>
                        </div>
                    </div>
                    <div class="ps-container" style="max-height: 600px;">
                        <ul id="messageBox">
                            @include('backEnd.order.messages')
                        </ul>
                    </div>
                    <div class="chat-widget-body p-0">
                        <form class="chat-form" action="{{ route('admin.message.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="hidden" name="member_id" value="{{ $order->member_id }}">
                            <div class="chatbox-footer">
                                <div class="chatbox-message-part">
                                    <div class="avatar">{{ Str::limit(Auth::user()->name, 1, '') }}</div>
                                    <input class="chatbox-footer-input shadow-none" id="message" name="message"
                                        type="text" placeholder="Write something" autocomplete="off">

                                </div>
                                <div class="chatbox-send-part d-flex align-items-center justify-content-end flex-wrap">
                                    <a class="btn attach-btn" href="javascript:void(0)"
                                        onclick="$('#attachment').click()"><i class="las la-paperclip"></i></a>
                                    <button class="btn btn-lg bg-primary" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('public/frontEnd/js/lightcase.js') }}"></script>
    <script>
        $('a[data-rel^=lightcase]').lightcase();
        $(document).on('click', '.chat-reload', function(e) {
            e.preventDefault();
            const order_id = {{ $order->id }};
            return message_update(order_id);
        });
        $(document).ready(function() {
            const order_id = {{ $order->id }};
            message_update(order_id);
            setInterval(() => {
                message_update(order_id);
            }, 2000);
        });

        function message_update(id) {
            $.ajax({
                url: '{{ route('admin.message.reload') }}',
                type: 'GET',
                data: {
                    id: id,
                },
                success: function(messages) {
                    if (messages) {
                        $('#messageBox').html(messages);
                    } else {
                        console.log(response.message || 'Failed to update cart');
                    }
                },
                error: function() {
                    console.log('An error occurred while updating the cart.');
                },
            });
        }
    </script>
@endsection
