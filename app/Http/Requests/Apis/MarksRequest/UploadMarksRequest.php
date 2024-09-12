<?php

namespace App\Http\Requests\Apis\MarksRequest;

use App\Http\Requests\Apis\BaseFormRequest;
use App\Rules\AllStudentsMarksUploaded;
use App\Rules\MaxMark;
use App\Rules\SameArrayLength;
use PhpParser\Node\Expr\New_;

class UploadMarksRequest extends BaseFormRequest
{
    public function rules()
    {
        $Length = count($this->input('users_ids'));
        $total_marks = max($this->input('classwork')) + max($this->input('homeworks')) + max($this->input('exams'));

        return [
            'classroom_id'=>['required','integer','exists:classrooms,id'],
            'section_id'=>['required','integer','exists:sections,id'],
            'subject_id'=>['required','integer','exists:subjects,id',new MaxMark($total_marks)],
            'users_ids'=>['required','array',new SameArrayLength($Length),new AllStudentsMarksUploaded($Length,$this->section_id)],
            'users_ids.*'=>['integer','exists:users,id'],
            'classwork'=>['required','array',new SameArrayLength($Length)],
            'classwork.*'=>['integer'],
            'homeworks'=>['required','array',new SameArrayLength($Length)],
            'homeworks.*'=>['integer'],
            'exams'=>['required','array',new SameArrayLength($Length)],
            'exams.*'=>['integer'],
            'evaluations'=>['required','array',new SameArrayLength($Length)],
            'evaluations.*'=>['string'],

        ];
    }
}
