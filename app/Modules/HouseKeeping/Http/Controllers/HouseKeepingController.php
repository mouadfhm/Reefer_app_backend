<?php

namespace App\Modules\HouseKeeping\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\HouseKeeping\Models\HouseKeeping;

class HouseKeepingController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("HouseKeeping::welcome");
    }
    public function index()
    {
        try{
            $housekeeping=HouseKeeping::with('reefer')->get();
            return [
                "payload"=>$housekeeping,
                "status"=>200
            ];
        }catch(\Exception $e){
            return [
                "error"=>$e->getMessage(),
                "status"=>500
            ];
        }
    }
    public function getHouseKeeping(Request $request)
    {
        try{
            $housekeeping=HouseKeeping::with(['reefer', 'reefer.actionHistory' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->get();
            return [
                "payload"=>$housekeeping,
                "status"=>200
            ];
        }catch(\Exception $e){
            return [
                "error"=>$e->getMessage(),
                "status"=>500
            ];
        }
    }

    public function add(Request $request)
    {
        $rules=[
            'reefer_id'=>'required',
            'plan_position'=>'required',
            'HK_time'=>'required',
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                "error" => $validator->errors()->all(),
                "status" => 422
            ];
        }
        try{
            $housekeeping=HouseKeeping::create($request->all());
            return [
                "payload"=>$housekeeping,
                "status"=>200
            ];
        }catch(\Exception $e){
            return [
                "error"=>$e->getMessage(),
                "status"=>500
            ];
        }
    }
    public function update(Request $request)
    {
        $rules=[
            'reefer_id'=>'integer',
            'plan_position'=>'string',
            'HK_time'=>'date',
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                "error" => $validator->errors()->all(),
                "status" => 422
            ];
        }
        try{
            $housekeeping=HouseKeeping::find($request->id);
            $housekeeping->update($request->all());
            return [
                "payload"=>$housekeeping,
                "status"=>200
            ];
        }catch(\Exception $e){
            return [
                "error"=>$e->getMessage(),
                "status"=>500
            ];
        }
    }
    public function delete(Request $request)
    {
        try{
            $housekeeping=HouseKeeping::find($request->id);
            $housekeeping->delete();
            return [
                "payload"=>$housekeeping,
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
