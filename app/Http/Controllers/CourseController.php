<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Http\Requests\CreateCourseRequest;

use Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()-> json(['message' => 'Request executed successfully', 'courses'=>Course::all()],200);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCourseRequest $request)
    {
    	if (Auth::user()->permissions()->where('permission_id','9')->exists()) {
    		$course = new Course();

	        $course->fill($request->all());

	        $course->user_id = 1;

	        $course->save();

	        return response()->json(['message'=>'Course has been created','code'=>201, 'course' => $course], 201);
		}
        return response()->json(['message'=>'You do not have the permissions to create courses', 'code'=>403],403);
    }

     /**
     * Display the specified resource.
     *
     * @param  Course $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return response()->json(['message' =>'Successful retrieval of course.', 'course'=>$course, 'code'=>201], 201);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
    	if (Auth::user()->permissions()->where('permission_id','10')->exists() || $course->user_id == Auth::user()->id || Auth::user()->courses()->where('course_id', $course)->first()->pivot->teacher) {
	        $course->fill($request->all())->save();

	        return response()->json(['message'=>'Course updated','course' => $course, 201], 201);
		}
        return response()->json(['message'=>'You do not have the permissions to edit courses', 'code'=>403],403);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
    	if (Auth::user()->permissions()->where('permission_id','10')->exists()|| $course->user_id == Auth::user()->id) {
	        $course->delete();
	        return response()->json(['message'=>'This course has been deleted','code'=>201], 201);
		}
        return response()->json(['message'=>'You do not have the permissions to delete courses', 'code'=>403],403);
    }
}
