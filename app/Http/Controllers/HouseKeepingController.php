<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HouseKeeping;
use finfo;
use Illuminate\Http\Request;

class HouseKeepingController extends Controller
{
    //
    public function index()
    {
        try{
            $housekeeping=HouseKeeping::with('reefers')->get();
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
            'hk_time'=>'required',
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
            'reefer_id'=>'required',
            'plan_position'=>'required',
            'hk_time'=>'required',
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
}
