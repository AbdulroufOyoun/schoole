<?php

namespace App\Http\Requests\Apis\PlansRequest;

use App\Http\Requests\Apis\BaseFormRequest;

class UpdateWeeklyPlanRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => ['required','integer','exists:weekly_plans'],
            'homework'=>['string'],
            'classwork'=>['required','string'],
        ];
    }
}
