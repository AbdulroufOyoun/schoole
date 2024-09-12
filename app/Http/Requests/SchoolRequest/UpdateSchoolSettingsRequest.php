<?php

namespace App\Http\Requests\SchoolRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolSettingsRequest extends FormRequest
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
        return [
            'name' => ['required','string'],
            'logo' => ['nullable','image','max:1025'],
            'welcome_screen' => ['required','string'],
            'about_us' => ['nullable','string'],
        ];
    }
}
