<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Schedule;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function create()
    {
        return view('pages.schedules.create');
    }

    public function store(Request $request)
    {
        // return $request->all();
        $notifications_to_add = [];
        $today = Carbon::now(new DateTimeZone('Asia/Tehran'));
        if ($today->dayOfWeek == Carbon::SATURDAY) {
            $date = $today->copy()->startOfDay();
        } else {
            $date = new Carbon('last saturday');
        }
        for ($i = 0; $i < 4; $i++) {
            foreach ($request->notifs as $notification) {
                $next_sat = $date->copy()->addWeeks($i);
                $data = [
                    'name' => $notification['name'],
                    'course' => $notification['course'],
                    'time' => $notification['time']
                ];
                $timestamp = $next_sat->addDays($notification['day'] - 1)->addHours($notification['hour'])->addMinutes($notification['minute'])->timestamp;
                if ($timestamp > $today->timestamp) {
                    $notifications_to_add[] = [
                        'schedule_id' => $notification['schedule_id'],
                        'deadline' => $timestamp,
                        'time_zone' => 'Asia/Tehran',
                        'pattern_id' => 1,
                        'data' => json_encode($data),
                        'created_at' => $today,
                        'updated_at' => $today
                    ];
                }
            }
        }
        Notification::insert($notifications_to_add);
        return $notifications_to_add;
    }
}
