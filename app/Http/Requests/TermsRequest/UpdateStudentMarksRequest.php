<?php

namespace App\Http\Requests\TermsRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentMarksRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => ['required', 'integer', 'exists:marks,id'],
            'classwork' => ['required', 'integer'],
            'homework' => ['required', 'integer'],
            'exam' => ['required', 'integer'],
            'evaluation' => ['required', 'string'],
        ];
    }
}
