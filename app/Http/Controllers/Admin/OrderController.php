<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Gloudemans\Shoppingcart\Facades\Cart;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderDetails;
use App\Models\OrderStatus;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Orderimage;
use App\Models\Message;
use ZipArchive;

class OrderController extends Controller
{
    public function index($slug, Request $request)
    {
        if ($slug == 'all') {
            $order_status = (object) [
                'name' => 'All',
                'orders_count' => Order::count(),
            ];
            $show_data = Order::latest()->with('shipping', 'status')->where('order_type', $request->type);
            if ($request->keyword) {
                $show_data = $show_data->where(function ($query) use ($request) {
                    $query->orWhere('invoice_id', 'LIKE', '%' . $request->keyword . '%')
                        ->orWhereHas('shipping', function ($subQuery) use ($request) {
                            $subQuery->where('phone', $request->keyword);
                        });
                });
            }
            $show_data = $show_data->paginate(50);
        } else {
            $order_status = OrderStatus::where('slug', $slug)
                ->withCount(['orders' => function ($query) use ($request) {
                    $query->where('order_type', $request->type);
                }])->first();
            $show_data = Order::where(['order_status' => $order_status->id, 'order_type'=> $request->type])->latest()->with('shipping', 'status')->paginate(50);
        }

        return view('backEnd.order.index', compact('show_data', 'order_status'));
    }

    public function order_edit($invoice_id)
    {
        $data = Order::where(['invoice_id' => $invoice_id])->select('id', 'invoice_id', 'order_status', 'member_id', 'order_name', 'prefer_delivery', 'external_link','order_note')->with('orderdetails','member')->first();
        $order = Order::where('invoice_id', $invoice_id)->first();
        Cart::instance('sale')->destroy();
        $shippinginfo = Shipping::where('order_id', $order->id)->first();
        Session::put('product_discount', $order->discount);
        Session::put('pos_shipping', $order->shipping_charge);
        $orderdetails = OrderDetails::where('order_id', $order->id)->get();
        foreach ($orderdetails as $ordetails) {
            $cartinfo = Cart::instance('sale')->add([
                'id' => $ordetails->product_id,
                'name' => $ordetails->product_name,
                'qty' => $ordetails->qty,
                'price' => $ordetails->sale_price,
                'weight' => $ordetails->weight ?? 1,
                'options' => [
                    'purchase_price' => $ordetails->purchase_price,
                    'product_discount' => $ordetails->product_discount,
                    'product_size' => $ordetails->product_size,
                    'product_color' => $ordetails->product_color,
                    'details_id' => $ordetails->id,
                    'type' => $ordetails->product_type,
                ],
            ]);
        }
        $cartinfo = Cart::instance('sale')->content();
        return view('backEnd.order.edit', compact('cartinfo', 'shippinginfo', 'order', 'data'));
    }

    public function cart_clear(Request $request)
    {
        Cart::instance('sale')->destroy();
        Session::forget('pos_shipping');
        Session::forget('pos_discount');
        Session::forget('product_discount');
        return redirect()->back();
    }

    public function invoice($invoice_id)
    {
        $order = Order::where(['invoice_id' => $invoice_id])->with('orderdetails', 'payment', 'shipping', 'member')->firstOrFail();
        return view('backEnd.order.invoice', compact('order'));
    }

    public function order_create()
    {
        $cartinfo = Cart::instance('sale')->content();
        Session::put('pos_shipping');
        Session::forget('pos_discount');
        Session::forget('product_discount');
        Session::forget('cpaid');
        Session::forget('cdue');
        $members = Member::where('status', 1)->get();
        return view('backEnd.order.create', compact('cartinfo', 'members'));
    }
    public function members (Request $request) {
        $members = Member::where('phone', 'LIKE', '%' . $request->phone . "%")->where('type', $request->type)->get();
        if (empty($request->phone || !$members)) {
            $members = [];
        }
        return view('backEnd.order.customers', compact('members'));
    }

