<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\DataRecap;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RecapDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hts:recap-reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recap weekly academic and health logs, then reset (truncate) the active tables.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Starting Data Recap & Reset...");

        $users = User::all();
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now();

        foreach ($users as $user) {
            // Fetch past week's logic (simplified: just take all un-recapped data assuming we run this exactly weekly)
            $academicLogs = DB::table('academic_logs')->where('user_id', $user->id)->get();
            $healthLogs = DB::table('daily_health_logs')->get(); // Note: currently health logs are global tracking, not per user

            if ($academicLogs->isEmpty() && $healthLogs->isEmpty()) continue;

            $avgScore = $academicLogs->avg('score') ?? 0;
            $avgSleepAc = $academicLogs->avg('sleep_hours') ?? 0;

            $avgWater = $healthLogs->avg('water_intake') ?? 0;
            $avgSleepHl = $healthLogs->avg('sleep_hours') ?? 0;
            
            $moods = $healthLogs->pluck('mood_status')->countBy()->toArray();

            $summaryData = [
                'average_score' => round($avgScore, 1),
                'average_sleep_hours' => round(($avgSleepAc + $avgSleepHl) / 2, 1),
                'average_water_intake' => round($avgWater, 1),
                'mood_distributions' => $moods,
                'total_quizzes_taken' => $academicLogs->count(),
            ];

            DataRecap::create([
                'user_id' => $user->id,
                'period_type' => 'weekly',
                'start_date' => $startDate,
                'end_date' => $endDate,
                'summary_data' => $summaryData,
            ]);

            $this->info("Recapped data for User: {$user->name}");
        }

        // RESET the tables
        DB::table('academic_logs')->truncate();
        DB::table('daily_health_logs')->truncate();
        
        $this->info("Academic and Health Logs successfully truncated/reset for the new week.");
    }
}
