<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamRequest;
use App\Models\Team;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    private $name = 'teams';

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
        $teams = Team::get();

        return DataTables::of($teams)
            ->addColumn('record_select', 'admin.'.$this->name.'.data_table.record_select')
            ->addColumn('image', function (Team $team) {
                return view('admin.'.$this->name.'.data_table.image', compact('team'));
            })
            ->editColumn('created_at', function (Team $team) {
                return $team->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.'.$this->name.'.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.'.$this->name.'.create');

    }// end of create

    public function store(TeamRequest $request)
    {
        $requestData = $request->validated();
        if ($request->image) {
            $request->image->store('public/uploads/'.$this->name.'/');
            $requestData['image'] = $request->image->hashName();
        }

        Team::create($requestData);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.'.$this->name.'.index');

    }// end of store

    public function edit(Team $team)
    {
        return view('admin.'.$this->name.'.edit', compact('team'));

    }// end of edit

    public function update(TeamRequest $request, Team $team)
    {
        $requestData = $request->validated();

        if ($request->image) {
            Storage::disk('local')->delete('public/uploads/'.$this->name.'/' . $team->image);
            $request->image->store('public/uploads/'.$this->name.'/');
            $requestData['image'] = $request->image->hashName();
        }

        $team->update($requestData);

        session()->flash('success', __('Update Successfully'));
        return redirect()->route('admin.'.$this->name.'.index');

    }// end of update

    public function destroy(Team $team)
    {
        $this->delete($team);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $team = Team::FindOrFail($recordId);
            $this->delete($team);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Team $team)
    {
        Storage::disk('local')->delete('public/uploads/'.$this->name.'/' . $team->image);

        $press->delete();

    }// end of delete

}//end of controller
