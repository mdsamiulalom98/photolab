<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Order;
use App\Models\Member;
use Image;
use File;
use Auth;
use Hash;

class MemberManageController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'shop_name' => 'required',
            'name' => 'required',
            'phone' => 'required|unique:members',
            'email' => 'required|unique:members',
            'password' => 'required'
        ]);
        $verify                     = rand(1111, 9999);
        $store_data                 = new Member();
        $store_data->shop_id        = $this->generateShopId();
        $store_data->shop_name      = $request->shop_name;
        $store_data->name           = $request->name;
        $store_data->email          = $request->email;
        $store_data->phone          = $request->phone;
        $store_data->district_id    = $request->district;
        $store_data->area_id        = $request->area;
        $store_data->address        = $request->address;
        $store_data->verify         = 1;
        $store_data->agree          = 1;
        $store_data->status         = 'pending';
        $store_data->password       = bcrypt($request->password);
        $store_data->save();

        Toastr::success('Success','Merchant added successfully');
        return redirect()->route('members.index');
    }
    public function index(Request $request){
        $show_data = Member::where('type',$request->member);
        if($request->status == 'pending'){
           $show_data = $show_data->where('status',$request->status);
        }
        if($request->keyword){
            $show_data = $show_data->orWhere('phone',$request->keyword)->orWhere('name',$request->keyword);
        }
        $show_data = $show_data->paginate(50);
        $member_type = $request->member;
        return view('backEnd.member.index',compact('show_data','member_type'));
    }
    public function edit($id){
        $edit_data = Member::find($id);
        return view('backEnd.member.edit',compact('edit_data'));
    }
    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $input = $request->except('hidden_id');
        $update_data = Member::find($request->hidden_id);
        // new password


        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }
        $image = $request->file('image');
        if($image){
            // image with intervention
            $name =  time().'-'.$image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp',$name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/member/';
            $imageUrl = $uploadpath.$name;
            $img=Image::make($image->getRealPath());
            $img->encode('webp', 90);
            $width = 100;
            $height = 100;
            $img->height() > $img->width() ? $width=null : $height=null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($imageUrl);
            $input['image'] = $imageUrl;
            File::delete($update_data->image);
        }else{
            $input['image'] = $update_data->image;
        }
        $input['status'] = $request->status?1:0;
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return back();
    }

    public function inactive(Request $request){
        $inactive = Member::find($request->hidden_id);
        $inactive->status = 'inactive';
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request){
        $active = Member::find($request->hidden_id);
        $active->status = 'active';
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function profile(Request $request){
        $profile = Member::find($request->id);
        $parcels = Order::where('member_id',$profile->id);
        $total_cod = $parcels->sum('amount');
        $parcels = $parcels->paginate(50);
        return view('backEnd.member.profile',compact('profile','total_cod','parcels'));
    }

    public function adminlog(Request $request){
        $customer = Member::find($request->hidden_id);
        Auth::guard('member')->loginUsingId($customer->id);
        return redirect()->route('member.dashboard');
    }

    public function destroy(Request $request)
    {
        $delete_data = Member::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }

    public function bulk_destroy(Request $request)
    {
        $customers_id = $request->customer_ids;
        foreach ($customers_id as $customer_id) {
            $order = Member::where('id', $customer_id)->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'Member delete successfully']);
    }
    public function bulk_active(Request $request)
    {
        $customers_id = $request->customer_ids;
        foreach ($customers_id as $customer_id) {
            Member::where('id', $customer_id)->update(['status' => 'active']);
        }
        return response()->json(['status' => 'success', 'message' => 'Member delete successfully']);
    }
    public function bulk_inactive(Request $request)
    {
        $customers_id = $request->customer_ids;
        foreach ($customers_id as $customer_id) {
            Member::where('id', $customer_id)->update(['status' => 'inactive']);
        }
        return response()->json(['status' => 'success', 'message' => 'Member delete successfully']);
    }
}
