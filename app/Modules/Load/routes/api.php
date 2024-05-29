<?php

use App\Modules\Load\Http\Controllers\LoadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api'
    ],
    function ($router) {

        Route::get('/load', [LoadController::class, 'index']);
        Route::post('/load/byvessel', [LoadController::class, 'getLoads']);
    }
);
