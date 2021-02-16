<?php

namespace App\Console\Commands;

use App\Jobs\SendSmsJob;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckSmsDeadline extends Command
{
    protected $signature = 'check:deadline';

    protected $description = 'check for not sent notifications that should be sent';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $not_sent_notifications = Notification::whereNull('sent_at')->get();
        $now = Carbon::now()->timestamp;
        echo $now . "\n";
        foreach($not_sent_notifications as $notification){
            if($notification->deadline < $now){
                SendSmsJob::dispatch($notification);
            }
        }
    }
}
