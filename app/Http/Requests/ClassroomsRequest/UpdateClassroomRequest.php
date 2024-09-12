<?php

namespace App\Http\Requests\ClassroomsRequest;

use App\Rules\UniqueInHisSchool;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClassroomRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => ['required', 'integer', 'exists:classrooms,id'],
            'name' => ['required', 'string', new UniqueInHisSchool('classrooms')]
        ];
    }
}
