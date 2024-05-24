<?php

namespace App\Modules\IssueType\Http\Controllers;

use App\Modules\IssueType\Models\IssueType;
use Illuminate\Http\Request;

class IssueTypeController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("IssueType::welcome");
    }
    public function index()
    {
        try{
            $issueTypes = IssueType::all();
            return [
                "payload" => $issueTypes,
                "status" => 200
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
}
