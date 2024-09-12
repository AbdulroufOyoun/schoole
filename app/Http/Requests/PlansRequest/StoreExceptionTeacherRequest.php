<?php

namespace App\Http\Requests\PlansRequest;

use App\Models\Week;
use Illuminate\Foundation\Http\FormRequest;

class StoreExceptionTeacherRequest extends FormRequest
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
            'teacher_id'=>['required','integer','exists:users,id']
        ];
    }

    public function validated()
    {
        $data = parent::validated();
        $data['week_id'] = Week::latest()->first()->id;
        return $data;
    }
}
