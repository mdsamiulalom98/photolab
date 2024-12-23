<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $data = Portfolio::orderBy('id', 'DESC')->get();
        return view('backEnd.portfolio.index', compact('data'));
    }
    public function create()
    {
        $pcategories = PortfolioCategory::where('status', 1)->get();
        return view('backEnd.portfolio.create', compact('pcategories'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'image_one' => 'required',
            'image_two' => 'required',
            'status' => 'required',
        ]);
        // image with intervention
        $imageOne = $request->file('image_one');
        if ($imageOne) {
            $name =  time() . '-' . $imageOne->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/portfolio/';
            $imageOneUrl = $uploadpath . $name;
            $img = Image::make($imageOne->getRealPath());
            $img->encode('webp', 90);
            $width = "400";
            $height = "400";
            $img->height() > $img->width() ? $width = null : $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($imageOneUrl);
        } else {
            $imageOneUrl = null;
        }
        // image two with intervention
        $imageTwo = $request->file('image_two');
        if ($imageTwo) {
            $name =  time() . '-' . $imageTwo->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/portfolio/';
            $imageTwoUrl = $uploadpath . $name;
            $img = Image::make($imageTwo->getRealPath());
            $img->encode('webp', 90);
            $width = "400";
            $height = "400";
            $img->height() > $img->width() ? $width = null : $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($imageTwoUrl);
        } else {
            $imageTwoUrl = null;
        }

        $input = $request->all();
        $input['image_one'] = $imageOneUrl;
        $input['image_two'] = $imageTwoUrl;
        Portfolio::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('portfolios.index');
    }

    public function edit($id)
    {
        $edit_data = Portfolio::find($id);
        $pcategories = PortfolioCategory::select('id', 'name')->get();
        return view('backEnd.portfolio.edit', compact('edit_data', 'pcategories'));
    }

    public function update(Request $request)
    {
        $update_data = Portfolio::find($request->id);
        $input = $request->all();
        $imageOne = $request->file('image_one');
        if ($imageOne) {
            // image with intervention
            $name =  time() . '-' . $imageOne->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/portfolio/';
            $imageOneUrl = $uploadpath . $name;
            $img = Image::make($imageOne->getRealPath());
            $img->encode('webp', 90);
            $width = "400";
            $height = "400";
            $img->height() > $img->width() ? $width = null : $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::delete($update_data->image_one);
            $img->save($imageOneUrl);
            $input['image_one'] = $imageOneUrl;
        } else {
            $input['image_one'] = $update_data->image_one;
        }
        $imageTwo = $request->file('image_two');
        if ($imageTwo) {
            // image with intervention
            $name =  time() . '-' . $imageTwo->getClientOriginalName();
            $name = preg_replace('"\.(jpg|jpeg|png|webp)$"', '.webp', $name);
            $name = strtolower(preg_replace('/\s+/', '-', $name));
            $uploadpath = 'public/uploads/portfolio/';
            $imageTwoUrl = $uploadpath . $name;
            $img = Image::make($imageTwo->getRealPath());
            $img->encode('webp', 90);
            $width = "400";
            $height = "400";
            $img->height() > $img->width() ? $width = null : $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::delete($update_data->image_two);
            $img->save($imageTwoUrl);
            $input['image_two'] = $imageTwoUrl;
        } else {
            $input['image_two'] = $update_data->image_two;
        }
        $input['status'] = $request->status ? 1 : 0;
        $update_data->update($input);
        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('portfolios.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Portfolio::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Portfolio::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = Portfolio::find($request->hidden_id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
