<?php

namespace App\Http\Requests\Apis\UserRequest;
use App\Http\Requests\Apis\BaseFormRequest;


class UpdateTokenRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => ['required','exists:users,id'],
            'fcm_token' => ['required','string'],
        ];
    }
}
