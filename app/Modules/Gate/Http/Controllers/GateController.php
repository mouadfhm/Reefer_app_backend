<?php

namespace App\Modules\Gate\Http\Controllers;

use App\Models\Gate as ModelsGate;
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
        try {
            $gate = Gate::with('reefer')->get();
            return [
                "payload" => $gate,
                "status" => 200
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
    public function getGateIn(Request $request)
    {
        try {
            $gateIn = Gate::where('type', 'IN')->with(['reefer', 'reefer.actionHistory' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
                ->get();
            return [
                "payload" => $gateIn,
                "status" => 200
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
    public function getGateOut(Request $request)
    {
        try {
            $gateOut = Gate::where('type', 'OUT')->with(['reefer', 'reefer.actionHistory' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
                ->get();
            return [
                "payload" => $gateOut,
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
