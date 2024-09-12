<?php

namespace App\Http\Requests\TermsRequest;

use App\Models\Semester;
use App\Models\Term;
use App\Models\Year;
use Illuminate\Foundation\Http\FormRequest;

class StoreTermRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $term = Term::latest()->first();
        return [
            'name' => ['required','string'],
            'end_at' => ['required','date','after_or_equal:'.$term->end_at],
        ];

    }

    public function validated()
    {
        $semester_id = Semester::latest()->first()->id;
        $data = parent::validated();
        $data['year_id'] = session('year_id');
        $data['semester_id'] = $semester_id;
        return $data;
    }
}
