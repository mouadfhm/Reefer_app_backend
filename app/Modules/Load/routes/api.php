<?php

use App\Modules\Load\Http\Controllers\LoadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/api/load/', [LoadController::class, 'index']);
