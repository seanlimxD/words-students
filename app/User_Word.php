<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Word extends Model
{
    protected $fillable = ['user_id', 'word_id', 'view_count', 'active'];
    protected $table = "users_words";
}