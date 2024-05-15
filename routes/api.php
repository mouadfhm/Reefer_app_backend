<?php

use App\Http\Controllers\DischController;
use App\Http\Controllers\GateController;
use App\Http\Controllers\HouseKeepingController;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\ReeferController;
use Illuminate\Support\Facades\Route;

Route::get('/api/reefers/', [ReeferController::class, 'index']);
Route::get('/api/load/', [LoadController::class, 'index']);
Route::get('/api/discharge/', [DischController::class, 'index']);
Route::get('/api/gate/', [GateController::class, 'index']);
Route::get('/api/housekeeping/', [HouseKeepingController::class, 'index']);
Route::post('/api/housekeeping/add', [HouseKeepingController::class, 'add']);