    public function member_add(Request $request) {
        $member = Member::find($request->id);
        return response()->json([
            'success' => $member ? true : false,
            'member' => $member
        ]);
    }
    public function order_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'type' => 'required',
        ]);
        $name = $request->name;
        $phone = $request->phone;

        if (Cart::instance('sale')->count() <= 0) {
            Toastr::error('Your shopping empty', 'Failed!');
            return redirect()->back();
        }

        $subtotal = Cart::instance('sale')->subtotal();
        $subtotal = str_replace(',', '', $subtotal);
        $subtotal = str_replace('.00', '', $subtotal);

        $exits_member = Member::where('phone', $phone)->select('phone', 'id')->first();
        if ($exits_member) {
            $member_id = $exits_member->id;
        } else {
            $password = rand(111111, 999999);
            $store = new Member();
            $store->name = $name;
            $store->slug = $name;
            $store->phone = $phone;
            $store->password = bcrypt($password);
            $store->verify = 1;
            $store->status = 'active';
            $store->save();
            $member_id = $store->id;
        }

        // order data save
        $order = new Order();
        $order->invoice_id = rand(11111, 99999);
        $order->order_name = $request->order_name;
        $order->amount = $subtotal;
        $order->discount = 0;
        $order->shipping_charge = 0;
        $order->member_id = $member_id;
        $order->order_status = 1;
        $order->order_type = $request->type;
        $order->order_note = $request->order_note;
        $order->external_link = $request->external_link;
        $order->prefer_delivery = $request->prefer_delivery;
        $order->save();



        // payment data save
        $payment = new Payment();
        $payment->order_id = $order->id;
        $payment->member_id = $member_id;
        $payment->payment_method = 'Cash On Delivery';
        $payment->amount = $order->amount;
        $payment->payment_status = 'pending';
        $payment->save();

        // order details data save
        foreach (Cart::instance('sale')->content() as $cart) {
            $order_details = new OrderDetails();
            $order_details->order_id = $order->id;
            $order_details->product_id = $cart->id;
            $order_details->product_name = $cart->name;
            $order_details->sale_price = $cart->price;
            $order_details->qty = $cart->qty;
            $order_details->save();
        }

        $images = $request->file('image');
        if ($images) {
            foreach ($images as $key => $image) {
                $name = time() . '-' . $image->getClientOriginalName();
                $name = strtolower(preg_replace('/\s+/', '-', $name));
                $uploadPath = 'public/uploads/order/';
                $image->move($uploadPath, $name);
                $imageUrl = $uploadPath . $name;

                $oimage = new Orderimage();
                $oimage->order_id = $order->id;
                $oimage->image = $imageUrl;
                $oimage->save();
            }
        }
        Cart::instance('sale')->destroy();
        Session::forget('sale');
        Session::forget('cpaid');
        Session::forget('cdue');
        Toastr::success('Thanks, Your order place successfully', 'Success!');
        return redirect()->route('admin.orders', ['slug' => 'all']);
    }
    public function cart_add(Request $request)
    {
        $cartinfo = Cart::instance('sale')->content();
        $max_id = $cartinfo->max('id');
        $max_id = $max_id ? $max_id + 1 : '1';
        Cart::instance('sale')->add([
            'id' => $max_id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 1,
        ]);
        $updatedHtml = view('backEnd.order.cart_content', ['cartinfo' => $cartinfo])->render();

        return response()->json([
            'success' => true,
            'updatedHtml' => $updatedHtml,
        ]);
    }

    public function cart_content()
    {
        $cartinfo = Cart::instance('sale')->content();
        return view('backEnd.order.cart_content', compact('cartinfo'));
    }
    public function cart_details()
    {
        $cartinfo = Cart::instance('sale')->content();
        return view('backEnd.order.cart_details', compact('cartinfo'));
    }
    public function cart_increment(Request $request)
    {
        $qty = $request->qty + 1;
        $cartinfo = Cart::instance('sale')->update($request->id, $qty);
        return response()->json($cartinfo);
    }
    public function cart_decrement(Request $request)
    {
        $qty = $request->qty - 1;
        $cartinfo = Cart::instance('sale')->update($request->id, $qty);
        return response()->json($cartinfo);
    }
    public function cart_remove(Request $request)
    {
        Cart::instance('sale')->remove($request->id);
        $cartinfo = Cart::instance('sale')->content();
        return response()->json($cartinfo);
    }

    public function process($invoice_id)
    {
        $data = Order::where(['invoice_id' => $invoice_id])->select('id', 'invoice_id', 'order_status')->with('orderdetails', 'shipping')->first();

        return view('backEnd.order.process', compact('data'));
    }
    public function order_details($id)
    {
        $order = Order::where(['id' => $id])->with('orderdetails')->first();
        $messages = Message::where('order_id', $order->id)->get();
        return view('backEnd.order.details', compact('order', 'messages'));
    }

    public function order_process(Request $request)
    {
        $order = Order::with('payment')->find($request->id);
        $shipping_update = Shipping::where('order_id', $order->id)->first();
        $shipping_update->name = $request->name;
        $shipping_update->phone = $request->phone;
        $shipping_update->address = $request->address;
        $shipping_update->download_link = $request->download_link;
        $shipping_update->save();

        Toastr::success('Success', 'Order status change successfully');
        return redirect()->route('admin.orders', ['slug' => 'all']);
    }

    public function order_status(Request $request)
    {
        Order::whereIn('id', $request->input('order_ids'))->update(['order_status' => $request->order_status]);
        return response()->json(['status' => 'success', 'message' => 'Order status change successfully']);
    }

    public function order_update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
        ]);

        if (Cart::instance('sale')->count() <= 0) {
            Toastr::error('Your shopping empty', 'Failed!');
            return redirect()->back();
        }

        $subtotal = Cart::instance('sale')->subtotal();
        $subtotal = str_replace(',', '', $subtotal);
        $subtotal = str_replace('.00', '', $subtotal);

        $exits_member = Member::where('phone', $request->phone)->select('phone', 'id')->first();
        if ($exits_member) {
            $member_id = $exits_member->id;
        } else {
            $password = rand(111111, 999999);
            $store = new Member();
            $store->name = $request->name;
            $store->slug = $request->name;
            $store->phone = $request->phone;
            $store->address = $request->address;
            $store->password = bcrypt($password);
            $store->verify = 1;
            $store->status = 1;
            $store->save();
            $member_id = $store->id;
        }

        // order data save
        $order = Order::where('id', $request->order_id)->first();
        $order->amount = $subtotal;
        $order->discount = 0;
        $order->shipping_charge = 0;
        $order->member_id = $member_id;
        $order->order_name = $request->order_name;
        $order->order_note = $request->order_note;
        $order->external_link = $request->external_link;
        $order->prefer_delivery = $request->prefer_delivery;
        $order->save();


        // payment data save
        $payment = Payment::where('order_id', $request->order_id)->first();
        $payment->order_id = $order->id;
        $payment->member_id = $member_id;
        $payment->payment_method = 'Cash On Delivery';
        $payment->amount = $order->amount;
        $payment->payment_status = 'pending';
        $payment->save();

        // order details data save
        foreach ($order->orderdetails as $orderdetail) {
            $item = Cart::instance('sale')->content()->where('id', $orderdetail->product_id)->first();
            if (!$item) {
                $orderdetail->delete();
            }
        }
        foreach (Cart::instance('sale')->content() as $cart) {
            $exits = OrderDetails::where('id', $cart->options->details_id)->first();
            if ($exits) {
                $order_details = OrderDetails::find($exits->id);
                $order_details->order_id = $order->id;
                $order_details->product_id = $cart->id;
                $order_details->product_name = $cart->name;
                $order_details->sale_price = $cart->price;
                $order_details->qty = $cart->qty;
                $order_details->save();
            } else {
                $order_details = new OrderDetails();
                $order_details->order_id = $order->id;
                $order_details->product_id = $cart->id;
                $order_details->product_name = $cart->name;
                $order_details->sale_price = $cart->price;
                $order_details->qty = $cart->qty;
                $order_details->save();
            }
        }

        $images = $request->file('image');
        if ($images) {
            foreach ($images as $key => $image) {
                $name = time() . '-' . $image->getClientOriginalName();
                $name = strtolower(preg_replace('/\s+/', '-', $name));
                $uploadPath = 'public/uploads/order/';
                $image->move($uploadPath, $name);
                $imageUrl = $uploadPath . $name;

                $oimage = new Orderimage();
                $oimage->order_id = $order->id;
                $oimage->image = $imageUrl;
                $oimage->save();
            }
        }
        Cart::instance('sale')->destroy();
        Session::forget('pos_shipping');
        Session::forget('pos_discount');
        Session::forget('product_discount');
        Session::forget('cpaid');
        Toastr::success('Thanks, Your order place successfully', 'Success!');
        return redirect('admin/orders/pending');
    }

    public function message_update(Request $request) {
        $receipient_id = $request->member_id;
        $message = new Message();
        $message->order_id = $request->order_id;
        $message->sender_id = Auth::user()->id;
        $message->username = 'admin';
        $message->recipient_id = $receipient_id;
        $message->message = $request->message;
        $message->save();
        return redirect()->back();
    }
    public function message_reload(Request $request) {
        $messages = Message::where('order_id',$request->id)->get();
        return view('backEnd.order.messages', compact('messages'));
    }

    public function change_status(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->order_status = $request->order_status;
        $order->save();
        return redirect()->back();
    }


    public function downloadImagesAsZip(Request $request)
    {
        $order = Order::find($request->id);
        $orderimages = Orderimage::where('order_id', $order->id)->pluck('image')->toArray();
        if ($orderimages > 0) {
            $zipFileName = $order->order_name . '.zip';
            $zipFilePath = public_path($zipFileName);
            $zip = new ZipArchive();
            if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                foreach ($orderimages as $image) {
                    if (File::exists($image)) {
                        $fileName = basename($image);
                        $zip->addFile($image, $fileName);
                    }
                }
                $zip->close();
                return response()->download($zipFilePath)->deleteFileAfterSend(true);
            } else {
                return response()->json(['error' => 'Unable to create ZIP file.'], 500);
            }
        }
        return redirect()->back();
    }
}
