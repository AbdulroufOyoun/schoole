<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageTrait;
use App\Http\Requests\SchoolRequest\UpdateSchoolSettingsRequest;
use App\Http\Requests\SettingsRequest\StoreYearRequest;
use App\Http\Requests\SettingsRequest\UpdateSettingsRequest;
use App\Http\Requests\SettingsRequest\UpdateYearRequest;
use App\Models\AdvertisingTeacher;
use App\Models\School;
use App\Models\Setting;
use App\Models\User;
use App\Models\Year;
use Auth;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    use ImageTrait;
    public function settings()
    {
        $settings = Setting::first();
        return view('admin_panel.settings.index')->with('settings', $settings);
    }

    public function update_settings(UpdateSettingsRequest $request)
    {

        $data = $request->validated();
        $item = Setting::first();
        $item->update($data);
        session()->flash('success', __('alert.alert_update'));
        return redirect()->route('settings.index');

    }

    public function advertisingTeacher()
    {
        $teachers = User::whereRoleId(2)->get();
        $advertisingTeachers = AdvertisingTeacher::get();
        return view('admin_panel.settings.advertising-teacher',compact('teachers','advertisingTeachers'));
    }

    public function storeAdvertisingTeacher(Request $request)
    {
        $request->validate(['id' => 'required|unique:advertising_teachers,teacher_id']);
        AdvertisingTeacher::create([
            'teacher_id'=>$request->id ,
        ]);
        session()->flash('success', __('alert.alert_saved'));
        return redirect()->back();
    }

    public function deleteAdvertisingTeacher(Request $request)
    {
        AdvertisingTeacher::find($request->id)->delete();
        session()->flash('success', __('alert.alert_delete'));
        return redirect()->back();
    }
    public function schoolSettings()
    {
        $school = School::find(auth()->user()->school_id);
        return view('admin_panel.settings.school-settings',compact('school'));
    }

    public function updateSchoolSettings(UpdateSchoolSettingsRequest $request)
    {
        $data = $request->validated();
        $school = School::find(auth()->user()->school_id);
        if (isset($data['logo'])){
            $this->deleteImage($school->logo);
            $data['logo'] = $this->uploadImage($data['logo']);
        }
        $school->update($data);
        session()->flash('success', __('alert.alert_update'));
        return redirect()->back();
    }


    public function years()
    {
        $years = Year::latest()->get();
        return view('admin_panel.settings.years')->with('years', $years);
    }

    public function create_year(StoreYearRequest $request)
    {
        $data = $request->validated();
        Year::create($data);
        session()->flash('success', __('alert.alert_saved'));
        return redirect()->route('settings.years');
    }

    public function update_year(UpdateYearRequest $request)
    {
        $data = $request->validated();
        Year::find($request->id)->update($data);
        session()->flash('success', __('alert.alert_update'));
        return redirect()->route('settings.years');
    }

    public function activation_message(int $id)
    {
        $year_id = $id;
        return view('admin_panel.classrooms.Students-promotion.message-warning', compact('year_id'));
    }

    public function activation(int $id = null)
    {
        if ($id) {
            Year::where('activated', true)->update(['activated' => false]);
            Year::where('id', $id)->update(['activated' => true]);
            Auth::logout();
//            session()->flash('success', __('alert.alert_activeted'));
            return redirect()->route('dashboard');
        }
        return redirect()->route('settings.years');


    }

}
