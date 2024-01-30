<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_products')->only(['index']);
        $this->middleware('permission:create_products')->only(['create', 'store']);
        $this->middleware('permission:update_products')->only(['edit', 'update']);
        $this->middleware('permission:delete_products')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
         return view('admin.products.index');

    }// end of index

    public function data()
    {
        $products = Product::get();

        return DataTables::of($products)
            ->addColumn('record_select', 'admin.products.data_table.record_select')
            ->editColumn('created_at', function (Product $product) {
                return $product->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.products.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.products.create');

    }// end of create

    public function store(ProductRequest $request)
    {
        $requestData = $request->validated();
        Product::create($requestData);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.products.index');

    }// end of store

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));

    }// end of edit

    public function update(ProductRequest $request, Product $product)
    {
        $requestData = $request->validated();
        $product->update($requestData);

        session()->flash('success', __('Update Successfully'));
        return redirect()->route('admin.products.index');

    }// end of update

    public function destroy(Product $product)
    {
        $this->delete($product);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $product = Product::FindOrFail($recordId);
            $this->delete($product);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Product $products)
    {
        $product->delete();

    }// end of delete

}//end of controller
