@php
    $subtotal = Cart::instance('sale')->subtotal();
    $subtotal = str_replace(',','',$subtotal);
    $subtotal = str_replace('.00', '',$subtotal);
    $contents = Cart::instance('sale')->content()->count();
@endphp
<tr>
    <td>Cart Items</td>
    <td>{{$contents}}</td>
</tr>
<tr>
    <td>Sub Total</td>
    <td>{{$subtotal}}</td>
</tr>

<tr>
    <td>Total</td>
    <td>{{$subtotal}}</td>
</tr>
