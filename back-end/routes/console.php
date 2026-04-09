<?php

use Illuminate\Support\Facades\Schedule;

// I execute per minute - for testing only
// Schedule::command('emailSending:send-report-summary')
//     ->everyMinute();

// I execute weekly every Saturday at 8PM
Schedule::command('emailSending:send-report-summary')
    ->weeklyOn(6, '20:00'); // Saturday at 8 PM