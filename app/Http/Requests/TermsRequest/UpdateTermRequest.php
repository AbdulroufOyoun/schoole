<?php

namespace App\Http\Requests\TermsRequest;

use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTermRequest extends FormRequest
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
        $term = Term::find($this->id);
        return [
            'id' => ['required','integer','exists:terms,id'],
            'name' => ['required','string'],
            'end_at' => ['required','date','after_or_equal:'.Carbon::parse($term->end_at)->subMonth(),'before:'.Carbon::parse($term->end_at)->addMonth()],
        ];
    }
}
