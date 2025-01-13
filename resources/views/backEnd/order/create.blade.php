@extends('backEnd.layouts.master')
@section('title', 'Order Create')
@section('css')
    <style>
        .increment_btn,
        .remove_btn {
            margin-top: -17px;
            margin-bottom: 10px;
        }
    </style>
    <link href="{{ asset('public/backEnd') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backEnd') }}/assets/libs/summernote/summernote-lite.min.css" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form action="{{ route('admin.order.cart_clear') }}" class="d-inline">
                            <button type="submit" class="btn btn-danger rounded-pill delete-confirm" title="Delete"><i
                                    class="fas fa-trash-alt"></i> Cart Clear</button>
                        </form>
                    </div>
                    <h4 class="page-title">Order Create</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group mb-3">
                                    <input type="text"
                                        class="form-control  {{ $errors->has('cart_name') ? 'is-invalid' : '' }}"
                                        placeholder="Service Name" id="cart_name" name="cart_name"
                                        value="{{ old('cart_name') }}">
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
                                        Item</button>
                                </div>
                            </div>
                        </div>
                        <!-- col end -->
                        <form action="{{ route('admin.order.store') }}" method="POST" class="row pos_form"
                            data-parsley-validate="" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12">
                                <table class="table table-bordered table-responsive-sm">
                                    <thead>
                                        <tr></tr>
                                        <tr>
                                            <th style="width: 25%;">Name</th>
                                            <th style="width: 15%;">Quantity</th>
                                            <th style="width: 15%;">Sell Price</th>
                                            <th style="width: 15%;">Sub Total</th>
                                            <th style="width: 15%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cartTable">
                                        @foreach ($cartinfo as $key => $value)
                                            <tr>

                                                <td>{{ $value->name }} </td>
                                                <td>
                                                    <div class="qty-cart vcart-qty">
                                                        <div class="quantity">
                                                            <button class="minus cart_decrement"
                                                                value="{{ $value->qty }}"
                                                                data-id="{{ $value->rowId }}">-</button>
                                                            <input type="text" value="{{ $value->qty }}" readonly />
                                                            <button class="plus cart_increment" value="{{ $value->qty }}"
                                                                data-id="{{ $value->rowId }}">+</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $value->price }}</td>

                                                <td>{{ $value->price * $value->qty }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-xs cart_remove"
                                                        data-id="{{ $value->rowId }}"><i class="fa fa-times"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- custome address -->
                            <div class="row ">


                            </div>
                            <div class="col-sm-6">

                                <div class="row new_customer">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-2">
                                            <input type="text" id="name" required
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Customer Name" name="name" value="" />
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-12">
                                        <div class="form-group mb-2 position-relative">
                                            <input type="number" id="phone" required
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Customer Number" name="phone" value="" />
                                            <div id="customerItems" style="display: none;">
                                                @include('backEnd.order.customers')
                                            </div>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-12">
                                        <div class="form-group mb-2">
                                            <label class="mb-1" for="order_name">Order Name *</label>
                                            <input type="text" id="order_name"
                                                class="form-control @error('order_name') is-invalid @enderror"
                                                placeholder="Order Name" name="order_name" value="{{ old('order_name') }}" required />
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
                                            <label class="mb-1" for="prefer_delivery">Prefer Delivery *</label>
                                            <input type="text" placeholder="Prefer Delivery" id="prefer_delivery"
                                                class="form-control @error('prefer_delivery') is-invalid @enderror"
                                                name="prefer_delivery" value="{{ old('prefer_delivery') }}" required />
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
                                            <label class="mb-1" for="external_link">External Link</label>
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
                                        <label class="mb-1" for="image">Image *</label>
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
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="mb-1" for="order_note">Order Note *</label>
                                            <textarea id="order_note" name="order_note" class="form-control mb-3 @error('order_note') is-invalid @enderror">{{ $data->order_note ?? '' }}</textarea>
                                        </div>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <input type="hidden" name="type"
                                        value="{{ request()->get('type') ?? 'seller' }}">

                                </div>
                            </div>
                            <!-- cart total -->
                            <div class="col-sm-6">
                                <table class="table table-bordered">
                                    <tbody id="cart_details">
                                        @php
                                            $subtotal = Cart::instance('sale')->subtotal();
                                            $subtotal = str_replace(',', '', $subtotal);
                                            $subtotal = str_replace('.00', '', $subtotal);
                                            $contents = Cart::instance('sale')->content()->count();
                                        @endphp
                                        <tr>
                                            <td>Cart Items</td>
                                            <td>{{ $contents }}</td>
                                        </tr>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td>{{ $subtotal }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>{{ $subtotal }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-success" value="Order Submit" />
                            </div>
                        </form>
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->
        </div>
    </div>
    @endsection @section('script')
    <script src="{{ asset('public/backEnd/') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/libs/select2/js/select2.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-advanced.init.js"></script>
    <!-- Plugins js -->
    <script src="{{ asset('public/backEnd/') }}/assets/libs//summernote/summernote-lite.min.js"></script>
    <script>
        $(".summernote").summernote({
            placeholder: "Enter Your Text Here",
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
    <script>
        function cart_content() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.order.cart_content') }}",
                dataType: "html",
                success: function(cartinfo) {
                    $("#cartTable").html(cartinfo);
                },
            });
        }

        function cart_details() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.order.cart_details') }}",
                dataType: "html",
                success: function(cartinfo) {
                    $("#cart_details").html(cartinfo);
                },
            });
        }



        $(".cart_increment").click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var qty = $(this).val();
            if (id) {
                $.ajax({
                    cache: false,
                    data: {
                        id: id,
                        qty: qty
                    },
                    type: "GET",
                    url: "{{ route('admin.order.cart_increment') }}",
                    dataType: "json",
                    success: function(cartinfo) {
                        return cart_content() + cart_details();
                    },
                });
            }
        });
        $(".cart_decrement").click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var qty = $(this).val();
            if (id) {
                $.ajax({
                    cache: false,
                    type: "GET",
                    data: {
                        id: id,
                        qty: qty
                    },
                    url: "{{ route('admin.order.cart_decrement') }}",
                    dataType: "json",
                    success: function(cartinfo) {
                        return cart_content() + cart_details();
                    },
                });
            }
        });
        $(".cart_remove").click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            if (id) {
                $.ajax({
                    cache: false,
                    type: "GET",
                    data: {
                        id: id
                    },
                    url: "{{ route('admin.order.cart_remove') }}",
                    dataType: "json",
                    success: function(cartinfo) {
                        return cart_content() + cart_details();
                    },
                });
            }
        });

        $(".cartclear").click(function(e) {
            $.ajax({
                cache: false,
                type: "GET",
                url: "{{ route('admin.order.cart_clear') }}",
                dataType: "json",
                success: function(cartinfo) {
                    return cart_content() + cart_details();
                },
            });
        });
    </script>

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
                    url: '{{ route('admin.order.cart_add') }}',
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
    </script>

    <script>
        $('#phone').on('input', function() {
            var phone = $(this).val();
            var type = "{{ request()->get('type') ?? 'seller' }}";
            const targetElement = $(`#customerItems`);
            $.ajax({
                url: '{{ route('admin.order.members') }}',
                type: 'GET',
                data: {
                    phone: phone,
                    type: type,
                },
                success: function(members) {
                    if (members) {
                        targetElement.show();
                        targetElement.html(members);
                    } else {
                        targetElement.hide();
                        targetElement.html(members);
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
            const memberId = $(this).data('id');
            if (memberId) {
                $.ajax({
                    url: '{{ route('admin.order.member_add') }}',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: memberId,
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#customerItems').hide();
                            $('#name').val(response.member.name);
                            $('#phone').val(response.member.phone);
                            $('#address').val(response.member.address);
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

@endsection
