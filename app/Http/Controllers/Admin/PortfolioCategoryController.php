<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\PortfolioCategory;

class PortfolioCategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = PortfolioCategory::orderBy('id', 'DESC')->get();
        return view('backEnd.portfolio.category.index', compact('data'));
    }
    public function create()
    {
        return view('backEnd.portfolio.category.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
        ]);
        // image with intervention

        $input = $request->all();
        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->name));
        $input['slug'] = str_replace('/', '', $input['slug']);

        PortfolioCategory::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('portfolio_category.index');
    }

    public function edit($id)
    {
        $edit_data = PortfolioCategory::find($id);
        return view('backEnd.portfolio.category.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $update_data = PortfolioCategory::find($request->id);
        $input = $request->all();

        $input['slug'] = strtolower(preg_replace('/\s+/', '-', $request->name));
        $input['slug'] = str_replace('/', '', $input['slug']);
        $input['status'] = $request->status ? 1 : 0;
        $update_data->update($input);
        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('portfolio_category.index');
    }

    public function inactive(Request $request)
    {
        $inactive = PortfolioCategory::find($request->hidden_id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = PortfolioCategory::find($request->hidden_id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $delete_data = PortfolioCategory::find($request->hidden_id);
        File::delete($delete_data->image);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
