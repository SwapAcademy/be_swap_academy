<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\MentoringController;
use App\Http\Controllers\API\UserController;
use App\Models\Mentoring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::post('register', [UserController::class, 'register']);
// Route::get('users', [UserController::class, 'getAllUsers']);

// Route::controller(RegisterController::class)->group(function () {
//     Route::post('register', 'register');
//     Route::post('login', 'login');
// });

// Route::middleware('auth:sanctum')->group(function () {
//     Route::resource('products', ProductController::class);
// });


// Authentication
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'jwt.verify'], function ($router) {
    Route::get('getUsersById/{usersId}', [UserController::class, 'getUsersbyId']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('users', [UserController::class, 'getAllUsers']);

    // course
    Route::get('course', [CourseController::class, 'getAllCourse']);
    Route::get('course/category', [CourseController::class, 'getCourseByCategory']);
    Route::post('course/upload-course', [CourseController::class, 'uploadCourse']);
    Route::post('course/uploadVideoByCourse', [CourseController::class, 'uploadVideoByCourse']);
    Route::post('course/takeCourse', [CourseController::class, 'takeCourse']);
    Route::get('course/{userId}', [CourseController::class, 'getCourseByUser']);

    // mentoring
    Route::get('mentoring', [MentoringController::class, 'showAllMentoring']);
    Route::get('mentoring/{userId}', [MentoringController::class, 'getMentoringByUser']);
    Route::get('mentoring/category', [MentoringController::class, 'getMentoringByCategory']);
});
