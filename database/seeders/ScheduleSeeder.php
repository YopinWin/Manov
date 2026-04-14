<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'course_name' => 'Kalkulus Lanjut',
                'start_time' => '08:00:00',
                'end_time' => '10:30:00',
                'intensity' => 5, // Sangat Berat
            ],
            [
                'course_name' => 'Bahasa Inggris',
                'start_time' => '11:00:00',
                'end_time' => '12:30:00',
                'intensity' => 2, // Ringan
            ],
            [
                'course_name' => 'Praktikum Struktur Data',
                'start_time' => '14:00:00',
                'end_time' => '17:00:00',
                'intensity' => 5, // Berat
            ],
        ];

        foreach ($data as $val) {
            Schedule::create($val);
        }
    }
}