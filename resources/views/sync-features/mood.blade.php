<div class="max-w-3xl bg-white rounded-[2.5rem] p-10 shadow-sm border border-pink-100 mx-auto">
    <h3 class="text-2xl font-bold mb-10 text-center uppercase tracking-tight">
        Mood-Check AI <span id="mood-robot">🤖</span>
    </h3>

    <div class="mb-8 text-center">
        <p class="text-[11px] font-black text-pink-400 uppercase tracking-widest mb-4">
            AI Prediction for <span id="predictedDayText">{{ date('l') }}</span>
        </p>
        <div id="predictionBadge" class="inline-block px-6 py-2 rounded-full text-[10px] font-bold border animate-pulse">
            Menganalisis Jadwal...
        </div>
    </div>

    <div id="moodContainer" class="grid grid-cols-3 gap-6 mb-10">
        <button id="btn-stres" class="mood-btn p-8 bg-pink-50 rounded-[2rem] transition border group relative overflow-hidden cursor-default">
            <span class="text-4xl inline-block">😫</span>
            <p class="text-xs font-black mt-2 text-pink-600">STRES</p>
        </button>

        <button id="btn-flat" class="mood-btn p-8 bg-yellow-50 rounded-[2rem] transition border group relative overflow-hidden cursor-default">
            <span class="text-4xl inline-block">😐</span>
            <p class="text-xs font-black mt-2 text-yellow-600">FLAT</p>
        </button>

        <button id="btn-senang" class="mood-btn p-8 bg-green-50 rounded-[2rem] transition border group relative overflow-hidden cursor-default">
            <span class="text-4xl inline-block">😊</span>
            <p class="text-xs font-black mt-2 text-green-600">SENANG</p>
        </button>
    </div>

    <div id="resultBox" class="p-8 bg-gradient-to-br from-white to-pink-50 rounded-[2.5rem] border border-pink-100 shadow-inner min-h-[180px] transition-all duration-500 relative">
        <div id="realResult" class="animate-fadeIn">
            <p class="text-[10px] font-black text-pink-500 uppercase tracking-[0.2em] mb-3 flex items-center gap-2">
                <i class="fa-solid fa-wand-magic-sparkles"></i> AI Status Analysis
            </p>
            <p id="resultText" class="text-gray-700 font-bold italic text-sm leading-relaxed mb-8 transition-opacity duration-300"></p>
            
            <div class="space-y-3">
                <div class="flex justify-between items-end">
                    <div class="flex flex-col">
                        <span class="text-[9px] font-black text-gray-400 uppercase italic leading-none mb-1">Schedule Stress Index</span>
                        <span class="text-[10px] text-pink-400 font-medium" id="dayIndicatorText">Analisis hari ini</span>
                    </div>
                    <span id="stressValue" class="text-2xl font-black text-pink-500 tracking-tighter">0%</span>
                </div>
                <div class="w-full bg-gray-100 h-3 rounded-full overflow-hidden shadow-inner p-[2px]">
                    <div id="stressBar" class="bg-gradient-to-r from-pink-400 via-rose-400 to-pink-600 h-full rounded-full transition-all duration-1000 ease-out" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.calculateStressIndex = function(day) {
    if (!allSchedules || allSchedules.length === 0) return 0;
    const schedules = Object.values(allSchedules).filter(s => s.day.toLowerCase() === day.toLowerCase());
    
    let totalMinutes = 0;
    let heavyBonus = 0;

    schedules.forEach(s => {
        const start = s.start_time.split(':');
        const end = s.end_time.split(':');
        const diff = (parseInt(end[0])*60 + parseInt(end[1])) - (parseInt(start[0])*60 + parseInt(start[1]));
        totalMinutes += diff;
        if (parseInt(s.intensity) >= 4) heavyBonus += 15;
    });

    let score = Math.round((totalMinutes / 360) * 100) + heavyBonus;
    return Math.min(score, 100); 
}

