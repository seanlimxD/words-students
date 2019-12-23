<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parent_Student extends Model
{   
    protected $fillable = ['parent_id','student_id'];
    protected $table = "parents_students";
}
