<?php

namespace App\Http\Requests\TermsRequest;

use App\Rules\BelongsToSchool;
use Illuminate\Foundation\Http\FormRequest;

class StoreConfigurationRequest extends FormRequest
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
            'classroom_id' => ['required','integer',new BelongsToSchool('classrooms')],
            'subject_ids' => ['required','array'],
            'subject_ids.*' => ['integer',new BelongsToSchool('subjects')],
            'full_mark' => ['required','integer'],
            'passing_mark' => ['required','integer'],
        ];
    }
}
