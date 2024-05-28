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
    public function getDischarges(Request $request)
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
            $discharge=Discharge::where('vessel_id',$request->vessel_id,)->with(['reefer', 'reefer.actionHistory' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->get();
            return [
                "payload"=>$discharge,
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
