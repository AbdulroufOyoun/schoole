<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageTrait;
use App\Http\Requests\SchoolRequest\StoreSchoolAdminRequest;
use App\Http\Requests\SchoolRequest\StoreSchoolRequest;
use App\Http\Requests\SchoolRequest\UpdateSchoolRequest;
use App\Models\Post;
use App\Models\School;
use App\Models\Semester;
use App\Models\Term;
use App\Models\User;
use App\Models\Week;
use App\Models\Year;
use App\Models\YearlyPlan;
use Hash;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SchoolController extends Controller
{

    use ImageTrait;

    public function schools()
    {
        $schools = School::get();
        return view('admin_panel.schools.index', compact('schools'));
    }

    public function createSchool(StoreSchoolRequest $request)
    {
        $data = $request->validated();
        $data['logo'] = $this->uploadImage($data['logo']);
        $school = School::create($data);
        $year = Year::create([
            'name' => '2023-2024',
            'end_date' => '2024-6-12',
            'activated' => true,
        ]);
        $year->school_id = $school->id;
        $year->update();
        $semester = Semester::create([
            'year_id'=>$year->id,
            'name'=>'Semester 1',
            'end_at'=>'2023-12-20',
        ]);
        $semester->school_id = $school->id;
        $semester->update();
        $term = Term::create([
            'name'=>'Term 1',
            'year_id'=>$year->id,
            'semester_id'=>$semester->id,
            'end_at'=>'2023-10-20',
        ]);
        $term->school_id = $school->id;
        $term->update();
        $week = Week::create([
            'year_id'=>$year->id,
            'start_at'=>'2023-06-19 02:14:00',
            'end_at'=>'2023-06-23 02:14:00',
            'start_upload_plans'=>'2023-06-21 03:14:00',
            'end_upload_plans'=>'2023-06-22 01:14:00',
        ]);
        $week->school_id = $school->id;
        $week->update();
        $request->session()->flash('success', __('alert.alert_saved'));
        return redirect()->back();
    }

    public function updateSchool(UpdateSchoolRequest $request)
    {
        $data = $request->validated();
        $school = School::find($data['id']);
        if (isset($data['logo'])) {
            $this->deleteImage($school->logo);
            $data['logo'] = $this->uploadImage($data['logo']);
        }
        $school->update($data);
        $request->session()->flash('success', __('alert.alert_update'));
        return redirect()->back();
    }

    public function createSchoolAdmin()
    {
        $schools = School::get();
        return view('admin_panel.schools.create-admins', compact('schools'));
    }

    public function StoreSchoolAdmin(StoreSchoolAdminRequest $request)
    {
        $data = $request->validated();
        if ($data['image']) {
            $data['image'] = $this->uploadImage($data['image']);
        }
        $data['password'] = Hash::make($data['password']);
        $item = User::create($data);
        $role = Role::findByName('admin');
        $item->assignRole($role);
        $request->session()->flash('success', __('alert.alert_saved'));
        return redirect()->back();
    }

    public function schoolsAdmins()
    {
        $admins = User::whereRoleId(6)->get();
        return view('admin_panel.schools.schools-admins', compact('admins'));
    }

    public function deleteSchool(Request $request)
    {
        $school =  School::find($request->id);
        if ($school->logo)
            $this->deleteImage($school->logo);
        $schools_users = User::where('school_id', $school->id)->whereNotNull('image')->get();
        foreach ($schools_users as $user){
            $this->deleteImage($user->image);
            #delete users social media
            $posts = Post::whereUserId($user->id)->get();
            foreach ($posts as $post) {
                foreach ($post->attachments as $attachment) {
                    $this->deleteImage($attachment->image);
                    $attachment->delete();
                }
                $post->delete();
            }
            if ($user->account_type === 'teacher'){
                $plans = YearlyPlan::where('teacher_id',$user->id)->get();
                foreach ($plans as $plan){
                    $this->deleteImage($plan->file);
                    $plan->delete();
                }
            }
        }
        $school->delete();
        session()->flash('success', __('alert.alert_delete'));
        return redirect()->back();
    }
}
