<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    <!-- INPUT -->
    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-pink-100">
        <h3 class="font-bold text-gray-700 mb-6">Input Log Performa & Tidur</h3>

        <div class="space-y-4">
            <input id="quizName" type="text" placeholder="Nama Kuis"
                class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none">

            <div class="grid grid-cols-2 gap-4">
                <input id="score" type="number" placeholder="Nilai (0-100)"
                    class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none">

                <input id="sleep" type="number" placeholder="Jam Tidur"
                    class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none">
            </div>

            <button onclick="saveData()"
                class="w-full py-4 bg-pink-500 text-white rounded-2xl font-black text-xs hover:bg-pink-600 shadow-lg">
                SINKRONISASI DATA
            </button>
        </div>
    </div>

    <!-- CHART -->
    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-pink-100">
        <h3 class="font-bold text-gray-700 mb-4 flex items-center">
            <i class="fa-solid fa-chart-simple text-indigo-400 mr-2"></i>
            Health-Academic Correlation
        </h3>

        <canvas id="myChart" class="w-full h-40"></canvas>

        <p id="analysisText" class="mt-6 text-[10px] text-gray-400 italic text-center">
            Masukkan data untuk melihat analisis.
        </p>
    </div>
</div>

<script>
    let chart;
    let dataList = JSON.parse(localStorage.getItem("data")) || [];

    function saveData() {
        const name = document.getElementById("quizName").value.trim();
        const score = parseInt(document.getElementById("score").value);
        const sleep = parseInt(document.getElementById("sleep").value);

        if (!name || isNaN(score) || isNaN(sleep)) {
            alert("Isi semua data dengan benar!");
            return;
        }

        // simpan data
        dataList.push({
            name,
            score,
            sleep
        });
        localStorage.setItem("data", JSON.stringify(dataList));

        // update grafik & analisis
        renderChart();
        analyze();

        // reset input
        document.getElementById("quizName").value = "";
        document.getElementById("score").value = "";
        document.getElementById("sleep").value = "";
    }

    function renderChart() {
        const ctx = document.getElementById("myChart").getContext("2d");

        const labels = dataList.map(d => d.name);
        const scores = dataList.map(d => d.score);
        const sleeps = dataList.map(d => d.sleep);

        if (chart) chart.destroy(); // biar refresh clean

        chart = new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [{
                        label: "Nilai",
                        data: scores,
                        borderColor: "#6366f1",
                        backgroundColor: "rgba(99,102,241,0.2)",
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: "Jam Tidur",
                        data: sleeps,
                        borderColor: "#ec4899",
                        backgroundColor: "rgba(236,72,153,0.2)",
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                animation: {
                    duration: 800
                },
                plugins: {
                    legend: {
                        labels: {
                            color: "#6b7280"
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: "#9ca3af"
                        }
                    },
                    x: {
                        ticks: {
                            color: "#9ca3af"
                        }
                    }
                }
            }
        });
    }

    function analyze() {
        if (dataList.length === 0) return;

        const last = dataList[dataList.length - 1];
        const text = document.getElementById("analysisText");

        if (last.sleep >= 7) {
            text.innerText = "Tidur cukup! Performa akademik optimal 🚀";
        } else if (last.sleep >= 5) {
            text.innerText = "Cukup, tapi bisa lebih baik. Tambah jam tidur 😴";
        } else {
            text.innerText = "Kurang tidur! Performa bisa turun drastis ⚠️";
        }
    }

    // AUTO LOAD PAS BUKA
    document.addEventListener("DOMContentLoaded", () => {
        renderChart();
        analyze();
    });
</script>
