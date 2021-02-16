<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.homepage');
});

Route::get('/schedules/create', function(){
    return view('pages.schedules.create');
});