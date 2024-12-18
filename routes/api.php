<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckTokenMiddleware;


Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);


Route::middleware([ 'check.token' ])->group(function () {
    // Route::middleware([CheckTokenMiddleware::class])->group(function () {
    Route::apiResource('posts', PostController::class);
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});


// Route::middleware(['check.token'])->group(function () {
//     Route::middleware(['auth:sanctum'])->group(function () {
//         Route::apiResource('posts', PostController::class);
//         Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
//     });
// });
