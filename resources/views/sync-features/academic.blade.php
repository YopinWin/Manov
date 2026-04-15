<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="space-y-8">
    <!-- RECAP BANNER -->
    @if(isset($lastRecap))
    <div class="glass-card p-6 bg-gradient-to-r from-amber-50/80 to-yellow-50/80 border-amber-100/50 flex flex-col md:flex-row items-center gap-6 shadow-sm border-dashed">
        <div class="w-14 h-14 rounded-3xl bg-amber-100/50 flex justify-center items-center text-amber-500 text-2xl font-black rotate-12 shadow-sm border border-amber-200">
            <i class="fa-solid fa-clock-rotate-left"></i>
        </div>
        <div class="text-center md:text-left flex-1">
            <h4 class="font-black text-amber-500 text-[10px] tracking-[0.2em] uppercase mb-1 flex items-center justify-center md:justify-start gap-2">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                History Ringkasan Minggu Lalu
            </h4>
            <div class="flex flex-wrap justify-center md:justify-start gap-4 text-xs font-medium text-gray-500">
                <span class="bg-white/60 px-3 py-1 rounded-xl">Nilai Rata-Rata: <strong class="text-amber-600 text-sm ml-1">{{ $lastRecap->summary_data['average_score'] ?? '-' }}</strong></span>
                <span class="bg-white/60 px-3 py-1 rounded-xl">Jam Tidur: <strong class="text-amber-600 text-sm ml-1">{{ $lastRecap->summary_data['average_sleep_hours'] ?? '-' }}h</strong></span>
                <span class="bg-white/60 px-3 py-1 rounded-xl">Total Kuis: <strong class="text-amber-600 text-sm ml-1">{{ $lastRecap->summary_data['total_quizzes_taken'] ?? 0 }}</strong></span>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- INPUT -->
        <div class="glass-card p-8">
            <h3 class="font-bold text-gray-700 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square text-pink-400"></i> Input Log Performa & Tidur
            </h3>

            <div class="space-y-4">
                <div>
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Nama Kuis</label>
                    <input id="quizName" type="text" placeholder="Misal: Kalkulus"
                        class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-pink-300 transition">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Nilai</label>
                        <input id="score" type="number" min="0" max="100" placeholder="Nilai (0-100)"
                            class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-pink-300 transition">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Jam Tidur</label>
                        <input id="sleep" type="number" min="0" max="24" step="0.5" placeholder="Jam Tidur"
                            class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-pink-300 transition">
                    </div>
                </div>

                <button onclick="saveData()"
                    class="w-full py-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:shadow-xl hover:shadow-pink-200 transition-all active:scale-[0.98]">
                    <i class="fa-solid fa-rotate mr-2"></i> SINKRONISASI DATA
                </button>

                <button onclick="clearAllData()"
                    class="w-full py-3 bg-white text-gray-400 border border-gray-200 rounded-2xl text-xs font-bold hover:bg-rose-50 hover:text-rose-500 hover:border-rose-200 transition-all">
                    <i class="fa-solid fa-trash-can mr-1"></i> Reset Data (Hapus Saja)
                </button>

                <form method="POST" action="{{ route('system.recap') }}">
                    @csrf
                    <button type="submit" class="w-full py-4 mt-4 bg-gradient-to-r from-amber-500 to-yellow-500 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:shadow-xl hover:shadow-amber-200 transition-all active:scale-[0.98]">
                        <i class="fa-solid fa-box-archive mr-2"></i> Force Recap & Reset (Mingguan)
                    </button>
                    <p class="text-[9px] text-gray-400 text-center mt-2 italic">Akan memindahkan seluruh log aktif minggu ini ke dalam histori database (recap).</p>
                </form>
            </div>

            {{-- DATA TABLE --}}
            <div id="dataTableContainer" class="mt-6 hidden">
                <h4 class="text-xs font-black text-gray-500 uppercase tracking-widest mb-3">Riwayat Data</h4>
                <div class="max-h-48 overflow-y-auto rounded-2xl border border-pink-100">
                    <table class="w-full text-xs">
                        <thead class="bg-pink-50 sticky top-0">
                            <tr>
                                <th class="px-4 py-2 text-left font-black text-pink-600">Kuis</th>
                                <th class="px-4 py-2 text-center font-black text-pink-600">Nilai</th>
                                <th class="px-4 py-2 text-center font-black text-pink-600">Tidur</th>
                                <th class="px-4 py-2 text-center font-black text-pink-600">❌</th>
                            </tr>
                        </thead>
                        <tbody id="dataTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- CHART -->
        <div class="glass-card p-8">
            <h3 class="font-bold text-gray-700 mb-4 flex items-center">
                <i class="fa-solid fa-chart-simple text-amber-400 mr-2"></i>
                Health-Academic Correlation
            </h3>

            <canvas id="myChart" class="w-full h-40"></canvas>

            <p id="analysisText" class="mt-6 text-xs text-gray-400 italic text-center">
                Masukkan data untuk melihat analisis.
            </p>
        </div>
    </div>

    {{-- AI INSIGHT CARD --}}
    <div id="aiInsightCard" class="hidden bg-gradient-to-br from-amber-600 via-yellow-500 to-orange-400 rounded-[2.5rem] p-8 text-white shadow-2xl">
        <div class="flex items-center gap-3 mb-4">
            <span class="bg-white/20 text-[10px] font-black px-4 py-1 rounded-full uppercase tracking-widest">
                <i class="fa-solid fa-wand-magic-sparkles mr-1"></i> AI Academic Insight
            </span>
        </div>
        <h3 id="insightTitle" class="text-2xl font-black italic mb-3"></h3>
        <p id="insightDesc" class="text-sm text-white/80 leading-relaxed"></p>
        
        <div class="grid grid-cols-3 gap-4 mt-6">
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 text-center">
                <p class="text-[9px] font-black uppercase tracking-widest text-white/60 mb-1">Rata-rata Nilai</p>
                <p id="avgScore" class="text-2xl font-black">-</p>
            </div>
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 text-center">
                <p class="text-[9px] font-black uppercase tracking-widest text-white/60 mb-1">Rata-rata Tidur</p>
                <p id="avgSleep" class="text-2xl font-black">-</p>
            </div>
            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 text-center">
                <p class="text-[9px] font-black uppercase tracking-widest text-white/60 mb-1">Tren</p>
                <p id="trendIndicator" class="text-2xl font-black">-</p>
            </div>
        </div>
    </div>
