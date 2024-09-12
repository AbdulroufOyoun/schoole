<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
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

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(PostImage::class);
    }


    public function likesCount()
    {
        return $this->hasMany(PostLike::class, 'post_id')->count();
    }

    public function likers()
    {
        return $this->hasManyThrough(
            User::class,
            PostLike::class,
            'post_id',
            'id',
            'id',
            'user_id'
        )->select('users.name','users.last_name', 'users.image', 'users.id');

    }

    public function commentCount()
    {
        return $this->hasMany(PostComment::class, 'post_id')->count();
    }

    public function confirmedBy()
    {

        return $this->belongsTo(User::class, 'confirmed_by', 'id');
    }

}
