<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }// end of __construct


    public function general()
    {
        return view('admin.settings');

    }// end of index

    public function store(Request $request)
    {

        $request->validate([
            'email'         => 'sometimes|nullable|email',
            'phone'         => 'sometimes|nullable',
            'address'       => 'sometimes|nullable',
            'map_link'      => 'sometimes|nullable',
            'logo_header'   => 'sometimes|nullable|mimes:jpeg,png,jpg,gif,svg,webp',
            'logo_footer'   => 'sometimes|nullable|mimes:jpeg,png,jpg,gif,svg,webp',
            'facebook'      => 'sometimes|nullable',
            'twitter'       => 'sometimes|nullable',
            'linkedin'      => 'sometimes|nullable',
            'youtube'       => 'sometimes|nullable',
            'instagram'     => 'sometimes|nullable',
            'title'         => 'sometimes|nullable',
            'description'   => 'sometimes|nullable',
            'link_video'    => 'sometimes|nullable',
        ]);

        $requestData = $request->except(['_token', '_method']);

        if ($request->logo_header) {
            Storage::disk('local')->delete('public/uploads/' . setting('logo_header'));
            $request->logo_header->store('public/uploads/settings/');
            $requestData['logo_header'] = $request->logo_header->hashName();
        }

        if ($request->logo_footer) {
            Storage::disk('local')->delete('public/uploads/settings/' . setting('logo_footer'));
            $request->logo_footer->store('public/uploads/settings');
            $requestData['logo_footer'] = $request->logo_footer->hashName();
        }

        setting($requestData)->save();
        session()->flash('success', __('Update Successfully'));
        return redirect()->back();

    }// end of store

}//end of controller


