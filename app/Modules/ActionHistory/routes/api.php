<?php

use App\Modules\ActionHistory\Http\Controllers\ActionHistoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/api/actions', [ActionHistoryController::class, 'index']);
Route::post('/api/actions/add', [ActionHistoryController::class, 'add']);
