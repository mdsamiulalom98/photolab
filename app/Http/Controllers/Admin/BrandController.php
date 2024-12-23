<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Brand;

class BrandController extends Controller
{

    function __construct()
    {
        // $this->middleware('permission:brand-list|brand-create|brand-edit|brand-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:brand-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:brand-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Brand::orderBy('id', 'DESC')->get();
        return view('backEnd.brand.index', compact('data'));
    }
    public function create()
    {
        return view('backEnd.brand.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
        ]);
        // image with intervention
        $image = $request->file('image');
        if ($image) {
            $name =  time() . '-' . $image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/brand/';
            $imageUrl = $uploadpath . $name;
            $img = Image::make($image->getRealPath());
            $img->encode('webp', 90);
            $width = "400";
            $height = "400";
            $img->height() > $img->width() ? $width = null : $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($imageUrl);
        } else {
            $imageUrl = null;
        }

        $input = $request->all();
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->name));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $input['image'] = $imageUrl;
        Brand::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('brands.index');
    }

    public function edit($id)
    {
        $edit_data = Brand::find($id);
        $brands = Brand::select('id', 'name')->get();
        return view('backEnd.brand.edit', compact('edit_data', 'brands'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $update_data = Brand::find($request->id);
        $input = $request->all();
        $image = $request->file('image');
        if ($image) {
            // image with intervention
            $name =  time() . '-' . $image->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/brand/';
            $imageUrl = $uploadpath . $name;
            $img = Image::make($image->getRealPath());
            $img->encode('webp', 90);
            $width = "400";
            $height = "400";
            $img->height() > $img->width() ? $width = null : $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::delete($update_data->image);
            $img->save($imageUrl);
            $input['image'] = $imageUrl;
        } else {
            $input['image'] = $update_data->image;
        }
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->name));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $input['status'] = $request->status ? 1 : 0;
        $update_data->update($input);
        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('brands.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Brand::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Brand::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Brand::find($request->hidden_id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
