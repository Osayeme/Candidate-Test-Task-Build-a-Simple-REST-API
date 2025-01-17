<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->get('user', [AuthController::class, 'user']);
Route::middleware('auth:api')->group(function () {
    Route::post('posts', [PostController::class, 'store']); // Create
    Route::get('posts', [PostController::class, 'index']); // Read all
    Route::get('posts/{id}', [PostController::class, 'show']); // Read single
    Route::put('posts/{id}', [PostController::class, 'update']); // Update
    Route::delete('posts/{id}', [PostController::class, 'destroy']); // Delete
});