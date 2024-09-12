<?php

namespace App\Http\Requests\PlansRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeeklyPlanRequest extends FormRequest
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
            'id' => ['required','integer','exists:weekly_plans,id'],
            'homework' => ['string'],
            'classwork' => ['required','string'],
        ];
    }
}
