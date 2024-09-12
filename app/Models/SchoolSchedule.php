<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSchedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id','id');
    }

    public function classroomSubject($id)
    {
        return $this->belongsTo(ClassroomSubject::class, 'lesson'.$id, 'id');
    }

}
