<?php

namespace App\Http\Requests\SettingsRequest;

use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreYearRequest extends FormRequest
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
        // $last_year = Year::latest('end_date')->first();
        return [
            'name' => [
                'required','unique:years,name',
                'regex:/^\d{4}-\d{4}$/'
            ],
            'end_date'=>[
                'required',
                'date',
                'after:' .   Carbon::now(),
                'before_or_equal:' .  Carbon::now()->addYear()->addMonth(6),
                ]
        ];
    }
}
