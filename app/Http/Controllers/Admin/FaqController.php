<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Faq;

class FaqController extends Controller
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
        $show_data = Faq::orderBy('id', 'DESC')->get();
        return view('backEnd.faq.index', compact('show_data'));
    }
    public function create()
    {
        return view('backEnd.faq.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
            'status' => 'required',
        ]);
        $input = $request->all();
        Faq::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('faqs.index');
    }

    public function edit($id)
    {
        $edit_data = Faq::find($id);
        return view('backEnd.faq.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'question' => 'required',
            'answer' => 'required',
        ]);
        $input = $request->except('hidden_id');
        $update_data = Faq::find($request->hidden_id);
        $update_data->update($input);

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('faqs.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Faq::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Faq::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Faq::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
