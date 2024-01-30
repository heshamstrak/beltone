<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PressRequest;
use App\Models\Press;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class PressController extends Controller
{
    private $name = 'presses';

    public function __construct()
    {
        $this->middleware('permission:read_'.$this->name)->only(['index']);
        $this->middleware('permission:create_'.$this->name)->only(['create', 'store']);
        $this->middleware('permission:update_'.$this->name)->only(['edit', 'update']);
        $this->middleware('permission:delete_'.$this->name)->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
         return view('admin.'.$this->name.'.index');

    }// end of index

    public function data()
    {
        $presses = Press::get();

        return DataTables::of($presses)
            ->addColumn('record_select', 'admin.'.$this->name.'.data_table.record_select')
            ->addColumn('video_gallery', function (Press $press) {
                return view('admin.'.$this->name.'.data_table.video_gallery', compact('press'));
            })
            ->editColumn('created_at', function (Press $press) {
                return $press->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.'.$this->name.'.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.'.$this->name.'.create');

    }// end of create

    public function store(PressRequest $request)
    {
        $requestData = $request->validated();
        if ($request->poster) {
            $request->poster->store('public/uploads/'.$this->name.'/');
            $requestData['poster'] = $request->poster->hashName();
        }

        Press::create($requestData);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.'.$this->name.'.index');

    }// end of store

    public function edit(Press $press)
    {
        return view('admin.'.$this->name.'.edit', compact('press'));

    }// end of edit

    public function update(PressRequest $request, Press $press)
    {
        $requestData = $request->validated();

        if ($request->poster) {
            Storage::disk('local')->delete('public/uploads/'.$this->name.'/' . $press->poster);
            $request->poster->store('public/uploads/'.$this->name.'/');
            $requestData['poster'] = $request->poster->hashName();
        }

        $press->update($requestData);

        session()->flash('success', __('Update Successfully'));
        return redirect()->route('admin.'.$this->name.'.index');

    }// end of update

    public function destroy(Press $press)
    {
        $this->delete($press);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $press = Press::FindOrFail($recordId);
            $this->delete($press);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Press $press)
    {
        Storage::disk('local')->delete('public/uploads/'.$this->name.'/' . $press->poster);

        $press->delete();

    }// end of delete

    public function upload(Request $request)
    {
        $image = $request->file('upload')->store('public/presses/ckeditor/');
        $url = asset(str_replace('public', 'storage', $image));
        return response()->json(['url' => $url]);
    }

}//end of controller
