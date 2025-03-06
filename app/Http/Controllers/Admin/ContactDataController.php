<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactData;
use Brian2694\Toastr\Facades\Toastr;

class ContactDataController extends Controller
{
    public function index(Request $request)
    {
        $show_data = ContactData::orderBy('id', 'DESC')->get();
        return view('backEnd.contactdata.index', compact('show_data'));
    }

    public function destroy(Request $request)
    {
        $delete_data = ContactData::find($request->hidden_id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }

    public function bulk_destroy(Request $request)
    {
        $infos = $request->info_ids;
        foreach ($infos as $info) {
            ContactData::where('id', $info)->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'Data delete successfully']);
    }
}
