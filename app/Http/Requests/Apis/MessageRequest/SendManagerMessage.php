<?php

namespace App\Http\Requests\Apis\MessageRequest;

use App\Http\Requests\Apis\BaseFormRequest;
use Carbon\Carbon;

class SendManagerMessage extends BaseFormRequest
{
    public function rules()
    {
        return [
            'type' => ['required', 'integer', 'in:1,2,3,5,6'],
            'subject' => ['required', 'string'],
            'message' => ['required', 'string'],

        ];
    }
    public function validated()
    {
        $data = parent::validated();
        $data['sender_id'] = auth()->id();
        $data['accepted'] = true;
        $data['accepted_at'] = Carbon::now();
        return  $data;
    }

}
