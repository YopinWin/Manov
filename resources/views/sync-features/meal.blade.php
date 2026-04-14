<div class="space-y-10 animate-fadeIn">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h3 class="font-black text-gray-800 text-3xl tracking-tighter italic">Smart <span class="text-pink-500">Meal Sync</span></h3>
            <p class="text-[11px] text-gray-400 mt-1 font-medium italic">Nutrisi tepat untuk performa akademik maksimal!</p>
        </div>
        <div id="mealReminder" class="bg-white border border-pink-100 px-6 py-3 rounded-2xl shadow-sm flex items-center gap-3 animate-pulse">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-500"></span>
            </span>
            <p class="text-[10px] font-black uppercase tracking-widest text-pink-600" id="reminderText">Checking Schedule...</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white/80 backdrop-blur-xl rounded-[3rem] p-8 shadow-xl border border-white">
                <h4 class="font-black text-gray-800 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-shop text-pink-500"></i> Kantin Live
                </h4>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-transparent hover:border-pink-200 transition-all group">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm text-xl group-hover:scale-110 transition-transform">🥗</div>
                            <div>
                                <p class="text-xs font-black text-gray-800">Gado-Gado Ibu</p>
                                <p class="text-[9px] text-green-500 font-bold uppercase">Tersedia • 12K</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-circle-check text-green-400"></i>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-transparent opacity-60">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm text-xl">🍗</div>
                            <div>
                                <p class="text-xs font-black text-gray-800">Ayam Geprek</p>
                                <p class="text-[9px] text-rose-500 font-bold uppercase">Habis</p>
                            </div>
                        </div>
                        <i class="fa-solid fa-circle-xmark text-rose-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div id="nutritionCard" class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-[3.5rem] p-10 text-white shadow-2xl relative overflow-hidden min-h-[400px]">
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-8">
                        <span class="bg-pink-500 text-[10px] font-black px-4 py-1 rounded-full uppercase tracking-widest">AI Nutrition Analysis</span>
                    </div>

                    <h2 id="recomTitle" class="text-4xl font-black italic mb-4 leading-tight">Menganalisis Kebutuhan Tubuhmu...</h2>
                    <p id="recomDesc" class="text-sm text-gray-400 mb-10 max-w-md">Klik mood atau update jadwal untuk melihat rekomendasi nutrisi.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white/10 backdrop-blur-md rounded-3xl p-6 border border-white/10">
                            <p class="text-[9px] font-black text-pink-400 uppercase mb-2">Komponen Nutrisi</p>
                            <p id="nutriInfo" class="text-xs leading-relaxed text-gray-200">-</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md rounded-3xl p-6 border border-white/10">
                            <p class="text-[9px] font-black text-green-400 uppercase mb-2">Rekomendasi Menu</p>
                            <p id="foodInfo" class="text-xs leading-relaxed text-gray-200">-</p>
                        </div>
                    </div>
                </div>
                
                <i id="bgIcon" class="fa-solid fa-bowl-food absolute -right-10 -bottom-10 text-[15rem] text-white opacity-5 rotate-12 transition-all duration-700"></i>
            </div>
        </div>

    </div>
</div>

<script>
window.updateMealAI = function(mood, stressLevel) {
    const title = document.getElementById('recomTitle');
    const desc = document.getElementById('recomDesc');
    const nutri = document.getElementById('nutriInfo');
    const food = document.getElementById('foodInfo');
    const icon = document.getElementById('bgIcon');
    const card = document.getElementById('nutritionCard');

    let data = {};

    if (mood === 'stres' || stressLevel >= 70) {
        data = {
            t: "The Stress Buster! 🍫",
            d: "Jadwalmu gila banget! Tubuhmu sedang memproduksi Kortisol berlebih. Kamu butuh penyeimbang segera.",
            n: "Magnesium & Flavonoid. Nutrisi ini membantu merelaksasi pembuluh darah yang tegang akibat tekanan akademik.",
            f: "Dark Chocolate, Pisang, atau Oatmeal. Hindari kopi berlebih!",
            c: "from-rose-900 to-gray-900",
            i: "fa-brain"
        };
    } else if (mood === 'flat' || (stressLevel > 30 && stressLevel < 70)) {
        data = {
            t: "The Energy Booster 🍌",
            d: "Fokusmu mulai turun. Otakmu butuh glukosa stabil (Complex Carbs) agar tidak mengantuk di kelas berikutnya.",
            n: "Karbohidrat Kompleks & Serat. Menjaga gula darah tetap stabil tanpa 'sugar crash'.",
            f: "Gado-gado (banyakin sayur), Roti Gandum, atau Buah Apel.",
            c: "from-indigo-900 to-gray-900",
            i: "fa-bolt"
        };
    } else {
        data = {
            t: "Happy Maintainer ✨",
            d: "Kondisi prima! Jaga endorfinmu dengan makanan segar agar mood positif ini bertahan sampai sore.",
            n: "Protein Ringan & Omega-3. Mendukung fungsi neurotransmitter agar tetap kreatif.",
            f: "Ikan Bakar, Salad Buah, atau Jus Alpukat tanpa susu berlebih.",
            c: "from-emerald-900 to-gray-900",
            i: "fa-face-smile-beam"
        };
    }

    // Update UI with Animation
    card.className = `bg-gradient-to-br ${data.c} rounded-[3.5rem] p-10 text-white shadow-2xl relative overflow-hidden min-h-[400px] transition-all duration-700`;
    title.innerText = data.t;
    desc.innerText = data.d;
    nutri.innerText = data.n;
    food.innerText = data.f;
    icon.className = `fa-solid ${data.i} absolute -right-10 -bottom-10 text-[15rem] text-white opacity-5 rotate-12 transition-all duration-700`;
}

// Reminder Logika berdasarkan Jam
function checkMealTime() {
    const hour = new Date().getHours();
    const reminder = document.getElementById('reminderText');
    if (hour >= 7 && hour <= 9) reminder.innerText = "Waktunya Sarapan! 🍳";
    else if (hour >= 12 && hour <= 14) reminder.innerText = "Jam Makan Siang! 🍱";
    else if (hour >= 18 && hour <= 20) reminder.innerText = "Waktu Makan Malam 🌙";
    else reminder.innerText = "Stay Hydrated! 💧";
}

setInterval(checkMealTime, 60000);
checkMealTime();
</script>