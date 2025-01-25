<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Orderimage;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Member;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderDetails;
use App\Models\Shipping;
use App\Models\Bank;
use App\Models\MemberMethod;
use App\Models\MemberPayment;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use ZipArchive;

class MemberController extends Controller
{
    private function setting()
    {
        return GeneralSetting::select('name')->first();
    }
    public function register()
    {
        return view('frontEnd.layouts.member.register');
    }
    public function order_create()
    {
        $cartinfo = Cart::instance('shopping')->content();
        return view('frontEnd.layouts.member.order_create', compact('cartinfo'));
    }
    public function order_success($id)
    {
        $order = Order::find($id);
        return view('frontEnd.layouts.member.order_success', compact('order'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|unique:members',
            'email' => 'required|unique:members',
            'password' => 'required',
            'agree' => 'required',
            'confirmed' => 'required_with::password|same:password',
        ]);
        $max_id = DB::table('members')->max('id');
        $max_id = $max_id ? $max_id + 1 : '1';
        $verify = rand(1111, 9999);

        $formattedId = str_pad($max_id, 6, '0', STR_PAD_LEFT);
        $store_data = new Member();
        $store_data->member_id = $formattedId;
        $store_data->name = $request->name;
        $store_data->slug = strtolower(preg_replace('/[\/\s]+/', '-', $request->name . '-' . $max_id));
        $store_data->email = $request->email;
        $store_data->phone = $request->phone;
        $store_data->agree = $request->agree;
        $store_data->type = $request->type;
        $store_data->status = 0;
        $store_data->verify = $verify;
        $store_data->password = bcrypt($request->password);
        $store_data->save();

        Session::put('verify_phone', $store_data->phone);
        // verify by sms
        $apiKey = 'mPHNEo5pvdzYOfj7cyLJczoNyrSMZB4g0DGuAzBExOo=';
        $clientId = '37574055-f638-4736-87af-c995ad7200ff';
        $senderId = '8809617611899';
        $message = "Dear $store_data->name, Your account verify OTP is $verify. Thanks for using " . $this->setting()->name;
        $mobileNumbers = "88$store_data->phone";
        $isUnicode = '0';
        $isFlash = '0';
        $message = urlencode($message);
        $mobileNumbers = urlencode($mobileNumbers);
        $url = "http://sms.insafhost.com/api/v2/SendSMS?ApiKey=$apiKey&ClientId=$clientId&SenderId=$senderId&Message=$message&MobileNumbers=$mobileNumbers&Is_Unicode=$isUnicode&Is_Flash=$isFlash";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        Toastr::success('Please check your phone for account verify token');
        return redirect()->route('member.verify');
    }
    public function verify()
    {
        return view('frontEnd.layouts.member.verify');
    }
    public function account_verify(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required',
        ]);
        $auth_check = Member::select('id', 'phone', 'verify')->where('phone', Session::get('verify_phone'))->first();
        if ($auth_check->verify == $request->otp) {
            $auth_check->verify = 1;
            $auth_check->status = 1;
            $auth_check->save();

            Auth::guard('member')->loginUsingId($auth_check->id);
            Toastr::success('Your account verified successfully', 'Congratulations!');
            Session::forget('verify_phone');
            return redirect()->route('member.dashboard');
        } else {
            Toastr::error('Your token does not match', 'Failed!');
            return redirect()->back();
        }
    }

    public function login()
    {
        return view('frontEnd.layouts.member.login');
    }
    // login form
    public function signin(Request $request)
    {
        $this->validate($request, [
            'email_phone' => 'required',
            'password' => 'required',
        ]);
        $auth_check = Member::select('id', 'phone', 'email', 'name', 'password', 'verify', 'status')->where('phone', $request->email_phone)->orWhere('email', $request->email_phone)->first();

        $email_phone = $request->email_phone;
        $credentials = [];
        if (filter_var($email_phone, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $email_phone;
        } else {
            $credentials['phone'] = $email_phone;
        }
        $credentials['password'] = $request->password;

        if ($auth_check) {
            if ($auth_check->verify != 1) {
                $verify = rand(1111, 9999);
                $auth_check->verify = $verify;
                $auth_check->save();

                Session::put('verify_phone', $auth_check->phone);
                // verify by sms
                $apiKey = 'mPHNEo5pvdzYOfj7cyLJczoNyrSMZB4g0DGuAzBExOo=';
                $clientId = '37574055-f638-4736-87af-c995ad7200ff';
                $senderId = '8809617611899';
                $message = "Dear $auth_check->name, Your account verify OTP is $verify. Thanks for using " . $this->setting()->name;
                $mobileNumbers = "88$auth_check->phone";
                $isUnicode = '0';
                $isFlash = '0';
                $message = urlencode($message);
                $mobileNumbers = urlencode($mobileNumbers);
                $url = "http://sms.insafhost.com/api/v2/SendSMS?ApiKey=$apiKey&ClientId=$clientId&SenderId=$senderId&Message=$message&MobileNumbers=$mobileNumbers&Is_Unicode=$isUnicode&Is_Flash=$isFlash";
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                curl_close($ch);
                Toastr::error('Your account not verified, check your phone for OTP', 'Failed');
                return redirect()->route('member.verify');
            } elseif ($auth_check->status == 0) {
                Toastr::error('Your account not active now', 'Failed');
                return redirect()->back();
            } else {
                if (Auth::guard('member')->attempt($credentials)) {

                    Toastr::success('You are login successfully', 'Success');
                    return redirect()->route('member.dashboard');
                } else {
                    Toastr::error('Your password does not match', 'Failed');
                    return redirect()->back();
                }
            }
        } else {
            Toastr::error('message', 'Sorry! You have no account');
            return redirect()->back();
        }
    }

    public function dashboard(Request $request)
    {
        return view('frontEnd.layouts.member.dashboard');
    }

    public function profile()
    {
        $profile = Member::find(Auth::guard('member')->user()->id);
        return view('frontEnd.layouts.member.profile', compact('profile'));
    }
    public function settings()
    {
        $profile = Member::find(Auth::guard('member')->user()->id);
        $areas = [];
        $districts = [];
        $banks = Bank::where('status', 1)->get();
        $method = MemberMethod::where('member_id', Auth::guard('member')->user()->id)->first();
        return view('frontEnd.layouts.member.settings', compact('profile', 'districts', 'areas', 'banks', 'method'));
    }
    public function basic_update(Request $request)
    {
        $update_data = Member::find(Auth::guard('member')->user()->id);
        $update_image = $request->file('image');
        if ($update_image) {
            $file = $request->file('image');
            $name = time() . '-' . $file->getClientOriginalName();
            $uploadPath = 'public/uploads/member/';
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        } else {
            $fileUrl = $update_data->image;
        }
        $update_data->name = $request->name ?? $update_data->name;
        $update_data->address = $request->address ?? $update_data->address;
        $update_data->default_method = $request->default_method ?? $update_data->default_method;
        $update_data->payment_type = $request->payment_type ?? $update_data->payment_type;
        $update_data->image = $fileUrl;
        $update_data->save();
        Toastr::success('Basic info update successfully', 'Success');
        return redirect()->back();
    }

    public function change_pass()
    {
        return view('frontEnd.layouts.member.change_password');
    }

    public function password_update(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required_with:new_password|same:new_password|'
        ]);
        $auth_user = Member::find(Auth::guard('member')->user()->id);
        $hashPass = $auth_user->password;
        if (Hash::check($request->old_password, $hashPass)) {
            $auth_user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            Toastr::success('Password changed successfully!', 'Success');
            return redirect()->route('member.dashboard');
        } else {
            Toastr::error('Old password not match!', 'Failed');
            return redirect()->back();
        }
    }

    public function forgot_password()
    {
        return view('frontEnd.layouts.member.forgot_password');
    }

    public function forgot_verify(Request $request)
    {
        $auth_info = Member::where('phone', $request->phone)->first();
        if (!$auth_info) {
            Toastr::error('Your phone number not found', 'Failed');
            return back();
        }
        $auth_info->forgot = rand(1111, 9999);
        $auth_info->save();

        $apiKey = 'mPHNEo5pvdzYOfj7cyLJczoNyrSMZB4g0DGuAzBExOo=';
        $clientId = '37574055-f638-4736-87af-c995ad7200ff';
        $senderId = '8809617611899';
        $message = "Dear $auth_info->name, Your account forgot OTP is $auth_info->forgot. Thanks for using " . $this->setting()->name;
        $mobileNumbers = "88$auth_info->phone";
        $isUnicode = '0';
        $isFlash = '0';
        $message = urlencode($message);
        $mobileNumbers = urlencode($mobileNumbers);
        $url = "http://sms.insafhost.com/api/v2/SendSMS?ApiKey=$apiKey&ClientId=$clientId&SenderId=$senderId&Message=$message&MobileNumbers=$mobileNumbers&Is_Unicode=$isUnicode&Is_Flash=$isFlash";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        session::put('verify_phone', $request->phone);
        Toastr::success('Verify OTP send your phone number', 'Success');
        return redirect()->route('member.forgot.reset');
    }

    public function forgot_reset()
    {
        if (!Session::get('verify_phone')) {
            Toastr::error('Something wrong please try again', 'Failed');
            return redirect()->route('member.forgot.password');
        }
        return view('frontEnd.layouts.member.forgot_reset');
    }
    public function forgot_store(Request $request)
    {
        $auth_info = Member::where('phone', session::get('verify_phone'))->first();
        if ($auth_info->forgot != $request->otp) {
            Toastr::error('Failed', 'Your OTP not match');
            return redirect()->back();
        }
        $auth_info->forgot = 1;
        $auth_info->password = bcrypt($request->password);
        $auth_info->save();
        if (Auth::guard('member')->attempt(['phone' => $auth_info->phone, 'password' => $request->password])) {
            Session::forget('verify_phone');
            Toastr::success('You are login successfully', 'success!');
            return redirect()->route('member.dashboard');
        }
    }


    public function payment_invoice($invoice_id)
    {
        $payment = Payment::where(['user_id' => Auth::guard('member')->user()->id, 'user_type' => 'member', 'invoice_id' => $invoice_id])->with('paymentdetails.parcel', 'member')->first();
        return view('frontEnd.layouts.member.invoice', compact('payment'));
    }



    public function logout()
    {
        Session::flush();
        Toastr::success('You are logout successfully', 'Logout!');
        return redirect()->route('member.login');
    }
    public function generateShopId()
    {
        $lastMember = Member::orderBy('id', 'desc')->first();
        if ($lastMember) {
            $lastId = (int) substr($lastMember->id, -5);
            $newId = $lastId + 1;
        } else {
            $newId = 1;
        }
        return '10000' . str_pad($newId, 1, '0', STR_PAD_LEFT);
    }
    public function order_store(Request $request)
    {
        $this->validate($request, [
            'order_name' => 'required',
            'order_note' => 'required',
        ]);

        if (Cart::instance('shopping')->count() <= 0) {
            Toastr::error('Your shopping empty', 'Failed!');
            return redirect()->back();
        }

        $subtotal = Cart::instance('shopping')->subtotal();
        $subtotal = str_replace(',', '', $subtotal);
        $subtotal = str_replace('.00', '', $subtotal);
        if (Auth::guard('member')->user()) {
            $member_id = Auth::guard('member')->user()->id;
        } else {
            $exits_member = Member::where('phone', $request->phone)->select('phone', 'id')->first();
            if ($exits_member) {
                $member_id = $exits_member->id;
            } else {
                $password = rand(111111, 999999);
                $store = new Member();
                $store->name = $request->name;
                $store->slug = $request->name;
                $store->phone = $request->phone;
                $store->password = bcrypt($password);
                $store->verify = 1;
                $store->status = 'active';
                $store->save();
                $member_id = $store->id;
            }
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
        $order->order_note = $request->order_note;
        $order->external_link = $request->external_link;
        $order->prefer_delivery = $request->prefer_delivery;
        $order->save();


        // payment data save
        $payment = new Payment();
        $payment->order_id = $order->id;
        $payment->member_id = $member_id;
        $payment->payment_method = $request->payment_method;
        $payment->amount = $order->amount;
        $payment->payment_status = 'pending';
        $payment->save();

        // order details data save
        foreach (Cart::instance('shopping')->content() as $cart) {
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

        Cart::instance('shopping')->destroy();

        Toastr::success('Thanks, Your order place successfully', 'Success!');
        return redirect('order-success/' . $order->id);
    }

    public function orders(Request $request)
    {
        $order_status = OrderStatus::where('slug', $request->slug)->first();
        $order_status = $order_status->id ?? 1;
        $orders = Order::where('member_id', Auth::guard('member')->user()->id)->where('order_status', $order_status)->with('status')->latest()->get();
        return view('frontEnd.layouts.member.orders', compact('orders'));
    }

    public function invoice(Request $request)
    {
        $order = Order::where(['id' => $request->id, 'member_id' => Auth::guard('member')->user()->id])->with('orderdetails', 'payment', 'shipping', 'member')->firstOrFail();

        $payment = Payment::where(['order_id' => $order->id])->first();
        // return $payment;
        return view('frontEnd.layouts.member.invoice', compact('order', 'payment'));
    }

    public function order_details($id, Request $request)
    {
        $order = Order::where(['id' => $id, 'member_id' => Auth::guard('member')->user()->id])->with('orderdetails', 'payment', 'shipping', 'member')->firstOrFail();
        $payment = Payment::where(['order_id' => $order->id])->first();
        $messages = Message::where('order_id', $order->id)->get();
        // $messages = Message::where(['order_id' => $request->id, 'status'=> 0])->where('username', 'admin')->select('id', 'order_id', 'status')->get();
        // return $messages;
        return view('frontEnd.layouts.member.order_details', compact('order', 'payment', 'messages'));
    }
    public function message_reload(Request $request)
    {
        Message::where(['order_id' => $request->id, 'status'=> 0])->where('username', 'admin')->select('id', 'order_id', 'status')->update(['status'=>1]);
        $messages = Message::where('order_id', $request->id)->get();
        return view('frontEnd.layouts.ajax.messages', compact('messages'));
    }

    public function payment_method(Request $request)
    {
        $update_data = MemberMethod::where('member_id', Auth::guard('member')->user()->id)->first();
        if ($update_data) {
            $update_data->bank_id = $request->bank_id ?? $update_data->bank_id;
            $update_data->branch = $request->branch ?? $update_data->branch;
            $update_data->routing = $request->routing ?? $update_data->routing;
            $update_data->account_name = $request->account_name ?? $update_data->account_name;
            $update_data->account_number = $request->account_number ?? $update_data->account_number;
            $update_data->bkash = $request->bkash ?? $update_data->bkash;
            $update_data->nagad = $request->nagad ?? $update_data->nagad;
            $update_data->rocket = $request->rocket ?? $update_data->rocket;
            $update_data->save();
        } else {
            $data_store = new MemberMethod();
            $data_store->member_id = Auth::guard('member')->user()->id;
            $data_store->bank_id = $request->bank_id;
            $data_store->branch = $request->branch;
            $data_store->routing = $request->routing;
            $data_store->account_name = $request->account_name;
            $data_store->account_number = $request->account_number;
            $data_store->bkash = $request->bkash;
            $data_store->nagad = $request->nagad;
            $data_store->rocket = $request->rocket;
            $data_store->save();
        }

        Toastr::success('Basic info update successfully', 'Success');
        return redirect()->back();
    }

    public function member_payment(Request $request)
    {
        $memberpay = MemberMethod::where(['member_id' => Auth::guard('member')->user()->id])->first();
        $payments = MemberPayment::where(['member_id' => Auth::guard('member')->user()->id]);
        switch ($request->filter) {
            case 'today':
                $payments = $payments->whereDate('created_at', Carbon::today());
                break;
            case 'week':
                $payments = $payments->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()]);
                break;
            case 'month':
                $payments = $payments->whereMonth('created_at', Carbon::now()->month);
                break;
            case 'last-month':
                $payments = $payments->whereMonth('created_at', Carbon::now()->subMonth()->month);
                break;
            case 'year':
                $payments = $payments->whereYear('created_at', Carbon::now()->year);
                break;
            case 'last-year':
                $payments = $payments->whereYear('created_at', Carbon::now()->subYear()->year);
                break;
            default:
                break;
        }
        $payments = $payments->latest()->paginate(30);
        return view('frontEnd.layouts.member.payment', compact('memberpay', 'payments'));
    }

    public function payment_request(Request $request)
    {
        $orders = Order::where(['member_id' => Auth::guard('member')->user()->id, 'order_status' => 6, 'member_payment_status' => 'unpaid'])->select('id', 'member_id', 'order_status', 'member_payment_status', 'amount')->get();
        $memberpay = MemberMethod::where(['member_id' => Auth::guard('member')->user()->id])->with('bankname')->first();

        if ($request->payment_method == 'bank') {
            $member_note = 'Bank Name: ' . ($memberpay->bankname ? $memberpay->bankname->name : '') . ', Account Name: ' . $memberpay->account_name . ', Account Number: ' . $memberpay->account_number . ', Routing: ' . $memberpay->routing;
        } elseif ($request->payment_method == 'bkash') {
            $member_note = 'Receive Number: ' . $memberpay->bkash;
        } elseif ($request->payment_method == 'nagad') {
            $member_note = 'Receive Number: ' . $memberpay->nagad;
        } elseif ($request->payment_method == 'rocket') {
            $member_note = 'Receive Number: ' . $memberpay->rocket;
        }
        $payment = new MemberPayment();
        $payment->invoice_id = $this->invoiceIdGenerate();
        $payment->member_id = Auth::guard('member')->user()->id;
        $payment->member_type = 'seller';
        $payment->amount = $orders->sum('amount');
        $payment->payable_amount = $orders->sum('amount');
        $payment->payment_method = $request->payment_method;
        $payment->member_note = $member_note;
        $payment->status = 'process';
        $payment->save();

        Toastr::success('Your payment request has been place successfully', 'success!');
        return redirect()->back();
    }

    private function invoiceIdGenerate()
    {
        do {
            $uniqueId = 'INV-' . date('dmy') . Str::upper(Str::random(6));
            $exists = MemberPayment::where('invoice_id', $uniqueId)->exists();
        } while ($exists);

        return $uniqueId;
    }

    public function order_destroy(Request $request)
    {
        Order::where('id', $request->id)->delete();
        OrderDetails::where('order_id', $request->id)->delete();
        Shipping::where('order_id', $request->id)->delete();
        Payment::where('order_id', $request->id)->delete();
        Toastr::success('Success', 'Order delete success successfully');
        return redirect()->back();
    }

    public function message_update(Request $request)
    {
        $receipient_id = User::first()->id;
        $message = new Message();
        $message->order_id = $request->order_id;
        $message->sender_id = Auth::guard('member')->user()->id;
        $message->username = Auth::guard('member')->user()->member_id;
        $message->recipient_id = $receipient_id;
        $message->message = $request->message;
        $message->save();
        return redirect()->back();
    }
    public function message_active(Request $request)
    {
        $active = Message::find($request->id);
        $active->status = 1;
        $active->save();
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
