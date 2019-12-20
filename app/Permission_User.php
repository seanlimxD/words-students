<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission_User extends Model
{
    use RecordLog;
    	
    protected $fillable = ['permission_id','user_id'];
    protected $table = "permission_user";
}
