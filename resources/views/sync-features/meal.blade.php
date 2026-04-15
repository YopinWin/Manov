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
            class="glass-panel px-6 py-3 rounded-full flex items-center gap-3 animate-bounce">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-500"></span>
            </span>
            <p class="text-[10px] font-black uppercase tracking-widest text-pink-600" id="reminderText">
                Checking Schedule...
            </p>
        </div>
    </div>

    {{-- LAYOUT: Kantin Live (Kiri) + AI Nutrition (Kanan) --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

        {{-- ==================== KANTIN LIVE ==================== --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="glass-card p-8">
                <h4 class="font-black text-gray-800 text-lg mb-6 flex items-center gap-2">
                    🍱 Kantin Live
                </h4>

                <div class="space-y-4" id="kantinList">
                    {{-- Menu items rendered by JS --}}
                </div>

                {{-- Add Menu Button --}}
                <button onclick="openKantinModal()" class="w-full mt-4 py-3 border-2 border-dashed border-pink-200 text-pink-400 rounded-2xl text-xs font-bold hover:bg-pink-50 hover:text-pink-600 hover:border-pink-400 transition-all">
                    <i class="fa-solid fa-plus mr-1"></i> Tambah Menu
                </button>
            </div>
        </div>

        {{-- ==================== AI NUTRITION CARD ==================== --}}
        <div class="lg:col-span-3">
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
</div>

{{-- ==================== KANTIN MODAL ==================== --}}
<div id="kantinModal" class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="glass-card p-10 w-full max-w-md relative animate-fadeIn">
        <button onclick="closeKantinModal()" class="absolute top-6 right-6 w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-pink-100 transition">
            <i class="fa-solid fa-xmark text-gray-500"></i>
        </button>

        <h3 class="text-xl font-black text-gray-800 mb-6 italic">Tambah Menu Kantin 🍽️</h3>

        <div class="space-y-4">
            <div>
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Nama Menu</label>
                <input type="text" id="kantinMenuName" placeholder="Contoh: Nasi Goreng"
                    class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-pink-300 transition">
            </div>
            
            <div>
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Harga</label>
                <input type="text" id="kantinMenuPrice" placeholder="Contoh: 12K"
                    class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-pink-300 transition">
            </div>

            <div>
                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Status</label>
                <select id="kantinMenuStatus" class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-pink-300 transition">
                    <option value="tersedia">✅ Tersedia</option>
                    <option value="habis">❌ Habis</option>
                </select>
            </div>

            <button onclick="addKantinMenu()" class="w-full py-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:shadow-xl hover:shadow-pink-200 transition-all active:scale-[0.98]">
                <i class="fa-solid fa-plus mr-2"></i> Tambah
            </button>
        </div>
    </div>
</div>

<script>
(function() {
    // ==================== KANTIN LIVE ====================
    const defaultMenus = [
        { name: "Gado-Gado Ibu", price: "12K", status: "tersedia", emoji: "🥗" },
        { name: "Ayam Geprek", price: "15K", status: "tersedia", emoji: "🍗" },
        { name: "Nasi Goreng Spesial", price: "13K", status: "tersedia", emoji: "🍛" },
        { name: "Mie Ayam Bakso", price: "14K", status: "habis", emoji: "🍜" },
        { name: "Es Teh Manis", price: "5K", status: "tersedia", emoji: "🧊" },
    ];

    let kantinMenus = JSON.parse(localStorage.getItem('kantinMenus')) || defaultMenus;

    function renderKantin() {
        const container = document.getElementById('kantinList');
        if (!container) return;
        container.innerHTML = '';

        kantinMenus.forEach(function(menu, idx) {
            const isAvailable = menu.status === 'tersedia';
            const card = document.createElement('div');
            card.className = `flex items-center justify-between p-4 rounded-2xl border transition-all duration-300 cursor-pointer hover:shadow-md ${isAvailable ? 'bg-white border-green-100 hover:border-green-300' : 'bg-gray-50 border-gray-200 opacity-60'}`;
            
            card.innerHTML = `
                <div class="flex items-center gap-4">
                    <span class="text-2xl">${menu.emoji}</span>
                    <div>
                        <p class="font-bold text-sm text-gray-800">${menu.name}</p>
                        <p class="text-[10px] font-black uppercase tracking-widest ${isAvailable ? 'text-green-500' : 'text-red-400'}">
                            ${isAvailable ? 'TERSEDIA' : 'HABIS'} • ${menu.price}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="toggleKantinStatus(${idx})" class="w-8 h-8 rounded-full flex items-center justify-center transition-all ${isAvailable ? 'bg-green-100 text-green-500 hover:bg-green-200' : 'bg-red-100 text-red-400 hover:bg-red-200'}">
                        <i class="fa-solid ${isAvailable ? 'fa-check' : 'fa-xmark'} text-xs"></i>
                    </button>
                    <button onclick="removeKantinMenu(${idx})" class="w-8 h-8 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center hover:bg-rose-100 hover:text-rose-500 transition-all">
                        <i class="fa-solid fa-trash text-xs"></i>
                    </button>
                </div>
            `;
            container.appendChild(card);
        });
        
        localStorage.setItem('kantinMenus', JSON.stringify(kantinMenus));
    }

    window.toggleKantinStatus = function(idx) {
        kantinMenus[idx].status = kantinMenus[idx].status === 'tersedia' ? 'habis' : 'tersedia';
        renderKantin();
    }

    window.removeKantinMenu = function(idx) {
        if (confirm('Hapus menu "' + kantinMenus[idx].name + '"?')) {
            kantinMenus.splice(idx, 1);
            renderKantin();
        }
    }

    window.addKantinMenu = function() {
        const name = document.getElementById('kantinMenuName').value.trim();
        const price = document.getElementById('kantinMenuPrice').value.trim();
        const status = document.getElementById('kantinMenuStatus').value;
        
        if (!name || !price) {
            alert('Isi semua data!');
            return;
        }

        const emojis = ['🍛', '🍜', '🍗', '🥗', '🍲', '🧊', '🍵', '🥤', '🍔', '🌮'];
        const randomEmoji = emojis[Math.floor(Math.random() * emojis.length)];

        kantinMenus.push({ name, price, status, emoji: randomEmoji });
        renderKantin();
        closeKantinModal();

        document.getElementById('kantinMenuName').value = '';
        document.getElementById('kantinMenuPrice').value = '';
    }

    window.openKantinModal = function() { document.getElementById('kantinModal').classList.remove('hidden'); }
    window.closeKantinModal = function() { document.getElementById('kantinModal').classList.add('hidden'); }

    // ==================== AI MEAL RECOMMENDATIONS ====================
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
                c: "from-amber-950 via-amber-900 to-gray-900",
                i: "fa-bolt-lightning"
            };
        } else {
            data = {
                t: "Happy Maintainer ✨",
                d: "Kondisi prima! Jaga endorfinmu dengan makanan segar agar mood positif ini bertahan sampai sore.",
                n: "Protein Ringan & Omega-3. Mendukung fungsi neurotransmitter agar tetap kreatif.",
                f: "Ikan Bakar, Salad Buah, atau Jus Alpukat tanpa susu berlebih.",
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

    // ==================== MEAL TIME REMINDER ====================
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
        renderKantin();
        window.checkMealTime();
        window.updateMealAI('flat', 50);
        setInterval(window.checkMealTime, 60000);
    });

    // Close modal on outside click
    document.addEventListener('click', function(e) {
        if (e.target.id === 'kantinModal') closeKantinModal();
    });
})();
</script>
