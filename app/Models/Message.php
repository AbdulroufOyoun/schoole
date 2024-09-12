<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'sender_id',
        'section_id',
        'subject',
        'message',
        'accepted',
        'accepted_at',
        'read',
        'reply_to_message'
    ];

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
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function getTypeAttribute()
    {
        if ($this->attributes['type'] === 1) {
            return 'students';
        } elseif ($this->attributes['type'] == 2) {
            return 'teachers';
        } elseif ($this->attributes['type'] == 3) {
            return 'editors';
        } elseif ($this->attributes['type'] == 4) {
            return 'parents';
        } elseif ($this->attributes['type'] === 5) {
            return 'academic';
        } elseif ($this->attributes['type'] === 6) {
            return 'admin';
        } else {
            return 'null';
        }
    }

}
