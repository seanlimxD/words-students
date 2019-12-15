<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Word;
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
        $values = $request->all();

        $word = Word::create($values);

        return response()->json(['message'=>'Word is now added','code'=>201, 'word' => $word], 201);
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
        $word->fill($request->all())->save();

        return response()->json(['message'=>'Word updated','word' => $word, 201], 201);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
        $word->delete();
        return response()->json(['message'=>'This word has been deleted','code'=>201], 201);
    }
}
