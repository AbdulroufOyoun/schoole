<?php

namespace App\Http\Controllers\Marks;

use App\Http\Controllers\Controller;
use App\Http\Requests\TermsRequest\StoreConfigurationRequest;
use App\Http\Requests\TermsRequest\UpdateStudentMarksRequest;
use App\Models\Classroom;
use App\Models\ClassroomSubject;
use App\Models\Mark;
use App\Models\MarksConfiguration;
use App\Models\Semester;
use App\Models\SubjectMark;
use App\Models\Term;
use App\Models\User;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function getSubjectMarks()
    {
        $term_id = Term::latest()->first()->id;
        $subjects_marks = SubjectMark::where('term_id',$term_id)->get();
        return view('admin_panel.marks.subjects-marks',compact('subjects_marks'));

    }

    public function delete(Request $request)
    {
        $id = $request->validate(['id'=>['required','integer','exists:subject_marks,id']]);
        SubjectMark::whereId($id)->delete();
        $request->session()->flash('success',__('alert.alert_delete'));
        return redirect()->back();

    }

    public function getStudentsMarks($id)
    {
        $subject_mark = SubjectMark::whereId($id)->with(['marks','subject','classroom','section'])->first();
        return view('admin_panel.marks.students-marks',compact('subject_mark'));
    }

    public function updateStudentMarks(UpdateStudentMarksRequest $request)
    {
        $data = $request->validated();
        Mark::find($data['id'])->update($data);
        $request->session()->flash('success', __('alert.alert_update'));
        return redirect()->back();
    }

//    final score
    public function selectStudent()
    {
        $classrooms = Classroom::get();
        return view('admin_panel.marks.select-student', compact('classrooms'));
    }

    public function filterStudents($id)
    {
        $students = User::whereRoleId(1)->whereHas('section', function ($students) use ($id) {
            $students->where('sections.id', $id);
        })->get()->map(function ($student) {
            return [
                'id' => $student->id,
                'text' => $student->name . ' ' . $student->last_name,
            ];
        });

        return response()->json($students);
    }

    public function grade($percentage)
    {
        if ($percentage >= 97) {
            return "A+";
        } elseif ($percentage >= 93) {
            return "A";
        } elseif ($percentage >= 90) {
            return "A-";
        } elseif ($percentage >= 87) {
            return "B+";
        } elseif ($percentage >= 83) {
            return "B";
        } elseif ($percentage >= 80) {
            return "B-";
        } elseif ($percentage >= 77) {
            return "C+";
        } elseif ($percentage >= 73) {
            return "C";
        } elseif ($percentage >= 70) {
            return "C-";
        } elseif ($percentage >= 67) {
            return "D+";
        } elseif ($percentage >= 63) {
            return "D";
        } elseif ($percentage >= 60) {
            return "D-";
        } else {
            return "F";
        }
    }

    public function GPA($percentage )
    {
        if ($percentage >= 97) {
            return "4";
        } elseif ($percentage >= 93) {
            return "3.7";
        } elseif ($percentage >= 90) {
            return "3.3";
        } elseif ($percentage >= 87) {
            return "3";
        } elseif ($percentage >= 83) {
            return "2.7";
        } elseif ($percentage >= 80) {
            return "2.3";
        } elseif ($percentage >= 77) {
            return "2";
        } elseif ($percentage >= 73) {
            return "1.7";
        } elseif ($percentage >= 70) {
            return "1.3";
        } elseif ($percentage >= 67) {
            return "1";
        } elseif ($percentage >= 63) {
            return "0.7";
        } elseif ($percentage >= 60) {
            return "0.3";
        } else {
            return "0";
        }
    }

    public function studentScore(Request $request)
    {
        $student = User::find($request->student_id);
        $semesters = Semester::where('year_id', session('year_id'))
            ->whereHas('marks', function ($q) use ($student) {
                $q->where('marks.user_id', $student->id);
            })->with('terms')->get();

        $final_grade = [
            'classwork' => 0,
            'homework' => 0,
            'exam' => 0,
            'total_marks' => 0,
            'final_percentage' => 0,
            'grade' => 0,
            'GPA' => 0,
        ];
        $semesters_count = count($semesters);
        if ($semesters_count > 0) {
            foreach ($semesters as $semester) {
                $final_grade['classwork'] += $semester->totalClasswork($student->id) / $semesters_count;
                $final_grade['homework'] += $semester->totalHomework($student->id) / $semesters_count;
                $final_grade['exam'] += $semester->totalExam($student->id) / $semesters_count;
                $final_grade['total_marks'] += $semester->totalMark($student->id) / $semesters_count;
                $final_grade['final_percentage'] += $semester->percentage($student->id);
            }
            $final_grade['final_percentage'] = round($final_grade['final_percentage'] / $semesters_count, 1);
            $final_grade['grade'] = $this->grade($final_grade['final_percentage']);
            $final_grade['GPA'] = $this->GPA($final_grade['final_percentage']);
        }

        return view('admin_panel.marks.student-score', compact('student', 'semesters', 'final_grade'));

    }

//    config
    public function configSubjectsMarks()
    {
        $classrooms = Classroom::get();
        return view('admin_panel.marks.config-subjects-marks', compact('classrooms'));
    }

    public function filterSubject($id)
    {
        $subject = ClassroomSubject::whereYearId(session('year_id'))->whereClassroomId($id)->get()->map(function ($row){
           return [
               'id'=>$row->subject->id,
               'text'=>$row->subject->name,
           ];
        })->unique()->values();
        return response()->json($subject);
    }

    public function storeConfiguration(StoreConfigurationRequest $request)
    {
        $data = $request->validated();
        foreach ($data['subject_ids'] as $subject_id){
            $exists  =MarksConfiguration::where('classroom_id',$data['classroom_id'])
                ->where('subject_id',$subject_id)
                ->first();
            if ($exists){
                $exists->full_mark = $data['full_mark'];
                $exists->passing_mark = $data['passing_mark'];
                $exists->update();
            }else {
                MarksConfiguration::create([
                    'classroom_id'=>$data['classroom_id'],
                    'subject_id'=>$subject_id,
                    'full_mark'=>$data['full_mark'],
                    'passing_mark'=>$data['passing_mark'],
                ]);
            }
        }
        $request->session()->flash('success',__('alert.alert_update'));
        return redirect()->back();
    }

    public function marksConfiguration()
    {
        $subjects_marks = MarksConfiguration::get();
        return view('admin_panel.marks.marks-configuration',compact('subjects_marks'));
    }


}
