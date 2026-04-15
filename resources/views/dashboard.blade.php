<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>HTS - Soft Glassmorphism</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Cormorant+Garamond:italic,wght@600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .brand-aesthetic { font-family: 'Cormorant Garamond', serif; letter-spacing: 0.05em; }
        
        /* Glassmorphism Classes */
        .glass-panel {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px 0 rgba(255, 182, 193, 0.2);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 4px 24px 0 rgba(255, 182, 193, 0.15);
            border-radius: 2.5rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Floating Anim */
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-floating { animation: floating 6s ease-in-out infinite; }
        
        /* Fluid Abstract Background */
        .bg-fluid {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: -1;
            background: linear-gradient(120deg, #fbc2eb 0%, #ffecd2 40%, #fcb69f 80%, #ffefba 100%);
            background-size: 300% 300%;
            animation: gradientBG 20s ease infinite;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Blob shapes */
        .blob {
            position: fixed;
            filter: blur(80px);
            opacity: 0.6;
            animation: blobBounce 15s infinite alternate;
            border-radius: 50%;
            mix-blend-mode: multiply;
            z-index: -1;
        }
        .blob-1 { background: #ff9a9e; width: 50vw; height: 50vw; top: -10%; left: -10%; }
        .blob-2 { background: #fecfef; width: 45vw; height: 45vw; bottom: -10%; right: -10%; animation-delay: 2s; }
        .blob-3 { background: #fff176; width: 40vw; height: 40vw; top: 40%; left: 30%; animation-delay: 4s; }
        
        @keyframes blobBounce {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        .tab-content { display: none; opacity: 0; transition: opacity 0.4s ease; transform: scale(0.98); }
        .tab-content.active { display: block; opacity: 1; transform: scale(1); transition: opacity 0.4s ease, transform 0.4s ease;}
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255, 182, 193, 0.5); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255, 182, 193, 0.8); }
    </style>
</head>
<body class="text-gray-800 antialiased min-h-screen relative">
    
    <!-- FLUID BACKGROUND -->
    <div class="bg-fluid"></div>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    {{-- SUCCESS NOTIFICATION --}}
    @if(session('success'))
    <div id="toast" class="fixed bottom-24 md:bottom-6 right-6 z-[99999] glass-panel px-8 py-4 rounded-full font-bold text-sm flex items-center gap-3 animate-bounce">
        <i class="fa-solid fa-check-circle text-green-500 text-lg"></i>
        <span class="text-gray-700">{{ session('success') }}</span>
    </div>
    <script>setTimeout(function(){ document.getElementById('toast').style.display='none'; }, 4000);</script>
    @endif

    {{-- VALIDATION ERROR NOTIFICATION --}}
    @if($errors->any())
    <div id="error-toast" class="fixed bottom-24 md:bottom-6 right-6 z-[99999] glass-panel bg-rose-50/90 border-rose-200 px-8 py-4 rounded-3xl font-bold text-sm flex flex-col gap-2 animate-bounce shadow-xl shadow-rose-200/50 text-rose-600 max-w-sm">
        <div class="flex items-center gap-3 border-b border-rose-100 pb-2">
            <i class="fa-solid fa-triangle-exclamation text-xl"></i>
            <span>Ada Kesalahan:</span>
        </div>
        <ul class="list-disc pl-6 text-xs font-medium space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <script>setTimeout(function(){ document.getElementById('error-toast').style.display='none'; }, 6000);</script>
    @endif

    <!-- FLOATING PILL NAVBAR -->
    <nav class="fixed top-6 left-1/2 -translate-x-1/2 z-50 glass-panel rounded-full px-4 py-3 flex items-center justify-between shadow-xl w-[95%] max-w-5xl transition-all duration-300">
        
        <!-- LOGO -->
        <div class="flex items-center gap-3 pl-2">
            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white/70 shadow-sm flex items-center justify-center overflow-hidden">
                <img src="{{ asset('images/logo-hts.png') }}" class="w-6 h-6 md:w-7 md:h-7 object-contain">
            </div>
            <h1 class="brand-aesthetic text-xl md:text-2xl text-pink-500 italic font-bold">HTS</h1>
        </div>

        <!-- TABS (CENTERED) -->
        <div class="hidden md:flex items-center gap-2 bg-white/30 p-1.5 rounded-full border border-white/40">
            <button onclick="showTab('dashboard', this)" class="tab-btn px-5 py-2 rounded-full text-xs font-bold transition-all text-pink-600 bg-white shadow-sm">Dashboard</button>
            <button onclick="showTab('energy', this)" class="tab-btn px-5 py-2 rounded-full text-xs font-bold transition-all text-gray-500 hover:text-pink-500 hover:bg-white/50">Energy</button>
            <button onclick="showTab('mood', this)" class="tab-btn px-5 py-2 rounded-full text-xs font-bold transition-all text-gray-500 hover:text-pink-500 hover:bg-white/50">Mood AI</button>
            <button onclick="showTab('meal', this)" class="tab-btn px-5 py-2 rounded-full text-xs font-bold transition-all text-gray-500 hover:text-pink-500 hover:bg-white/50">Meal</button>
            <button onclick="showTab('academic', this)" class="tab-btn px-5 py-2 rounded-full text-xs font-bold transition-all text-gray-500 hover:text-pink-500 hover:bg-white/50">Academic</button>
            <button onclick="showTab('about', this)" class="tab-btn px-5 py-2 rounded-full text-xs font-bold transition-all text-gray-500 hover:text-pink-500 hover:bg-white/50">About</button>
        </div>

        <!-- USER & ACTIONS -->
        <div class="flex items-center gap-3 pr-1">
            <!-- Date Widget -->
            <div class="hidden lg:flex items-center gap-2 bg-white/40 px-4 py-2 rounded-full hover:bg-white/60 cursor-pointer transition-all border border-white/50" onclick="openDatePicker()">
                <i class="fa-solid fa-calendar-day text-pink-400"></i>
                <div class="text-left">
                    <p id="dateWidgetDay" class="text-[9px] font-black text-pink-500 uppercase tracking-wider leading-none"></p>
                    <p id="dateWidgetDate" class="text-[10px] font-bold text-gray-600 leading-tight"></p>
                </div>
            </div>
            <input type="date" id="hiddenDatePicker" class="hidden" onchange="onDatePicked(this.value)">

            <!-- User -->
            <div class="flex items-center gap-3 bg-white/40 px-3 py-1.5 rounded-full border border-white/50">
                <div class="w-7 h-7 md:w-8 md:h-8 bg-pink-100 rounded-full flex items-center justify-center text-pink-500 font-bold text-xs shadow-inner">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="hidden sm:block">
                    <p class="text-[10px] md:text-xs font-bold text-gray-700 leading-tight">{{ Auth::user()->name }}</p>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="ml-2 border-l border-white/50 pl-2">
                    @csrf
                    <button class="text-gray-400 hover:text-rose-500 transition-colors" title="Logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    
    <!-- Mobile Tabs (Visible only on small screens) -->
    <div class="md:hidden fixed bottom-6 left-1/2 -translate-x-1/2 z-50 glass-panel rounded-full px-2 py-2 flex items-center justify-center gap-1 shadow-xl w-[90%] max-w-sm">
        <button onclick="showTab('dashboard', this)" class="tab-btn p-3 rounded-full text-pink-600 bg-white shadow-sm flex-1"><i class="fa-solid fa-house"></i></button>
        <button onclick="showTab('energy', this)" class="tab-btn p-3 rounded-full text-gray-500 hover:text-pink-500 hover:bg-white/50 flex-1"><i class="fa-solid fa-bolt"></i></button>
        <button onclick="showTab('mood', this)" class="tab-btn p-3 rounded-full text-gray-500 hover:text-pink-500 hover:bg-white/50 flex-1"><i class="fa-solid fa-face-smile"></i></button>
        <button onclick="showTab('meal', this)" class="tab-btn p-3 rounded-full text-gray-500 hover:text-pink-500 hover:bg-white/50 flex-1"><i class="fa-solid fa-utensils"></i></button>
        <button onclick="showTab('about', this)" class="tab-btn p-3 rounded-full text-gray-500 hover:text-pink-500 hover:bg-white/50 flex-1"><i class="fa-solid fa-info"></i></button>
    </div>

    <!-- CONTENT WRAPPER -->
    <main class="pt-[110px] pb-24 px-4 sm:px-6 max-w-6xl mx-auto min-h-screen flex flex-col">
        <!-- Dashboard Content -->
        <div id="dashboard" class="tab-content active flex-1">
            <div class="glass-panel p-2 rounded-[3.5rem] mb-10 overflow-hidden relative shadow-2xl">
                <!-- Video Container modified for glass -->
                <div class="relative w-full h-[350px] md:h-[450px] rounded-[3rem] overflow-hidden">
                    <video autoplay muted loop playsinline class="w-full h-full object-cover">
                        <source src="{{ asset('video/hero-bg.mp4') }}" type="video/mp4">
                    </video>
                    <div class="absolute inset-0 bg-white/10 backdrop-blur-[2px] flex items-center justify-center text-center border border-white/20">
                        <div class="text-gray-800 max-w-xl mx-auto px-6 animate-floating">
                            <span class="bg-white/50 backdrop-blur-md text-[10px] text-pink-600 uppercase tracking-[0.2em] px-4 py-1.5 rounded-full border border-white/60 shadow-sm font-bold mb-6 inline-block">
                                Welcome to HTS
                            </span>
                            <h2 class="text-5xl md:text-6xl font-black italic mb-4 leading-tight">Health & <br><span class="text-pink-500">Time Sync</span></h2>
                            <p class="text-gray-600 text-sm italic font-medium">Platform manajemen waktu premium dengan integrasi soft AI untuk mahasiswa.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="glass-panel p-6 md:p-10 rounded-[3rem]">
                @include('sync-features.overview')
            </div>
        </div>

        <div id="energy" class="tab-content flex-1">
            @include('sync-features.energy')
        </div>

        <div id="mood" class="tab-content flex-1">
            @include('sync-features.mood')
        </div>

        <div id="meal" class="tab-content flex-1">
            @include('sync-features.meal')
        </div>

        <div id="academic" class="tab-content flex-1">
            @include('sync-features.academic')
        </div>

        <div id="about" class="tab-content flex-1">
            @include('sync-features.about')
        </div>
    </main>

    <!-- UI LAYER SCRIPTS -->
    <script>
        var allSchedules = @json($schedules ?? []);
        var currentDaySelected = '{{ \Carbon\Carbon::now()->format('l') }}';
        var currentSelectedDate = new Date();

        // ==================== DATE WIDGET ====================
        const dayNamesId = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const dayNamesEn = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        function updateDateWidget(date) {
            const d = date || new Date();
            const dayWidget = document.getElementById('dateWidgetDay');
            const dateWidget = document.getElementById('dateWidgetDate');
            if (dayWidget && dateWidget) {
                dayWidget.innerText = dayNamesId[d.getDay()];
                dateWidget.innerText = d.getDate() + ' ' + monthNames[d.getMonth()] + ' ' + d.getFullYear();
            }
        }

        function openDatePicker() {
            const picker = document.getElementById('hiddenDatePicker');
            picker.showPicker ? picker.showPicker() : picker.click();
        }

        function onDatePicked(dateStr) {
            const picked = new Date(dateStr + 'T00:00:00');
            currentSelectedDate = picked;
            const dayEn = dayNamesEn[picked.getDay()];
            
            updateDateWidget(picked);
            
            // Find mobile or desktop energy button
            const energyBtn = document.querySelectorAll('.tab-btn')[1];
            showTab('energy', energyBtn);

            setTimeout(() => {
                const dayBtns = document.querySelectorAll('.day-btn');
                dayBtns.forEach(function(btn) {
                    if (btn.textContent.trim().toLowerCase() === dayEn.toLowerCase()) {
                        if(typeof window.filterDay === 'function') window.filterDay(dayEn, btn);
                    }
                });
            }, 100);
        }

        // ==================== TAB NAVIGATION ====================
        function showTab(tabId, btn) {
            document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('text-pink-600', 'bg-white', 'shadow-sm');
                b.classList.add('text-gray-500');
            });

            const tab = document.getElementById(tabId);
            if(tab) tab.classList.add('active');

            if (btn) {
                // If it's a mobile nav click, find corresponding desktop btn to sync state
                const allBtnsArray = Array.from(document.querySelectorAll('.tab-btn'));
                const btnIndex = allBtnsArray.indexOf(btn);
                
                // Active requested button
                btn.classList.add('text-pink-600', 'bg-white', 'shadow-sm');
                btn.classList.remove('text-gray-500');
                
                // Active its counterpart (desktop <-> mobile)
                if(btnIndex > -1) {
                   const counterpartIdx = btnIndex > 5 ? btnIndex - 5 : btnIndex + 5; // assumes 6 desktop buttons then 5 mobile buttons
                   const counterpart = allBtnsArray[counterpartIdx];
                   if(counterpart) {
                       counterpart.classList.add('text-pink-600', 'bg-white', 'shadow-sm');
                       counterpart.classList.remove('text-gray-500');
                   }
                }
            }

            // TRIGGER AI CHAIN
            if (tabId === 'mood' || tabId === 'energy') {
                setTimeout(function() {
                    if (typeof window.autoDetectMood === 'function') window.autoDetectMood();
                    if (tabId === 'energy' && typeof window.calculateGoldenGap === 'function') {
                        window.calculateGoldenGap(currentDaySelected);
                    }
                }, 100);
            }
            if (tabId === 'meal') {
                setTimeout(function() {
                    if (typeof window.checkMealTime === 'function') window.checkMealTime();
                }, 100);
            }
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        window.onload = function() {
            updateDateWidget(new Date());
            
            setTimeout(function() {
                if (typeof window.calculateGoldenGap === 'function') window.calculateGoldenGap(currentDaySelected);
                if (typeof window.autoDetectMood === 'function') window.autoDetectMood();
            }, 300);
        };
    </script>
</body>
</html>
