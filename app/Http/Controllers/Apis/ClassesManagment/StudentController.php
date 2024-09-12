<?php

namespace App\Http\Controllers\Apis\ClassesManagment;

use App\Http\Controllers\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\ClassroomSubject;
use App\Models\Year;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use ApiResponseTrait;
    public function getStudentTeacher()
    {
        $user = auth()->user();
        if ($user->AccountType == 'student') {

            $active_year = Year::where('activated', 1)->firstOrFail()->id;
            $teachers = ClassroomSubject::select('teacher_id')
                ->where(['section_id' => $user->section->id, 'year_id' => $active_year])
                ->distinct()
                ->with('teacher')->get()->map(function ($section) { {
                        return [
                            'id' => $section->teacher->id,
                            'name' => $section->teacher->name.' '.$section->teacher->last_name,
                            'image' => $section->teacher->image,
                            'teacher section' => $section->teacher->teacher_section,
                        ];
                    }
                })->toArray();
            return $this->apiResponse($teachers);

        }
        return $this->IncorrectAccountType();

    }
}
