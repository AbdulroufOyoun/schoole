<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $guarded = [];


//    public function getAverageAttribute()
//    {
//        $average = ceil(($this->attributes['classwork'] + $this->attributes['homework'] + $this->attributes['exam']) / 3);
//        return $average;
//    }


    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function getTotalMarkAttribute()
    {
        $total_mark = $this->attributes['classwork'] + $this->attributes['homework'] + $this->attributes['exam'];
        return $total_mark;
    }

    public function percentage($total_mark = null)
    {
        if ($total_mark)
            $percentage = ($total_mark * 100) / ($this->subjectMark->full_mark/2);
        else
            $percentage = ($this->total_mark * 100) / ($this->subjectMark->full_mark/2);

        return $percentage;
    }

    public function grade($percentage = null)
    {
        if ($percentage)
            $percent = $percentage;
        else
            $percent = $this->percentage();
        if ($percent >= 97) {
            return "A+";
        } elseif ($percent >= 93) {
            return "A";
        } elseif ($percent >= 90) {
            return "A-";
        } elseif ($percent >= 87) {
            return "B+";
        } elseif ($percent >= 83) {
            return "B";
        } elseif ($percent >= 80) {
            return "B-";
        } elseif ($percent >= 77) {
            return "C+";
        } elseif ($percent >= 73) {
            return "C";
        } elseif ($percent >= 70) {
            return "C-";
        } elseif ($percent >= 67) {
            return "D+";
        } elseif ($percent >= 63) {
            return "D";
        } elseif ($percent >= 60) {
            return "D-";
        } else {
            return "F";
        }
    }

    public function GPA($percentage = null)
    {
        if ($percentage)
            $percent = $percentage;
        else
            $percent = $this->percentage();
        if ($percent >= 97) {
            return "4";
        } elseif ($percent >= 93) {
            return "3.7";
        } elseif ($percent >= 90) {
            return "3.3";
        } elseif ($percent >= 87) {
            return "3";
        } elseif ($percent >= 83) {
            return "2.7";
        } elseif ($percent >= 80) {
            return "2.3";
        } elseif ($percent >= 77) {
            return "2";
        } elseif ($percent >= 73) {
            return "1.7";
        } elseif ($percent >= 70) {
            return "1.3";
        } elseif ($percent >= 67) {
            return "1";
        } elseif ($percent >= 63) {
            return "0.7";
        } elseif ($percent >= 60) {
            return "0.3";
        } else {
            return "0";
        }
    }

    public function subjectMark()
    {
        return $this->belongsTo(SubjectMark::class, 'subject_mark_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }



}
