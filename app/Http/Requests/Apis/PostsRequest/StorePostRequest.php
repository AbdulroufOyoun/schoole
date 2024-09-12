<?php

namespace App\Http\Requests\Apis\PostsRequest;

use App\Http\Requests\Apis\BaseFormRequest;

class StorePostRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'title' => ['nullable', 'string'],
            'images' => ['array','required_without:text', function ($attribute, $value, $fail) {
                if ($this->input('text') !== null && $value !== null) {
                    $fail(__('The :attribute field cannot be used when text is present.'));
                }
            }],
            'images.*' => ['image'],
            'text' => ['nullable','string'],
            'color' => ['nullable', 'string'],
        ];
    }
}
