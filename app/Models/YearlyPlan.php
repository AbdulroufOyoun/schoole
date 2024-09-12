<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearlyPlan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id','id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function year()
    {
        return $this->belongsTo(Year::class);
    }


}
