<?php

namespace App\Http\Requests\SettingsRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
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
            'email' => ['nullable','email'],
            'phone' => ['nullable','string'],
            'logo' => ['nullable','image'],
            'about_us' => ['nullable','string'],
            'educational_missions' => ['nullable','string'],
            'educational_vision' => ['nullable','string'],
            'trip_description' => ['nullable','string'],
            'link_trip' => ['nullable','url'],

        ];
    }
}
