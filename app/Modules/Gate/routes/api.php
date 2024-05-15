<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Gate\Http\Controllers\GateController;

Route::get('/api/gate/', [GateController::class, 'index']);
