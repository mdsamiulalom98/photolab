<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trialimage;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use App\Models\TrialOrder;
use App\Models\Service;
use ZipArchive;

class TrialOrderController extends Controller
{
    public function index($slug){
        $show_data = TrialOrder::where(['type'=> $slug])->latest()->paginate(50);
        return view('backEnd.trial.index', compact('show_data'));
    }

    public function trial_details($id)
    {
        $order = TrialOrder::where(['id' => $id])->with('trialimages')->first();
        $order->seen = 1;
        $order->save();
        $array = json_decode($order->services, true);
        $services = Service::whereIn('id', $array)->select('id', 'title')->get();
        return view('backEnd.trial.details', compact('order', 'services'));
    }

    public function downloadImagesAsZip($id)
    {
        $order = TrialOrder::find($id);
        $orderimages = Trialimage::where('trial_id', $order->id)->pluck('image')->toArray();
        if ($orderimages > 0) {
            $zipFileName = time() . '.zip';
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
    public function trial_status(Request $request) {
        $order_data = TrialOrder::where('id' , $request->id)->first();
        $order_data->status = $request->status;
        $order_data->save();
        Toastr::success('Success', 'Order status change successfully');
        return redirect()->back();
    }
    public function get_quote(Request $request) {
        $order_data = TrialOrder::where('id' , $request->id)->first();
        $order_data->status = $request->status;
        $order_data->save();
        Toastr::success('Success', 'Order status change successfully');
        return redirect()->back();
    }
    public function trial_delete(Request $request) {
        $order_data = TrialOrder::where('id' , $request->id)->first();
        $order_data->delete();
        Toastr::success('Success', 'Order delete successfully');
        return redirect()->back();
    }
    public function bulk_destroy(Request $request)
    {
        $orders_id = $request->order_ids;
        foreach ($orders_id as $order_id) {
            $order = TrialOrder::where('id', $order_id)->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'Order delete successfully']);
    }
}
