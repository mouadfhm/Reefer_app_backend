<?php

use App\Modules\ActionHistory\Http\Controllers\ActionHistoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api'
    ],
    function ($router) {

Route::get('/actions', [ActionHistoryController::class, 'index']);
Route::post('/actions/add', [ActionHistoryController::class, 'add']);

    }
);