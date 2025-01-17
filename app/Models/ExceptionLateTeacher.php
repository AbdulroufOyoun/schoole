<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExceptionLateTeacher extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function teacher()
    {
       return $this->belongsTo(User::class,'teacher_id','id');
    }
}
