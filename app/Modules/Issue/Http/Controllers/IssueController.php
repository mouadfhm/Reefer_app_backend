<?php

namespace App\Modules\Issue\Http\Controllers;

use App\Modules\Issue\Models\Issue;
use Illuminate\Http\Request;

class IssueController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Issue::welcome");
    }
    public function index(){
        try{
            $issues=Issue::all();
            return [
                "payload"=>$issues,
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
            'type'=>'required',
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                "error" => $validator->errors()->all(),
                "status" => 422
            ];
        }
        try{
            $issue=Issue::create([
                'reefer_id'=>$request->reefer_id,
                'type'=>$request->type
            ]);
            return [
                "payload"=>$issue,
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
