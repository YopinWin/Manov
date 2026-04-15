<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Data Recap Scheduler 
// Runs every Sunday at 23:59
\Illuminate\Support\Facades\Schedule::command('hts:recap-reset')->weeklyOn(0, '23:59');
