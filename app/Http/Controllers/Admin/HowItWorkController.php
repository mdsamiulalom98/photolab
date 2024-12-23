<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\HowItWork;

class HowItWorkController extends Controller
{

    function __construct()
    {
        // $this->middleware('permission:contact-list|contact-create|contact-edit|contact-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:contact-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:contact-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = HowItWork::orderBy('id', 'DESC')->get();
        return view('backEnd.howitwork.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.howitwork.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'icon' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        HowItWork::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('howitworks.index');
    }

    public function edit($id)
    {
        $edit_data = HowItWork::find($id);
        return view('backEnd.howitwork.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'icon' => 'required',
            'description' => 'required',
        ]);
        $input = $request->except('hidden_id');
        $update_data = HowItWork::find($request->hidden_id);
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('howitworks.index');
    }

    public function inactive(Request $request)
    {
        $inactive = HowItWork::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = HowItWork::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = HowItWork::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
