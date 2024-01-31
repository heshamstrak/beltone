<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InvestorRequest;
use App\Models\Investor;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class InvestorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }// end of __construct

    public function index()
    {
         return view('admin.investors.index');

    }// end of index

    public function data()
    {
        $investors = Investor::get();

        return DataTables::of($investors)
            ->addColumn('record_select', 'admin.investors.data_table.record_select')
            ->addColumn('parent', function (Investor $investor) {
                return view('admin.investors.data_table.parent', compact('investor'));
            })
            ->editColumn('created_at', function (Investor $investor) {
                return $investor->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.investors.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        $investors = Investor::whereNull('parent_id')->get();
        return view('admin.investors.create', compact('investors'));

    }// end of create

    public function store(InvestorRequest $request)
    {
        $requestData = $request->validated();
        Investor::create($requestData);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.investors.index');

    }// end of store

    public function edit(Investor $investor)
    {
        $investors = Investor::where('id', '!=', $investor->id)->whereNull('parent_id')->get();
        return view('admin.investors.edit', compact('investor', 'investors'));

    }// end of edit

    public function update(InvestorRequest $request, Investor $investor)
    {
        $requestData = $request->validated();
        $investor->update($requestData);

        session()->flash('success', __('Update Successfully'));
        return redirect()->route('admin.investors.index');

    }// end of update

    public function destroy(Investor $investor)
    {
        $this->delete($investor);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $investor = Investor::FindOrFail($recordId);
            $this->delete($investor);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Investor $investor)
    {
        $investor->delete();
    }// end of delete

}//end of controller
