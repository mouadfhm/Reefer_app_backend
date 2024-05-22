<?php

namespace App\Modules\Vessel\Http\Controllers;

use App\Models\Vessel;
use Illuminate\Http\Request;

class VesselController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Vessel::welcome");
    }
    public function index()
    {
        try{
            $vessels=Vessel::all();
            return [
                "payload"=>$vessels,
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
