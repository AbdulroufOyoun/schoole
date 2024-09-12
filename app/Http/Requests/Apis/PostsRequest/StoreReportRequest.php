<?php

namespace App\Http\Requests\Apis\PostsRequest;


use App\Http\Requests\Apis\BaseFormRequest;

class StoreReportRequest extends  BaseFormRequest
{

    public function rules()
    {
        return [
            'post_id' => ['required','integer','exists:posts,id'],
            'message'=>['required','string'],
        ];
    }
}
