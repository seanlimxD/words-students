<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission_User extends Model
{
    protected $fillable = ['permission_id','user_id'];
    protected $table = "permissions_users";
}
