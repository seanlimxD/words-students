<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Word;
use App\User;
use App\Http\Requests\CreateWordRequest;

use Auth;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()-> json(['message' => 'Request executed successfully', 'words'=>Word::all()],200);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateWordRequest  $word
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWordRequest $request)
    {
    	if (Auth::user()->permissions()->where('permission_id','4')->exists()) {
			$values = $request->all();

	        $word = Word::create($values);

	        return response()->json(['message'=>'Word is now added','code'=>201, 'word' => $word], 201);
    	}
        return response()->json(['message'=>'You do not have the permissions to create new words', 'code'=>403],403);
    }

     /**
     * Display the specified resource.
     *
     * @param  Word $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        return response()->json(['message' =>'Successful retrieval of word.', 'word'=>$word, 'code'=>201], 201);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Word  $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
    	if (Auth::user()->permissions()->where('permission_id','5')->exists()) {
			$word->fill($request->all())->save();

        	return response()->json(['message'=>'Word updated','word' => $word, 201], 201);
		}
        return response()->json(['message'=>'You do not have the permissions to edit words', 'code'=>403],403);
        
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
    	if (Auth::user()->permissions()->where('permission_id','5')->exists()) {
    		$word->delete();
        	return response()->json(['message'=>'This word has been deleted','code'=>201], 201);
		}
        return response()->json(['message'=>'You do not have the permissions delete words', 'code'=>403],403);
    }
}
