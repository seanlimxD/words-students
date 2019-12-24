<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\User_Word;
use App\Word;

class UserWordController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(User $user) 
     {
     	if (Auth::user()->permissions()->where('permission_id','1')->exists() || Auth::user()->children()->where('student_id', $user->id)->exists() || Auth::user() == $user) {
     		$words = $user->words;
     		return response()-> json(['message' => 'Request executed successfully', 'words'=>$words],200);-
		}
		return response()->json(['message'=>'You do not have the permissions to view this users information.', 'code'=>403],403);
     }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, Request $request)
    {
    	if (Auth::user()->permissions()->where('permission_id','2')->exists() || Auth::user()->children()->where('student_id', $user->id)->exists() || Auth::user() == $user) {
	    	foreach ($request->all() as $word_id){
	            if ($word=Word::find($word_id)){
	                $word->users()->sync($user->id, false);
	            } else {
	                response()->json(['message'=>'Error in word chosen'], 401);
	            } 
	        }
	        return response()->json(['message' => 'Word(s) correctly added to user', 'words added'=>$user->words,'code'=>201]);
	    }
		return response()->json(['message'=>'You do not have the permissions to edit this users information.', 'code'=>403],403);
    }

     /**
     * Display the specified resource.
     *
     * @param  User $user
     * @param  Word $word
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Word $word)
    {
    	if (Auth::user()->permissions()->where('permission_id','1')->exists() || Auth::user()->children()->where('student_id', $user->id)->exists() || Auth::user() == $user) {
    		$words = $user->words->find($word->id);
	        if (!$words) {
	            return response()->json(['message' => 'This user is currently not working on this word.', 'code'=>404], 404);
	        }
	        $user_word = $user->words()->whereWordId($word->id)->get();
			return response()->json(['message' =>'Successful retrieval of record.', 'user_word'=>$user_word, 'code'=>201], 201);
		}
		return response()->json(['message'=>'You do not have the permissions to view this users information.', 'code'=>403],403);
    	
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Word $word)
    {
    	if (Auth::user()->permissions()->where('permission_id','2')->exists() || Auth::user()->children()->where('student_id', $user->id)->exists() || Auth::user() == $user) {
    		$words = $user->words->find($word->id);
	        if (!$words) {
	            return response()->json(['message' => 'This user is currently not working on this word.', 'code'=>404], 404);
	        }

	        else if ($request->exists('user_id') || $request->exists('word_id')) {
	        	return response()->json(['message' => 'You cannot change these values.', 'code'=>401], 401);
	        }

	        $user_word = User_Word::where('user_id', $user->id)->where('word_id', $word->id)->first();

	        $user_word->fill($request->all())->save();

	        return response()->json(['message'=>'Record updated','user_word' => $user_word, 201], 201);
	    }
		return response()->json(['message'=>'You do not have the permissions to edit this users information.', 'code'=>403],403);
    }

    public function addView(User $user, Word $word)
    {
    	if (Auth::user()->permissions()->where('permission_id','2')->exists() || Auth::user()->children()->where('student_id', $user->id)->exists() || Auth::user() == $user) {
    		$words = $user->words->find($word->id);
	        if (!$words) {
	            return response()->json(['message' => 'This user is currently not working on this word.', 'code'=>404], 404);
	        }
	        $user_word = User_Word::where('user_id', $user->id)->where('word_id', $word->id)->first(); 
	        
	        $user_word->view_count++;

	        $user_word->save();

	        return response()->json(['message'=>'Record updated','user_word' => $user_word, 201], 201);
	    }
    	return response()->json(['message'=>'You do not have the permissions to edit this users information.', 'code'=>403],403);
    }

	public function toggleActive(User $user, Word $word)
    {
    	if (Auth::user()->permissions()->where('permission_id','2')->exists() || Auth::user()->children()->where('student_id', $user->id)->exists() || Auth::user() == $user) {
    		$words = $user->words->find($word->id);
	        if (!$words) {
	            return response()->json(['message' => 'This user is currently not working on this word.', 'code'=>404], 404);
	        }
	        $user_word = User_Word::where('user_id', $user->id)->where('word_id', $word->id)->first(); 
	        
	        $user_word->active = !($user_word->active);

	        $user_word->save();

	        return response()->json(['message'=>'Record updated','user_word' => $user_word, 201], 201);
	    }
    	return response()->json(['message'=>'You do not have the permissions to edit this users information.', 'code'=>403],403);
    }

    public function newWord(User $user)
    {
    	if (Auth::user()->permissions()->where('permission_id','2')->exists() || Auth::user()->children()->where('student_id', $user->id)->exists() || Auth::user() == $user) {
    		$word_ids = User_Word::select('word_id')->where('user_id',$user->id)->get();
	    	if ($new_word = Word::where('lexile_level', $user->lexile_level)->whereNotIn('id', $word_ids)->inRandomOrder()->first()){
	    		$new_word->users()->sync($user->id, false);
	    		return response()->json(['message' => 'Word(s) correctly added to user', 'current words'=>$user->words,'code'=>201]);
	    	}
	    	return response()->json(['message'=>'This user has no additional words of this lexile level.'], 401);
	    }
    	return response()->json(['message'=>'You do not have the permissions to edit this users information.', 'code'=>403],403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Word $word)
    {
    	if (Auth::user()->permissions()->where('permission_id','2')->exists() || Auth::user()->children()->where('student_id', $user->id)->exists() || Auth::user() == $user) {
    		$words = $user->words->find($word->id);
	        if (!$words) {
	            return response()->json(['message' => 'This user is currently not working on this word.', 'code'=>404], 404);
	        }
	        $user->words()->detach($word->id);
	        return response()->json(['message'=>'The user is no longer working on this word.', 'words'=>$user->words()->get(), 'code'=>201], 201);
		}
    	return response()->json(['message'=>'You do not have the permissions to edit this users information.', 'code'=>403],403);
    }
}
