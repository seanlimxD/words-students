<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'lexile_level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    * current words the student is working on
    */

    public function words()
    {
        return $this->belongsToMany('App\Word', 'users_words', 'user_id', 'word_id')->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

    public function children(){
        return $this->belongsToMany('App\User', 'parents_students', 'parent_id', 'student_id');
    }

    public function parents(){
        return $this->belongsToMany('App\User', 'parents_students', 'parent_id', 'student_id');
    }

    public function courses(){
        return $this->belongsToMany("App\Course", 'courses_users', 'user_id', 'course_id')->withTimestamps();
    }
}
