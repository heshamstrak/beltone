<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BusinessRequest;
use App\Models\Business;
use App\Models\Category;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Storage;

class BusinessController extends Controller
{
    private $name = 'businesses';

    public function __construct()
    {
        $this->middleware('permission:read_'.$this->name)->only(['index']);
        $this->middleware('permission:create_'.$this->name)->only(['create', 'store']);
        $this->middleware('permission:update_'.$this->name)->only(['edit', 'update']);
        $this->middleware('permission:delete_'.$this->name)->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index(Category $category)
    {
         return view('admin.'.$this->name.'.index', compact('category'));

    }// end of index

    public function data(Category $category)
    {
        $businesses = Business::where('category_id', $category->id)->get();

        return DataTables::of($businesses)
            ->addColumn('record_select', 'admin.'.$this->name.'.data_table.record_select')
            ->addColumn('image', function (Business $business) {
                return view('admin.'.$this->name.'.data_table.image', compact('business'));
            })
            ->editColumn('created_at', function (Business $Business) {
                return $Business->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.'.$this->name.'.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create(Category $category)
    {
        $categories = Category::get();
        return view('admin.'.$this->name.'.create', compact('categories', 'category'));

    }// end of create

    public function store(BusinessRequest $request, Category $category)
    {
        $requestData = $request->validated();
        if ($request->image) {
            $request->image->store('public/uploads/'.$this->name.'/');
            $requestData['image'] = $request->image->hashName();
        }
        $requestData['category_id'] = $category->id;
        Business::create($requestData);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.'.$this->name.'.index', $category->id);

    }// end of store

    public function edit(Business $business, Category $category)
    {
        return view('admin.'.$this->name.'.edit', compact('business', 'category'));
    }// end of edit

    public function update(BusinessRequest $request, Business $business)
    {
        $requestData = $request->validated();

        if ($request->image) {
            Storage::disk('local')->delete('public/uploads/'.$this->name.'/' . $business->image);
            $request->image->store('public/uploads/'.$this->name.'/');
            $requestData['image'] = $request->image->hashName();
        }

        $business->update($requestData);

        session()->flash('success', __('Update Successfully'));
        return redirect()->route('admin.'.$this->name.'.index', $business->category_id);

    }// end of update

    public function destroy(Business $business)
    {
        $this->delete($business);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $business = Business::FindOrFail($recordId);
            $this->delete($business);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Business $business)
    {
        Storage::disk('local')->delete('public/uploads/'.$this->name.'/' . $business->image);

        $business->delete();

    }// end of delete

}//end of controller
