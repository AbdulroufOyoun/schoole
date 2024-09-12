<?php

namespace App\Http\Requests\SubjectsRequest;

use Illuminate\Foundation\Http\FormRequest;

class assignTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'teacher_id' => ['required','integer','exists:users,id'],
            'subject_id' => ['required','integer','exists:subjects,id'],
            'classroom_id' => ['required','integer','exists:classrooms,id'],
            'section_ids' => ['required','array'],
            'section_ids.*' => ['integer','exists:sections,id'],

        ];
    }
}
