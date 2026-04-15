<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManovLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::where('email', 'user@example.com')->first();
        if (!$user) return;

        // --- Academic Logs (Past 7 Days Simulation) ---
        DB::table('academic_logs')->truncate();
        $academicLogs = [
            ['user_id' => $user->id, 'quiz_name' => 'Kuis Matdis (Senin)', 'score' => 85, 'sleep_hours' => 6.5, 'created_at' => now()->subDays(6)],
            ['user_id' => $user->id, 'quiz_name' => 'Tugas Sister (Rabu)', 'score' => 90, 'sleep_hours' => 5.0, 'created_at' => now()->subDays(4)],
            ['user_id' => $user->id, 'quiz_name' => 'Kuis AI (Kamis)', 'score' => 75, 'sleep_hours' => 4.0, 'created_at' => now()->subDays(3)],
            ['user_id' => $user->id, 'quiz_name' => 'Logika (Jumat)', 'score' => 88, 'sleep_hours' => 7.0, 'created_at' => now()->subDays(2)],
            ['user_id' => $user->id, 'quiz_name' => 'Proyek Web (Minggu)', 'score' => 95, 'sleep_hours' => 8.0, 'created_at' => now()->subDays(0)],
        ];
        DB::table('academic_logs')->insert($academicLogs);

        // --- Daily Health Logs ---
        DB::table('daily_health_logs')->truncate();
        $healthLogs = [];
        for ($i = 6; $i >= 0; $i--) {
            // Generate some random sleep and mood
            $moods = ['Senang', 'Neutral', 'Stres'];
            $mood = $moods[array_rand($moods)];
            
            $healthLogs[] = [
                'log_date' => now()->subDays($i)->format('Y-m-d'),
                'water_intake' => rand(4, 12),
                'sleep_hours' => rand(4, 9),
                'mood_status' => $mood,
                'created_at' => now()->subDays($i),
            ];
        }
        DB::table('daily_health_logs')->insert($healthLogs);

        // --- Data Recaps (Fake last week) ---
        DB::table('data_recaps')->truncate();
        DB::table('data_recaps')->insert([
            'user_id' => $user->id,
            'period_type' => 'weekly',
            'start_date' => now()->subDays(14),
            'end_date' => now()->subDays(7),
            'summary_data' => json_encode([
                'average_score' => 82.5,
                'average_sleep_hours' => 6.2,
                'average_water_intake' => 7,
                'total_quizzes_taken' => 5
            ]),
            'created_at' => now()->subDays(7)
        ]);
    }
}
