<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Http\Requests\CreatePermissionRequest;

use Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()-> json(['message' => 'Request executed successfully', 'permissions'=>Permission::all()],200);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreatePermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePermissionRequest $request)
    {
    	if (Auth::user()->permissions()->where('permission_id','6')->exists()) {
	        $permission = Permission::create($request->all());

	        return response()->json(['message'=>'Permission has been created','code'=>201, 'permission' => $permission], 201);
		}
        return response()->json(['message'=>'You do not have the permissions to create new permissions', 'code'=>403],403);
    }

     /**
     * Display the specified resource.
     *
     * @param  Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return response()->json(['message' =>'Successful retrieval of permission.', 'permission'=>$permission, 'code'=>201], 201);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
    	if (Auth::user()->permissions()->where('permission_id','7')->exists()) {
	        $permission->fill($request->all())->save();
	        return response()->json(['message'=>'Permission updated','permission' => $permission, 201], 201);
		}
        return response()->json(['message'=>'You do not have the permissions to edit permissions', 'code'=>403],403);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
    	if (Auth::user()->permissions()->where('permission_id','7')->exists()) {
        	$permission->delete();
        	return response()->json(['message'=>'This permission has been deleted','code'=>201], 201);
		}
        return response()->json(['message'=>'You do not have the permissions to delete permissions', 'code'=>403],403);
    }
}
