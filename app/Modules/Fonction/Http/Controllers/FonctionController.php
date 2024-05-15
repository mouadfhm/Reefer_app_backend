<?php

namespace App\Modules\Fonction\Http\Controllers;

use Illuminate\Http\Request;

class FonctionController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Fonction::welcome");
    }
}
