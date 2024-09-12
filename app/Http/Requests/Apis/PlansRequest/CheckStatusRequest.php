<?php

namespace App\Http\Requests\Apis\PlansRequest;

use App\Http\Requests\Apis\BaseFormRequest;

class CheckStatusRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'day' => ['required', 'string'],
            'classroom_id' => ['required', 'integer', 'exists:classrooms,id'],
            'section_id' => ['required', 'integer', 'exists:sections,id'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
        ];
    }
}
