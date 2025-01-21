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
                                Name <span class="fw-bold">{{ $order->name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Phone <span class="fw-bold"><a
                                       >{{ $order->phone ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Email <span class="fw-bold"><a
                                       >{{ $order->email ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Country <span class="fw-bold"><a
                                       >{{ $order->country ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Company <span class="fw-bold"><a
                                       >{{ $order->company ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Website <span class="fw-bold"><a
                                       >{{ $order->website ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Image Sizes <span class="fw-bold"><a
                                       >{{ $order->image_size ?? '' }}</a></span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Width <span class="fw-bold"><a
                                       >{{ $order->width ?? 'Not Specified' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Height <span class="fw-bold"><a
                                       >{{ $order->height ?? 'Not Specified' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Quantity <span class="fw-bold"><a
                                       >{{ $order->quantity ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Margin <span class="fw-bold"><a
                                       >{{ $order->margin ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Message <span class="fw-bold"><a
                                       >{{ $order->message ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Preffered Delivery <span class="fw-bold"><a
                                       >{{ $order->pre_delivery_time ?? '' }}</a></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Services <span class="fw-bold">
                                    @foreach ($services as $index => $details)
                                        {{ $index > 0 ? ', ' : '' }}{{ $details->title }}
                                    @endforeach
                                </span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Images <span class="fw-bold">{{ $order->quantity}}</span>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="card custom--card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="">Images </h5>
                            <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.trial.zip', ['id' => $order->id]) }}">
                                <i class="fa fa-download"></i> Download Images</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row order-images-row">
                            @foreach ($order->trialimages as $key => $value)
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
