<?php

namespace App\Http\Requests\ClassroomsRequest;

use Illuminate\Foundation\Http\FormRequest;

class PromotionStudentsRequest extends FormRequest
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
            'action'=>['required','string'],
            'from_classroom_id' => ['required','integer','exists:classrooms,id'],
            'to_classroom_id' => ['required','integer','exists:classrooms,id'],

            'from_section_ids' => ['required','array'],
            'from_section_ids.*' => ['integer','exists:sections,id'],

            'to_section_id' => ['required','integer','exists:sections,id'],
        ];
    }
}
