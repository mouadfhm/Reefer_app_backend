<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gate;
use Illuminate\Http\Request;

class GateController extends Controller
{
    //
    public function index()
    {
        try{
            $gate=Gate::with('reefers')->get();
            return [
                "payload"=>$gate,
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
