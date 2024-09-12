<?php

namespace App\Http\Requests\ClassroomsRequest;

use App\Rules\UniqueInHisSchool;
use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
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
            'name' => ['required', 'string',new UniqueInHisSchool('classrooms')]
        ];
    }
}
