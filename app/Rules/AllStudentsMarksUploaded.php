<?php

namespace App\Rules;

use App\Models\Student;
use App\Models\Year;
use Illuminate\Contracts\Validation\Rule;

class AllStudentsMarksUploaded implements Rule
{
    protected $length,$section_id,$year_id;

    public function __construct($length,$section_id)
    {
        $this->length = $length;
        $this->section_id = $section_id;
        $this->year_id = Year::whereActivated(true)->first()->id;

    }

    public function passes($attribute, $value)
    {

        $section_students_count = Student::whereYearId($this->year_id)
            ->whereSectionId($this->section_id)->count();

        return $section_students_count === $this->length;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'All students\' marks must be uploaded in this section';
    }
}
