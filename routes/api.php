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

// This endpoint does not need authentication.
Route::get('/public', function (Request $request) {
    return response()->json(['message' => 'Hello from a public endpoint!']);
});

// These endpoints require a valid access token.
Route::middleware(['jwt'])->group(function () {
    Route::get('/private', function (Request $request) {
        return response()->json(['message' => 'Hello from a private endpoint!']);
    });
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
Route::resource('permissions.users', 'PermissionUserController', ['except' => ['create', 'edit', 'update']]);