window.autoDetectMood = function() {
    const day = typeof currentDaySelected !== 'undefined' ? currentDaySelected : 'Monday';
    const stressPercent = window.calculateStressIndex(day);
    let predictedMood = "";
    let badge = document.getElementById("predictionBadge");

    // 1. Logika Prediksi AI
    if (stressPercent >= 70) {
        predictedMood = "stres";
        badge.innerText = "🚨 High Pressure Detected";
        badge.className = "inline-block px-6 py-2 rounded-full text-[10px] font-bold border border-rose-200 bg-rose-50 text-rose-500";
    } else if (stressPercent >= 35) {
        predictedMood = "flat";
        badge.innerText = "😐 Medium Workload";
        badge.className = "inline-block px-6 py-2 rounded-full text-[10px] font-bold border border-yellow-200 bg-yellow-50 text-yellow-600";
    } else {
        predictedMood = "senang";
        badge.innerText = "😊 Low Stress Day";
        badge.className = "inline-block px-6 py-2 rounded-full text-[10px] font-bold border border-green-200 bg-green-50 text-green-600";
    }

    // 2. Terapkan kunci (Hanya satu yang aktif)
    window.lockAndSetMood(predictedMood, stressPercent, day);
}

window.lockAndSetMood = function(mood, stressPercent, day) {
    const resultText = document.getElementById("resultText");
    const bar = document.getElementById("stressBar");
    const valText = document.getElementById("stressValue");
    const robot = document.getElementById("mood-robot");
    const dayLabel = document.getElementById("dayIndicatorText");
    const dayTitle = document.getElementById("predictedDayText");

    // Reset Semua Button ke kondisi "Disabled"
    document.querySelectorAll(".mood-btn").forEach(btn => {
        btn.classList.remove("ring-4","ring-pink-200","scale-105","border-pink-300");
        btn.style.opacity = "0.3";
        btn.style.pointerEvents = "none";
        btn.classList.add("grayscale");
    });

    // Aktifkan HANYA yang sesuai rekomendasi
    const activeBtn = document.getElementById("btn-" + mood);
    if(activeBtn) {
        activeBtn.classList.add("ring-4","ring-pink-200","scale-105","border-pink-300");
        activeBtn.style.opacity = "1";
        activeBtn.classList.remove("grayscale");
    }

    // Update Visual Lainnya
    const emojis = { stres: '😫', flat: '😐', senang: '😊' };
    robot.innerText = emojis[mood];
    dayLabel.innerText = `Data jadwal hari ${day}`;
    if(dayTitle) dayTitle.innerText = day;

    // --- INTEGRASI KE SMART MEAL (DITAMBAHKAN DI SINI) ---
    if(typeof window.updateMealAI === "function") {
        window.updateMealAI(mood, stressPercent);
    }

    // Respon AI
    let advice = "";
    if (mood === 'senang') advice = `AI mendeteksi harimu santai (${stressPercent}%). Mood SENANG dikunci. Gunakan energi ini untuk produktif!`;
    else if (mood === 'flat') advice = `Beban harimu lumayan (${stressPercent}%). Mood FLAT dikunci. AI menyarankan istirahat singkat di sela kegiatan.`;
    else advice = `OVERLOAD terdeteksi (${stressPercent}%). Mood STRES dikunci. AI mewajibkan kamu istirahat segera!`;

    // Animasi Update
    resultText.style.opacity = 0;
    setTimeout(() => {
        resultText.innerText = `"${advice}"`;
        resultText.style.opacity = 1;
        bar.style.width = stressPercent + "%";
        
        let startTime = null;
        function animateNumber(timestamp) {
            if (!startTime) startTime = timestamp;
            let progress = timestamp - startTime;
            let currentNum = Math.min(Math.floor((progress / 800) * stressPercent), stressPercent);
            valText.innerText = currentNum + "%";
            if (progress < 800) window.requestAnimationFrame(animateNumber);
        }
        window.requestAnimationFrame(animateNumber);
    }, 100);
}

// Jalankan otomatis
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => { window.autoDetectMood(); }, 500);
});
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.5s ease forwards;
    }
</style>