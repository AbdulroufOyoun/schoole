<?php

namespace App\Http\Requests\UserRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAcountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user_id = $this->id;
        return [
            'id' => 'required|integer|exists:users,id',
            'name' => 'required|string',
            'last_name' => 'required|string',
            'father_name' => 'nullable|string',
            'mother_name' => 'nullable|string',
            'UserName' => ['required','string',Rule::unique('users','UserName')->ignore($user_id)],
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|integer',
            'classroom' => 'required_if:role_id,1|integer',
            'section' => 'required_if:role_id,1|integer',
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($user_id),
            ],
            'parent' => 'required_if:role_id,1|integer',
            'phone' => 'required|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|integer',
            'languages' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'teacher_section' => 'required_if:role_id,2|string',
            'roles' => 'required|array',
            'roles.*' => 'integer',

        ];
    }

}
