<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BelongsToSchool implements Rule
{
    protected $table;
    public function __construct($table)
    {
        $this->table = $table;
    }

    public function passes($attribute, $value)
    {
        return \DB::table($this->table)
            ->where('id', $value)
            ->where('school_id', auth()->user()->school_id)
            ->exists();
    }

    public function message()
    {
        return 'The selected :attribute does not exist or does not belong to your school.';
    }
}
