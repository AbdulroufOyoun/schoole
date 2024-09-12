<?php

namespace App\Http\Requests\PaymentRequest;

use App\Models\Year;
use Illuminate\Foundation\Http\FormRequest;

class StoreBatchRequest extends FormRequest
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
            'parent_id'=>['required','integer','exists:users,id'],
            'batch'=>['required','integer'],
            'next_batch'=>['required','date'],
        ];
    }

    public function validated()
    {
        $data = parent::validated();
        $data['year_id'] = Year::whereActivated(true)->first()->id;
        return $data;
    }
}
