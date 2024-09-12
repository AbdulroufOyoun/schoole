<?php

namespace App\Http\Requests\SchoolRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchoolAdminRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'school_id'=>['required','integer','exists:schools,id'],
            'name' => 'required|string',
            'last_name' => 'required|string',
            'UserName' => 'required|string|unique:users,UserName',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'role_id' => 'required|integer',
        ];
    }
}
