<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id', 'id');

    }

}
