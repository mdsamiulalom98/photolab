@php
    $cartcontents = Cart::instance('sale')->content();
@endphp
@foreach ($cartcontents as $key => $value)
    <tr>

        <td>{{ $value->name }} </td>
        <td>
            <div class="qty-cart vcart-qty">
                <div class="quantity">
                    <button class="minus cart_decrement" value="{{ $value->qty }}"
                        data-id="{{ $value->rowId }}">-</button>
                    <input type="text" value="{{ $value->qty }}" readonly />
                    <button class="plus cart_increment" value="{{ $value->qty }}"
                        data-id="{{ $value->rowId }}">+</button>
                </div>
            </div>
        </td>
        <td>{{ $value->price }}</td>

        <td>{{ ($value->price - $value->options->product_discount) * $value->qty }}
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-xs cart_remove" data-id="{{ $value->rowId }}"><i
                    class="fa fa-times"></i></button>
        </td>
    </tr>
@endforeach
<script>
    function cart_content() {
        $.ajax({
            type: "GET",
            url: "{{ route('admin.order.cart_content') }}",
            dataType: "html",
            success: function(cartinfo) {
                $('#cartTable').html(cartinfo)
            }
        });
    }

    function cart_details() {
        $.ajax({
            type: "GET",
            url: "{{ route('admin.order.cart_details') }}",
            dataType: "html",
            success: function(cartinfo) {
                $('#cart_details').html(cartinfo)
            }
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
                    'id': id,
                    'qty': qty
                },
                type: "GET",
                url: "{{ route('admin.order.cart_increment') }}",
                dataType: "json",
                success: function(cartinfo) {
                    return cart_content() + cart_details();
                }
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
                    'id': id,
                    'qty': qty
                },
                url: "{{ route('admin.order.cart_decrement') }}",
                dataType: "json",
                success: function(cartinfo) {
                    return cart_content() + cart_details();
                }
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
                    'id': id
                },
                url: "{{ route('admin.order.cart_remove') }}",
                dataType: "json",
                success: function(cartinfo) {
                    return cart_content() + cart_details();
                }
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
            }
        });
    }); // pshippingfee from total
</script>
