<?php

namespace App\Http\Controllers\Apis\Plans;

use App\Http\Controllers\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageTrait;
use App\Http\Requests\Apis\PlansRequest\StoreYearPlanRequest;
use App\Models\ClassroomSubject;
use App\Models\LessonPlanSetting;
use App\Models\SchoolSchedule;
use App\Models\Year;
use App\Models\YearlyPlan;
use Illuminate\Http\Request;

class YearlyPlanController extends Controller
{
    use ApiResponseTrait,ImageTrait;

    public function getTeacherClassrooms()
    {
        $year_id = Year::whereActivated(true)->first()->id;
        $classroom = ClassroomSubject::select('classroom_id')
            ->whereYearId($year_id)
            ->whereTeacherId(auth()->user()->id)
            ->with('classroom')
            ->distinct()
            ->get()
            ->map(function ($row){
            return [
                'id'=>$row->classroom->id,
                'classroom'=>$row->classroom->name,
            ];
        })->toArray();

        return $this->apiResponse($classroom);

    }

    public function getSubjectForTeacherClassrooms($id)
    {
        $year_id = Year::whereActivated(true)->first()->id;
        $classroom = ClassroomSubject::select('subject_id')
            ->whereYearId($year_id)
            ->whereTeacherId(auth()->user()->id)->whereClassroomId($id)
            ->with('subject')
            ->distinct()
            ->get()
            ->map(function ($row){
                return [
                    'id'=>$row->subject->id,
                    'classroom'=>$row->subject->name,
                ];
            })->toArray();

        return $this->apiResponse($classroom);

    }

    public function storeLessonPlan(StoreYearPlanRequest $request)
    {
        $data = $request->validated();
        $settings = LessonPlanSetting::first();
        if ($settings && $settings->enable == 0)
            return $this->errorApiResponse("disable","Uploading plans is now disabled");
        $data['file'] = $this->uploadFile($data['file']);
        $data['type'] = 1 ;
        YearlyPlan::create($data);
        return $this->apiResponse("file stored Successfully");

    }

    public function storeAnnualPlan(StoreYearPlanRequest $request)
    {
        $data = $request->validated();
        $existsPlan = YearlyPlan::whereYearId($data['year_id'])
            ->whereClassroomId($data['classroom_id'])
            ->whereSubjectId($data['subject_id'])
            ->whereType(2)
            ->first();
        if ($existsPlan)
            return $this->errorApiResponse("exists","you already have a annual plan for this classroom subject in this year");
        $data['file'] = $this->uploadFile($data['file']);
        $data['type'] = 2 ;
        YearlyPlan::create($data);
        return $this->apiResponse("file stored Successfullu");

    }

    public function getSchedule()
    {
        $user = auth()->user();
        $year_id = Year::whereActivated(true)->first()->id;
        if ($user->account_type !== "student")
            return $this->notAllow();
        $schedule = SchoolSchedule::whereYearId($year_id)
            ->whereSectionId($user->section->id)
            ->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->get()
            ->map(function ($day){
                $scheduleData = [
                    'day' => $day->day,
                ];

                for ($i = 1; $i <= 7; $i++) {
                    $classroomSubject = $day->classroomSubject($i)->first();
                    $scheduleData['lesson' . $i] = $classroomSubject ? $classroomSubject->subject->name : null;
                    $scheduleData['teacher of lesson' . $i] = $classroomSubject ? $classroomSubject->teacher->name : null;

                }

                return $scheduleData;
            });
        return $this->apiResponse($schedule);

    }


}
