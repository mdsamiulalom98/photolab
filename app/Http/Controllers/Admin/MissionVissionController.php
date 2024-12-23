<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MissionVission;
use Toastr;
use Image;
use File;

class MissionVissionController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:misssionvission-list|misssionvission-create|misssionvission-edit|misssionvission-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:misssionvission-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:misssionvission-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:misssionvission-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $show_data = MissionVission::orderBy('id', 'DESC')->get();
        return view('backEnd.missionvission.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.missionvission.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        // dd($request->all());

        $input = $request->all();
        MissionVission::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('missionvission.index');
    }

    public function edit($id)
    {
        $edit_data = MissionVission::find($id);
        return view('backEnd.missionvission.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
        ]);
        $update_data = MissionVission::find($request->id);
        $input = $request->all();
       
        $input['status'] = $request->status ? 1 : 0;
        $update_data->update($input);


        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('missionvission.index');
    }

    public function inactive(Request $request)
    {
        $inactive = MissionVission::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = MissionVission::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = MissionVission::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
