<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// I execute per minute - for testing only
// Schedule::command('emailSending:send-report-summary')
//     ->everyMinute();

// I execute weekly every Saturday at 8PM
Schedule::command('emailSending:send-report-summary')
    ->weeklyOn(6, '20:00'); // Saturday at 8 PM
