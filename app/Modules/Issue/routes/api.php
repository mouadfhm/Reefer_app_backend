<?php

use App\Modules\Issue\Http\Controllers\IssueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api'
    ],
    function ($router) {

        Route::post('/issues/add', [IssueController::class, 'add']);
        Route::get('/issues', [IssueController::class, 'index']);
        Route::post('/issues/firstTier', [IssueController::class, 'firstTier']);
    }
);
