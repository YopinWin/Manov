<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicLog extends Model
{
    protected $fillable = ['user_id', 'quiz_name', 'score', 'sleep_hours'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
