<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//  ------------------   Register and Login routes   ----------------  //

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//  ------------------   Authenticated routes   ----------------  //

Route::middleware(['auth:sanctum'])->group(function () {


    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user details', [AuthController::class, 'user']);

    // ---------- Post routes  ---------- //

    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/create post', [PostController::class, 'createPost']);
    Route::put('/update post/{post}', [PostController::class, 'updatePost']);
    Route::delete('/delete post/{post}', [PostController::class, 'deletePost']);


});
