@extends('frontEnd.layouts.member.master')
@section('title', 'Order Create')
@push('css')
    <link href="{{ asset('public/backEnd') }}/assets/libs/summernote/summernote-lite.min.css" rel="stylesheet"
        type="text/css" />
@endpush
@section('content')
    @php
        $member = Auth::guard('member')->user();
    @endphp
    <form action="{{ route('member.order.store') }}" method="POST" class="row pos_form" data-parsley-validate=""
        enctype="multipart/form-data">
        @csrf
        <div class="order-content-inner">
            <div class="container">
                <div class="page-header">
                    <h5>Order Create</h5>
                </div>

                <div class=" sm-order-1">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="order-item-content">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group mb-3 position-relative">
                                            <input type="text"
                                                class="form-control  {{ $errors->has('cart_name') ? 'is-invalid' : '' }}"
                                                placeholder="Service Name" id="cart_name" name="cart_name"
                                                value="{{ old('cart_name') }}">
                                            <div id="serviceItems" style="display: none;">
                                            </div>
                                            @if ($errors->has('cart_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('cart_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group mb-3">
                                            <input type="number"
                                                class="form-control  {{ $errors->has('cart_price') ? 'is-invalid' : '' }}"
                                                placeholder="Price" id="cart_price" name="cart_price"
                                                value="{{ old('cart_price') }}">
                                            @if ($errors->has('cart_price'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('cart_price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-3">
                                            <input type="number"
                                                class="form-control  {{ $errors->has('cart_qty') ? 'is-invalid' : '' }}"
                                                placeholder="Quantity" id="cart_qty" name="cart_qty"
                                                value="{{ old('cart_qty') }}">
                                            @if ($errors->has('cart_qty'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('cart_qty') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mb-3">
                                            <button class="btn btn-success btn-submit" id="submit" type="button">Add
                                                Item <i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="order-create-content">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th style="width: 25%;">Name</th>
                                                <th style="width: 15%;">Quantity</th>
                                                <th style="width: 20%;">Price</th>
                                                <th style="width: 20%;">Sub Total</th>
                                                <th style="width: 20%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cartTable">
                                            @include('frontEnd.layouts.ajax.cart_content')
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="row ">
                                <div class="col-sm-12">
                                    <div class="form-group mb-2">
                                        <label class="mb-2" for="order_name">Order Name *</label>
                                        <input type="text" id="order_name" required
                                            class="form-control @error('order_name') is-invalid @enderror"
                                            placeholder="Order Name" name="order_name" value="{{ old('order_name') }}" />
                                        @error('order_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->

                                <div class="col-sm-12">
                                    <div class="form-group mb-2">
                                        <label class="mb-2" for="prefer_delivery">Prefer Delivery *</label>
                                        <input type="text" placeholder="Prefer Delivery" id="prefer_delivery" required
                                            class="form-control @error('prefer_delivery') is-invalid @enderror"
                                            name="prefer_delivery" value="{{ old('prefer_delivery') }}" />
                                        @error('prefer_delivery')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->

                                <div class="col-sm-12">
                                    <div class="form-group mb-2">
                                        <label class="mb-2" for="external_link">External Link</label>
                                        <input type="text" placeholder="External Link" id="external_link"
                                            class="form-control @error('external_link') is-invalid @enderror"
                                            name="external_link" value="{{ old('external_link') }}" />
                                        @error('external_link')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->

                                <div class="col-sm-12 mb-3">
                                    <label class="mb-2" for="image">Image *</label>
                                    <div class="clone hide" style="display: none;">
                                        <div class="control-group input-group mb-3 gap-3 align-items-center">
                                            <input type="file" name="image[]" class="form-control" />
                                            <div class="input-group-btn">
                                                <button class="btn btn-danger" type="button"><i
                                                        class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="input-group control-group increment align-items-center gap-3 input-group mb-3">
                                        <input type="file" name="image[]"
                                            class="form-control @error('image') is-invalid @enderror" />
                                        <div class="input-group-btn">
                                            <button class="btn btn-success btn-increment" type="button"><i
                                                    class="fa fa-plus"></i></button>
                                        </div>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->

                            </div>

                        </div>
                        <!-- cart total -->
                        <div class="col-sm-6">
                            <table class="table table-bordered">
                                <tbody id="cart_details">
                                    @include('frontEnd.layouts.ajax.cart_details')
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group mb-2">
                                <label class="mb-2" for="order_note">Order Note </label>
                                <textarea type="text" placeholder="Order Note" id="order_note"
                                    class="form-control summernote @error('order_note') is-invalid @enderror" name="order_note"
                                    value="{{ old('order_note') }}"></textarea>
                                @error('order_note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn order_submit_btn" type="submit">Order Place</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('script')
    <!-- Plugins js -->
    <script src="{{ asset('public/backEnd/') }}/assets/libs//summernote/summernote-lite.min.js"></script>
    <script>
        $(".summernote").summernote({
            placeholder: "Enter Your Text Here",

        });
    </script>
    {{-- finder-item-label --}}
    <script>
        $('input').on('input', function() {
            if ($(this).val().trim() !== '') {
                $(this).removeClass('is-blank');
            } else {
                $(this).addClass('is-blank');
            }
        });

        $(document).on('click', '#submit', function(e) {
            e.preventDefault();
            const price = $('#cart_price').val();
            const name = $('#cart_name').val();
            const qty = $('#cart_qty').val();
            const targetElement = $(`#cartTable`);
            if (price && name && qty) {
                $.ajax({
                    url: '{{ route('order.item.add') }}',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        price: price,
                        name: name,
                        qty: qty,
                    },
                    success: function(response) {
                        if (response.success) {
                            targetElement.html(response.updatedHtml);
                            $('#cart_price').val('');
                            $('#cart_name').val('');
                            $('#cart_qty').val('');
                            return cart_details();
                        } else {
                            alert(response.message || 'Failed to update cart');
                        }
                    },
                    error: function() {
                        alert('An error occurred while updating the cart.');
                    },
                });
            } else {
                $('input').each(function() {
                    if ($(this).val().trim() === '') {
                        $(this).addClass('is-blank');
                    } else {
                        $(this).removeClass('is-blank');
                    }
                });
            }
        });

        function cart_details() {
            $.ajax({
                type: "GET",
                url: "{{ route('cart.details') }}",
                success: function(data) {
                    if (data) {
                        $("#cart_details").html(data);
                    } else {
                        $("#cart_details").empty();
                    }
                },
            });
        }

        $(document).on('click', '.cart_remove', function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            const targetElement = $(`#cartTable`);
            $.ajax({
                type: 'GET',
                url: '{{ route('order.item.destroy') }}',
                data: {
                    id: id,
                },
                success: function(cartinfo) {
                    if (cartinfo) {
                        targetElement.html(cartinfo);
                        return cart_details();
                    } else {
                        alert(response.message || 'Failed to update cart');
                    }
                },
                error: function() {
                    alert('An error occurred while updating the cart.');
                },
            });
        });
    </script>
    <script>
        $('#cart_name').on('input', function() {
            var name = $(this).val();
            const targetElement = $(`#serviceItems`);
            $.ajax({
                url: '{{ route('ajax.services') }}',
                type: 'GET',
                data: {
                    name: name,
                },
                success: function(services) {
                    if (services) {
                        targetElement.show();
                        targetElement.html(services);
                    } else {
                        targetElement.hide();
                        targetElement.html(services);
                    }
                },
                error: function() {
                    console.log('An error occurred while updating the cart.');
                },
            });
        });
    </script>

    <script>
        $(document).on('click', '.member-item', function(e) {
            e.preventDefault();
            const serviceId = $(this).data('id');
            if (serviceId) {
                $.ajax({
                    url: '{{ route('ajax.service.add') }}',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: serviceId,
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#serviceItems').hide();
                            $('#cart_name').val(response.service.title);
                        } else {
                            alert(response.message || 'Failed to update cart');
                        }
                    },
                    error: function() {
                        alert('An error occurred while updating the cart.');
                    },
                });
            } else {
                $('input').each(function() {
                    if ($(this).val().trim() === '') {
                        $(this).addClass('is-blank');
                    } else {
                        $(this).removeClass('is-blank');
                    }
                });
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-increment").click(function() {
                var html = $(".clone").html();
                $(".increment").after(html);
            });
            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".control-group").remove();
            });
        });
    </script>
@endpush
