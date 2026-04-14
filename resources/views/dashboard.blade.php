<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTS - Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Cormorant+Garamond:italic,wght@500;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }

        .brand-aesthetic {
            font-family: 'Cormorant Garamond', serif;
            font-variant: small-caps;
            letter-spacing: 0.1em;
        }

        #main-sidebar { transition: all 0.4s ease; }
        .sidebar-closed { margin-left: -288px; opacity: 0; }

        .tab-content { display: none; }
        .tab-content.active { display: block; }

        /* HERO */
        .video-container {
            position: relative;
            width: 100%;
            height: 450px;
            border-radius: 3rem;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        }

        .video-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        footer i:hover {
            transform: translateY(-4px) scale(1.1);
            transition: 0.3s;
        }
    </style>
</head>

<body class="bg-[#FFF5F7] text-gray-800 overflow-x-hidden">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside id="main-sidebar" class="w-72 bg-white border-r border-pink-100 flex flex-col sticky top-0 h-screen">

        <div class="p-6 flex items-center gap-1">
            <div class="w-10 h-10">
                <img src="{{ asset('images/logo-hts.png') }}" class="w-full h-full object-contain">
            </div>
            <h1 class="brand-aesthetic text-3xl text-pink-600 italic font-bold -ml-1">HTS</h1>
        </div>

        <nav class="flex-1 px-4 space-y-2">

            <button onclick="showTab('dashboard', this)" class="tab-btn w-full flex items-center px-4 py-3 bg-pink-50 text-pink-600 rounded-2xl font-bold">
                <i class="fa-solid fa-house-chimney w-8"></i> Dashboard
            </button>

            <button onclick="showTab('energy', this)" class="tab-btn w-full flex items-center px-4 py-3 text-gray-400 hover:bg-pink-50 rounded-2xl">
                <i class="fa-solid fa-bolt-lightning w-8"></i> Energy Flow
            </button>

            <button onclick="showTab('mood', this)" class="tab-btn w-full flex items-center px-4 py-3 text-gray-400 hover:bg-pink-50 rounded-2xl">
                <i class="fa-solid fa-face-smile w-8"></i> Mood-Check AI
            </button>

            <button onclick="showTab('meal', this)" class="tab-btn w-full flex items-center px-4 py-3 text-gray-400 hover:bg-pink-50 rounded-2xl">
                <i class="fa-solid fa-utensils w-8"></i> Smart Meal
            </button>

            <button onclick="showTab('academic', this)" class="tab-btn w-full flex items-center px-4 py-3 text-gray-400 hover:bg-pink-50 rounded-2xl">
                <i class="fa-solid fa-chart-line w-8"></i> Academic Stats
            </button>

            <!-- NEW -->
            <button onclick="window.location.href='/about'" class="w-full flex items-center px-4 py-3 text-gray-400 hover:bg-pink-50 rounded-2xl">
                <i class="fa-solid fa-circle-info w-8"></i> About Us
            </button>

        </nav>

        <div class="p-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full py-4 bg-pink-600 text-white rounded-xl font-bold">Logout</button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 flex flex-col min-h-screen p-10">

        <!-- HEADER -->
        <header class="flex justify-between items-center mb-10">

            <div class="flex items-center gap-4">
                <button id="sidebar-toggle" class="w-10 h-10 flex items-center justify-center bg-white border border-pink-100 rounded-xl hover:bg-pink-50">
                    <i class="fa-solid fa-bars text-pink-500"></i>
                </button>

                <h2 id="tab-title" class="text-3xl font-black">Dashboard ✨</h2>
            </div>

            <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-full border">
                <div class="w-8 h-8 bg-pink-200 rounded-full flex items-center justify-center text-pink-600 font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <span class="text-sm font-bold">{{ Auth::user()->name }}</span>
            </div>
        </header>

        <!-- CONTENT WRAPPER (KUNCI ALIGN) -->
        <div class="w-full max-w-5xl mx-auto flex-1">

            <!-- DASHBOARD -->
            <div id="dashboard" class="tab-content active">

                <!-- HERO -->
                <div class="video-container mb-6">
                    <video autoplay muted loop playsinline>
                        <source src="{{ asset('video/hero-bg.mp4') }}" type="video/mp4">
                    </video>

                    <div class="video-overlay">
                        <div class="text-white max-w-xl mx-auto">
                            <span class="bg-pink-500 text-xs px-4 py-1 rounded-full uppercase">New Update</span>
                            <h1 class="text-5xl font-black mt-4 italic">
                                Study Hard,<br>Rest Smart.
                            </h1>
                            <p class="text-sm mt-2 opacity-80">
                                Level up your productivity without burning out.
                            </p>
                        </div>
                    </div>
                </div>

                @include('sync-features.overview')
            </div>

            <!-- TAB LAIN -->
            <div id="energy" class="tab-content">@include('sync-features.energy')</div>
            <div id="mood" class="tab-content">@include('sync-features.mood')</div>
            <div id="meal" class="tab-content">@include('sync-features.meal')</div>
            <div id="academic" class="tab-content">@include('sync-features.academic')</div>

            <!-- FOOTER -->
            <footer class="mt-4 pb-8 flex justify-center">

                <div class="bg-[#FFFDFE] border border-pink-100 rounded-[3rem] px-12 py-10 shadow-sm text-center w-full">

                    <p class="text-sm italic text-gray-500 max-w-xl mx-auto">
                        “Balance your time, protect your energy, and everything else will follow.”
                    </p>

                    <div class="w-20 h-[2px] bg-pink-200 mx-auto my-5 rounded-full"></div>

                    <div class="flex justify-center gap-10 text-xl text-gray-400 mb-5">
                        <a href="https://www.instagram.com/revalyaaaa?igsh=cXF0Nmd5NTk5Y3Bo" target="_blank">
                            <i class="fa-brands fa-instagram hover:text-pink-500"></i>
                        </a>

                        <a href="https://wa.me/6282350678544" target="_blank">
                            <i class="fa-brands fa-whatsapp hover:text-green-500"></i>
                        </a>

                        <a href="https://www.tiktok.com/@butterscotcholicsss?_r=1&_t=ZS-95ONTCOUw9X" target="_blank">
                            <i class="fa-brands fa-tiktok hover:text-black"></i>
                        </a>
                    </div>

                    <h1 class="brand-aesthetic text-lg text-pink-500 italic">HTS</h1>
                    <p class="text-xs text-gray-400 mt-1">© 2026 Health & Time Sync</p>

                </div>

            </footer>

        </div>

    </main>
