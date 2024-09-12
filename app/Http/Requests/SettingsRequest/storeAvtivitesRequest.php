<?php

namespace App\Http\Requests\SettingsRequest;

use Illuminate\Foundation\Http\FormRequest;

class storeAvtivitesRequest extends FormRequest
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
            'name' => ['string','required'],
            'image' => ['image','required'],
            'rate' => ['string','required'],
            'description' => ['string','required'],

        ];
    }
}
