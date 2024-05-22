<?php

namespace App\Modules\Fonction\Http\Controllers;

use App\Modules\Fonction\Models\Fonction;
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
    public function index()
    {
        try{
            $fonctions=Fonction::all();
            return [
                "payload"=>$fonctions,
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
