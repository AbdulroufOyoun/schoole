<?php

namespace App\Http\Controllers\Apis\Teacher;

use App\Http\Controllers\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\MessageRequest\SendGroupMessage;
use App\Http\Requests\Apis\MessageRequest\SendUserMessage;
use App\Models\ClassroomSubject;
use App\Models\Message;
use App\Models\SchoolSchedule;
use App\Models\Section;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    use ApiResponseTrait;

    public function getTeacherSectionByClassroom(Request $request)
    {
        $request->validate(['classroom_id' => ['required', 'integer', 'exists:classrooms,id']]);
        $year_id = Year::whereActivated(true)->first()->id;
        $user = auth()->user();
        $section = ClassroomSubject::whereYearId($year_id)
            ->whereClassroomId($request->classroom_id)
            ->whereTeacherId($user->id)
            ->get()
            ->map(function ($row) {
                return [
                    'section id' => $row->section->id,
                    'section name' => $row->section->name,
                    'classroom name' => $row->classroom->name,
                ];
            })->unique()->toArray();
        $section = array_values($section);
        return $this->apiResponse($section);
    }

    public function getTeacherSubjectBySection(Request $request)
    {
        $request->validate([
            'classroom_id' => ['required', 'integer', 'exists:classrooms,id'],
            'section_id' => ['required', 'integer', 'exists:sections,id']
        ]);
        $user = auth()->user();
        $year_id = Year::whereActivated(true)->first()->id;
        $subject = ClassroomSubject::whereYearId($year_id)
            ->whereClassroomId($request->classroom_id)
            ->whereTeacherId($user->id)
            ->whereSectionId($request->section_id)
            ->get()->map(function ($row) {
                return [
                    'subject id' => $row->subject->id,
                    'subject name' => $row->subject->name,
                ];
            });
        return $this->apiResponse($subject);
    }

    public function getStudentOfSection(Request $request)
    {
        $request->validate(['section_id' => ['required', 'integer', 'exists:sections,id']]);
        $data = $request->all();
        $student['classroom'] = Section::find($data['section_id'])->classroom->name;
        $student['student'] = User::where('school_id',auth()->user()->school_id)->whereHas('section', function ($section) use ($data) {
            $section->where('section_id', $data['section_id']);
        })->get()->map(function ($student) {
            return [
                'id' => $student->id,
                'name' => $student->name.' '.$student->last_name,
            ];
        });
        return $this->apiResponse($student);
    }

    public function sendGroupMessage(SendGroupMessage $request)
    {
        $data = $request->validated();
        Message::create($data);
        return $this->apiResponse('Message Send Successfully');

    }

    public function sendParentMessage(SendUserMessage $request)
    {
        $data = $request->validated();
        $parent = User::find($data['user_id'])->parent;
        $data['user_id'] = $parent;
        Message::create($data);
        return $this->apiResponse('Message Send Successfully');
    }


    public function getTeacherSchedule()
    {
        $year_id = Year::whereActivated(true)->first()->id;
//        get the subject of teacher for every classroom
        $teacherSubjectIds = ClassroomSubject::where('year_id', $year_id)
            ->where('teacher_id', auth()->id())
            ->pluck('id')
            ->toArray();
//get day has teacher subject and check which lesson for teacher
        $schedule = SchoolSchedule::where('year_id', $year_id)
            ->where(function ($query) use ($teacherSubjectIds) {
                for ($i = 1; $i <= 7; $i++) {
                    $lesson = 'lesson' . $i;
                    $query->orWhereIn($lesson, $teacherSubjectIds);
                }
            })
            ->get()
            ->groupBy('day')
            ->map(function ($rows) use ($teacherSubjectIds) {
                $lessonData = [];
                foreach ($rows as $row) {
                    for ($i = 1; $i <= 7; $i++) {
                        $lesson = 'lesson' . $i;
                        if (isset($lessonData[$lesson]) && $lessonData[$lesson])
                            continue;
                        if (in_array($row->$lesson, $teacherSubjectIds)) {
                            $classroomSubject = $row->classroomSubject($i)->first();
                            $lessonData[$lesson] = $classroomSubject->classroom->name . ' | ' . $classroomSubject->section->name . ' | ' . $classroomSubject->subject->name;
                        } else {
                            $lessonData[$lesson] = null;
                        }
                    }
                }
                return $lessonData;
            });

        return $this->apiResponse($schedule);
    }

}
