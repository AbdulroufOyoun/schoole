<?php

namespace App\Http\Requests\PlansRequest;

use App\Models\Week;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreWeekRequest extends FormRequest
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
        $last_week = Week::latest()->first();
        $end_of_last_week = $last_week ? Carbon::parse($last_week->end_at)->endOfDay() : null;
        return [
            'start_at' => ['required', 'date', 'after_or_equal:' . $end_of_last_week],
            'end_at'=>['required','date'],
            'start_upload_plans'=>['required','date','after_or_equal:start_at'],
            'end_upload_plans'=>['required','date','before_or_equal:end_at'],
        ];
    }
}
