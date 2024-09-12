<?php

namespace App\Http\Requests\Apis\PlansRequest;

use App\Http\Requests\Apis\BaseFormRequest;
use App\Models\Year;

class StoreYearPlanRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'classroom_id'=>['required','integer','exists:classrooms,id'],
            'subject_id'=>['required','integer','exists:subjects,id'],
            'file'=>['required','mimes:pdf','max:20000'],

        ];
    }
    public function validated()
    {
        $data = parent::validated();
        $data['teacher_id'] = auth()->id();
        $data['year_id'] = Year::whereActivated(true)->first()->id;
        return $data;
    }

}
