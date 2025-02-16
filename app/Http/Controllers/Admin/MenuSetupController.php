<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuSetup;
use Brian2694\Toastr\Facades\Toastr;
use Str;
class MenuSetupController extends Controller
{
    
    public function index(Request $request)
    {
        $show_data = MenuSetup::orderBy('id','DESC')->get();
        return view('backEnd.menusetup.index',compact('show_data'));
    }
    public function edit($id)
    {
        $edit_data = MenuSetup::find($id);
        return view('backEnd.menusetup.edit',compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $input = $request->except('hidden_id');
        $update_data = MenuSetup::find($request->id);
        $update_data->update($input);

        Toastr::success('Success','Data update successfully');
        return redirect()->route('menu_setup.index');
    }

    public function inactive(Request $request)
    {
        $inactive = MenuSetup::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = MenuSetup::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = MenuSetup::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
}
