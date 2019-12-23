<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Http\Requests\CreatePermissionRequest;

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
    	// if ($user->permissions()::whereId('3')) {
        $permission = Permission::create($request->all());

        return response()->json(['message'=>'Permission has been created','code'=>201, 'permission' => $permission], 201);
    	// }
        // return response()->json(['message'=>'You do not have the permissions to create new users', 'code'=>403],403);
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
        $permission->fill($request->all())->save();

        return response()->json(['message'=>'Permission updated','permission' => $permission, 201], 201);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(['message'=>'This permission has been deleted','code'=>201], 201);
    }
}
