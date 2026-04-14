<div class="space-y-10 animate-fadeIn">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h3 class="font-black text-gray-800 text-3xl tracking-tighter italic">
                Smart <span class="text-pink-500">Meal Sync</span>
            </h3>
            <p class="text-[11px] text-gray-400 mt-1 font-medium italic">
                Nutrisi tepat untuk performa akademik maksimal!
            </p>
        </div>

        <div id="mealReminder"
            class="bg-white border border-pink-100 px-6 py-3 rounded-2xl shadow-sm flex items-center gap-3 animate-bounce">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-500"></span>
            </span>
            <p class="text-[10px] font-black uppercase tracking-widest text-pink-600" id="reminderText">
                Checking Schedule...
            </p>
        </div>
    </div>

    <!-- LANGSUNG FULL WIDTH -->
    <div class="space-y-6">
        <div id="nutritionCard"
            class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-[3.5rem] p-10 text-white shadow-2xl relative overflow-hidden min-h-[420px] transition-all duration-700 hover:shadow-pink-500/20 hover:scale-[1.01]">

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-8">
                    <span
                        class="bg-pink-500 text-[10px] font-black px-4 py-1 rounded-full uppercase tracking-widest animate-pulse">
                        AI Nutrition Analysis
                    </span>
                </div>

                <h2 id="recomTitle" class="text-4xl md:text-5xl font-black italic mb-4 leading-tight">
                    Menganalisis Kebutuhan Tubuhmu...
                </h2>

                <p id="recomDesc" class="text-sm text-gray-400 mb-10 max-w-md leading-relaxed">
                    Pilih kondisi mood-mu di panel kiri untuk mendapatkan rekomendasi nutrisi yang presisi.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white/10 backdrop-blur-md rounded-3xl p-6 border border-white/10">
                        <p class="text-[9px] font-black text-pink-400 uppercase mb-2">Komponen Nutrisi</p>
                        <p id="nutriInfo" class="text-sm leading-relaxed text-gray-200">-</p>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md rounded-3xl p-6 border border-white/10">
                        <p class="text-[9px] font-black text-green-400 uppercase mb-2">Rekomendasi Menu</p>
                        <p id="foodInfo" class="text-sm leading-relaxed text-gray-200">-</p>
                    </div>
                </div>
            </div>

            <i id="bgIcon"
                class="fa-solid fa-robot absolute -right-10 -bottom-10 text-[18rem] text-white opacity-5 rotate-12 transition-all duration-1000"></i>
        </div>
    </div>
</div>

<script>
    (function() {
        window.updateMealAI = function(mood, stressLevel) {
            const title = document.getElementById('recomTitle');
            const desc = document.getElementById('recomDesc');
            const nutri = document.getElementById('nutriInfo');
            const food = document.getElementById('foodInfo');
            const icon = document.getElementById('bgIcon');
            const card = document.getElementById('nutritionCard');

            if (!card || !title) return;

            let data = {};

            if (mood === 'stres' || stressLevel >= 70) {
                data = {
                    t: "The Stress Buster! 🍫",
                    d: "Jadwalmu gila banget! Tubuhmu sedang memproduksi Kortisol berlebih. Kamu butuh penyeimbang segera agar tidak 'burnout'.",
                    n: "Magnesium & Flavonoid. Membantu merelaksasi pembuluh darah yang tegang.",
                    f: "Dark Chocolate, Pisang, atau Oatmeal hangat. Hindari kopi berlebih!",
                    c: "from-rose-950 via-rose-900 to-gray-900",
                    i: "fa-brain"
                };
            } else if (mood === 'flat' || (stressLevel > 30 && stressLevel < 70)) {
                data = {
                    t: "The Energy Booster 🍌",
                    d: "Fokusmu mulai turun. Otakmu butuh glukosa stabil (Complex Carbs) agar tidak mengantuk di kelas berikutnya.",
                    n: "Karbohidrat Kompleks & Serat. Menjaga gula darah tetap stabil tanpa 'sugar crash'.",
                    f: "Gado-gado, Roti Gandum, atau Apel dengan selai kacang.",
                    c: "from-indigo-950 via-indigo-900 to-gray-900",
                    i: "fa-bolt-lightning"
                };
            } else {
                data = {
                    t: "Happy Maintainer ✨",
                    d: "Kondisi prima! Jaga endorfinmu dengan makanan segar agar mood positif ini bertahan sampai tugas selesai.",
                    n: "Protein Ringan & Omega-3. Mendukung fungsi neurotransmitter agar tetap kreatif.",
                    f: "Salad Buah, Jus Alpukat, atau Ikan Bakar segar.",
                    c: "from-emerald-950 via-emerald-900 to-gray-900",
                    i: "fa-face-smile-wink"
                };
            }

            card.classList.add('scale-[0.98]', 'opacity-80');

            setTimeout(function() {
                card.className = "bg-gradient-to-br " + data.c +
                    " rounded-[3.5rem] p-10 text-white shadow-2xl relative overflow-hidden min-h-[420px] transition-all duration-700 hover:shadow-pink-500/20 hover:scale-[1.01]";
                title.innerText = data.t;
                desc.innerText = data.d;
                nutri.innerText = data.n;
                food.innerText = data.f;
                icon.className = "fa-solid " + data.i +
                    " absolute -right-10 -bottom-10 text-[18rem] text-white opacity-5 rotate-12 transition-all duration-1000";
                card.classList.remove('scale-[0.98]', 'opacity-80');
            }, 150);
        };

        window.checkMealTime = function() {
            const hour = new Date().getHours();
            const reminder = document.getElementById('reminderText');
            if (!reminder) return;

            if (hour >= 5 && hour <= 10) reminder.innerText = "Waktunya Sarapan! 🍳";
            else if (hour >= 11 && hour <= 14) reminder.innerText = "Jam Makan Siang! 🍱";
            else if (hour >= 17 && hour <= 21) reminder.innerText = "Waktu Makan Malam 🌙";
            else reminder.innerText = "Stay Hydrated! 💧";
        };

        document.addEventListener('DOMContentLoaded', function() {
            window.checkMealTime();
            window.updateMealAI('flat', 50);
            setInterval(window.checkMealTime, 60000);
        });
    })();
</script>
