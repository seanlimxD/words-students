<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = ['word', 'definition', 'pronunciation', 'usage', 'lexile_level'];


    /*
    *	students working on this word
    */
    public function users()
    {
        return $this->belongsToMany('App\User', 'users_words', 'word_id', 'user_id')->withTimestamps();
    }
}
