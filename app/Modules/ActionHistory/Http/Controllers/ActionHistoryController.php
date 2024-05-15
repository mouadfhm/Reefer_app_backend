<?php

namespace App\Modules\ActionHistory\Http\Controllers;

use Illuminate\Http\Request;

class ActionHistoryController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("ActionHistory::welcome");
    }
}
