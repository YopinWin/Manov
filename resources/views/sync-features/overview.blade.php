<div class="space-y-12 pb-10">

    <div>
        <h3 class="text-xl font-black text-gray-800 uppercase tracking-tighter mb-8 flex items-center gap-3">
            <span class="w-8 h-1 bg-pink-500 rounded-full"></span> Fitur Unggulan
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="glow-card bg-white p-8 rounded-[2.5rem] cursor-pointer group transition-all duration-300">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 text-2xl mb-6 group-hover:bg-yellow-400 group-hover:text-white transition-all">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h4 class="font-black text-lg mb-2 tracking-tighter">Sync-Calendar</h4>
                <p class="text-gray-400 text-[11px] leading-relaxed italic">
                    Import jadwal kuliah otomatis & tandai slot kosong sebagai <span class="text-pink-500 font-bold text-[10px]">"Golden Recovery Time"</span>.
                </p>
            </div>

            <div class="glow-card bg-white p-8 rounded-[2.5rem] cursor-pointer group transition-all duration-300">
                <div class="w-14 h-14 bg-pink-50 rounded-2xl flex items-center justify-center text-pink-500 text-2xl mb-6 group-hover:bg-yellow-400 group-hover:text-white transition-all">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h4 class="font-black text-lg mb-2 tracking-tighter">Energy Flow</h4>
                <p class="text-gray-400 text-[11px] leading-relaxed italic">Sinkronisasi jadwal berat dengan waktu pemulihan energi seluler secara real-time.</p>
            </div>

            <div class="glow-card bg-white p-8 rounded-[2.5rem] cursor-pointer group transition-all duration-300">
                <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-500 text-2xl mb-6 group-hover:bg-yellow-400 group-hover:text-white transition-all">
                    <i class="fa-solid fa-face-smile"></i>
                </div>
                <h4 class="font-black text-lg mb-2 tracking-tighter">Mood-Check AI</h4>
                <p class="text-gray-400 text-[11px] leading-relaxed italic">AI pendeteksi burnout yang memberikan instruksi istirahat tepat sesuai kondisi mental.</p>
            </div>

            <div class="glow-card bg-white p-8 rounded-[2.5rem] cursor-pointer group transition-all duration-300">
                <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-500 text-2xl mb-6 group-hover:bg-yellow-400 group-hover:text-white transition-all">
                    <i class="fa-solid fa-utensils"></i>
                </div>
                <h4 class="font-black text-lg mb-2 tracking-tighter">Smart Meal</h4>
                <p class="text-gray-400 text-[11px] leading-relaxed italic">Rekomendasi asupan nutrisi paling efisien berbasis budget & jadwal kuliah harian.</p>
            </div>

        </div>
    </div>

    <div class="bg-white rounded-[3.5rem] p-12 border border-pink-100 flex flex-col md:flex-row items-center gap-12 relative overflow-hidden">
        <div class="flex-1 z-10">
            <h3 class="text-4xl font-black mb-8 text-pink-600 italic leading-none">Apa Manfaatnya?</h3>
            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <div class="bg-pink-100 p-2 rounded-lg text-pink-600"><i class="fa-solid fa-check"></i></div>
                    <p class="font-bold text-gray-600 italic">Meningkatkan Fokus Belajar Hingga 40%</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-pink-100 p-2 rounded-lg text-pink-600"><i class="fa-solid fa-check"></i></div>
                    <p class="font-bold text-gray-600 italic">Mencegah Stres Akademik & Burnout</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-pink-100 p-2 rounded-lg text-pink-600"><i class="fa-solid fa-check"></i></div>
                    <p class="font-bold text-gray-600 italic">Manajemen Waktu Lebih Terintegrasi</p>
                </div>
            </div>
        </div>
        <div class="w-full md:w-80 h-60 bg-pink-50 rounded-[2.5rem] flex items-center justify-center border-4 border-dashed border-pink-100 relative group cursor-pointer">
             <i class="fa-solid fa-hand-holding-heart text-6xl text-pink-200 group-hover:scale-125 transition-all"></i>
             <div class="absolute -bottom-4 bg-pink-600 text-white text-[9px] px-6 py-2 rounded-full font-black uppercase tracking-[0.3em]">Health Area</div>
        </div>
    </div>
</div>

<script>
  var swiper = new Swiper(".mySwiper", {
    autoplay: { delay: 4000, disableOnInteraction: false },
    pagination: { el: ".swiper-pagination", clickable: true },
    loop: true,
    effect: 'fade', // Menambah kesan smooth
  });
</script>