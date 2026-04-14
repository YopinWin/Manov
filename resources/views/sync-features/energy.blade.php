<div class="space-y-8 animate-fadeIn">
    <div class="flex flex-wrap justify-center gap-3 mb-10">
        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
            <button onclick="filterDay('{{ $day }}', this)" 
                class="day-btn px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] transition-all duration-300
                {{ $day == 'Monday' ? 'bg-pink-500 text-white shadow-xl shadow-pink-200 scale-105' : 'bg-white text-gray-400 border border-pink-50 hover:bg-pink-50 hover:text-pink-400' }}">
                {{ $day }}
            </button>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2 bg-white/70 backdrop-blur-xl rounded-[3.5rem] p-10 shadow-2xl shadow-pink-100/50 border border-white relative">
            <div class="flex justify-between items-center mb-12">
                <div>
                    <h3 class="font-black text-gray-800 text-2xl tracking-tighter italic">Weekly <span class="text-pink-500">Timeline</span></h3>
                    <p class="text-[11px] text-gray-400 mt-1 font-medium italic">Manajemen energi mahasiswa tingkat pro njir!</p>
                </div>
                <button onclick="openImportModal()" class="group bg-gradient-to-br from-pink-500 to-rose-400 text-white px-7 py-3 rounded-[1.5rem] text-[10px] font-black uppercase tracking-widest hover:shadow-xl hover:shadow-pink-200 transition-all active:scale-95 flex items-center">
                    <i class="fa-solid fa-plus mr-2 group-hover:rotate-90 transition-transform"></i> Plotting Jadwal
                </button>
            </div>

            @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
            <div id="day-{{ $day }}" class="day-content {{ $day == 'Monday' ? '' : 'hidden' }} space-y-10 relative before:content-[''] before:absolute before:left-[21px] before:top-4 before:bottom-4 before:w-1 before:bg-gradient-to-b before:from-pink-500 before:to-pink-50">
                @php $daySchedules = $schedules->where('day', $day)->sortBy('start_time'); @endphp
                
                @forelse($daySchedules as $s)
                <div class="relative pl-16 group">
                    <div class="absolute left-0 top-1 w-11 h-11 bg-white border-4 border-pink-100 rounded-[1.2rem] flex items-center justify-center z-10 group-hover:border-pink-500 transition-all duration-500">
                        <div class="w-2.5 h-2.5 bg-pink-500 rounded-full"></div>
                    </div>

                    <div class="glow-card bg-gradient-to-br from-white to-[#FFF9FA] p-8 rounded-[2.5rem] border border-pink-50 flex justify-between items-center transition-all duration-300">
                        <div class="flex-1 text-left">
                            <div class="flex items-center gap-4 mb-2">
                                <span class="bg-pink-50 text-pink-600 text-[10px] font-black px-4 py-1.5 rounded-full">
                                    {{ date('H:i', strtotime($s->start_time)) }} — {{ date('H:i', strtotime($s->end_time)) }}
                                </span>
                                @if($s->intensity >= 4)
                                <span class="bg-rose-500 text-white text-[9px] px-3 py-1 rounded-full font-black animate-bounce uppercase">🔥 Heavy Load</span>
                                @endif
                            </div>
                            <h4 class="font-black text-gray-800 text-xl tracking-tight">{{ $s->course_name }}</h4>
                        </div>
                        </div>
                </div>
                @empty
                <div class="py-20 text-center">
                    <p class="text-gray-400 font-bold italic">Belum ada agenda untuk hari {{ $day }}.</p>
                </div>
                @endforelse
            </div>
            @endforeach
        </div>

        <div class="space-y-8">
            <div id="recoveryWidget" class="bg-gradient-to-br from-indigo-700 via-purple-600 to-indigo-500 rounded-[3.5rem] p-10 text-white shadow-2xl relative overflow-hidden group">
                <h4 class="font-black text-2xl mb-4 italic flex items-center gap-3">Golden Gap 🍃</h4>
                <p id="gapDescription" class="text-xs opacity-80 leading-relaxed mb-10 font-medium">Menganalisis jadwalmu...</p>
                <button id="btnClaim" onclick="claimRecovery()" class="hidden w-full py-5 bg-white text-indigo-600 rounded-[1.8rem] text-[10px] font-black tracking-widest uppercase hover:shadow-2xl transition-all">Klaim Recovery</button>
            </div>

            <div class="bg-white rounded-[3rem] p-8 border border-pink-100 shadow-xl flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-pink-50 rounded-[2rem] flex items-center justify-center text-pink-500 text-3xl mb-4 shadow-inner">
                    <i id="suggestionIcon" class="fa-solid fa-brain"></i>
                </div>
                <p class="text-[10px] font-black text-pink-300 uppercase tracking-widest mb-2">AI Suggestion</p>
                <p id="suggestionText" class="text-[13px] text-gray-600 font-bold italic leading-relaxed px-4">"Sistem sedang membaca ritme energimu."</p>
            </div>
        </div>
    </div>
