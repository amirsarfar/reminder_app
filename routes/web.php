<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.homepage');
});

Route::get('schedules/create', [ScheduleController::class, 'create']);
Route::post('schedules', [ScheduleController::class, 'store']);