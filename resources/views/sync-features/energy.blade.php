<div class="space-y-8 animate-fadeIn">
    <div class="flex flex-wrap justify-center gap-3 mb-10">
        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
            <button onclick="filterDay('{{ $day }}', this)" 
                class="day-btn px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] transition-all duration-300
                {{ $day == date('l') ? 'bg-pink-500 text-white shadow-xl shadow-pink-200 scale-105' : 'bg-white text-gray-400 border border-pink-50 hover:bg-pink-50 hover:text-pink-400' }}">
                {{ $day }}
            </button>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2 glass-card p-10 relative">
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
            <div id="day-{{ $day }}" class="day-content {{ $day == date('l') ? '' : 'hidden' }} space-y-10 relative before:content-[''] before:absolute before:left-[21px] before:top-4 before:bottom-4 before:w-1 before:bg-gradient-to-b before:from-pink-500 before:to-pink-50">
                @php $daySchedules = $schedules->where('day', $day)->sortBy('start_time'); @endphp
                
                @forelse($daySchedules as $s)
                <div class="relative pl-16 group">
                    <div class="absolute left-0 top-1 w-11 h-11 bg-white border-4 border-pink-100 rounded-[1.2rem] flex items-center justify-center z-10 group-hover:border-pink-500 transition-all duration-500">
                        <div class="w-2.5 h-2.5 bg-pink-500 rounded-full"></div>
                    </div>

                    <div class="glass-panel p-8 rounded-[2.5rem] flex justify-between items-center transition-all duration-300 hover:shadow-lg hover:shadow-pink-100/50 hover:-translate-y-1">
                        <div class="flex-1 text-left">
                            <div class="flex items-center gap-4 mb-2">
                                <span class="bg-pink-50 text-pink-600 text-[10px] font-black px-4 py-1.5 rounded-full">
                                    {{ date('H:i', strtotime($s->start_time)) }} — {{ date('H:i', strtotime($s->end_time)) }}
                                </span>
                                @if($s->intensity >= 4)
                                <span class="bg-rose-500 text-white text-[9px] px-3 py-1 rounded-full font-black animate-bounce uppercase">🔥 Heavy Load</span>
                                @endif
                                <span class="bg-gray-100 text-gray-500 text-[9px] px-3 py-1 rounded-full font-bold">
                                    ⚡ {{ $s->intensity }}/5
                                </span>
                            </div>
                            <h4 class="font-black text-gray-800 text-xl tracking-tight">{{ $s->course_name }}</h4>
                        </div>
                        
                        {{-- ACTION BUTTONS --}}
                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <button onclick="openEditModal({{ $s->id }}, '{{ $s->course_name }}', '{{ $s->start_time }}', '{{ $s->end_time }}', {{ $s->intensity }})" 
                                class="w-10 h-10 bg-amber-50 text-amber-500 rounded-xl flex items-center justify-center hover:bg-amber-100 transition-all" title="Edit">
                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                            </button>
                            <form method="POST" action="{{ route('energy.destroy', $s->id) }}" onsubmit="return confirm('Yakin hapus jadwal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 bg-rose-50 text-rose-500 rounded-xl flex items-center justify-center hover:bg-rose-100 transition-all" title="Hapus">
                                    <i class="fa-solid fa-trash text-sm"></i>
                                </button>
                            </form>
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
            <!-- RECAP BANNER ENERGY -->
            @if(isset($lastRecap))
            <div class="glass-card p-6 bg-gradient-to-br from-pink-50/80 to-rose-50/80 border-pink-100/50 shadow-sm border-dashed">
                <h4 class="font-black text-pink-500 text-[10px] tracking-[0.2em] uppercase mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left"></i> Ringkasan Health Log
                </h4>
                <div class="space-y-3 relative">
                    <div class="flex justify-between items-end border-b border-pink-100 pb-2">
                        <span class="text-[9px] font-black text-gray-400 uppercase italic">Rata-rata Air</span>
                        <span class="text-lg font-black text-pink-500">{{ $lastRecap->summary_data['average_water_intake'] ?? '-' }} <span class="text-[10px]">Gelas</span></span>
                    </div>
                    <div class="flex justify-between items-end">
                        <span class="text-[9px] font-black text-gray-400 uppercase italic">Rata-rata Tidur</span>
                        <span class="text-lg font-black text-amber-600">{{ $lastRecap->summary_data['average_sleep_hours'] ?? '-' }} <span class="text-[10px]">Jam</span></span>
                    </div>
                </div>
            </div>
            @endif

            <div id="recoveryWidget" class="bg-gradient-to-br from-amber-600 via-yellow-500 to-orange-400 rounded-[3.5rem] p-10 text-white shadow-2xl relative overflow-hidden group">
                <h4 class="font-black text-2xl mb-4 italic flex items-center gap-3">Golden Gap 🍃</h4>
                <p id="gapDescription" class="text-xs opacity-80 leading-relaxed mb-10 font-medium">Menganalisis jadwalmu...</p>
                <button id="btnClaim" onclick="claimRecovery()" class="hidden w-full py-5 bg-white text-amber-600 rounded-[1.8rem] text-[10px] font-black tracking-widest uppercase hover:shadow-2xl transition-all">Klaim Recovery</button>
            </div>

            <div class="glass-card p-8 flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-pink-50 rounded-[2rem] flex items-center justify-center text-pink-500 text-3xl mb-4 shadow-inner">
                    <i id="suggestionIcon" class="fa-solid fa-brain"></i>
                </div>
                <p class="text-[10px] font-black text-pink-300 uppercase tracking-widest mb-2">AI Suggestion</p>
                <p id="suggestionText" class="text-[13px] text-gray-600 font-bold italic leading-relaxed px-4">"Sistem sedang membaca ritme energimu."</p>
            </div>
        </div>
    </div>
