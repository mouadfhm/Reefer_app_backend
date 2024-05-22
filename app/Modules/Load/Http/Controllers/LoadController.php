<?php

namespace App\Modules\Load\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Load\Models\Load;

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
            $loads=Load::where('vessel_id',$request->vessel_id)->with('reefer')->get();
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

}
