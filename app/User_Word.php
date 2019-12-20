<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Word extends Model
{
    protected $fillable = ['user_id', 'word_id', 'times_seen'];
    protected $table = "user_word";
}