<?php

namespace App\Console\Commands;

use App\Modules\Reefer\Models\Reefer;
use App\Modules\User\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckReefers extends Command
{
    protected $signature = 'app:check-reefers';
    protected $description = 'Check reefers and send notifications';

    public function handle()
    {
        Log::info('CheckReefers command started');
        $this->reeferReadyForLoading();
        $this->reeferUnplugged4Hours();
        Log::info('CheckReefers command completed');
        return Command::SUCCESS;
    }

    public function reeferReadyForLoading()
    {
        $reefers = Reefer::where('plug_status', 'unplugged')->get();
        $emails = User::all()->pluck('email')->toArray();
        foreach ($reefers as $reefer) {
            $estimatedLoadTime = new \DateTime($reefer->estimated_time);
            $dateTimeNow = new \DateTime(now());
            $interval = $estimatedLoadTime->diff($dateTimeNow);
            if ($interval->h < 2) {
                foreach ($emails as $email) {
                    $param1 = $email;
                    $param2 = 'This reefer ' . $reefer->id . ' is ready for loading and its load time is in less than ' . $interval->h . ' hours.';

                    $command = escapeshellcmd("python3 myenv/Scripts/Mail.py --recipient_email $param1 --body " . escapeshellarg($param2));
                    $output = shell_exec($command);
                    Log::info('Executed reeferReadyForLoading with output: ' . $output);
                }
            }
        }
    }

    public function reeferUnplugged4Hours()
    {
        $reefers = Reefer::where('plug_status', 'unplugged')->get();
        $emails = User::all()->pluck('email')->toArray();
        foreach ($reefers as $reefer) {
            $estimatedLoadTime = new \DateTime($reefer->estimated_time);
            $actionHistory = $reefer->actionHistory()->where('type', 'unplug')->orderBy('created_at', 'desc')->first();

            if ($actionHistory) {
                $createdAt = new \DateTime($actionHistory->created_at);
                $interval = $estimatedLoadTime->diff($createdAt);

                if ($interval->h > 4) {
                    foreach ($emails as $email) {
                        $param1 = $email;
                        $param2 = 'This reefer ' . $reefer->id . ' is unplugged and its load time is in more than ' . $interval->h . ' hours.';

                        $command = escapeshellcmd("python3 myenv/Scripts/Mail.py --recipient_email $param1 --body " . escapeshellarg($param2));
                        $output = shell_exec($command);
                        Log::info('Executed reeferUnplugged4Hours with output: ' . $output);
                    }
                }
            }
        }
    }
}
