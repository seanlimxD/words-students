<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course_User extends Model
{    	
    protected $fillable = ['course_id','user_id', 'teacher'];
    protected $table = "courses_users";
}
