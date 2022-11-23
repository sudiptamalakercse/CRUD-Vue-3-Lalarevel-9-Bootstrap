<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Route::post('/register/user', [UserController::class, 'register']);
// Route::post('/login/user', [UserController::class, 'login']);
// Route::post('/logout/user', [UserController::class, 'logout']);

Route::post('/posts', [PostController::class, 'store']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