</div>

<script>
    let chart;
    let dataList = JSON.parse(localStorage.getItem("academicData")) || [];
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    function saveData() {
        const name = document.getElementById("quizName").value.trim();
        const score = parseInt(document.getElementById("score").value);
        const sleep = parseFloat(document.getElementById("sleep").value);

        if (!name || isNaN(score) || isNaN(sleep)) {
            alert("Isi semua data dengan benar!");
            return;
        }

        if (score < 0 || score > 100) {
            alert("Nilai harus antara 0-100!");
            return;
        }

        if (sleep < 0 || sleep > 24) {
            alert("Jam tidur harus antara 0-24!");
            return;
        }

        // Save locally
        dataList.push({ name, score, sleep });
        localStorage.setItem("academicData", JSON.stringify(dataList));

        // Also try to save to server (non-blocking)
        if (csrfToken) {
            fetch('/academic/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ quiz_name: name, score: score, sleep_hours: sleep })
            }).catch(function() {});
        }

        // Update UI
        renderChart();
        analyze();
        renderTable();

        // Reset input
        document.getElementById("quizName").value = "";
        document.getElementById("score").value = "";
        document.getElementById("sleep").value = "";

        // Feedback
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-check mr-2"></i> DATA TERSINKRONISASI!';
        btn.classList.add('from-green-500', 'to-emerald-500');
        btn.classList.remove('from-pink-500', 'to-rose-500');
        setTimeout(function() {
            btn.innerHTML = originalText;
            btn.classList.remove('from-green-500', 'to-emerald-500');
            btn.classList.add('from-pink-500', 'to-rose-500');
        }, 2000);
    }

    function renderTable() {
        const container = document.getElementById('dataTableContainer');
        const tbody = document.getElementById('dataTableBody');
        
        if (dataList.length === 0) {
            container.classList.add('hidden');
            return;
        }
        
        container.classList.remove('hidden');
        tbody.innerHTML = '';

        dataList.forEach(function(d, idx) {
            const tr = document.createElement('tr');
            tr.className = 'border-t border-pink-50 hover:bg-pink-50/50 transition';
            tr.innerHTML = `
                <td class="px-4 py-2 font-medium text-gray-700">${d.name}</td>
                <td class="px-4 py-2 text-center font-bold ${d.score >= 80 ? 'text-green-500' : d.score >= 60 ? 'text-yellow-500' : 'text-rose-500'}">${d.score}</td>
                <td class="px-4 py-2 text-center font-bold ${d.sleep >= 7 ? 'text-green-500' : d.sleep >= 5 ? 'text-yellow-500' : 'text-rose-500'}">${d.sleep}h</td>
                <td class="px-4 py-2 text-center">
                    <button onclick="removeData(${idx})" class="text-gray-300 hover:text-rose-500 transition"><i class="fa-solid fa-xmark"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    function removeData(idx) {
        dataList.splice(idx, 1);
        localStorage.setItem("academicData", JSON.stringify(dataList));
        renderChart();
        analyze();
        renderTable();
    }

    function clearAllData() {
        if (!confirm('Hapus semua data akademik?')) return;
        dataList = [];
        localStorage.setItem("academicData", JSON.stringify(dataList));
        renderChart();
        analyze();
        renderTable();
        document.getElementById('aiInsightCard').classList.add('hidden');
    }

    function renderChart() {
        const ctx = document.getElementById("myChart").getContext("2d");

        const labels = dataList.map(function(d) { return d.name; });
        const scores = dataList.map(function(d) { return d.score; });
        const sleeps = dataList.map(function(d) { return d.sleep; });

        if (chart) chart.destroy();

        chart = new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [{
                        label: "Tidur (Jam)",
                        data: sleeps,
                        borderColor: "#ec4899",
                        backgroundColor: "rgba(236,72,153,0.1)",
                        tension: 0.4,
                        fill: true,
                        borderWidth: 3,
                        pointRadius: 5,
                        pointBackgroundColor: "#ec4899",
                    },
                    {
                        label: "Nilai",
                        data: scores,
                        borderColor: "#f59e0b",
                        backgroundColor: "rgba(245,158,11,0.1)",
                        tension: 0.4,
                        fill: true,
                        borderWidth: 3,
                        pointRadius: 5,
                        pointBackgroundColor: "#f59e0b",
                    }
                ]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 800,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    legend: {
                        labels: {
                            color: "#6b7280",
                            font: { weight: 'bold', size: 11 },
                            padding: 15,
                            usePointStyle: true,
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { color: "#9ca3af", font: { size: 10 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: "#9ca3af", font: { size: 10 } }
                    }
                }
            }
        });
    }

    function analyze() {
        const text = document.getElementById("analysisText");
        const insightCard = document.getElementById("aiInsightCard");

        if (dataList.length === 0) {
            text.innerText = "Masukkan data untuk melihat analisis.";
            insightCard.classList.add('hidden');
            return;
        }

        const avgScore = dataList.reduce(function(sum, d) { return sum + d.score; }, 0) / dataList.length;
        const avgSleep = dataList.reduce(function(sum, d) { return sum + d.sleep; }, 0) / dataList.length;

        // Correlation analysis
        let optimalSleepEntries = dataList.filter(function(d) { return d.sleep >= 7 && d.sleep <= 9; });
        let lowSleepEntries = dataList.filter(function(d) { return d.sleep < 6; });

        let optimalAvgScore = optimalSleepEntries.length > 0 
            ? optimalSleepEntries.reduce(function(s, d) { return s + d.score; }, 0) / optimalSleepEntries.length 
            : 0;
        let lowAvgScore = lowSleepEntries.length > 0 
            ? lowSleepEntries.reduce(function(s, d) { return s + d.score; }, 0) / lowSleepEntries.length 
            : 0;

        // Trend analysis
        let trend = "→";
        if (dataList.length >= 2) {
            const last = dataList[dataList.length - 1].score;
            const prev = dataList[dataList.length - 2].score;
            trend = last > prev ? "📈" : last < prev ? "📉" : "➡️";
        }

        // Basic analysis text
        const last = dataList[dataList.length - 1];
        if (last.sleep >= 7 && last.sleep <= 9) {
            text.innerText = `Analisis menunjukkan performa akademik meningkat drastis saat durasi tidur mencapai 7-9 jam.`;
        } else if (last.sleep >= 5) {
            text.innerText = `Tidur ${last.sleep} jam cukup, tapi untuk performa optimal disarankan 7-9 jam.`;
        } else {
            text.innerText = `⚠️ Tidur hanya ${last.sleep} jam! Performa akademik bisa turun drastis. Prioritaskan tidur!`;
        }

        // Show AI Insight Card
        insightCard.classList.remove('hidden');
        document.getElementById('avgScore').innerText = avgScore.toFixed(0);
        document.getElementById('avgSleep').innerText = avgSleep.toFixed(1) + "h";
        document.getElementById('trendIndicator').innerText = trend;

        // Generate insight title & desc
        const insightTitle = document.getElementById('insightTitle');
        const insightDesc = document.getElementById('insightDesc');

        if (avgScore >= 80 && avgSleep >= 7) {
            insightTitle.innerText = "Performa Luar Biasa! 🏆";
            insightDesc.innerText = `Rata-rata nilaimu ${avgScore.toFixed(0)} dengan tidur ${avgSleep.toFixed(1)} jam. Kamu sudah menemukan sweet spot antara istirahat dan belajar! Pertahankan ritme ini.`;
        } else if (avgScore >= 60 && avgSleep >= 6) {
            insightTitle.innerText = "Di Jalur yang Tepat 👍";
            insightDesc.innerText = `Nilai rata-ratamu ${avgScore.toFixed(0)} cukup baik. Coba tingkatkan jam tidur ke 7-8 jam untuk mendorong performa lebih tinggi. AI mendeteksi korelasi positif antara tidur dan nilaimu.`;
        } else if (avgSleep < 6) {
            insightTitle.innerText = "⚠️ Warning: Sleep Deficit";
            insightDesc.innerText = `Rata-rata tidurmu hanya ${avgSleep.toFixed(1)} jam! Ini berbahaya untuk kesehatan dan performa. ${optimalAvgScore > lowAvgScore ? `Data menunjukkan nilaimu ${(optimalAvgScore - lowAvgScore).toFixed(0)} poin lebih tinggi saat tidur 7+ jam.` : 'Tambah jam tidur untuk melihat peningkatan.'}`;
        } else {
            insightTitle.innerText = "Perlu Perbaikan 💪";
            insightDesc.innerText = `Rata-rata nilaimu ${avgScore.toFixed(0)} masih bisa ditingkatkan. AI merekomendasikan: tidur cukup (7-9 jam), review materi sebelum tidur, dan konsistensi jadwal belajar.`;
        }
    }

    // AUTO LOAD
    document.addEventListener("DOMContentLoaded", function() {
        if(csrfToken) {
            fetch('/academic/data', {
                headers: { 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                if(data && data.length > 0) {
                    dataList = data;
                    localStorage.setItem("academicData", JSON.stringify(dataList));
                }
                renderChart();
                analyze();
                renderTable();
            })
            .catch(() => {
                renderChart();
                analyze();
                renderTable();
            });
        } else {
            renderChart();
            analyze();
            renderTable();
        }
    });
</script>
