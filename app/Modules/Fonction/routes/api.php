<?php

use App\Modules\Fonction\Http\Controllers\FonctionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api'
    ],
    function ($router) {

        Route::get('/fonction', [FonctionController::class, 'index']);
    }
);
