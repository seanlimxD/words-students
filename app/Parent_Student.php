<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parent_Student extends Model
{   
    use RecordLog;
    	
    protected $fillable = ['parent_id','student_id'];
    protected $table = "parent_student";
}
