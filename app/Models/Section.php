<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
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

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function studentCount()
    {
        $year_id = Year::whereActivated(true)->first()->id;
        return $this->hasMany(Student::class, 'section_id', 'id')->where('year_id', $year_id)->count();
    }

    public function allYearstudentCount()
    {
        return $this->hasMany(Student::class, 'section_id', 'id')->count();
    }

}
