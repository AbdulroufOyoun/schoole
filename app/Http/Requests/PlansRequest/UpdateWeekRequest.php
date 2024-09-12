<?php

namespace App\Http\Requests\PlansRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeekRequest extends FormRequest
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
            'id'=>['required','integer','exists:weeks,id'],
            'start_at' => ['required','date'],
            'end_at'=>['required','date'],
            'start_upload_plans'=>['required','date','after_or_equal:start_at'],
            'end_upload_plans'=>['required','date','before_or_equal:end_at'],
        ];
    }
}
