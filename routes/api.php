<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('words', 'WordController', ['except' => ['create', 'edit']]);
Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);
Route::resource('users.words', 'UserWordController', ['except' => ['create', 'edit']]);
Route::post('users/{user}/newWord', 'UserWordController@newWord');
Route::post('users/{user}/words/{word}/addView', 'UserWordController@addView');
Route::post('users/{user}/words/{word}/toggleActive', 'UserWordController@toggleActive');
Route::resource('parents.students', 'ParentStudentController', ['except' => ['create', 'edit', 'update']]);
Route::resource('courses', 'CourseController', ['except' => ['create', 'edit']]);
Route::resource('permissions', 'PermissionController', ['except' => ['create', 'edit']]);
Route::resource('courses.users', 'CourseUserController', ['except' => ['create', 'edit', 'update']]);
Route::post('courses/{course}/users/{user}/toggleTeacher', 'CourseUserController@toggleTeacher');