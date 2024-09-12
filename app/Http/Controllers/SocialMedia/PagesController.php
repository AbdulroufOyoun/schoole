<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageTrait;
use App\Http\Requests\SettingsRequest\storeAvtivitesRequest;
use App\Http\Requests\SettingsRequest\UpdateActivityRequest;
use App\Models\Activities;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    use ImageTrait;

    public function activites()
    {
        $activites = Activities::get();
        return view('admin_panel.advertising.activites.index')->with('activites', $activites);
    }

    public function store_activities(storeAvtivitesRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $this->uploadImage($data['image']);
        Activities::create($data);
        session()->flash('success', __('alert.alert_saved'));
        return redirect()->route('advertising.activtes');
    }

    public function delete_activities(Request $request)
    {

        Activities::find($request->id)->delete();
        session()->flash('success', __('alert.alert_delete'));
        return redirect()->route('advertising.activtes');

    }
    public function edit_activities(int $id)
    {
        $activity = Activities::find($id);
        return view('admin_panel.advertising.activites.edit')->with('activity',$activity);
    }

    public function update_activities(UpdateActivityRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $this->deleteImage($data['image']);
            $data['image'] = $this->uploadImage($data['image']);
        }
        Activities::find($data['id'])->update($data);
        session()->flash('success', __('alert.alert_update'));
        return redirect()->route('advertising.activtes');

    }

}
