<?php

namespace App\Http\Requests\TermsRequest;

use App\Models\Semester;
use App\Rules\BelongsToSchool;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSemesterRequest extends FormRequest
{
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
        $semester = Semester::find($this->id);
        return [
            'id' => ['required','integer',new BelongsToSchool('semesters')],
            'name' => ['required','string'],
            'end_at' => ['required','date','after_or_equal:'.Carbon::parse($semester->end_at)->subMonth(2),'before:'.Carbon::parse($semester->end_at)->addMonth(2)],
        ];
    }
}
