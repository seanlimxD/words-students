<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\CreateUserRequest;

use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()-> json(['message' => 'Request executed successfully', 'users'=>User::all()],200);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
    	// if ($user->permissions()::whereId('3')) {
		$values = $request->all();
        $values['password'] = bcrypt($request->password);
        $user = User::create($values);

        return response()->json(['message'=>'User has been registered','code'=>201, 'user' => $user], 201);
    	// }
        // return response()->json(['message'=>'You do not have the permissions to create new users', 'code'=>403],403);
    }

     /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(['message' =>'Successful retrieval of user.', 'user'=>$user, 'code'=>201], 201);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
		$values = $request;
        $values['password'] = bcrypt($request->password);
        $user->fill($values->all())->save();

        return response()->json(['message'=>'User updated','user' => $user, 201], 201);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message'=>'This user has been deleted','code'=>201], 201);
    }
}
