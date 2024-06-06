<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\HouseKeeping\Http\Controllers\HouseKeepingController as ControllersHouseKeepingController;

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api'
    ],
    function ($router) {

        Route::get('/housekeeping', [ControllersHouseKeepingController::class, 'index']);
        Route::get('/housekeeping/getHouseKeeping', [ControllersHouseKeepingController::class, 'getHouseKeeping']);
        Route::post('/housekeeping/add', [ControllersHouseKeepingController::class, 'add']);
        Route::post('/housekeeping/update', [ControllersHouseKeepingController::class, 'update']);
        Route::post('/housekeeping/delete', [ControllersHouseKeepingController::class, 'delete']);
        Route::post('/housekeeping/houseKeepingMail', [ControllersHouseKeepingController::class, 'houseKeepingMail']);
    }
);
