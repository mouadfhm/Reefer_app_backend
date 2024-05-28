<?php

namespace App\Modules\Load\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Load\Models\Load;
use App\Modules\Reefer\Models\Reefer;
use App\Notifications\ReeferReadyForLoading;
use Illuminate\Support\Facades\Notification ;

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
    public function getLoads(Request $request)
    {
        $rules=[
            'vessel_id'=>'required|integer'
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                "error" => $validator->errors()->all(),
                "status" => 422
            ];
        }

        try{
            $loads=Load::where('vessel_id',$request->vessel_id,)->with(['reefer', 'reefer.actionHistory' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->get();
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

public function checkReeferStatus()
{
    $reefers = Reefer::where('plug_status', 'unplugged')->get();
    
    foreach ($reefers as $reefer) {
        $estimatedLoadTime = new \DateTime($reefer->estimated_time);
        $actionHistory = $reefer->action_history()->orderBy('created_at', 'desc')->first();

        if ($actionHistory) {
            $createdAt = new \DateTime($actionHistory->created_at);
            $interval = $estimatedLoadTime->diff($createdAt);

            // Check if unplugged within 2 hours of estimated load time
            if ($interval->h > 2) {
                Notification::send($reefer->user, new ReeferReadyForLoading($reefer));
            }
        }
    }
}


}
