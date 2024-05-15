<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Discharge;
use Illuminate\Http\Request;

class DischController extends Controller
{
    //
    public function index()
    {
        try{
            $disch=Discharge::with('reefers')->get();
            return [
                "payload"=>$disch,
                "status"=>200
            ];
        }catch(\Exception $e){
            return [
                "error"=>$e->getMessage(),
                "status"=>500
            ];
        }
    }

}
