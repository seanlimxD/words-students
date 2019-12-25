<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\User;
use App\Course_User;

use Auth;

class CourseUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
    	if (Auth::user()->permissions()->where('permission_id','10')->exists() || $course->user_id == Auth::user()->id || Auth::user()->courses()->where('course_id', $course)->first()->pivot->teacher) {
	    	$users = $course->users;
	        return response()-> json(['message' => 'Request executed successfully', 'users'=>$users],200);
		}
        return response()->json(['message'=>'You do not have the permissions to view this courses information.', 'code'=>403],403);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Courspe $course
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
    	if (Auth::user()->permissions()->where('permission_id','9')->exists() || $course->user_id == Auth::user()->id || Auth::user()->courses()->where('course_id', $course)->first()->pivot->teacher) {
    		foreach ($request->all() as $user_id){
	            if ($user=User::find($user_id)){
	                $user->courses()->sync($course->id, false);
	            } else {
	                response()->json(['message'=>'Error in user chosen'], 401);
	            } 
	        }
	        return response()->json(['message' => 'User(s) correctly added to course', 'users added'=>$course->users,'code'=>201]);
		}
        return response()->json(['message'=>'You do not have the permissions to edit this course.', 'code'=>403],403);
    }

     /**
     * Display the specified resource.
     *
     * @param  Course $course
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, User $user)
    {
    	if (Auth::user()->permissions()->where('permission_id','10')->exists() || $course->user_id == Auth::user()->id || Auth::user()->courses()->where('course_id', $course)->first()->pivot->teacher) {
			$users = $course->users->find($user->id);
	        if (!$users) {
	            return response()->json(['message' => 'This user is not registered to this course.', 'code'=>404], 404);
	        }
	        $course_user = $course->users()->whereUserId($user->id)->get();
	        return response()->json(['message' =>'Successful retrieval of record.', 'course_user'=>$course_user, 'code'=>201], 201);
		}
        return response()->json(['message'=>'You do not have the permissions to view this courses information.', 'code'=>403],403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Course $course
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function toggleTeacher(Course $course, User $user)
    {
    	if (Auth::user()->permissions()->where('permission_id','9')->exists() || $course->user_id == Auth::user()->id || Auth::user()->courses()->where('course_id', $course)->first()->pivot->teacher) {
    		$users = $course->users->find($user->id);
	        if (!$users) {
	            return response()->json(['message' => 'This user is not registered to this course.', 'code'=>404], 404);
	        }
			$course_user = Course_User::where('course_id', $course->id)->where('user_id', $user->id)->first(); 
	        
	        $course_user->teacher = !($course_user->teacher);

	        $course_user->save();

	        return response()->json(['message'=>'Record updated','course_user' => $course_user, 201], 201);
		}
        return response()->json(['message'=>'You do not have the permissions to edit this courses information.', 'code'=>403],403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Course $course
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, User $user)
    {
    	if (Auth::user()->permissions()->where('permission_id','9')->exists() || $course->user_id == Auth::user()->id || Auth::user()->courses()->where('course_id', $course)->first()->pivot->teacher) {
	    	$users = $course->users->find($user->id);
	        if (!$users) {
	            return response()->json(['message' => 'This user is not registered to this course.', 'code'=>404], 404);
	        }
	        $course->users()->detach($user->id);
	        return response()->json(['message'=>'This user is no longer registered to this course.', 'users'=>$course->users()->get(), 'code'=>201], 201);
		}
        return response()->json(['message'=>'You do not have the permissions to edit this courses information.', 'code'=>403],403);
    }
}
