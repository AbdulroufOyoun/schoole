<?php

namespace App\Http\Requests\UserRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'id'=>['required','integer','exists:users,id'],
            'name'=>['required','string'],
            'last_name'=>['required','string'],
            'email' => ['required', 'email','unique:users,email,'.$this->id],
            'image' => 'nullable|image|max:2048',
            'phone' => 'required|string',
            'password' => 'nullable|string|min:6',
        ];
    }
}
