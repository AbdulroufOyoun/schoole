<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
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

    public function sectionCount()
    {
        return $this->hasMany(Section::class)->count();
    }

    public function studentCount()
    {
        return $this->hasMany(Student::class, 'classroom_id', 'id')->count();
    }

}
