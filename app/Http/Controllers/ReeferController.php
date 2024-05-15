<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reefer;
use Illuminate\Http\Request;

class ReeferController extends Controller
{
    //
    public function index(){
        try{
            $reefers=Reefer::with('vessels')->get();
            return [
                "payload"=>$reefers,
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
