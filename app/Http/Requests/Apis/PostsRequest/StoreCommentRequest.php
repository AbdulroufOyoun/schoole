<?php

namespace App\Http\Requests\Apis\PostsRequest;

use App\Http\Requests\Apis\BaseFormRequest;

class StoreCommentRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'post_id' => ['required','string','exists:posts,id'],
            'comment' => ['required','string'],
        ];
    }
}
