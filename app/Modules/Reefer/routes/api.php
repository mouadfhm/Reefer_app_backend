<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Reefer\Http\Controllers\ReeferController as ControllersReeferController;

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api'
    ],
    function ($router) {
        Route::get('/reefers', [ControllersReeferController::class, 'index']);
        Route::post('/reefers/changestatus', [ControllersReeferController::class, 'changeStatus']);
    }
);