</div>

{{-- ==================== IMPORT MODAL ==================== --}}
<div id="importModal" class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="glass-card p-10 w-full max-w-lg relative animate-fadeIn border-white/80">
        <button onclick="closeImportModal()" class="absolute top-6 right-6 w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-pink-100 transition">
            <i class="fa-solid fa-xmark text-gray-500"></i>
        </button>

        <h3 class="text-2xl font-black text-gray-800 mb-2 italic">Plotting Jadwal ✨</h3>
        <p class="text-xs text-gray-400 mb-8">Tambah jadwal kuliah mingguan baru.</p>

        <form method="POST" action="{{ route('energy.store') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Nama Mata Kuliah</label>
                    <input type="text" name="course_name" required placeholder="Contoh: Kalkulus II"
                        class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-pink-300 transition">
                </div>
                
                <div>
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Hari</label>
                    <select name="day" required class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-pink-300 transition">
                        <option value="">Pilih Hari</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Jam Mulai</label>
                        <input type="time" name="start_time" required
                            class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-pink-300 transition">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Jam Selesai</label>
                        <input type="time" name="end_time" required
                            class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-pink-300 transition">
                    </div>
                </div>

                <div>
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Intensitas (1-5)</label>
                    <div class="flex gap-2" id="intensityPicker">
                        @for($i = 1; $i <= 5; $i++)
                        <button type="button" onclick="setIntensity({{ $i }})" 
                            class="intensity-btn w-12 h-12 rounded-xl border-2 border-gray-200 text-sm font-black hover:border-pink-400 hover:bg-pink-50 transition {{ $i == 3 ? 'border-pink-500 bg-pink-50 text-pink-600' : 'text-gray-400' }}">
                            {{ $i }}
                        </button>
                        @endfor
                    </div>
                    <input type="hidden" name="intensity" id="intensityValue" value="3">
                </div>

                <button type="submit" class="w-full py-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:shadow-xl hover:shadow-pink-200 transition-all active:scale-[0.98] mt-4">
                    <i class="fa-solid fa-rocket mr-2"></i> Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ==================== EDIT MODAL ==================== --}}
