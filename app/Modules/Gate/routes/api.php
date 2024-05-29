<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Gate\Http\Controllers\GateController;

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api'
    ],
    function ($router) {

        Route::get('/gate', [GateController::class, 'index']);
        Route::get('/gate/in', [GateController::class, 'getGateIn']);
        Route::get('/gate/out', [GateController::class, 'getGateOut']);
    }
);
