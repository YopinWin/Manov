<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - HTS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .swiper-slide img { transition: transform 6s linear; transform: scale(1); }
        .swiper-slide-active img { transform: scale(1.2); }
        .btn-glass { background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-[#FFF5F7] overflow-hidden">

    <div class="relative h-screen w-full">
        <div class="swiper mySwiper h-full w-full">
            <div class="swiper-wrapper">
                <div class="swiper-slide relative">
                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1200" class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center text-center">
                        <div class="text-white px-6">
                            <h1 class="text-5xl md:text-7xl font-black italic tracking-tighter mb-4">Mindfulness.</h1>
                            <p class="text-lg opacity-80 italic tracking-widest uppercase text-xs">Prioritaskan Kesehatan Mentalmu</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide relative">
                    <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?q=80&w=1200" class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center text-center text-white px-6">
                        <div>
                            <h1 class="text-5xl md:text-7xl font-black italic tracking-tighter mb-4">Balance.</h1>
                            <p class="text-lg opacity-80 italic tracking-widest uppercase text-xs">Sinkronisasi Jadwal & Istirahat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute top-0 left-0 w-full z-50 p-10 flex justify-between items-center">
            <h2 class="text-white font-black text-2xl italic tracking-widest uppercase">HTS.</h2>
            <div class="flex gap-4">
                <a href="{{ route('login') }}" class="btn-glass text-white px-8 py-3 rounded-2xl font-bold border border-white/30 hover:bg-white hover:text-pink-600 transition">Login</a>
                <a href="{{ route('register') }}" class="bg-pink-600 text-white px-8 py-3 rounded-2xl font-bold hover:bg-pink-700 shadow-xl transition">Daftar</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "fade",
            autoplay: { delay: 4000 },
            loop: true,
        });
    </script>
</body>
</html>