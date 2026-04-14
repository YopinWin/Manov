<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyHealthLog extends Model
{
    protected $fillable = ['water_intake', 'sleep_hours', 'mood_status', 'log_date'];
}