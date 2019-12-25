<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permission;
use App\Permission_User;
use App\User;

use Auth;

class PermissionUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Permission $permission)
    {
    	$users = $permission->users;
        return response()-> json(['message' => 'Request executed successfully', 'users'=>$users],200);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Permission $permission)
    {
    	if (Auth::user()->permissions()->where('permission_id','8')->exists()) {
    		foreach ($request->all() as $user_id){
	            if ($user=User::find($user_id)){
	                $user->permissions()->sync($permission->id, false);
	            } else {
	                response()->json(['message'=>'Error in user chosen'], 401);
	            } 
	        }
	        return response()->json(['message' => 'Users(s) correctly added to permission', 'users added'=>$permission->users,'code'=>201]);
		}
        return response()->json(['message'=>'You do not have the permissions to grant permissions.', 'code'=>403],403);	
    }

     /**
     * Display the specified resource.
     *
     * @param  Permission $permission
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission, User $user)
    {
    	$users = $permission->users->find($user->id);
        if (!$users) {
            return response()->json(['message' => 'This user does not have this permission.', 'code'=>404], 404);
        }
        $permission_word = $permission->users()->whereUserId($user->id)->get();
        return response()->json(['message' =>'Successful retrieval of record.', 'permission_word'=>$permission_word, 'code'=>201], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Permission $permission
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission, User $user)
    {
    	if (Auth::user()->permissions()->where('permission_id','8')->exists()) {
    		$users = $permission->users->find($user->id);
	        if (!$users) {
	            return response()->json(['message' => 'This user does not have this permission.', 'code'=>404], 404);
	        }
	        $permission->users()->detach($user->id);
	        return response()->json(['message'=>'This user no longer has this permission.', 'users'=>$permission->users()->get(), 'code'=>201], 201);
		}
        return response()->json(['message'=>'You do not have the permissions to revoke permissions.', 'code'=>403],403);
    }
}
