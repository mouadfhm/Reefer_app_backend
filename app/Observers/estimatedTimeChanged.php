<?php

namespace App\Observers;

use App\Models\Load;
use App\Modules\User\Models\User;

class estimatedTimeChanged
{
    /**
     * Handle the Load "created" event.
     */
    public function created(Load $load): void
    {
        //
    }

    /**
     * Handle the Load "updated" event.
     */
    public function updated(Load $load): void
    {
        //
        if ($load->isDirty('estimated_time')) {
            $emails = User::all()->pluck('email')->toArray();
            foreach ($emails as $email) {
                $param1 = $email;
                $param2 = "The estimated time of load " . $load->id . " has been changed to " . $load->estimated_time;
                try {
                    $command = escapeshellcmd("python3 ../myenv/Scripts/Mail.py --recipient_email $param1 --body " . escapeshellarg($param2));
                    $output = shell_exec($command);
                } catch (\Exception $e) {
                    dd($e);
                }
            }
        }
    }

    /**
     * Handle the Load "deleted" event.
     */
    public function deleted(Load $load): void
    {
        //
    }

    /**
     * Handle the Load "restored" event.
     */
    public function restored(Load $load): void
    {
        //
    }

    /**
     * Handle the Load "force deleted" event.
     */
    public function forceDeleted(Load $load): void
    {
        //
    }
}
