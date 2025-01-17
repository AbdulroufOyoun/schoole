<?php

namespace App\Http\Requests\CalenderRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'start_at'=>['required','date'],
            'end_at'=>['required','date','after:'.$this->start_at],
            'description'=>['required','string'],
            'color'=>['required','string'],

        ];
    }
}
