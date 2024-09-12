<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MarksConfiguration extends Model
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

    public function subject()
    {
        return $this->belongsTo(Subject::class,'subject_id','id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class,'classroom_id','id');
    }

}
