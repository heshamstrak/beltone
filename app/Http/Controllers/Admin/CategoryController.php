<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_categories')->only(['index']);
        $this->middleware('permission:create_categories')->only(['create', 'store']);
        $this->middleware('permission:update_categories')->only(['edit', 'update']);
        $this->middleware('permission:delete_categories')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
         return view('admin.categories.index');

    }// end of index

    public function data()
    {
        $categories = Category::get();

        return DataTables::of($categories)
            ->addColumn('record_select', 'admin.categories.data_table.record_select')
            ->editColumn('created_at', function (Category $category) {
                return $category->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.categories.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.categories.create');

    }// end of create

    public function store(CategoryRequest $request)
    {
        $requestData = $request->validated();
        if ($request->image) {
            $request->image->store('public/uploads/categories/');
            $requestData['image'] = $request->image->hashName();
        }

        Category::create($requestData);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.categories.index');

    }// end of store

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));

    }// end of edit

    public function update(CategoryRequest $request, Category $category)
    {
        $requestData = $request->validated();
        if ($request->image) {
            Storage::disk('local')->delete('public/uploads/categories/' . $category->image);
            $request->poster->store('public/uploads/categories/');
            $requestData['image'] = $request->image->hashName();
        }

        $category->update($requestData);
        session()->flash('success', __('Update Successfully'));
        return redirect()->route('admin.categories.index');

    }// end of update

    public function destroy(Category $category)
    {
        $this->delete($category);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $category = Category::FindOrFail($recordId);
            $this->delete($category);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Category $category)
    {
        Storage::disk('local')->delete('public/uploads/categories/' . $category->image);
        $category->delete();

    }// end of delete

}//end of controller
