<?php

namespace App\Http\Requests\Apis\PlansRequest;

use App\Http\Requests\Apis\BaseFormRequest;
use App\Models\Week;

class StoreWeeklyPlanRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'day' => ['required', 'string'],
            'classroom_id' => ['required', 'integer', 'exists:classrooms,id'],
            'section_id' => ['required', 'integer', 'exists:sections,id'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
            'homework'=>['string'],
            'classwork'=>['required','string'],
        ];
    }

}
