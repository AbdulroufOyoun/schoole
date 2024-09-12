<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SubjectMark extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class,'classroom_id','id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id','id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class,'subject_mark_id','id');
    }

    public function term()
    {
        return $this->belongsTo(Term::class,'term_id','id');
    }


}
