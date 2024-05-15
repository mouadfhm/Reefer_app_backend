<?php

namespace App\Modules\Gate\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Gate\Models\Gate;


class GateController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Gate::welcome");
    }
    public function index()
    {
        try{
            $gate=Gate::with('reefer')->get();
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
