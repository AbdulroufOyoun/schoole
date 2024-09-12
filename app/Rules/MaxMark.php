<?php

namespace App\Rules;

use App\Models\MarksConfiguration;
use Illuminate\Contracts\Validation\Rule;

class MaxMark implements Rule
{
    protected $total_marks;

    public function __construct($total_marks)
    {
        $this->total_marks = $total_marks;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */

    public function passes($attribute,$value)
    {
        $subject_configuration = MarksConfiguration::where('subject_id',$value)->first();
        if ($subject_configuration){
            $full_mark = $subject_configuration->full_mark ;
            return $this->total_marks <= ($full_mark/2);
        }else
            return false;
    }

    public function message()
    {
        return 'Homework,classwork and exam marks must be less than half of the full mark';
    }

}
