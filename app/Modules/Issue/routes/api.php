<?php

use App\Modules\Issue\Http\Controllers\IssueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/api/issues/add', [IssueController::class, 'add']);
Route::get('/api/issues/', [IssueController::class, 'index']);