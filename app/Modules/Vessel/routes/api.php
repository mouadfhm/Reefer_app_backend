<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Vessel\Http\Controllers\VesselController as ControllersVesselController;

Route::get('/api/vessel', [ControllersVesselController::class, 'index']);