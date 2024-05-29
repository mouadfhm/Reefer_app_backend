<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Discharge\Http\Controllers\DischargeController as ControllersDischargeController;

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api'
    ],
    function ($router) {

Route::get('/discharge', [ControllersDischargeController::class, 'index']);
Route::post('/discharge/byvessel', [ControllersDischargeController::class, 'getDischarges']);

    }
);