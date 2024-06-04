<?php

namespace App\Modules\ActionHistory\Http\Controllers;

use App\Modules\ActionHistory\Models\ActionHistory;
use App\Modules\Reefer\Models\Reefer;
use Illuminate\Http\Request;
use Illuminate\Notifications\Action;

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
    public function index()
    {
        try {
            $actions = ActionHistory::all();
            return [
                "payload" => $actions,
                "status" => 200
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
    public function add(Request $request)
    {
        $rules = [
            'user_id' => 'required|integer|max:255',
            'reefer_id' => 'integer|max:255',
            'type' => 'string|max:255',
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                "error" => $validator->errors()->all(),
                "status" => 422
            ];
        }
        try {
            $reefer = Reefer::find($request->reefer_id);
            if ($reefer->plug_status === 'plugged') {
                $type = 'plug';
            }elseif ($reefer->plug_status === 'unplugged') {
                $type = 'unplug';
            };

            $action = ActionHistory::create([
                'user_id' => $request->user_id,
                'reefer_id' => $request->reefer_id,
                'type' => $type
            ]);
            return [
                "payload" => $action,
                "status" => 201,
                "message" => "action history created successfully"
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
    public function add_hk(Request $request)
    {
        $rules = [
            'user_id' => 'required|integer|max:255',
            'reefer_id' => 'required|integer|max:255',
            'housekeeping_id' => 'required|integer|max:255',
            'type' => 'required|string|max:255',
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                "error" => $validator->errors()->all(),
                "status" => 422
            ];
        }
        try {
            $action = ActionHistory::create([
                'user_id' => $request->user_id,
                'reefer_id' => $request->reefer_id,
                'housekeeping_id' => $request->housekeeping_id,
                'type' => $request->type
            ]);
            return [
                "payload" => $action,
                "status" => 201,
                "message" => "action history created successfully"
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
}
