<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_services')->only(['index']);
        $this->middleware('permission:create_services')->only(['create', 'store']);
        $this->middleware('permission:update_services')->only(['edit', 'update']);
        $this->middleware('permission:delete_services')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
         return view('admin.services.index');

    }// end of index

    public function data()
    {
        $services = Service::get();

        return DataTables::of($services)
            ->addColumn('record_select', 'admin.services.data_table.record_select')
            ->editColumn('created_at', function (Service $service) {
                return $service->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.services.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.services.create');

    }// end of create

    public function store(ServiceRequest $request)
    {
        $requestData = $request->validated();
        Service::create($requestData);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.services.index');

    }// end of store

    public function edit(service $service)
    {
        return view('admin.services.edit', compact('service'));

    }// end of edit

    public function update(serviceRequest $request, service $service)
    {
        $requestData = $request->validated();
        $service->update($requestData);

        session()->flash('success', __('Update Successfully'));
        return redirect()->route('admin.services.index');

    }// end of update

    public function destroy(service $service)
    {
        $this->delete($service);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $service = service::FindOrFail($recordId);
            $this->delete($service);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(service $service)
    {
        $service->delete();

    }// end of delete

}//end of controller
