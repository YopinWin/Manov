<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::truncate();

        $schedules = [
            // Monday
            ['course_name' => 'Kalkulus Lanjut', 'day' => 'Monday', 'start_time' => '08:00', 'end_time' => '10:30', 'intensity' => 5, 'notes' => 'Siapin mental'],
            ['course_name' => 'Fisika Dasar', 'day' => 'Monday', 'start_time' => '13:00', 'end_time' => '15:00', 'intensity' => 4, 'notes' => 'Praktikum'],
            
            // Tuesday
            ['course_name' => 'Pemrograman Web', 'day' => 'Tuesday', 'start_time' => '09:00', 'end_time' => '11:00', 'intensity' => 3, 'notes' => 'Bawa laptop'],
            ['course_name' => 'Kecerdasan Buatan', 'day' => 'Tuesday', 'start_time' => '14:00', 'end_time' => '16:30', 'intensity' => 5, 'notes' => 'Tugas model ML'],
            
            // Wednesday
            ['course_name' => 'Struktur Data', 'day' => 'Wednesday', 'start_time' => '07:30', 'end_time' => '10:00', 'intensity' => 4, 'notes' => 'Kuis dadakan biasanya'],
            
            // Thursday
            ['course_name' => 'Pancasila', 'day' => 'Thursday', 'start_time' => '10:00', 'end_time' => '12:00', 'intensity' => 2, 'notes' => 'Santai'],
            ['course_name' => 'Jaringan Komputer', 'day' => 'Thursday', 'start_time' => '13:30', 'end_time' => '16:00', 'intensity' => 4, 'notes' => 'Subnetting'],
            
            // Friday
            ['course_name' => 'Sistem Operasi', 'day' => 'Friday', 'start_time' => '08:00', 'end_time' => '10:30', 'intensity' => 4, 'notes' => 'Instalasi Linux Linuxan'],
            ['course_name' => 'Kerja Praktek', 'day' => 'Friday', 'start_time' => '14:00', 'end_time' => '17:00', 'intensity' => 3, 'notes' => 'Bimbingan'],
        ];

        foreach ($schedules as $schedule) {
            Schedule::create($schedule);
        }
    }
}