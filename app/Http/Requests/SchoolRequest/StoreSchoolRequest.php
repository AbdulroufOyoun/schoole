<?php

namespace App\Http\Requests\SchoolRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchoolRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required','unique:schools,name','string'],
            'logo' => ['required','image','max:1024'],
            'welcome_screen' => ['required','string'],
        ];
    }
}
