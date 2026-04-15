<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRecap extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'period_type', // 'weekly', 'monthly', etc.
        'start_date',
        'end_date',
        'summary_data', // JSON
    ];

    protected $casts = [
        'summary_data' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
