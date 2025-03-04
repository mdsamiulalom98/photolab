<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Workname;

class WorknameController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:workname-list|workname-create|workname-edit|workname-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:workname-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:workname-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:workname-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $show_data = Workname::orderBy('id', 'DESC')->get();
        return view('backEnd.workname.index', compact('show_data'));
    }

    public function create()
    {
        return view('backEnd.workname.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $input = $request->except(['names', 'old_prices', 'new_prices']);
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->title));
        $input['slug'] = str_replace('/', '', $input['slug']);
        Workname::create($input);

        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('worknames.index');
    }

    public function edit($id)
    {
        $edit_data = Workname::find($id);
        return view('backEnd.workname.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $input = $request->except('hidden_id');
        $update_data = Workname::find($request->hidden_id);

        $input['status'] = $request->status ? 1 : 0;
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->title));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('worknames.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Workname::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Workname::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {

        $delete_data = Workname::find($request->hidden_id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
