<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Semester extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        if (auth()->id()) {
            static::addGlobalScope('exclude', function (Builder $builder) {
                $builder->where('school_id', auth()->user()->school_id);
            });
            static::creating(function ($model) {
                $model->school_id = auth()->user()->school_id;
            });
        }
    }

    public function marks()
    {
        return $this->hasManyThrough(Mark::class,Term::class,'semester_id','term_id','id','id')->where('terms.activated',true);
    }

    public function studentMarks($user_id)
    {
        return $this->hasManyThrough(Mark::class,Term::class,'semester_id','term_id','id','id')->where('terms.activated',true)->where('user_id', $user_id)->get();
    }

    public function terms()
    {
        return $this->hasMany(Term::class)->where('activated',true);
    }

    public function totalClasswork($user_id)
    {
        return $this->studentMarks($user_id)->sum('classwork');
    }

    public function totalHomework($user_id)
    {
        return $this->studentMarks($user_id)->sum('homework');
    }

    public function totalExam($user_id)
    {
        return $this->studentMarks($user_id)->sum('exam');
    }

    public function totalMark($user_id)
    {
        $marks = $this->studentMarks($user_id);
        $total_mark = $marks->sum('exam') + $marks->sum('classwork') + $marks->sum('homework');
        return $total_mark;
    }

    public function totalFullMark($user_id)
    {
        $marks = $this->studentMarks($user_id);
        $total_full_mark = 0;
        foreach ($marks as $mark) {
            $total_full_mark += $mark->subjectMark->full_mark;
        }
        return $total_full_mark;
    }

    public function percentage($student_id)
    {
        $percentage = round(($this->totalMark($student_id) * 100) / ($this->totalFullMark($student_id)/$this->terms()->count()),1);
        return $percentage;
    }

    public function grade($student_id)
    {
        $percent = $this->percentage($student_id);
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

    public function GPA($student_id)
    {
        $percent = $this->percentage($student_id);
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

}
