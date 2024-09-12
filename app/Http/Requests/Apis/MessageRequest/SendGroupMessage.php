<?php

namespace App\Http\Requests\Apis\MessageRequest;

use App\Http\Requests\Apis\BaseFormRequest;

class SendGroupMessage extends BaseFormRequest
{
    public function rules()
    {
        return [
            'section_id'=>['required','integer','exists:sections,id'],
            'subject'=>['required','string'],
            'message'=>['required','string']
        ];
    }
    public function validated()
    {
        $data = parent::validated();
        $data['sender_id'] = auth()->id();
        return  $data;
    }
}
