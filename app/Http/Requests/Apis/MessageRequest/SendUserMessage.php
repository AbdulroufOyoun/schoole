<?php

namespace App\Http\Requests\Apis\MessageRequest;

use App\Http\Requests\Apis\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class SendUserMessage extends BaseFormRequest
{
    public function rules()
    {
        return [
            'user_id'=>['required','integer','exists:users,id'],
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
