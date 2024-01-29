<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_blogs')->only(['index']);
        $this->middleware('permission:create_blogs')->only(['create', 'store']);
        $this->middleware('permission:update_blogs')->only(['edit', 'update']);
        $this->middleware('permission:delete_blogs')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
         return view('admin.blogs.index');

    }// end of index

    public function data()
    {
        $blogs = Blog::get();

        return DataTables::of($blogs)
            ->addColumn('record_select', 'admin.blogs.data_table.record_select')
            ->addColumn('poster', function (Blog $blog) {
                return view('admin.blogs.data_table.poster', compact('blog'));
            })
            ->editColumn('created_at', function (Blog $blog) {
                return $blog->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.blogs.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.blogs.create');

    }// end of create

    public function store(BlogRequest $request)
    {
        $requestData = $request->validated();
        if ($request->poster) {
            $request->poster->store('public/uploads/blogs');
            $requestData['poster'] = $request->poster->hashName();
        }

        Blog::create($requestData);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.blogs.index');

    }// end of store

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));

    }// end of edit

    public function update(BlogRequest $request, Blog $blog)
    {
        $requestData = $request->validated();

        if ($request->poster) {
            Storage::disk('local')->delete('public/uploads/blogs/' . $blog->poster);
            $request->poster->store('public/uploads/blogs/');
            $requestData['poster'] = $request->poster->hashName();
        }

        $blog->update($requestData);

        session()->flash('success', __('Update Successfully'));
        return redirect()->route('admin.blogs.index');

    }// end of update

    public function destroy(Blog $blog)
    {
        $this->delete($blog);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $blog = Blog::FindOrFail($recordId);
            $this->delete($blog);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Blog $blog)
    {
        Storage::disk('local')->delete('public/uploads/blogs/' . $blog->poster);

        $blog->delete();

    }// end of delete

}//end of controller
