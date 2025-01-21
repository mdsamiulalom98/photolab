<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trialimage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\TrialOrder;
use App\Models\Service;
use ZipArchive;

class TrialOrderController extends Controller
{
    public function index(Request $request)
    {
        $show_data = TrialOrder::where(['type'=> $request->type])->latest()->paginate(50);
        return view('backEnd.trial.index', compact('show_data'));
    }

    public function trial_details($id)
    {
        $order = TrialOrder::where(['id' => $id])->with('trialimages')->first();
        $array = json_decode($order->services, true);
        $services = Service::whereIn('id', $array)->select('id', 'title')->get();
        return view('backEnd.trial.details', compact('order', 'services'));
    }

    public function downloadImagesAsZip(Request $request)
    {
        $order = TrialOrder::find($request->id);
        $orderimages = Trialimage::where('trial_id', $order->id)->pluck('image')->toArray();
        if ($orderimages > 0) {
            $zipFileName = $order->order_name . '.zip';
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
}
