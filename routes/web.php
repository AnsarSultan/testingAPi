<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->prefix('posts')->group(function () {
    
    // Route::get('/', [PostController::class, 'index']);
    // Route::post('/create', [PostController::class, 'store']);
    // Route::put('/update/{id}', [PostController::class, 'update']);
    // Route::delete('/delete/{id}', [PostController::class, 'destroy']);
});
