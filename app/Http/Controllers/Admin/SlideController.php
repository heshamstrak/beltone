<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SlideRequest;
use App\Models\Slide;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_slides')->only(['index']);
        $this->middleware('permission:create_slides')->only(['create', 'store']);
        $this->middleware('permission:update_slides')->only(['edit', 'update']);
        $this->middleware('permission:delete_slides')->only(['delete', 'bulk_delete']);

    }// end of __construct


    public function index()
    {
         return view('admin.slides.index');

    }// end of index

    public function data()
    {
        $slides = Slide::get();

        return DataTables::of($slides)
            ->addColumn('record_select', 'admin.slides.data_table.record_select')
            ->addColumn('image', function (Slide $slide) {
                return view('admin.slides.data_table.image', compact('slide'));
            })
            ->editColumn('created_at', function (Slide $slide) {
                return $slide->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.slides.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.slides.create');

    }// end of create

    public function store(SlideRequest $request)
    {
        $requestData = $request->validated();
        if ($request->image) {
            $request->image->store('public/uploads/slides');
            $requestData['image'] = $request->image->hashName();
        }

        Slide::create($requestData);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.slides.index');

    }// end of store

    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));

    }// end of edit

    public function update(SlideRequest $request, Slide $slide)
    {
        $requestData = $request->validated();

        if ($request->image) {
            Storage::disk('local')->delete('public/uploads/slides/' . $slide->image);
            $request->image->store('public/uploads/slides/');
            $requestData['image'] = $request->image->hashName();
        }

        $slide->update($requestData);

        session()->flash('success', __('Update Successfully'));
        return redirect()->route('admin.slides.index');

    }// end of update

    public function destroy(Slide $slide)
    {
        $this->delete($slide);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $slide = Slide::FindOrFail($recordId);
            $this->delete($slide);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Slide $slide)
    {
        Storage::disk('local')->delete('public/uploads/slides/' . $slide->image);

        $slide->delete();

    }// end of delete

}//end of controller
