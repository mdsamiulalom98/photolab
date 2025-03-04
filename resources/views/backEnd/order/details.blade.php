@extends('backEnd.layouts.master')
@section('title', 'Customer Account')
@section('css')
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/lightcase.css') }}" />
    <link href="{{ asset('public/backEnd') }}/assets/libs/summernote/summernote-lite.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/backEnd') }}/assets/libs/summernote/summernote-lite.min.css" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')
    <div class="page-header">
        <h5>Order Details {{ $order->order_name }}</h5>
    </div>
    <div class="page-content sm-order-1">
        <div class="row">
            <div class="col-xl-6 col-md-6 mb-30">
                <div class="card b-radius-10 box-shadow1 mb-4 overflow-hidden">
                    <div class="card-header">
                        <h5 class="">Details</h5>

                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Order Place <span
                                    class="fw-bold">{{ date('d M Y, h:i A', strtotime($order->created_at)) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Delivery Time <span
                                    class="fw-bold">{{ date('d M Y, h:i A', strtotime($order->prefer_delivery)) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Order ID <span class="fw-bold">{{ $order->order_name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                username <span class="fw-bold"><a>{{ $order->member->name ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Services <span class="fw-bold">
                                    @foreach ($order->orderdetails as $index => $details)
                                        {{ $index > 0 ? ', ' : '' }}{{ $details->service_name }}
                                    @endforeach
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Images <span class="fw-bold">{{ $order->orderimages->count() }}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total Price <span class="fw-bold">{{ $order->currency == 'usd' ? '$' : '৳' }}
                                    {{ $order->amount }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Status <span class="fw-bold"><span
                                        class="badge {{ $order->status->color ?? 'bg-dark' }} font-12">{{ $order->status->name ?? '' }}</span></span>
                            </li>
                            @if ($order->download_link)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Download Link <span class="fw-bold"><span
                                            class="badge {{ $order->status->color ?? 'bg-dark' }} font-12"><a
                                                href="{{ $order->download_link }}" download><i
                                                    class="fa-solid fa-download"></i> Download File</a></span></span>
                                </li>
                            @endif
                        </ul>
                        <div class="d-flex justify-content-end mt-4">
                            @if ($order->order_status == 1)
                                <button class="btn btn-outline-success btn-sm ms-1 confirmationBtn"
                                    data-action="{{ route('admin.order.approve') }}"
                                    data-question="Are you sure to approve this order?"><i
                                        class="fa fa-check-circle px-1"></i>Approve</button>
                            @endif

                            @if ($order->order_status < 7)
                                <button class="btn btn-outline-danger btn-sm ms-1 confirmationBtn"
                                    data-action="{{ route('admin.order.reject') }}"
                                    data-question="Are you sure you want to reject/cancel this order? "><i
                                        class="fa fa-cancel px-1"></i> Cancel</button>
                            @endif
                        </div>


                    </div>
                </div>
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="">Images </h5>
                            <a class="btn btn-outline-primary btn-sm"
                                href="{{ route('admin.image.zip', ['id' => $order->id]) }}">
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
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="">Instruction </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="order-images-row">
                            <div>{!! $order->order_note !!}</div>
                        </div>
                    </div>
                </div>

                <div class="card custom-card mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="">Change Status </h5>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row order-images-row">
                            <div class="col-sm-12">
                                <form action="{{ route('admin.order.status_change') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <div class="form-group mb-3">
                                        <label for="order_status" class="form-label">Order Status</label>
                                        <select
                                            class="form-control form-select  @error('order_status') is-invalid @enderror"
                                            name="order_status" data-placeholder="Choose ...">

                                            <option value="">Select..</option>
                                            @foreach ($orderstatus as $value)
                                                <option value="{{ $value->id }}"
                                                    {{ $value->id <= $order->order_status ? 'disabled' : '' }}
                                                    {{ $value->id == $order->order_status ? 'selected' : '' }}>
                                                    {{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('order_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="download_link" class="form-label">Download Link</label>
                                        <input class="form-control @error('download_link') is-invalid @enderror"
                                            name="download_link">
                                        @error('download_link')
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
                <div class="chat-widget height-fix">
                    <div class="chat-widget-header">
                        <div class="left">
                            <h4 class="title mb-0 text-white">
                                Chat </h4>
                        </div>
                        <div class="right">
                            <button class="btn btn-primary chat-reload rounded text-white" type="button">
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
                                    <textarea class="chatbox-footer-input shadow-none summernote" id="message" name="message"></textarea>
                                </div>
                                <div class="chatbox-send-part d-flex align-items-center flex-wrap mt-2">
                                    <button class="btn btn-lg bg-primary" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="confirmationModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation Alert!</h5>
                    <button type="button" class="close btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <form method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}" />
                    <div class="modal-body">
                        <p class="question"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary bg-base">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('public/frontEnd/js/lightcase.js') }}"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/libs/summernote/summernote-lite.min.js"></script>
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
            }, 10000);
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
    <script>
        (function($) {
            "use strict";
            $(document).on('click', '.confirmationBtn', function() {
                var modal = $('#confirmationModal');
                let data = $(this).data();
                modal.find('.question').text(`${data.question}`);
                modal.find('form').attr('action', `${data.action}`);
                modal.modal('show');
            });
        })(jQuery);
    </script>
    <script>
        $(".summernote").summernote({
            placeholder: "Enter Your Text Here",
        });
    </script>
@endsection
