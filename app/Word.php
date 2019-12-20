<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = ['word', 'definition', 'pronunciation', 'usage', 'lexile_level']


    /*
    *	students working on this word
    */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_word', 'user_id', 'word_id');
    }
}
