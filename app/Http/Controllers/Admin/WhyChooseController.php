<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WhyChoose;
use Toastr;
use Image;
use File;
use DB;
class WhyChooseController extends controller
{
    public function __construct(){
        $this->middleware('permission:whychoose-list|whychoose-create|whychoose-edit|whychoose-delete', ['only' => ['index','store']]);
        $this->middleware('permission:whychoose-create', ['only' => ['create','store']]);
        $this->middleware('permission:whychoose-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:whychoose-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request){
        $show_data = WhyChoose::orderBy('id','DESC')->get();
        return view('backEnd.whychoose.index',compact('show_data'));
    }
    
    public function create(){
        return view('backEnd.whychoose.create');
    }
    
    public function store(Request $request){
        $this->validate($request, [
            'icon' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);
        $input = $request->all();
        $user = WhyChoose::create($input);
        Toastr::success('Success','Data insert successfully');
        return redirect()->route('whychoose.index');
    }
    
    public function edit($id){
        $edit_data = WhyChoose::find($id);
        return view('backEnd.whychoose.edit',compact('edit_data'));
    }
    
    public function update(Request $request){
        $this->validate($request, [
            'icon' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);
        $input = $request->except('hidden_id');
        $update_data = WhyChoose::find($request->hidden_id);
        $input['status'] = $request->status?1:0;
        $update_data->update($input);

        Toastr::success('Success','Data update successfully');
        return redirect()->route('whychoose.index');
    }
 
    public function inactive(Request $request)
    {
        $inactive = WhyChoose::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = WhyChoose::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {

        $delete_data = WhyChoose::find($request->hidden_id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success','Data delete successfully');
        return redirect()->back();
    }
}
