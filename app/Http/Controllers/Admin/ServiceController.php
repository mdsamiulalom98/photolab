<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Service;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:service-list|service-create|service-edit|service-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:service-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:service-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:service-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $show_data = Service::orderBy('id', 'DESC')->get();
        return view('backEnd.service.index', compact('show_data'));
    }

    public function create()
    {
        return view('backEnd.service.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required'
        ]);
        // image with intervention
        $image = $request->file('image');
        $name =  time() . '-' . $image->getClientOriginalName();
        $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
        $name = strtolower(preg_replace('/\s+/', '-', $name));
        $uploadpath = 'public/uploads/service/';
        $imageUrl = $uploadpath . $name;
        $img = Image::make($image->getRealPath());
        $img->encode('webp', 90);
        $width = '';
        $height = '';
        $img->height() > $img->width() ? $width = null : $height = null;
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($imageUrl);

        $input = $request->except(['names', 'old_prices', 'new_prices']);
        $input['image'] = $imageUrl;
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->title));
        $input['slug'] = str_replace('/', '', $input['slug']);

        $save_data = Service::create($input);

        if ($request->names) {
            $names      = array_filter($request->names);
            $old_price  = $request->old_prices;
            $new_price  = $request->new_prices;
            if (is_array($names)) {
                foreach ($names as $key => $name) {
                    $pricing = new Pricing();
                    $pricing->service_id = $save_data->id;
                    $pricing->name = $name ?? null;
                    $pricing->old_price = isset($old_price[$key]) ? $old_price[$key] : null;
                    $pricing->new_price = isset($new_price[$key]) ? $new_price[$key] : null;
                    $pricing->save();

                }
            }
        }
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('service.index');
    }

    public function edit($id)
    {
        $edit_data = Service::find($id);
        $pricings = Pricing::where('service_id', $edit_data->id)->get();
        return view('backEnd.service.edit', compact('edit_data', 'pricings'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required'
        ]);
        $input = $request->except('hidden_id', 'names', 'old_prices', 'new_prices', 'up_id', 'up_names', 'up_old_prices', 'up_new_prices');
        $update_data = Service::find($request->hidden_id);

        $image = $request->file('image');
        if ($image) {
            // image with intervention
            $name =  time() . '-' . $image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/service/';
            $imageUrl = $uploadpath . $name;
            $img = Image::make($image->getRealPath());
            $img->encode('webp', 90);
            $width = '';
            $height = '';
            $img->height() > $img->width() ? $width = null : $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($imageUrl);
            $input['image'] = $imageUrl;
            File::delete($update_data->image);
        } else {
            $input['image'] = $update_data->image;
        }
        $input['status'] = $request->status ? 1 : 0;
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->title));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $update_data->update($input);

        if ($request->up_id) {
            $update_ids = array_filter($request->up_id);
            $up_names     = $request->up_names;
            $up_old_price    = $request->up_old_prices;
            $up_new_price    = $request->up_new_prices;
            if ($update_ids) {
                foreach ($update_ids as $key => $update_id) {
                    $upvariable =  Pricing::find($update_id);
                    $upvariable->service_id       = $update_data->id;
                    $upvariable->name             = $up_names[$key];
                    $upvariable->old_price        = $up_old_price ? $up_old_price[$key] : NULL;
                    $upvariable->new_price        = $up_new_price[$key];
                    $upvariable->save();
                }
            }
        }

        if ($request->names) {
            $names     = array_filter($request->names);
            $old_price  = $request->old_prices;
            $new_price  = $request->new_prices;
            if (is_array($names)) {
                foreach ($names as $key => $name) {
                    $variable                   = new Pricing();
                    $variable->service_id       = $update_data->id;
                    $variable->name             = $name;
                    $variable->old_price        = $old_price ? $old_price[$key] : null;
                    $variable->new_price        = $new_price[$key];
                    $variable->save();
                }
            }
        }

        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('service.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Service::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Service::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {

        $delete_data = Service::find($request->hidden_id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
