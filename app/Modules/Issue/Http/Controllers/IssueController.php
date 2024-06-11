<?php

namespace App\Modules\Issue\Http\Controllers;

use App\Modules\Issue\Models\Issue;
use App\Modules\User\Models\User;
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
    public function index()
    {
        try {
            $issues = Issue::with(['reefer.actionHistory','reefer.loads'=> function ($query) {
                $query->orderBy('estimated_time', 'asc');
            }])->get();
            return [
                "payload" => $issues,
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
            'reefer_id' => 'required',
            'type' => 'required',
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                "error" => $validator->errors()->all(),
                "status" => 422
            ];
        }
        try {
            $issue = Issue::create([
                'reefer_id' => $request->reefer_id,
                'type' => $request->type
            ]);
            return [
                "payload" => $issue,
                "status" => 200
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
    public function deleteIssue(Request $request){
        $rules = [
            'id' => 'required',
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                "error" => $validator->errors()->all(),
                "status" => 422
            ];
        }
        try {
            $issue = Issue::find($request->id);
            $issue->delete();
            return [
                "payload" => $issue,
                "status" => 200
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
    public function firstTier(Request $request)
    {
        $emails = User::all()->pluck('email')->toArray();//should be yard planner mail
        foreach ($emails as $email) {
            $param1 = $email;
            $param2 = 'This reefer ' . $request->reefer_id . ' has an issue : ' . $request->type . ' should be moved to first tier. Please check it.';
            try {
                $command = escapeshellcmd("python3 ../myenv/Scripts/Mail.py --recipient_email $param1 --body " . escapeshellarg($param2));
                $output = shell_exec($command);
                return [
                    "payload" => $output,
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
    public function firstTierConfimed(Request $request)
    {
        $emails = User::all()->pluck('email')->toArray();//should be tech team mail
        $verb = $request->first_tier === 'false' ? 'moved to' : 'removed from';
        foreach ($emails as $email) {
            $param1 = $email;
            $param2 = ' The issue : ' . $request->type . ' in this reefer ' . $request->reefer_id . ' has been '.$verb.' first tier.';
            try {
                $command = escapeshellcmd("python3 ../myenv/Scripts/Mail.py --recipient_email $param1 --body " . escapeshellarg($param2));
                $output = shell_exec($command);
                return [
                    "payload" => $output,
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
    public function moveToFirstTier(Request $request)
    {
        $issue = Issue::find($request->id);
        try {
            $issue->first_tier = $issue->first_tier === 'true' ? 'false' : 'true';
            $issue->save();
            return [
                "payload" => $issue,
                "status" => 200
            ];

        } catch (\Exception $e) {
            return [
                "payload" => $issue,
                "status" => 500
            ];
        }

    }
    public function issueFixedMail(Request $request)
    {
        $emails = User::all()->pluck('email')->toArray();
        foreach ($emails as $email) {
            $param1 = $email;
            $param2 = 'The issue : "' . $request->type . '" in the reefer : ' . $request->reefer_id . ', has been fixed.';
            try {
                $command = escapeshellcmd("python3 ../myenv/Scripts/Mail.py --recipient_email $param1 --body " . escapeshellarg($param2));
                $output = shell_exec($command);
                return [
                    "payload" => $output,
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
}
