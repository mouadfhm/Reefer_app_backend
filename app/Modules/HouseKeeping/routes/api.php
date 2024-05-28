<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\HouseKeeping\Http\Controllers\HouseKeepingController as ControllersHouseKeepingController;

Route::get('/api/housekeeping/', [ControllersHouseKeepingController::class, 'index']);
Route::get('/api/housekeeping/getHouseKeeping', [ControllersHouseKeepingController::class, 'getHouseKeeping']);
Route::post('/api/housekeeping/add', [ControllersHouseKeepingController::class, 'add']);
Route::post('/api/housekeeping/update', [ControllersHouseKeepingController::class, 'update']);
Route::post('/api/housekeeping/delete', [ControllersHouseKeepingController::class, 'delete']);

