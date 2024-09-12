<?php

namespace App\Http\Requests\PlansRequest;

use App\Models\Year;
use Illuminate\Foundation\Http\FormRequest;

class SetLessonOfDayRequest extends FormRequest
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
            'classroom_id' => ['required','integer','exists:classrooms,id'],
            'section_id' => ['required','integer','exists:sections,id'],
            'day' => ['required','string'],

        ];
    }

    public function validated()
    {
        $year_id = Year::whereActivated(true)->first()->id;
        $data = parent::validated();
        $data['year_id'] = $year_id;
        return $data;
    }
}
