<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SameArrayLength implements Rule
{

    protected $length;

    public function __construct($length)
    {
        $this->length = $length;
    }


    public function passes($attribute, $value)
    {
        return count($value) === $this->length;
    }

    public function message()
    {
        return 'All the arrays must have the same length of users ids array.';
    }
}
