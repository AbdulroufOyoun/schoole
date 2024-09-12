<?php

namespace App\Http\Requests\TermsRequest;

use App\Models\Semester;
use Illuminate\Foundation\Http\FormRequest;

class StoreSemesterRequest extends FormRequest
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
        $term = Semester::latest()->first();
        return [
            'name' => ['required','string'],
            'end_at' => ['required','date','after_or_equal:'.$term->end_at],
        ];
    }

    public function validated()
    {
        $data = parent::validated();
        $data['year_id'] = session('year_id');
        return $data;
    }
}
