<?php

namespace App\Http\Requests\Apis\MessageRequest;

use App\Http\Requests\Apis\BaseFormRequest;

class ReplyMessage extends BaseFormRequest
{
    public function rules()
    {
        return [
            'reply_to_message'=>['required','integer','exists:messages,id'],
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
