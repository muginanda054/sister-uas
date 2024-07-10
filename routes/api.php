<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

Route::post('register', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Profile page
    Route::get('profile', [ApiController::class, 'profile']);
    
    // Logout
    Route::get('logout', [ApiController::class, 'logout']);

    // Get user info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});