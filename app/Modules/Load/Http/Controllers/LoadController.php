<?php

namespace App\Modules\Load\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Load\Models\Load;

class LoadController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Load::welcome");
    }
    public function index()
    {
        try{
            $loads=Load::with('reefer')->get();
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
