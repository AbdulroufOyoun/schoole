<?php

namespace App\Http\Requests\MessagesRequest;

use App\Rules\BelongsToSchool;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
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
        return [
            'user_id' => ['required','integer',new BelongsToSchool('users')],
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
