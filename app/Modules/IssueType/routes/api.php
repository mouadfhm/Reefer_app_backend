<?php

use App\Modules\IssueType\Http\Controllers\IssueTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/api/issue-type/', [IssueTypeController::class, 'index']);
