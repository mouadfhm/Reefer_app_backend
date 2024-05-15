<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\User\Http\Controllers\UserController as ControllersUserController;

Route::prefix('api/users')->group(function () {
    Route::post('/register', [ControllersUserController::class, 'register']);
    Route::post('/login', [ControllersUserController::class, 'login']);

Route::middleware(['auth:sanctum', 'web'])->group(function () {
    Route::get('/', [ControllersUserController::class, 'index']);
    Route::post('/logout', [ControllersUserController::class, 'logout']);
    Route::post('/update', [ControllersUserController::class, 'update']);
    Route::post('/delete', [ControllersUserController::class, 'delete']);
    Route::post('/reset-password', [ControllersUserController::class, 'resetPassword']);
    Route::post('/change-password', [ControllersUserController::class, 'changePassword']);
});
});