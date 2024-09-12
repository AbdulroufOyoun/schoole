<?php

namespace App\Http\Controllers\Apis\Marks;

use App\Http\Controllers\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\MarksRequest\GetStudentMarks;
use App\Http\Requests\Apis\MarksRequest\UploadMarksRequest;
use App\Http\Resources\MarksResources\StudentMarksResource;
use App\Models\Mark;
use App\Models\MarksConfiguration;
use App\Models\Semester;
use App\Models\SubjectMark;
use App\Models\Term;
use App\Models\Year;


class MarkController extends Controller

{
    use ApiResponseTrait;

    public function uploadMarks(UploadMarksRequest $request)
    {
        $data = $request->validated();
        $data['term_id'] = Term::latest()->first()->id;

//       create subject mark
        $exists = SubjectMark::where('term_id', $data['term_id'])
            ->where('classroom_id', $data['classroom_id'])
            ->where('section_id', $data['section_id'])
            ->where('subject_id', $data['subject_id'])
            ->exists();
        if ($exists)
            return $this->errorApiResponse('exists', 'the marks already uploaded');
        $mark_configuration = MarksConfiguration::where('classroom_id',$data['classroom_id'])
            ->where('subject_id',$data['subject_id'])->first();
        if (!$mark_configuration)
            return $this->errorApiResponse('no configuration yet', 'the admin not add the subject mark configuration yet');

        $subject_mark = SubjectMark::create([
            'term_id' => $data['term_id'],
            'classroom_id' => $data['classroom_id'],
            'section_id' => $data['section_id'],
            'subject_id' => $data['subject_id'],
            'passing_mark' => $mark_configuration->passing_mark,
            'full_mark' => $mark_configuration->full_mark,
        ]);

//       $create student marks
        $length = count($data['users_ids']);
        for ($i = 0; $i < $length; $i++) {
            Mark::create([
                'term_id' => $data['term_id'],
                'user_id' => $data['users_ids'][$i],
                'subject_mark_id' => $subject_mark->id,
                'classwork' => $data['classwork'][$i],
                'homework' => $data['homeworks'][$i],
                'exam' => $data['exams'][$i],
                'evaluation' => $data['evaluations'][$i],

            ]);
        }

        return $this->apiResponse("marks uploaded successfully");
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

    public function getSchoolTerms()
    {
        $year_id = Year::whereActivated(true)->first()->id;
        $Terms = Term::where('year_id',$year_id)->get();
        return $this->apiResponse($Terms);
    }
    public function getStudentsMarks(GetStudentMarks $request)
    {
        $data = $request->validated();
        $term = Term::find($data['term_id']);
        if ($term->activated == false)
            return $this->apiResponse("The term not activated yet");
        if (isset($data['student_id'])){
            $marks = Mark::where('term_id', $term->id)
                ->where('user_id',$data['student_id'])->with('subjectMark')->get();
        }else{
            $marks = Mark::where('term_id', $term->id)
                ->where('user_id', auth()->id())->with('subjectMark')->get();
        }
        $data = StudentMarksResource::collection($marks);
        $data = $data->toArray(request());
        $data['term'] = $term->name;
        $total_marks = 0;
        $term_percentage = 0;
        $count = count($marks);
        if ($count == 0)
            return $this->apiResponse($data);
        foreach ($marks as $mark) {
            $total_marks += $mark->total_mark;
            $term_percentage += $mark->percentage();
        }
        $data['total_marks'] = $total_marks;
        $data['term_percentage'] = ceil($term_percentage / $count);
        $data['grade'] = $this->grade($data['term_percentage']);
        $data['GPA'] = $this->GPA($data['term_percentage']);

        return $this->apiResponse($data);
    }

    public function getStudentGrade($id = null)
    {
        $year_id = Year::whereActivated(true)->first()->id;
        if ($id)
            $student_id = $id;
        else
            $student_id = auth()->id();
        $semesters = Semester::where('year_id', $year_id)
            ->whereHas('marks', function ($q) use ($student_id) {
                $q->where('marks.user_id', $student_id);
            })->with('terms')->get();

        $data = [];
        $semesters_count = count($semesters);
        if ($semesters_count > 0) {
            $final_grade = [
                'classwork' => 0,
                'homework' => 0,
                'exam' => 0,
                'total_marks' => 0,
                'final_percentage' => 0,
            ];

            foreach ($semesters as $semester) {
                #each semester
                $semester_data = [
                    'semester_name' => $semester->name,
                    'classwork' => $semester->totalClasswork($student_id),
                    'homework' => $semester->totalHomework($student_id),
                    'exam' => $semester->totalExam($student_id),
                    'total_marks' => $semester->totalMark($student_id),
                    'percentage' => $semester->percentage($student_id) . '%',
                    'grade' => $semester->grade($student_id),
                    'GPA' => $semester->GPA($student_id),
                    'terms' => [],
                ];
                foreach ($semester->terms as $term) {

                    $term_data = [
                        'semester_name' => $term->name,
                        'classwork' => $term->totalClasswork($student_id),
                        'homework' => $term->totalHomework($student_id),
                        'exam' => $term->totalExam($student_id),
                        'total_marks' => $term->totalMark($student_id),
                        'percentage' => $term->percentage($student_id) . '%',
                        'grade' => $term->grade($student_id),
                        'GPA' => $term->GPA($student_id),
                    ];

                    $semester_data['terms'][] = $term_data;
                }
                $data[] = $semester_data;
                #final grade
                $final_grade['classwork'] += $semester->totalClasswork($student_id) / $semesters_count;
                $final_grade['homework'] += $semester->totalHomework($student_id) / $semesters_count;
                $final_grade['exam'] += $semester->totalExam($student_id) / $semesters_count;
                $final_grade['total_marks'] += $semester->totalMark($student_id) / $semesters_count;
                $final_grade['final_percentage'] += $semester->percentage($student_id);
            }

            $final_grade['final_percentage'] = round($final_grade['final_percentage'] / $semesters_count,1) . '%';
            $final_grade['grade'] = $this->grade($final_grade['final_percentage']);
            $final_grade['GPA'] = $this->GPA($final_grade['final_percentage']);
            $data['final_grade'] = $final_grade;
        }


        return $this->apiResponse($data);
    }

}
