<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


/* Schedule::command('carts:send-abandoned-emails')
    ->dailyAt('12:10'); */

Schedule::command('carts:send-abandoned-emails')
    ->everyMinute();
