<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
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


}
