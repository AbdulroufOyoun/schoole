<?php

namespace App\Http\Requests\MessagesRequest;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SendGroupMessageRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => ['required','integer',Rule::in([1,2,3,4])],
            'subject' => ['required','string'],
            'message' => ['required','string'],
        ];
    }

    public function validated()
    {
        $data = parent::validated();
        $data['sender_id'] = auth()->id();
        $data['accepted'] = true;
        $data['accepted_at'] = Carbon::now();
        return $data;
    }
}
