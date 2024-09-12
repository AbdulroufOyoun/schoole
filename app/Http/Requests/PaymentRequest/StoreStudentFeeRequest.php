<?php

namespace App\Http\Requests\PaymentRequest;

use App\Models\User;
use App\Models\Year;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentFeeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'student_ids' => ['required' ,'array'],
            'student_ids.*' => ['integer','exists:users,id'],
            'fee' => ['required','integer'],
        ];
    }

    public function validated()
    {
        $data = parent::validated();
        $year_id = Year::whereActivated(true)->first()->id;
        $data['year_id'] = $year_id;
        return $data ;

    }

}
