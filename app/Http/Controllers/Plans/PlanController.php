<?php

namespace App\Http\Controllers\Plans;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageTrait;
use App\Http\Requests\PlansRequest\SelectSectionRequest;
use App\Http\Requests\PlansRequest\SetLessonOfDayRequest;
use App\Http\Requests\PlansRequest\StoreLessonsOfDayRequest;
use App\Models\Classroom;
use App\Models\ClassroomSubject;
use App\Models\LessonPlanSetting;
use App\Models\SchoolSchedule;
use App\Models\User;
use App\Models\Year;
use App\Models\YearlyPlan;
use App\Notifications\FirebaseNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    use ImageTrait;

    public function getLessonPlans()
    {
        $settings = LessonPlanSetting::first();
        $lessonPlans = YearlyPlan::whereYearId(session()->get('year_id'))->whereType(1)->get();
        return view('admin_panel.Plans.lessonPlans', compact('lessonPlans','settings'));

    }

    public function updateLessonPlanSetting(Request $request)
    {
        $settings = LessonPlanSetting::first();
        if ($settings){
            if ($request->enable){
                $settings->enable = true;
                $settings->update();
                #send notifications to all teachers
                $users = User::where('school_id',auth()->user()->school_id)->where('role_id', 2)->get();
                $fcm_tokens = [];
                $users_ids = [];
                foreach ($users as $user) {
                    $fcm_tokens[] = $user->fcm_token;
                    $users_ids[] = $user->id;
                }

                $message = [
                    'title' => 'Lesson plans are allowed to be uploaded',
                    'body' => 'You can upload lesson plans files now',
                    'type' => 'weekly plan',
                    'url' => url('api/plans/upload-lesson-plan'),

                ];
                \Notification::send(null, new FirebaseNotification($fcm_tokens, $message, $users_ids));

            }else{
                $settings->enable = false;
                $settings->update();
            }

        }else{
            if ($request->enable){
                $settings = LessonPlanSetting::create(['enable'=>true]);
                #send notifications to all teachers
                $users = User::where('school_id',auth()->user()->school_id)->where('role_id', 2)->get();
                $fcm_tokens = [];
                $users_ids = [];
                foreach ($users as $user) {
                    $fcm_tokens[] = $user->fcm_token;
                    $users_ids[] = $user->id;
                }

                $message = [
                    'title' => 'Lesson plans are allowed to be uploaded',
                    'body' => 'You can upload lesson plans files now',
                    'type' => 'weekly plan',
                    'url' => url('api/plans/upload-lesson-plan'),

                ];
                \Notification::send(null, new FirebaseNotification($fcm_tokens, $message, $users_ids));

            }else{
                $settings =LessonPlanSetting::create(['enable'=>false]);
            }
        }
        $request->session()->flash('success', __('alert.alert_update'));
        return redirect()->back();
    }

    public function browsePdf(int $id)
    {
        $file = YearlyPlan::find($id)->file;
        return response()->file(public_path($file));
    }

    public function delete(Request $request)
    {
        $request->validate(['id' => ['required', 'integer', 'exists:yearly_plans,id']]);
        $item = YearlyPlan::find($request->id);
        $this->deleteImage($item->file);
        $item->delete();
        $request->session()->flash('success', __('alert.alert_delete'));
        return redirect()->back();

    }

    public function getAnnualPlans()
    {
        $stydyPlans = YearlyPlan::whereYearId(session()->get('year_id'))->whereType(2)->get();
        return view('admin_panel.Plans.annualPlans', compact('stydyPlans'));

    }

    public function CreateSchoolSchedule()
    {
        $classrooms = Classroom::get();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        return view('admin_panel.Plans.SchoolSchedule.create', compact('classrooms', 'days'));
    }

    public function setLessonOfDay(SetLessonOfDayRequest $request)
    {
        $data = $request->validated();
        $classroomSubjects = ClassroomSubject::whereYearId($data['year_id'])
            ->whereClassroomId($data['classroom_id'])
            ->whereSectionId($data['section_id'])
            ->get();
        $day = $data['day'];
        return view('admin_panel.Plans.SchoolSchedule.createDayLesson', compact('classroomSubjects', 'day'));
    }

    public function storeLessonsOfDay(StoreLessonsOfDayRequest $request)
    {
        $data = $request->validated();
        $oldRow = SchoolSchedule::whereYearId($data['year_id'])
            ->where('day', $data['day'])
            ->whereSectionId($data['section_id'])
            ->first();
        if ($oldRow)
            $oldRow->delete();

        SchoolSchedule::create($data);
        $request->session()->flash('success',__('alert.alert_update'));
        return redirect()->route('plans.CreateSchoolSchedule');

    }

    public function selectSection()
    {
        $classrooms = Classroom::get();
        return view('admin_panel.Plans.SchoolSchedule.selectSection',compact('classrooms'));
    }

    public function getSchedule(SelectSectionRequest $request)
    {
        $data = $request->validated();
        $schedule = SchoolSchedule::whereYearId($data['year_id'])
            ->whereSectionId($data['section_id'])
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->get();
        return view('admin_panel.Plans.SchoolSchedule.schedule',['schedule'=>$schedule]);
    }

}
