<?php

namespace App\Modules\Reefer\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Reefer\Models\Reefer;

class ReeferController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Reefer::welcome");
    }
    public function index()
    {
        try {
            $reefers = Reefer::with('vessel', 'issue')->get();
            return [
                "payload" => $reefers,
                "status" => 200
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
    public function changeStatus(Request $request)
    {
        $reefer = Reefer::find($request->id);
        try {
            // Check if the plug_status is 'plugged', if so, change it to 'unplugged', and vice versa
            $reefer->plug_status = $reefer->plug_status === 'plugged' ? 'unplugged' : 'plugged';
            $reefer->save();
            return [
                "payload" => $reefer,
                "status" => 200
            ];

        } catch (\Exception $e) {
            return [
                "payload" => $reefer,
                "status" => 500
            ];
        }
    }
}
