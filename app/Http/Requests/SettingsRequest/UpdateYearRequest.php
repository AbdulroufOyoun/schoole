<?php

namespace App\Http\Requests\SettingsRequest;

use App\Models\Year;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdateYearRequest extends FormRequest
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
        $last_year = Year::find($this->id);

        return [
            'id'=>['required','exists:years,id'],
            'name' => ['required','unique:years,name','regex:/^\d{4}-\d{4}$/'],
            'end_date'=>[
                'required',
                'date',
                'after_or_equal:date' .   Carbon::parse($last_year->end_date)->subMonth(3),
                'before_or_equal:' .  Carbon::parse($last_year->end_date)->addMonth(3),
                ]
        ];
    }
}
