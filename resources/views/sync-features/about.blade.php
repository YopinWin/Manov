<div class="space-y-12 animate-fadeIn pb-10">

    <!-- HEADER EXPERIMENTAL -->
    <div class="text-center md:text-left mt-6">
        <h3 class="font-black text-gray-800 text-4xl md:text-5xl tracking-tighter italic mb-2">
            Meet the <span class="text-pink-500 bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-orange-400">Creators</span>
        </h3>
        <p class="text-sm text-gray-500 font-medium italic">
            From identity to personality. Hover the cards.
        </p>
    </div>

    <!-- MAIN CARD -->
    <div class="glass-card bg-gradient-to-br from-pink-500/80 via-rose-500/80 to-pink-600/80 p-12 text-white shadow-2xl relative overflow-hidden group">
        <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
            <div class="flex-1">
                <span class="bg-white/20 backdrop-blur-md text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest border border-white/30 shadow-sm inline-block mb-6">
                    About System
                </span>
                <h2 class="text-4xl lg:text-5xl font-black italic mb-6 leading-tight">
                    Smart Balance for <br>Student Life
                </h2>
                <p class="text-sm text-white/90 max-w-lg leading-relaxed">
                    HTS membantu mahasiswa menjaga keseimbangan antara kesehatan mental dan produktivitas akademik melalui antarmuka soft glassmorphism yang tenang.
                </p>
            </div>
            
            <div class="w-40 h-40 bg-white/10 rounded-full blur-2xl absolute -right-10 -bottom-10 group-hover:scale-150 transition-transform duration-700"></div>
            <i class="fa-solid fa-code-branch text-9xl text-white/10 rotate-12 relative z-0 md:mr-10"></i>
        </div>
    </div>

    <!-- EXCLUSIVE TEAM SECTION ("From Identity to Personality") -->
    <div class="mt-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 md:gap-6 pt-16">

            <!-- TEAM CARD STRUCTURE 1 -->
            <div class="relative group h-[300px] flex items-end justify-center rounded-[2.5rem] cursor-pointer">
                <!-- Glowing Aura -->
                <div class="absolute inset-0 bg-pink-500/0 rounded-[2.5rem] group-hover:bg-pink-400/20 group-hover:blur-xl transition-all duration-500"></div>

                <!-- Glass Base -->
                <div class="absolute bottom-0 w-full h-[220px] bg-white/20 backdrop-blur-xl border border-white/60 rounded-[2.5rem] shadow-[0_8px_32px_rgba(255,182,193,0.15)] group-hover:bg-white/40 group-hover:backdrop-blur-md group-hover:shadow-[0_15px_40px_rgba(255,105,180,0.3)] group-hover:border-pink-200 transition-all duration-500 flex flex-col justify-end p-6 z-10">
                    
                    <div class="text-center transform translate-y-0 group-hover:-translate-y-4 opacity-70 group-hover:opacity-100 transition-all duration-500">
                        <p class="font-black text-xl text-gray-800 tracking-tight mb-1">Radiska Rizki</p>
                        <p class="text-[10px] uppercase tracking-widest text-pink-500 font-bold mb-2">UI/UX Designer</p>
                    </div>
                </div>

                <!-- Pop-out Character Image -->
                <div class="absolute bottom-20 z-20 w-full h-56 flex justify-center transform translate-y-6 scale-90 opacity-0 group-hover:translate-y-0 group-hover:scale-110 group-hover:opacity-100 transition-all duration-[600ms] ease-out pointer-events-none">
                    <img id="preview1" src="https://ui-avatars.com/api/?name=Radiska+Rizki&background=fce7f3&color=ec4899&bold=true&size=256" class="h-full object-contain object-bottom drop-shadow-[0_10px_20px_rgba(0,0,0,0.2)]" onclick="uploadImage(1)">
                </div>
                
                <!-- Silent Input -->
                <input type="file" id="file1" class="hidden" accept="image/*" onchange="previewImage(event, 1)">
                <!-- Hitbox to allow click upload -->
                <div class="absolute inset-0 z-30 rounded-[2.5rem]" onclick="uploadImage(1)"></div>
            </div>

            <!-- TEAM CARD STRUCTURE 2 -->
            <div class="relative group h-[300px] flex items-end justify-center rounded-[2.5rem] cursor-pointer">
                <div class="absolute inset-0 bg-amber-500/0 rounded-[2.5rem] group-hover:bg-amber-400/20 group-hover:blur-xl transition-all duration-500"></div>
                <div class="absolute bottom-0 w-full h-[220px] bg-white/20 backdrop-blur-xl border border-white/60 rounded-[2.5rem] shadow-[0_8px_32px_rgba(255,182,193,0.15)] group-hover:bg-white/40 group-hover:backdrop-blur-md group-hover:shadow-[0_15px_40px_rgba(245,158,11,0.3)] group-hover:border-amber-200 transition-all duration-500 flex flex-col justify-end p-6 z-10">
                    <div class="text-center transform translate-y-0 group-hover:-translate-y-4 opacity-70 group-hover:opacity-100 transition-all duration-500">
                        <p class="font-black text-xl text-gray-800 tracking-tight mb-1">Reva Aliya</p>
                        <p class="text-[10px] uppercase tracking-widest text-amber-500 font-bold mb-2">Front-End Dev</p>
                    </div>
                </div>
                <div class="absolute bottom-20 z-20 w-full h-56 flex justify-center transform translate-y-6 scale-90 opacity-0 group-hover:translate-y-0 group-hover:scale-110 group-hover:opacity-100 transition-all duration-[600ms] ease-out pointer-events-none">
                    <img id="preview2" src="https://ui-avatars.com/api/?name=Reva+Aliya&background=fef3c7&color=f59e0b&bold=true&size=256" class="h-full object-contain object-bottom drop-shadow-[0_10px_20px_rgba(0,0,0,0.2)]">
                </div>
                <input type="file" id="file2" class="hidden" accept="image/*" onchange="previewImage(event, 2)">
                <div class="absolute inset-0 z-30 rounded-[2.5rem]" onclick="uploadImage(2)"></div>
            </div>

            <!-- TEAM CARD STRUCTURE 3 -->
            <div class="relative group h-[300px] flex items-end justify-center rounded-[2.5rem] cursor-pointer">
                <div class="absolute inset-0 bg-yellow-500/0 rounded-[2.5rem] group-hover:bg-yellow-400/20 group-hover:blur-xl transition-all duration-500"></div>
                <div class="absolute bottom-0 w-full h-[220px] bg-white/20 backdrop-blur-xl border border-white/60 rounded-[2.5rem] shadow-[0_8px_32px_rgba(255,182,193,0.15)] group-hover:bg-white/40 group-hover:backdrop-blur-md group-hover:shadow-[0_15px_40px_rgba(234,179,8,0.3)] group-hover:border-yellow-200 transition-all duration-500 flex flex-col justify-end p-6 z-10">
                    <div class="text-center transform translate-y-0 group-hover:-translate-y-4 opacity-70 group-hover:opacity-100 transition-all duration-500">
                        <p class="font-black text-xl text-gray-800 tracking-tight mb-1">Yopin Winda</p>
                        <p class="text-[10px] uppercase tracking-widest text-yellow-600 font-bold mb-2">Back-End Dev</p>
                    </div>
                </div>
                <div class="absolute bottom-20 z-20 w-full h-56 flex justify-center transform translate-y-6 scale-90 opacity-0 group-hover:translate-y-0 group-hover:scale-110 group-hover:opacity-100 transition-all duration-[600ms] ease-out pointer-events-none">
                    <img id="preview3" src="https://ui-avatars.com/api/?name=Yopin+Winda&background=fef9c3&color=ca8a04&bold=true&size=256" class="h-full object-contain object-bottom drop-shadow-[0_10px_20px_rgba(0,0,0,0.2)]">
                </div>
                <input type="file" id="file3" class="hidden" accept="image/*" onchange="previewImage(event, 3)">
                <div class="absolute inset-0 z-30 rounded-[2.5rem]" onclick="uploadImage(3)"></div>
            </div>

            <!-- TEAM CARD STRUCTURE 4 -->
            <div class="relative group h-[300px] flex items-end justify-center rounded-[2.5rem] cursor-pointer">
                <div class="absolute inset-0 bg-yellow-500/0 rounded-[2.5rem] group-hover:bg-yellow-400/20 group-hover:blur-xl transition-all duration-500"></div>
                <div class="absolute bottom-0 w-full h-[220px] bg-white/20 backdrop-blur-xl border border-white/60 rounded-[2.5rem] shadow-[0_8px_32px_rgba(255,182,193,0.15)] group-hover:bg-white/40 group-hover:backdrop-blur-md group-hover:shadow-[0_15px_40px_rgba(234,179,8,0.3)] group-hover:border-yellow-200 transition-all duration-500 flex flex-col justify-end p-6 z-10">
                    <div class="text-center transform translate-y-0 group-hover:-translate-y-4 opacity-70 group-hover:opacity-100 transition-all duration-500">
                        <p class="font-black text-xl text-gray-800 tracking-tight mb-1">Ratu Amelia</p>
                        <p class="text-[10px] uppercase tracking-widest text-yellow-500 font-bold mb-2">Project Manager</p>
                    </div>
                </div>
                <div class="absolute bottom-20 z-20 w-full h-56 flex justify-center transform translate-y-6 scale-90 opacity-0 group-hover:translate-y-0 group-hover:scale-110 group-hover:opacity-100 transition-all duration-[600ms] ease-out pointer-events-none">
                    <img id="preview4" src="https://ui-avatars.com/api/?name=Ratu+Amelia&background=fef9c3&color=ca8a04&bold=true&size=256" class="h-full object-contain object-bottom drop-shadow-[0_10px_20px_rgba(0,0,0,0.2)]">
                </div>
                <input type="file" id="file4" class="hidden" accept="image/*" onchange="previewImage(event, 4)">
                <div class="absolute inset-0 z-30 rounded-[2.5rem]" onclick="uploadImage(4)"></div>
            </div>

        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    function uploadImage(id) {
        document.getElementById('file' + id).click();
    }

    function previewImage(event, id) {
        const file = event.target.files[0];
        if (!file) return;
        
        const reader = new FileReader();
        reader.onload = function() {
            const img = document.getElementById('preview' + id);
            img.src = reader.result;
            // Rounded circle if it's user uploaded to force it nicely, but we want it cutout ideally. 
            // Setting object-cover dropshadow instead.
            img.classList.remove('object-contain');
            img.classList.add('object-cover', 'rounded-t-[3rem]');
            localStorage.setItem('teamPhotoEx' + id, reader.result);
        }
        reader.readAsDataURL(file);
    }

    // Load saved photos on page load
    document.addEventListener('DOMContentLoaded', function() {
        for (let i = 1; i <= 4; i++) {
            const saved = localStorage.getItem('teamPhotoEx' + i);
            if (saved) {
                const img = document.getElementById('preview' + i);
                img.src = saved;
                img.classList.remove('object-contain');
                img.classList.add('object-cover', 'rounded-t-[3rem]');
            }
        }
    });
</script>
