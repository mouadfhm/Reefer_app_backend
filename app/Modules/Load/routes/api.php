<?php

use App\Modules\Load\Http\Controllers\LoadController;
use App\Modules\Load\Models\Load;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => 'auth:sanctum',
        'prefix' => 'api'
    ],
    function ($router) {

        Route::get('/load', [LoadController::class, 'index']);
        Route::post('/load/byvessel', [LoadController::class, 'getLoads']);
        Route::get('/load/test-email', function () {
            // Fetch or create an ActionHistory record for testing
            $load = Load::first(); // or create one for the test
            if (!$load) {
                $load = Load::create([
                    // fill with necessary attributes
                    'estimated_time' => now(),
                    // other attributes...
                ]);
            }
        
            // Update the estimated_time to trigger the observer
            $load->estimated_time = now()->addDays(1);
            $load->save();
        
            return 'Email test triggered. Check your email.';
        });
    }
    
);
