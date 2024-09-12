<?php

namespace App\Http\Requests\Apis\PostsRequest;
use App\Http\Requests\Apis\BaseFormRequest;


class RejectPostRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'id' => ['required','integer','exists:posts,id'],
            'reason_reject' => ['required','string'],
        ];
    }
}
