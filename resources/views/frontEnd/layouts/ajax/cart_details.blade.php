@php
    $subtotal = Cart::instance('shopping')->subtotal();
    $subtotal = str_replace(',', '', $subtotal);
    $subtotal = str_replace('.00', '', $subtotal);
    $contents = Cart::instance('shopping')->content()->count();
@endphp
<tr>
    <td>Cart Item</td>
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
