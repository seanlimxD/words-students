<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class ParentStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $parent)
    {
    	$students = $parent->children;
        return response()-> json(['message' => 'Request executed successfully', 'children'=>$students],200);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $parent
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $parent)
    {
    	// if ($user->permissions()::whereId('3')) {
		foreach ($request->all() as $student_id){
            if ($student=User::find($student_id)){
                $student->parents()->sync($parent->id, false);
            } else {
                response()->json(['message'=>'Error in user chosen'], 401);
            } 
        }
        return response()->json(['message' => 'Student(s) correctly added to parent', 'students added'=>$parent->students,'code'=>201]);
    	// }
        // return response()->json(['message'=>'You do not have the permissions to create new users', 'code'=>403],403);
    }

     /**
     * Display the specified resource.
     *
     * @param  User $parent
     * @param  User $student
     * @return \Illuminate\Http\Response
     */
    public function show(User $parent, User $student)
    {
    	$students = $parent->children->find($student->id);
        if (!$students) {
            return response()->json(['message' => 'This student is not registered to this parent.', 'code'=>404], 404);
        }
        $parent_student = $parent->children()->whereStudentId($student->id)->get();
        return response()->json(['message' =>'Successful retrieval of record.', 'parent_student'=>$parent_student, 'code'=>201], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $parent, User $student)
    {
    	$students = $parent->children->find($student->id);
        if (!$students) {
            return response()->json(['message' => 'This student is not registered to this parent', 'code'=>404], 404);
        }
        $parent->children()->detach($student->id);
        return response()->json(['message'=>'This student is no longer registered to this parent.', 'children'=>$parent->children()->get(), 'code'=>201], 201);
    }
}