<div id="editModal" class="hidden fixed inset-0 z-[9999] flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-[2.5rem] p-10 w-full max-w-lg shadow-2xl relative animate-fadeIn">
        <button onclick="closeEditModal()" class="absolute top-6 right-6 w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-pink-100 transition">
            <i class="fa-solid fa-xmark text-gray-500"></i>
        </button>

        <h3 class="text-2xl font-black text-gray-800 mb-2 italic">Edit Jadwal ✏️</h3>
        <p class="text-xs text-gray-400 mb-8">Update jadwal kuliah yang sudah ada.</p>

        <form method="POST" id="editForm" action="">
            @csrf
            @method('PATCH')
            <div class="space-y-4">
                <div>
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Nama Mata Kuliah</label>
                    <input type="text" name="course_name" id="editCourseName" required
                        class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-pink-300 transition">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Jam Mulai</label>
                        <input type="time" name="start_time" id="editStartTime" required
                            class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-pink-300 transition">
                    </div>
                    <div>
                        <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Jam Selesai</label>
                        <input type="time" name="end_time" id="editEndTime" required
                            class="w-full px-5 py-4 bg-pink-50 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-pink-300 transition">
                    </div>
                </div>

                <div>
                    <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-1 block">Intensitas (1-5)</label>
                    <div class="flex gap-2" id="editIntensityPicker">
                        @for($i = 1; $i <= 5; $i++)
                        <button type="button" onclick="setEditIntensity({{ $i }})" 
                            class="edit-intensity-btn w-12 h-12 rounded-xl border-2 border-gray-200 text-sm font-black hover:border-pink-400 hover:bg-pink-50 transition text-gray-400">
                            {{ $i }}
                        </button>
                        @endfor
                    </div>
                    <input type="hidden" name="intensity" id="editIntensityValue" value="3">
                </div>

                <button type="submit" class="w-full py-4 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:shadow-xl hover:shadow-indigo-200 transition-all active:scale-[0.98] mt-4">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Update Jadwal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // === IMPORT MODAL ===
    window.openImportModal = function() { document.getElementById('importModal').classList.remove('hidden'); }
    window.closeImportModal = function() { document.getElementById('importModal').classList.add('hidden'); }

    // === EDIT MODAL ===
    window.openEditModal = function(id, name, start, end, intensity) {
        document.getElementById('editForm').action = '/energy/update/' + id;
        document.getElementById('editCourseName').value = name;
        document.getElementById('editStartTime').value = start.substring(0, 5);
        document.getElementById('editEndTime').value = end.substring(0, 5);
        document.getElementById('editIntensityValue').value = intensity;
        
        // Highlight intensity button
        document.querySelectorAll('.edit-intensity-btn').forEach((btn, idx) => {
            if (idx + 1 === intensity) {
                btn.classList.add('border-pink-500', 'bg-pink-50', 'text-pink-600');
                btn.classList.remove('border-gray-200', 'text-gray-400');
            } else {
                btn.classList.remove('border-pink-500', 'bg-pink-50', 'text-pink-600');
                btn.classList.add('border-gray-200', 'text-gray-400');
            }
        });
        
        document.getElementById('editModal').classList.remove('hidden');
    }
    window.closeEditModal = function() { document.getElementById('editModal').classList.add('hidden'); }

    // === INTENSITY PICKER ===
    window.setIntensity = function(val) {
        document.getElementById('intensityValue').value = val;
        document.querySelectorAll('.intensity-btn').forEach((btn, idx) => {
            if (idx + 1 === val) {
                btn.classList.add('border-pink-500', 'bg-pink-50', 'text-pink-600');
                btn.classList.remove('border-gray-200', 'text-gray-400');
            } else {
                btn.classList.remove('border-pink-500', 'bg-pink-50', 'text-pink-600');
                btn.classList.add('border-gray-200', 'text-gray-400');
            }
        });
    }

    window.setEditIntensity = function(val) {
        document.getElementById('editIntensityValue').value = val;
        document.querySelectorAll('.edit-intensity-btn').forEach((btn, idx) => {
            if (idx + 1 === val) {
                btn.classList.add('border-pink-500', 'bg-pink-50', 'text-pink-600');
                btn.classList.remove('border-gray-200', 'text-gray-400');
            } else {
                btn.classList.remove('border-pink-500', 'bg-pink-50', 'text-pink-600');
                btn.classList.add('border-gray-200', 'text-gray-400');
            }
        });
    }

    // === FILTER DAY ===
    window.filterDay = function(day, btn) {
        window.currentDaySelected = day; 

        const dayTextEl = document.getElementById('predictedDayText');
        if(dayTextEl) dayTextEl.innerText = day;

        document.querySelectorAll('.day-content').forEach(c => c.classList.add('hidden'));
        document.getElementById('day-' + day).classList.remove('hidden');
        
        document.querySelectorAll('.day-btn').forEach(b => {
            b.classList.remove('bg-pink-500', 'text-white', 'shadow-xl', 'scale-105');
            b.classList.add('bg-white', 'text-gray-400');
        });
        btn.classList.add('bg-pink-500', 'text-white', 'shadow-xl', 'scale-105');
        btn.classList.remove('bg-white', 'text-gray-400');
    
        if(typeof window.autoDetectMood === "function") {
            window.autoDetectMood();
        }

        if(typeof window.calculateGoldenGap === "function") {
            window.calculateGoldenGap(day);
        }
    }

    // === GOLDEN GAP CALCULATOR ===
    window.calculateGoldenGap = function(day) {
        if (typeof allSchedules === 'undefined') return;

        const schedules = Object.values(allSchedules)
            .filter(s => s.day === day)
            .sort((a, b) => a.start_time.localeCompare(b.start_time));
        
        const gapDesc = document.getElementById('gapDescription');
        const suggText = document.getElementById('suggestionText');
        const suggIcon = document.getElementById('suggestionIcon');
        const btnClaim = document.getElementById('btnClaim');

        if (!gapDesc) return;

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
            
            let activities = [];
            if (maxGap <= 30) {
                activities = [
                    { t: "Gap mikro! Minum air putih & stretching.", i: "fa-bottle-water" },
                    { t: "Gap singkat! Dengarkan musik santai.", i: "fa-music" },
                ];
            } else if (maxGap <= 60) {
                activities = [
                    { t: "Gap sedang! Waktu makan ringan yang sehat.", i: "fa-apple-whole" },
                    { t: "Gap sedang! Jalan santai di luar ruangan.", i: "fa-person-walking" },
                ];
            } else {
                activities = [
                    { t: "Gap luas! Waktunya Power Nap 20 menit.", i: "fa-bed" },
                    { t: "Gap luas! Review materi kuliah sebelumnya.", i: "fa-book-open" },
                ];
            }
            const rand = activities[Math.floor(Math.random() * activities.length)];
            suggText.innerText = `"${rand.t}"`;
            suggIcon.className = "fa-solid " + rand.i;
        } else {
            gapDesc.innerText = "Jadwal padat. Ambil nafas dalam!";
            suggText.innerText = "Tidak ada gap cukup lama. Tetap terhidrasi!";
            suggIcon.className = "fa-solid fa-bolt";
            btnClaim.classList.add('hidden');
        }
    }

    window.claimRecovery = function() {
        const day = window.currentDaySelected || 'Monday';
        const btn = document.getElementById('btnClaim');
        btn.innerHTML = '✅ Recovery Mode Aktif!';
        btn.classList.add('bg-green-100', 'text-green-600');
        btn.classList.remove('bg-white', 'text-indigo-600');
        btn.disabled = true;
        
        setTimeout(() => {
            btn.innerHTML = 'Klaim Recovery';
            btn.classList.remove('bg-green-100', 'text-green-600');
            btn.classList.add('bg-white', 'text-indigo-600');
            btn.disabled = false;
        }, 3000);
    }

    // Close modals when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.id === 'importModal') closeImportModal();
        if (e.target.id === 'editModal') closeEditModal();
    });
</script>