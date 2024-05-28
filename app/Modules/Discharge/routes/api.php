<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Discharge\Http\Controllers\DischargeController as ControllersDischargeController;

Route::get('/api/discharge/', [ControllersDischargeController::class, 'index']);
Route::post('/api/discharge/byvessel', [ControllersDischargeController::class, 'getDischarges']);