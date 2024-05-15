<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Reefer\Http\Controllers\ReeferController as ControllersReeferController;

Route::get('/api/reefers/', [ControllersReeferController::class, 'index']);
