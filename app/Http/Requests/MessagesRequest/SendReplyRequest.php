<?php

namespace App\Http\Requests\MessagesRequest;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class SendReplyRequest extends FormRequest
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
            'reply_to_message' => ['required','integer','exists:messages,id'],
            'subject' => ['required','string'],
            'message' => ['required','string'],
        ];
    }
    public function validated()
    {
        $data = parent::validated();
        $message = Message::find($data['reply_to_message']);
        $data['sender_id'] = auth()->id();
        $data['user_id'] = $message->sender_id;
        $data['accepted'] = true;
        $data['accepted_at'] = Carbon::now();

        return $data;
    }
}
