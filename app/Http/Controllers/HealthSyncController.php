<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\DailyHealthLog;
use App\Models\AcademicLog;
use App\Models\DataRecap;
use Carbon\Carbon;

class HealthSyncController extends Controller
{
    /**
     * Menampilkan Halaman Utama Dashboard
     */
    public function index()
    {
        // Ambil semua jadwal untuk diproses JavaScript di frontend
        $schedules = Schedule::orderBy('start_time', 'asc')->get();
        
        // Ambil log kesehatan hari ini
        $healthLog = DailyHealthLog::whereDate('log_date', Carbon::today())->first();
        
        // Generate rekomendasi AI untuk timeline
        $recommendations = $this->generateRecommendations($schedules);
        
        // Data default untuk Meal Recommendation awal (berdasarkan waktu sekarang)
        $mealPlan = $this->generateMealRecommendations('senang', 0);

        // Ambil Data Recap Terakhir
        $lastRecap = DataRecap::where('user_id', auth()->id() ?? User::first()->id ?? null)->latest()->first();
        if (!$lastRecap) {
            $lastRecap = DataRecap::latest()->first(); // Fallback if no specific user auth active
        }

        return view('dashboard', [
            'schedules' => $schedules,
            'recommendations' => $recommendations,
            'mealPlan' => $mealPlan,
            'healthLog' => $healthLog ?? (object)['water_intake' => 0, 'mood_status' => 'Neutral'],
            'lastRecap' => $lastRecap
        ]);
    }

    /**
     * Logika AI untuk memberikan saran berdasarkan jadwal (Timeline)
     */
    private function generateRecommendations($schedules)
    {
        $rec = [];
        $todayName = Carbon::now()->format('l');
        $todaySchedules = $schedules->where('day', $todayName);

        foreach ($todaySchedules as $session) {
            if ($session->intensity >= 4) {
                $rec[] = [
                    'time' => date('H:i', strtotime($session->start_time . ' -15 minutes')),
                    'action' => "Pre-Class: Kuliah " . $session->course_name . " berat. Siapkan fokus dan air minum!",
                    'type' => 'food'
                ];
            }

            $rec[] = [
                'time' => $session->end_time,
                'action' => "Post-Class: Selesai " . $session->course_name . ". " . ($session->intensity >= 4 ? "Otak butuh Dark Reset 5 menit." : "Yuk stretching sebentar."),
                'type' => 'mental'
            ];

            $nextSession = $todaySchedules->where('start_time', '>', $session->end_time)->first();
            if ($nextSession) {
                $gap = strtotime($nextSession->start_time) - strtotime($session->end_time);
                if ($gap >= 3600) {
                    $rec[] = [
                        'time' => date('H:i', strtotime($session->end_time . ' + 10 minutes')),
                        'action' => "Sync Nutrition: Ada jeda " . floor($gap/60) . " menit. Jangan telat makan!",
                        'type' => 'food'
                    ];
                }
            }
        }

        usort($rec, fn($a, $b) => strcmp($a['time'], $b['time']));
        return $rec;
    }

    /**
     * Logika AI untuk Smart Meal berdasarkan Mood & Stress Level
     * Fungsi ini juga bisa dipanggil via API/AJAX jika diperlukan
     */
    private function generateMealRecommendations($mood, $stressLevel)
    {
        if ($mood === 'stres' || $stressLevel >= 70) {
            return [
                'type' => 'Stress Buster 🍫',
                'color' => 'from-rose-900 to-gray-900',
                'description' => "Jadwal gila terdeteksi! Tubuhmu memproduksi kortisol tinggi. Butuh penenang saraf.",
                'nutrients' => "Magnesium & Flavonoid untuk relaksasi pembuluh darah.",
                'foods' => "Dark Chocolate (min 70%), Pisang, atau Oatmeal hangat.",
                'icon' => 'fa-brain'
            ];
        } elseif ($mood === 'flat' || $stressLevel >= 35) {
            return [
                'type' => 'Energy Booster 🍌',
                'color' => 'from-indigo-900 to-gray-900',
                'description' => "Fokus mulai goyah. Butuh glukosa stabil agar tidak mengantuk di kelas.",
                'nutrients' => "Karbohidrat Kompleks & Serat untuk gula darah stabil.",
                'foods' => "Gado-gado (banyak sayur), Roti Gandum, atau Apel.",
                'icon' => 'fa-bolt'
            ];
        } else {
            return [
                'type' => 'Happy Maintainer ✨',
                'color' => 'from-emerald-900 to-gray-900',
                'description' => "Kondisi prima! Jaga endorfinmu dengan makanan segar.",
                'nutrients' => "Protein Ringan & Omega-3 untuk neurotransmitter.",
                'foods' => "Ikan Bakar, Salad Buah, atau Jus Alpukat murni.",
                'icon' => 'fa-face-smile-beam'
            ];
        }
    }

    /**
     * Menyimpan Jadwal Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'day'         => 'required|string',
            'start_time'  => 'required',
            'end_time'    => 'required',
            'intensity'   => 'required|integer|min:1|max:5',
        ]);

        Schedule::create([
            'course_name' => $request->course_name,
            'day'         => $request->day,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'intensity'   => $request->intensity,
            'notes'       => $request->notes ?? 'Jadwal diimport secara mingguan.',
        ]);

        return redirect()->back()->with('success', 'Jadwal Mingguan Berhasil Diplotting!');
    }

    /**
     * Update Jadwal
     */
    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update([
            'course_name' => $request->course_name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'intensity' => $request->intensity ?? $schedule->intensity,
        ]);
        return redirect()->back()->with('success', 'Jadwal Berhasil Di-update!');
    }

    /**
     * Hapus Jadwal
     */
    public function destroy($id)
    {
        Schedule::destroy($id);
        return redirect()->back()->with('success', 'Jadwal Berhasil Dihapus!');
    }

    /**
     * Simpan Data Akademik via AJAX
     */
    public function storeAcademic(Request $request)
    {
        $request->validate([
            'quiz_name'   => 'required|string|max:255',
            'score'       => 'required|integer|min:0|max:100',
            'sleep_hours' => 'required|numeric|min:0|max:24',
        ]);

        $log = AcademicLog::create([
            'user_id'     => auth()->id(),
            'quiz_name'   => $request->quiz_name,
            'score'       => $request->score,
            'sleep_hours' => $request->sleep_hours,
        ]);

        return response()->json([
            'success' => true,
            'data' => $log
        ]);
    }

    /**
     * Ambil Data Akademik via AJAX
     */
    public function getAcademicData()
    {
        $data = AcademicLog::where('user_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($log) {
                return [
                    'name' => $log->quiz_name,
                    'score' => $log->score,
                    'sleep' => $log->sleep_hours,
                ];
            });

        return response()->json($data);
    }

    /**
     * Force Recap Data (Manual Trigger for Demo)
     */
    public function forceRecap()
    {
        \Illuminate\Support\Facades\Artisan::call('hts:recap-reset');
        return redirect()->back()->with('success', 'Recap & Reset berhasil dijalankan!');
    }
}