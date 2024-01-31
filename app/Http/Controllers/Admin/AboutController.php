<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutRequest;
use App\Models\About;
use App\Models\Item;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }// end of __construct

    public function index()
    {
         return view('admin.abouts.index');

    }// end of index

    public function data()
    {
        $abouts = Item::where('type', 'about-us')->get();

        return DataTables::of($abouts)
            ->addColumn('record_select', 'admin.abouts.data_table.record_select')
            ->addColumn('image', function (Item $about) {
                return view('admin.abouts.data_table.icon', compact('about'));
            })
            ->editColumn('created_at', function (Item $about) {
                return $about->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.abouts.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.abouts.create');

    }// end of create

    public function store(AboutRequest $request)
    {
        $requestData = $request->validated();
        if ($request->image) {
            $request->image->store('public/uploads/image');
            $requestData['image'] = $request->image->hashName();
        }
        Item::create([
            'label_1'       => $requestData['title'], 
            'description_1' => $requestData['description'], 
            'image_1'       => $requestData['image'],
            'type'          => 'about-us', 
        ]);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.abouts.index');

    }// end of store

    public function edit(About $about)
    {
        return view('admin.abouts.edit', compact('about'));

    }// end of edit

    public function update(AboutRequest $request, About $about)
    {
        $requestData = $request->validated();

        if ($request->icon) {
            Storage::disk('local')->delete('public/uploads/icons/' . $about->icon);
            $request->icon->store('public/uploads/icons/');
            $requestData['icon'] = $request->icon->hashName();
        }

        $about->update($requestData);

        session()->flash('success', __('Update Successfully'));
        return redirect()->route('admin.abouts.index');

    }// end of update

    public function destroy(About $about)
    {
        $this->delete($about);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $about = About::FindOrFail($recordId);
            $this->delete($about);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(About $about)
    {
        Storage::disk('local')->delete('public/uploads/icons/' . $about->icon);
        $about->delete();

    }// end of delete

}//end of controller
