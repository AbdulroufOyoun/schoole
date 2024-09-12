<?php

namespace App\Http\Controllers\Apis\Parents;

use App\Http\Controllers\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\MessageRequest\SendManagerMessage;
use App\Mail\messages\NotifyManagerOfReceiveMessage;
use App\Models\ClassroomSubject;
use App\Models\Fee;
use App\Models\Message;
use App\Models\Payment;
use App\Models\User;
use App\Models\Week;
use App\Models\WeeklyPlan;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ParentController extends Controller
{
    use ApiResponseTrait;


    public function getParentSons()
    {
        $parent = auth()->user();
        $sons = User::where('school_id',$parent->school_id)->where('parent', $parent->id)->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->image,
                'classroom' => $user->classroom? $user->classroom->name:null,
            ];
        });
        return $this->apiResponse($sons);
    }

    public function getSonsClassrooms()
    {
        $parent = auth()->user();
        $classrooms = User::where('school_id',$parent->school_id)->whereParent($parent->id)->get()->map(function ($son) {
            return [
                'id' => $son->classroom->id,
                'name' => $son->classroom? $son->classroom->name:null,
            ];
        })
            ->unique()
            ->values()
            ->toArray();

        return $this->apiResponse($classrooms);
    }

    public function getClassroomTeachers(Request $request)
    {
        $year_id = Year::whereActivated(true)->first()->id;
        $request->validate(['classroom_id' => ['required', 'integer', 'exists:classrooms,id']]);
        $teacher = ClassroomSubject::select('teacher_id')
            ->whereClassroomId($request->classroom_id)
            ->whereYearId($year_id)
            ->distinct()
            ->get()
            ->map(function ($row) {
                return [
                    'teacher id' => $row->teacher->id,
                    'teacher name' => $row->teacher->name.' '.$row->teacher->last_name,
                    'teacher section' => $row->teacher->teacher_section,

                ];
            });
        return $this->apiResponse($teacher);
    }

    public function getSonsTeacher()
    {
        $year_id = Year::whereActivated(true)->first()->id;
        $parent = auth()->user();
        $sons_sections_ids = User::where('school_id',$parent->school_id)->whereParent($parent->id)
            ->with('section')
            ->get()
            ->pluck('section.id')
            ->unique()
            ->toArray();

        $teachers = ClassroomSubject::select('teacher_id', 'classroom_id')
            ->whereYearId($year_id)
            ->whereIn('section_id', $sons_sections_ids)
            ->distinct()
            ->get()
            ->map(function ($row) {
                return [
                    'teacher id' => $row->teacher->id,
                    'teacher name' => $row->teacher->name.' '.$row->teacher->last_name,
                    'teacher image' => $row->teacher->image,
                    'teacher section' => $row->teacher->teacher_section,
                    'classroom name' => $row->classroom->name,

                ];
            });
        return $this->apiResponse($teachers);
    }

    public function sendMessageToManager(SendManagerMessage $request)
    {
        $data = $request->validated();
        $message = Message::create($data);
//        send email to manager
        if ($data['type'] == 5) {
            $users = User::where('school_id',auth()->user()->school_id)->whereRoleId(5)->get();
        } elseif ($data['type'] == 6) {
            $users = User::where('school_id',auth()->user()->school_id)->whereRoleId(6)->get();
        }
        foreach ($users as $user) {
            Mail::to($user->email)->send(new NotifyManagerOfReceiveMessage($message));
        }
        return $this->apiResponse('Message Send Successfully');
    }

    public function getPayment()
    {
        $year_id = Year::whereActivated(true)->first()->id;
        $user_id = auth()->id();
        $fees = Fee::whereYearId($year_id)->whereParentId($user_id)->get();
        $total_fees = 0;
        foreach ($fees as $fee){
            $total_fees += $fee->fee;
        }
        $exist =Payment::whereYearId($year_id)->whereParentId($user_id)->latest()->first();
        $data['total amount']=$total_fees;
        $data['paid payments']=Payment::whereYearId($year_id)->whereParentId($user_id)->sum('batch');
        $data['next batch']=$exist ? $exist->next_batch : null;

        return $this->apiResponse($data);
    }

    public function getBatches()
    {
        $year_id = Year::whereActivated(true)->first()->id;
        $batches = Payment::whereYearId($year_id)->whereParentId(auth()->id())->latest()->get()->map(function ($batch){
            return [
                'batch' => $batch->batch,
                'batch date' => Carbon::parse( $batch->created_at)->format('Y-m-d'),
                'next_batch' => $batch->next_batch,

            ];
        });
        return $this->apiResponse($batches);

    }

    public function getSonPlanByDay(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'day' => ['required', 'string']
        ]);

        $user = User::find($request->user_id);
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



}
