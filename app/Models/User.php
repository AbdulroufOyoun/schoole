<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'school_id',
        'name',
        'last_name',
        'father_name',
        'mother_name',
        'UserName',
        'email',
        'password',
        'role_id',
        'phone',
        'hobbies',
        'date_of_birth',
        'country',
        'about_me',
        'parent',
        'image',
        'gender',
        'teacher_section',
        'fcm_token',
        'languages'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function school()
    {
        return $this->belongsTo(School::class,'school_id','id');
    }

    public function getAccountTypeAttribute()
    {
        if ($this->attributes['role_id'] == 1) {
            return 'student';
        } elseif ($this->attributes['role_id'] == 2) {
            return 'teacher';
        } elseif ($this->attributes['role_id'] == 3) {
            return 'editor';
        } elseif ($this->attributes['role_id'] == 4) {
            return 'Parent';
        } elseif ($this->attributes['role_id'] == 5) {
            return 'academic';
        } elseif ($this->attributes['role_id'] == 6) {
            return 'admin';
        } elseif ($this->attributes['role_id'] == 7) {
            return 'accountant';
        } elseif ($this->attributes['role_id'] == 10) {
            return 'super admin';
        } else {
            return 'else';
        }
    }

    public function getGenderAttribute()
    {
        if ($this->attributes['gender'] == 1) {
            return 'Male';
        } else {
            return 'Female';
        }
    }

    public function likesCount()
    {
        return $this->hasMany(Like::class, 'profile_id')->count();
    }

    public function FollowersCount()
    {

        return $this->hasMany(Follow::class, 'profile_id')->count();

    }

    public function FollowingsCount()
    {

        return $this->hasMany(Follow::class, 'user_id')->count();

    }

    public function classroom()
    {
        $year_id = Year::whereActivated(true)->first()->id;
        return $this->hasOneThrough(
            Classroom::class,
            Student::class,
            'user_id', // foreign key on the students table
            'id', // local key on the users table
            'id', // local key on the classrooms table
            'classroom_id' // foreign key on the students table
        )->withoutGlobalScopes()->where('students.year_id', $year_id)
            ->where('students.school_id', auth()->user()->school_id);
    }

    public function section()
    {
        $year_id = Year::whereActivated(true)->first()->id;
        return $this->hasOneThrough(
            Section::class,
            Student::class,
            'user_id', // foreign key on the students table
            'id', // local key on the users table
            'id', // local key on the classrooms table
            'section_id' // foreign key on the students table
        )->withoutGlobalScopes()->where('students.year_id', $year_id)
            ->where('students.school_id', auth()->user()->school_id);
    }


}
