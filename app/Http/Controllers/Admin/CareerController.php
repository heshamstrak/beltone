<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CareerRequest;
use App\Models\Career;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_careers')->only(['index']);
        $this->middleware('permission:create_careers')->only(['create', 'store']);
        $this->middleware('permission:update_careers')->only(['edit', 'update']);
        $this->middleware('permission:delete_careers')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
         return view('admin.careers.index');

    }// end of index

    public function data()
    {
        $careers = Career::get();

        return DataTables::of($careers)
            ->addColumn('record_select', 'admin.careers.data_table.record_select')
            ->editColumn('created_at', function (Career $career) {
                return $career->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.careers.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.careers.create');

    }// end of create

    public function store(CareerRequest $request)
    {
        $requestData = $request->validated();
        Career::create($requestData);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.careers.index');

    }// end of store

    public function edit(Career $career)
    {
        return view('admin.careers.edit', compact('career'));

    }// end of edit

    public function update(CareerRequest $request, Career $career)
    {
        $requestData = $request->validated();
        $career->update($requestData);

        session()->flash('success', __('Update Successfully'));
        return redirect()->route('admin.careers.index');

    }// end of update

    public function destroy(Career $career)
    {
        $this->delete($career);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $career = Career::FindOrFail($recordId);
            $this->delete($career);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Career $career)
    {
        $career->delete();

    }// end of delete

}//end of controller
