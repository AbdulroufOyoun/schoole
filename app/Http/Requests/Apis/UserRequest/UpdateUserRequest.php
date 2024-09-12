<?php

namespace App\Http\Requests\Apis\UserRequest;
use App\Http\Requests\Apis\BaseFormRequest;


class UpdateUserRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => ['nullable','image'],
            'hobbies'=>['nullable','string'],
            'date_of_birth'=>['nullable','date'],
            'phone'=>['required','string'],
            'country'=>['nullable','string'],
            'about_me'=>['nullable','string'],
            'languages'=>['nullable','string'],

        ];
    }


}
