<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\Order;
use App\Models\TrialOrder;
use App\Models\SubscribeMail;
use App\Models\Blog;
use App\Models\Portfolio;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->except(['locked','unlocked']);
    }
    public function dashboard(){
        $buyer_count = Member::where(['type'=>'buyer'])->count();
        $seller_count = Member::where(['type'=>'seller'])->count();
        $total_orders = Order::count();
        $buyer_orders = Order::where('order_type', 'buyer')->count();
        $seller_orders = Order::where('order_type', 'seller')->count();
        $get_quote = TrialOrder::where('type', 'get-quote')->count();
        $free_trial = TrialOrder::where('type', 'free-trial')->count();
        $subscribes = SubscribeMail::count();
        $total_blog = Blog::count();
        $total_portfolio = Portfolio::count();
        return view('backEnd.admin.dashboard', compact('seller_count', 'buyer_count', 'total_orders', 'buyer_orders', 'seller_orders','get_quote','free_trial','subscribes','total_blog','total_portfolio'));
    }
    public function changepassword()
    {
        return view('backEnd.admin.changepassword');
    }
    public function newpassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required_with:new_password|same:new_password|'
        ]);

        $user = User::find(Auth::id());
        $hashPass = $user->password;

        if (Hash::check($request->old_password, $hashPass)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            Toastr::success('Success', 'Password changed successfully!');
            return redirect()->route('dashboard');
        } else {
            Toastr::error('Failed', 'Old password not match!');
            return back();
        }
    }
    public function locked()
    {
        // only if user is logged in

        Session::put('locked', true);
        return view('backEnd.auth.locked');
        return redirect()->route('login');
    }

    public function unlocked(Request $request)
    {

        if (!Auth::check())
            return redirect()->route('login');
        $password = $request->password;
        if (Hash::check($password, Auth::user()->password)) {
            Session::forget('locked');
            Toastr::success('Success', 'You are logged in successfully!');
            return redirect()->route('dashboard');
        }
        Toastr::error('Failed', 'Your password not match!');
        return back();
    }
}
