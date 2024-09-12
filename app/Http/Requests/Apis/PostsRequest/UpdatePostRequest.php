<?php

namespace App\Http\Requests\Apis\PostsRequest;

use App\Http\Requests\Apis\BaseFormRequest;

class UpdatePostRequest extends BaseFormRequest
{

    public function rules()
    {
        return [
            'title' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
            'images' => ['nullable','array'],
            'images.*' => ['image'],
            'text' => ['nullable','string'],
            'id' => ['required','integer','exists:posts,id'],
        ];
    }
}
