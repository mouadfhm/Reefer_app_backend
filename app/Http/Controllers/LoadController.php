<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Load;
use Illuminate\Http\Request;

class LoadController extends Controller
{
    //
    public function index()
    {
        try{
            $loads=Load::with('reefers')->get();
            return [
                "payload"=>$loads,
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
