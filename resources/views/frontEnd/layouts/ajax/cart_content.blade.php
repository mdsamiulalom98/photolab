@php
    $cartcontents = Cart::instance('shopping')->content();
@endphp
@foreach ($cartcontents as $key => $value)
    <tr>
        <td>{{ $value->name }}</td>
        <td>
            {{ $value->qty }}
        </td>
        <td>{{ $value->price }}</td>
        <td>
            {{ $value->price * $value->qty }}
        </td>

        <td><button type="button" data-id="{{ $value->rowId }}" class="btn btn-danger btn-xs cart_remove"><i class="fa fa-times"></i></button></td>
    </tr>
@endforeach
@if($cartcontents->count() < 1)
<tr>
    <td class="text-center" colspan="5">No Item in Cart</td>
</tr>
@endif
