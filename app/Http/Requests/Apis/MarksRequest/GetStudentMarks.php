<?php

namespace App\Http\Requests\Apis\MarksRequest;

use App\Http\Requests\Apis\BaseFormRequest;
use App\Rules\BelongsToSchool;
use Illuminate\Validation\Rule;

class GetStudentMarks extends BaseFormRequest
{
    public function rules()
    {
        return [
            'term_id' => ['required', 'integer',new BelongsToSchool('terms')],
            'student_id' => ['integer',new BelongsToSchool('users')],
        ];
    }
}
