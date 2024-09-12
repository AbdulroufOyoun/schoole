<?php

namespace App\Http\Controllers\Plans;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlansRequest\StoreExceptionTeacherRequest;
use App\Http\Requests\PlansRequest\StoreWeekRequest;
use App\Http\Requests\PlansRequest\UpdateWeeklyPlanRequest;
use App\Http\Requests\PlansRequest\UpdateWeekRequest;
use App\Models\ExceptionLateTeacher;
use App\Models\User;
use App\Models\Week;
use App\Models\WeeklyPlan;
use App\Notifications\FirebaseNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeeklyPlanController extends Controller
{
    public function index()
    {
        $weeks = Week::whereYearId(session('year_id'))->latest()->get();
        return view('admin_panel.Plans.WeeklyPlan.index', compact('weeks'));

    }

    public function storeWeek(StoreWeekRequest $request)
    {
        $data = $request->validated();
        $data['year_id'] = session('year_id');
        Week::create($data);
        #send notifications to all users
        $users = User::where('school_id',auth()->user()->school_id)->where('role_id', 2)->get();
        $fcm_tokens = [];
        $users_ids = [];
        foreach ($users as $user) {
            $fcm_tokens[] = $user->fcm_token;
            $users_ids[] = $user->id;
        }

        $message = [
            'title' => 'A new school week has started',
            'body' => 'You must enter your plan for this week in between '
                . Carbon::create($data['start_upload_plans'])->format('m/d H a') . ' and '
                . Carbon::create($data['end_upload_plans'])->format('m/d H a'),
            'type' => 'weekly plan',
            'url' => url('api/weekly-plans/days-of-teacher-lessons'),

        ];
        \Notification::send(null, new FirebaseNotification($fcm_tokens, $message, $users_ids));

        $request->session()->flash('success', __('alert.alert_saved'));
        return redirect()->back();

    }

    public function updateWeek(UpdateWeekRequest $request)
    {
        $data = $request->validated();
        $week = Week::find($data['id'])->update($data);
        $request->session()->flash('success', __('alert.alert_update'));
        return redirect()->back();
    }

    public function getExceptionTeacher($id)
    {
        $exceptionTeachers = ExceptionLateTeacher::whereWeekId($id)->get();
        $teachers = User::where('school_id',auth()->user()->school_id)->whereRoleId(2)->get();
        return view('admin_panel.Plans.WeeklyPlan.exception-teacher', compact('exceptionTeachers', 'teachers'));
    }

    public function storeExceptionTeacher(StoreExceptionTeacherRequest $request)
    {
        $data = $request->validated();
        $exists = ExceptionLateTeacher::where('week_id',$data['week_id'])
            ->where('teacher_id',$data['teacher_id'])->exists();
        if ($exists)
            return redirect()->back()->withErrors(['exists'=> __('alert.alert_already_exists')]);
        ExceptionLateTeacher::create($data);
        $request->session()->flash('success', __('alert.alert_saved'));
        return redirect()->back();
    }

    public function getWeeklyPlans(int $id)
    {
        $weeklyPlans = WeeklyPlan::where('week_id', $id)->get();
        return view('admin_panel.Plans.WeeklyPlan.plans', compact('weeklyPlans'));
    }

    public function deletePlan(Request $request)
    {
        $request->validate(['id' => ['required', 'integer', 'exists:weekly_plans,id']]);
        WeeklyPlan::find($request->id)->delete();
        $request->session()->flash('success', __('alert.alert_delete'));
        return redirect()->back();
    }

    public function activationWeek(int $id)
    {
        $week = Week::find($id);
        $can = Carbon::now()->isAfter(Carbon::parse($week->end_upload_plans));
        if (!$can) {
            return redirect()->back()->withErrors(__('alert.activation_week_error'));
        }
        $week->update(['activated' => true]);

        #send notifications to all users
        $users = User::where('school_id',auth()->user()->school_id)->whereIn('role_id',[1,4] )->get();
        $fcm_tokens = [];
        $users_ids = [];
        foreach ($users as $user) {
            $fcm_tokens[] = $user->fcm_token;
            $users_ids[] = $user->id;
        }

        $message = [
            'title' => 'A new school week has started',
            'body' => 'You can browse the Homework and weekly plan ',
            'type' => 'weekly plan',
            'url' => url('api/homework/get-student-homework'),

        ];
        \Notification::send(null, new FirebaseNotification($fcm_tokens, $message, $users_ids));

        session()->flash('success', __('alert.alert_activeted'));
        return redirect()->back();
    }

    public function updatePlan(UpdateWeeklyPlanRequest $request)
    {
        $data = $request->validated();
        WeeklyPlan::find($data['id'])->update($data);
        $request->session()->flash('success',__('alert.alert_update'));
        return redirect()->back();
    }

    public function cleaning()
    {
        WeeklyPlan::query()->delete();
        session()->flash('success', __('alert.alert_delete'));
        return redirect()->back();

    }

}
