<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    private $name = 'pages';

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
        $pages = Page::get();

        return DataTables::of($pages)
            ->addColumn('record_select', 'admin.'.$this->name.'.data_table.record_select')
            ->addColumn('parent', function (Page $page) {
                return view('admin.'.$this->name.'.data_table.parent', compact('page'));
            })
            ->editColumn('created_at', function (Page $page) {
                return $page->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.'.$this->name.'.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        $pages = Page::get();
        return view('admin.'.$this->name.'.create', compact('pages'));

    }// end of create

    public function store(PageRequest $request)
    {
        $requestData = $request->validated();
        $requestData['slug'] = str_replace(' ', '-', strtolower($requestData['title']));
        Page::create($requestData);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.'.$this->name.'.index');

    }// end of store

    public function edit(Page $page)
    {
        $pages = Page::get();
        return view('admin.'.$this->name.'.edit', compact('page', 'pages'));

    }// end of edit

    public function update(PageRequest $request, Page $page)
    {
        $requestData = $request->validated();
        $requestData['slug'] = str_replace(' ', '-', strtolower($requestData['title']));
        $page->update($requestData);

        session()->flash('success', __('Update Successfully'));
        return redirect()->route('admin.'.$this->name.'.index');

    }// end of update

    public function destroy(Page $page)
    {
        $this->delete($page);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $page = Page::FindOrFail($recordId);
            $this->delete($page);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Page $page)
    {
        $press->delete();
    }// end of delete

}//end of controller
