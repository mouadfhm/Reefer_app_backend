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
        Route::post('/issues/delete', [IssueController::class, 'deleteIssue']);
        Route::post('/issues/issueFixedMail', [IssueController::class, 'issueFixedMail']);
        Route::post('/issues/movetofirsttier', [IssueController::class, 'moveToFirstTier']);
        Route::post('/issues/firstTier', [IssueController::class, 'firstTier']);
        Route::post('/issues/firstTierConfirmed', [IssueController::class, 'firstTierConfimed']);
    
    }
);
