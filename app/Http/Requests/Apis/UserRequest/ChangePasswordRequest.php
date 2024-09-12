<?php

namespace App\Http\Requests\Apis\UserRequest;
use App\Http\Requests\Apis\BaseFormRequest;


class ChangePasswordRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'oldPassword'=>['required','string'],
            'newPassword'=>['required','string','confirmed'],
        ];
    }
}
