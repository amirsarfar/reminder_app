<?php

namespace App\Jobs;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Jaby\Sms\Sms;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function handle()
    {
        // echo $this->notification->deadline . "\t" . Carbon::now()->timestamp . "\n";
        $users = $this->notification->schedule->users;
        $data = json_decode($this->notification->data);

        $bulk_id = Sms::pattern('o8wjg0z7g8')->data([
            'name' => $data->name,
            'course' => $data->course,
            'time' => $data->time
        ])->to($users->pluck('phone')->all())->send();
    
        $this->notification->sent_at = now();
        $this->notification->save();
    }
}
