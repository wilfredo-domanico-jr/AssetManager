<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('emailSending:send-inventory-summary')
    ->dailyAt('08:00'); // or ->weeklyOn(1, '08:00') for Mondays