</div>

<script>
    // --- 1. DATA INITIALIZATION (WAJIB DI ATAS) ---
    // Pastikan data jadwal dikirim dari Controller ke JS
    var allSchedules = @json($schedules ?? []); 
    
    // Default hari aktif menggunakan hari ini (Monday, Tuesday, dst)
    var currentDaySelected = '{{ \Carbon\Carbon::now()->format("l") }}'; 

    // --- 2. SIDEBAR LOGIC ---
    const sidebar = document.getElementById('main-sidebar');
    const toggleBtn = document.getElementById('sidebar-toggle');

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            sidebar.classList.toggle('sidebar-closed');
        });
    }

    // --- 3. TAB NAVIGATION LOGIC ---
    function showTab(tabId, btn) {
        const targetTab = document.getElementById(tabId);
        if (!targetTab) return;

        // Sembunyikan semua tab
        document.querySelectorAll('.tab-content').forEach(t => {
            t.classList.remove('active');
            t.style.display = 'none'; // Paksa sembunyi agar tidak crash
        });

        // Reset style semua tombol sidebar
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('bg-pink-50','text-pink-600','font-bold');
            b.classList.add('text-gray-400');
        });

        // Tampilkan tab target
        targetTab.classList.add('active');
        targetTab.style.display = 'block';

        // Beri style aktif pada tombol yang diklik
        if(btn){
            btn.classList.add('bg-pink-50','text-pink-600','font-bold');
            btn.classList.remove('text-gray-400');
        }

        // Update Judul Header
        const titles = {
            dashboard: 'Dashboard ✨',
            energy: 'Energy Flow ⚡',
            mood: 'Mood-Check AI 🤖',
            meal: 'Smart Meal 🍱',
            academic: 'Academic Stats 📈'
        };
        const titleEl = document.getElementById('tab-title');
        if (titleEl) titleEl.innerText = titles[tabId];

        // --- 4. AUTO DETECT MOOD INTEGRATION ---
        // Jalankan deteksi otomatis HANYA jika masuk ke tab mood
        if (tabId === 'mood') {
            // Kita beri sedikit delay agar element mood.blade.php selesai muncul
            setTimeout(() => {
                if(typeof window.autoDetectMood === "function") {
                    window.autoDetectMood();
                }
            }, 50);
        }
    }

    // Inisialisasi tampilan pertama kali saat halaman dibuka
    window.onload = function() {
        showTab('dashboard', document.querySelector('.tab-btn'));
    };
</script>

</body>
</html>