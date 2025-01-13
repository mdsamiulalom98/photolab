<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingController extends Controller
{
    public function order_item(Request $request)
    {
        $cartinfo = Cart::instance('shopping')->content();
        $max_id = $cartinfo->max('id');
        $max_id = $max_id ? $max_id + 1 : '1';
        Cart::instance('shopping')->add([
            'id' => $max_id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 1,
        ]);
        $updatedHtml = view('frontEnd.layouts.ajax.cart_content', ['cartinfo' => $cartinfo])->render();

        return response()->json([
            'success' => true,
            'updatedHtml' => $updatedHtml,
        ]);

    }

    public function cart_details() {
        return view('frontEnd.layouts.ajax.cart_details');
    }

    public function order_item_destroy(Request $request)
    {
        Cart::instance('shopping')->update($request->id, 0);
        $cartinfo = Cart::instance('shopping')->content();
        return view('frontEnd.layouts.ajax.cart_content', compact('cartinfo'));
    }

}
