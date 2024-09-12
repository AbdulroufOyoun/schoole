<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueInHisSchool implements Rule
{
    protected $table;
    public function __construct($table)
    {
        $this->table = $table;
    }

    public function passes($attribute,$value)
    {
        return !(\DB::table($this->table)
            ->where($attribute, $value)
            ->where('school_id', auth()->user()->school_id)
            ->exists());
    }

    public function message()
    {
        return 'The selected :attribute already exists in your school.';
    }
}