</div>

<script>
    window.filterDay = function(day, btn) {
    // 1. Update variabel global hari aktif
    window.currentDaySelected = day; 
    
    // 2. UPDATE TEKS HARI DI TAB MOOD (TAMBAHKAN BARIS INI)
    const dayTextEl = document.getElementById('predictedDayText');
    if(dayTextEl) {
        dayTextEl.innerText = day;
    }

    // 3. Sembunyikan semua konten hari di timeline
    document.querySelectorAll('.day-content').forEach(c => c.classList.add('hidden'));
    document.getElementById('day-' + day).classList.remove('hidden');
    
    // 4. Update style tombol hari
    document.querySelectorAll('.day-btn').forEach(b => {
        b.classList.remove('bg-pink-500', 'text-white', 'shadow-xl', 'scale-105');
        b.classList.add('bg-white', 'text-gray-400');
    });
    btn.classList.add('bg-pink-500', 'text-white', 'shadow-xl', 'scale-105');
    
        // 5. Jalankan deteksi otomatis mood jika fungsi tersedia
        if(typeof window.autoDetectMood === "function") {
            window.autoDetectMood();
        }

        // 6. Update Golden Gap
        if(typeof window.calculateGoldenGap === "function") {
            window.calculateGoldenGap(day);
        }
    }

    // Fungsi hitung gap (Global)
    window.calculateGoldenGap = function(day) {
        if (typeof allSchedules === 'undefined') return;

        const schedules = Object.values(allSchedules)
            .filter(s => s.day === day)
            .sort((a, b) => a.start_time.localeCompare(b.start_time));
        
        const gapDesc = document.getElementById('gapDescription');
        const suggText = document.getElementById('suggestionText');
        const suggIcon = document.getElementById('suggestionIcon');
        const btnClaim = document.getElementById('btnClaim');

        if (!gapDesc) return; // Safety check

        if (schedules.length < 2) {
            gapDesc.innerText = `Celah recovery hari ${day} belum terdeteksi.`;
            suggText.innerText = "Import jadwal untuk melihat analisis energi.";
            btnClaim.classList.add('hidden');
            return;
        }

        let maxGap = 0;
        let gapStart = "";

        for (let i = 0; i < schedules.length - 1; i++) {
            let endCurrent = new Date(`2024-01-01 ${schedules[i].end_time}`);
            let startNext = new Date(`2024-01-01 ${schedules[i+1].start_time}`);
            let diffMins = Math.floor((startNext - endCurrent) / 60000);

            if (diffMins > maxGap) {
                maxGap = diffMins;
                gapStart = schedules[i].end_time;
            }
        }

        if (maxGap > 15) {
            btnClaim.classList.remove('hidden');
            gapDesc.innerHTML = `Detect: <span class="text-yellow-300 font-bold">${maxGap} menit</span> celah kosong setelah jam ${gapStart.substring(0,5)}.`;
            
            // Logika saran aktivitas...
            let activities = maxGap <= 30 ? [{ t: "Gap mikro! Minum air putih.", i: "fa-bottle-water" }] : [{ t: "Gap luas! Waktunya Power Nap.", i: "fa-bed" }];
            const rand = activities[0];
            suggText.innerText = `"${rand.t}"`;
            suggIcon.className = "fa-solid " + rand.i;
        } else {
            gapDesc.innerText = "Jadwal padat. Ambil nafas dalam!";
            suggText.innerText = "Tidak ada gap cukup lama.";
            suggIcon.className = "fa-solid fa-bolt";
            btnClaim.classList.add('hidden');
        }
    }

    window.claimRecovery = function() {
        alert("✨ Mode Recovery Aktif untuk hari " + window.currentDaySelected + "!");
    }

    window.openImportModal = function() { document.getElementById('importModal').classList.remove('hidden'); }
    window.closeImportModal = function() { document.getElementById('importModal').classList.add('hidden'); }
</script>