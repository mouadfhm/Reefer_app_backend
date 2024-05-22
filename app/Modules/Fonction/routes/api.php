<?php

use App\Modules\Fonction\Http\Controllers\FonctionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/api/fonction/', [FonctionController::class, 'index']);
