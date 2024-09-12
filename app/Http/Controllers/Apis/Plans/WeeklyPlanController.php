<?php

namespace App\Http\Controllers\Apis\Plans;

use App\Http\Controllers\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\PlansRequest\CheckStatusRequest;
use App\Http\Requests\Apis\PlansRequest\StoreWeeklyPlanRequest;
use App\Http\Requests\Apis\PlansRequest\UpdateWeeklyPlanRequest;
use App\Models\ClassroomSubject;
use App\Models\ExceptionLateTeacher;
use App\Models\SchoolSchedule;
use App\Models\StudentHomework;
use App\Models\User;
use App\Models\Week;
use App\Models\WeeklyPlan;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeeklyPlanController extends Controller
{
    use ApiResponseTrait;

    private $year, $classroomSubjectIds, $user, $week;

    public function initialize()
    {
        $this->user = auth()->user();
        $this->year = Year::whereActivated(true)->first()->id;
        $this->classroomSubjectIds = ClassroomSubject::whereYearId($this->year)->whereTeacherId(auth()->user()->id)->pluck('id')->toArray();
        $this->week = Week::latest()->first();

    }

    private function CommonQuery($query)
    {
        $query->whereIn('lesson1', $this->classroomSubjectIds)
            ->orWhereIn('lesson2', $this->classroomSubjectIds)
            ->orWhereIn('lesson3', $this->classroomSubjectIds)
            ->orWhereIn('lesson4', $this->classroomSubjectIds)
            ->orWhereIn('lesson5', $this->classroomSubjectIds)
            ->orWhereIn('lesson6', $this->classroomSubjectIds)
            ->orWhereIn('lesson7', $this->classroomSubjectIds);
    }

    public function getDaysOfTeacherLessons()
    {
        $this->initialize();
        $days = SchoolSchedule::where('year_id', $this->year)
            ->where(function ($query) {
                $this->CommonQuery($query);
            })
            ->pluck('day')
            ->values()
            ->unique()
            ->toArray();
        $days = array_values($days);
        return $this->apiResponse($days);
    }

    public function getClassroomsBySelectedDay(Request $request)
    {
        $this->initialize();

        $request->validate(['day' => ['required', 'string']]);

        $classrooms = SchoolSchedule::where('year_id', $this->year)
            ->where('day', $request->day)
            ->where(function ($query) {
                $this->CommonQuery($query);
            })
            ->get()
            ->map(function ($row) {
                $data = [];
                for ($i = 1; $i <= 7; $i++) {
                    $classroomSubject = $row->classroomSubject($i)->first();
                    $data['classroom id'] = $classroomSubject ? $classroomSubject->classroom->id : null;
                    $data['classroom name'] = $classroomSubject ? $classroomSubject->classroom->name : null;
                }
                return $data;
            })
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        return $this->apiResponse($classrooms);
    }

    public function getSectionsBySelectedClassroom(Request $request)
    {
        $this->initialize();
        $request->validate([
            'day' => ['required', 'string'],
            'classroom_id' => ['required', 'integer', 'exists:classrooms,id'],

        ]);
        $sections = SchoolSchedule::where('year_id', $this->year)
            ->where('day', $request->day)
            ->where('classroom_id', $request->classroom_id)
            ->where(function ($query) {
                $this->CommonQuery($query);
            })
            ->get()
            ->map(function ($row) {
                $data = [];
                for ($i = 1; $i <= 7; $i++) {
                    $classroomSubject = $row->classroomSubject($i)->first();
                    $data['section id'] = $classroomSubject ? $classroomSubject->section->id : null;
                    $data['section name'] = $classroomSubject ? $classroomSubject->section->name : null;
                }
                return $data;
            })
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        return $this->apiResponse($sections);
    }

    public function getSubjectBySelectedSection(Request $request)
    {
        $this->initialize();
        $request->validate([
            'day' => ['required', 'string'],
            'classroom_id' => ['required', 'integer', 'exists:classrooms,id'],
            'section_id' => ['required', 'integer', 'exists:sections,id'],

        ]);
        $subjects = SchoolSchedule::where('year_id', $this->year)
            ->where('day', $request->day)
            ->where('classroom_id', $request->classroom_id)
            ->where('section_id', $request->section_id)
            ->where(function ($query) {
                $this->CommonQuery($query);
            })
            ->get()
            ->map(function ($row) {
                $data = [];
                for ($i = 1; $i <= 7; $i++) {
                    $classroomSubject = $row->classroomSubject($i)->first();
                    if (!$classroomSubject || !in_array($classroomSubject->id, $this->classroomSubjectIds))
                        continue;
                    $data[] = [
                        'subject id' => $classroomSubject ? $classroomSubject->subject->id : null,
                        'subject name' => $classroomSubject ? $classroomSubject->subject->name : null,
                    ];
                }
                return $data;
            })
            ->values()
            ->toArray();

        $flattenedSubjects = [];
        foreach ($subjects as $subjectArray) {
            foreach ($subjectArray as $subjectItem) {
                $flattenedSubjects[] = $subjectItem;
            }
        }
        $flattenedSubjects = array_unique($flattenedSubjects, SORT_REGULAR);
        $flattenedSubjects = array_values($flattenedSubjects);
        return $this->apiResponse($flattenedSubjects);

    }

    public function checkTime()
    {
        $currentDateTime = Carbon::now();
        $startDateTime = Carbon::parse($this->week->start_upload_plans);
        $endDateTime = Carbon::parse($this->week->end_upload_plans);

        if ($currentDateTime->between($startDateTime, $endDateTime)) {
            return true;
        }
        return false;
    }

    public function checkException()
    {
        $exception = ExceptionLateTeacher::where('week_id', $this->week->id)
            ->where('teacher_id', $this->user->id)->exists();
        if ($exception) {
            return true;
        }
        return false;
    }


    public function exists($data)
    {
        $exists = WeeklyPlan::where('week_id', $this->week->id)
            ->where('day', $data['day'])
            ->where('classroom_id', $data['classroom_id'])
            ->where('section_id', $data['section_id'])
            ->where('subject_id', $data['subject_id'])
            ->where('teacher_id', $this->user->id)->first();
        return $exists;
    }


    public function checkStatus(CheckStatusRequest $request)
    {
        $data = $request->validated();
        $this->initialize();
        $exists = $this->exists($data);
        $can = $this->checkTime();
        if ($exists) {
            $item['plan'] = [
                'id' => $exists->id,
                'homework' => $exists->homework,
                'classwork' => $exists->classwork,
            ];
            $item['can update'] = $can;
            return $this->apiResponse($item);
        } else {
            if (!$can) {
                $can = $this->checkException();
            }
            $item['plan'] = "not exists";
            $item['can upload'] = $can;
            return $this->apiResponse($item);
        }
    }

    public function storeWeeklyPlan(StoreWeeklyPlanRequest $request)
    {
        $data = $request->validated();
        $this->initialize();
        $data['week_id'] = $this->week->id;
        $data['teacher_id'] = $this->user->id;
        if ($this->exists($data))
            return $this->errorApiResponse('exists', 'the plan already exists');
        if ($this->checkTime() || $this->checkException()) {
            WeeklyPlan::create($data);
            return $this->apiResponse('the plan stored successfully');
        }
        return $this->errorApiResponse('not allow', 'Expiry date and no exception');
    }

    public function updateWeeklyPlan(UpdateWeeklyPlanRequest $request)
    {
        $data = $request->validated();
        $this->initialize();
        if ($this->checkTime()) {
            WeeklyPlan::find($data['id'])->update($data);
            return $this->apiResponse('the plan updated successfully');
        }
        return $this->errorApiResponse('not allow', 'Expiry date');
    }

    public function getHomework($user)
    {

        $week = Week::latest()->first();
        if ($week->activated == false)
            return [];
        $today = Carbon::today()->format('l');
        $homework = WeeklyPlan::where('week_id', $week->id)
            ->where('day', $today)
            ->where('classroom_id', $user->classroom->id)
            ->where('section_id', $user->section->id)
            ->get()
            ->map(function ($row) use ($user) {
                return [
                    'id' => $row->id,
                    'subject' => $row->subject->name,
                    'homework' => $row->homework,
                    'done' => StudentHomework::where('weekly_plan_id', $row->id)->where('student_id', $user->id)->exists(),
                ];
            });
        return $homework;
    }

    public function getStudentHomework()
    {
        $user = auth()->user();
        $homework = $this->getHomework($user);
        return $this->apiResponse($homework);
    }

    public function finishStudentHomework(int $id)
    {
        $user_id = auth()->id();
        $exists = StudentHomework::where('weekly_plan_id', $id)->where('student_id', $user_id)->exists();
        if ($exists)
            return $this->errorApiResponse('exists', 'the home already done');
        StudentHomework::create([
            'weekly_plan_id' => $id,
            'student_id' => $user_id
        ]);
        return $this->apiResponse('Successful Done');
    }

    public function getStudentPlanByDay(Request $request)
    {
        $request->validate(['day' => ['required', 'string']]);

        $user = auth()->user();
        $week = Week::latest()->first();
        if ($week->activated == false)
            return $this->apiResponse([]);
        $homework = WeeklyPlan::where('week_id', $week->id)
            ->where('day', $request->day)
            ->where('classroom_id', $user->classroom->id)
            ->where('section_id', $user->section->id)
            ->get()
            ->map(function ($row) {
                return [
                    'id' => $row->id,
                    'subject' => $row->subject->name,
                    'classwork' => $row->classwork,
                    'homework' => $row->homework,
                ];
            });

        return $this->apiResponse($homework);

    }

    public function getSonHomework($id)
    {
        $user = User::whereId($id)->with('classroom')->first();
        $homework = $this->getHomework($user);
        return $this->apiResponse($homework);
    }


}
