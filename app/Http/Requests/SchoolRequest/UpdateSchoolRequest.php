<?php

namespace App\Http\Requests\SchoolRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => ['required','integer','exists:schools,id'],
            'name' => ['required','unique:schools,name,'.$this->id.',id','string'],
            'logo' => ['image','max:1024'],
            'welcome_screen' => ['required','string'],
        ];
    }
}
