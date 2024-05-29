<?php

use App\Modules\IssueType\Http\Controllers\IssueTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api'
    ],
    function ($router) {

        Route::get('/issue-type', [IssueTypeController::class, 'index']);
    }
);
