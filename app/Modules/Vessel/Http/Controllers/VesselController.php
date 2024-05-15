<?php

namespace App\Modules\Vessel\Http\Controllers;

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
}
