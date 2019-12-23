<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	protected $hidden = ['user_id', 'created_at', 'updated_at'];
    protected $fillable = ['course', 'description','user_id'];

	public function created_by() {                        //who created this course
        return $this->belongsTo('App\User', 'user_id');
    }

    public function users(){
    	return $this->belongsToMany('App\User', 'courses_users', 'course_id', 'user_id')->withTimestamps();
    }
}
