<?php

namespace App\Modules\Discharge\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Discharge\Models\Discharge;

class DischargeController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Discharge::welcome");
    }
    public function index()
    {
        try{
            $disch=Discharge::with('reefer')->get();
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
