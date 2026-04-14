<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - HTS</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .brand-aesthetic {
            font-family: serif;
            font-style: italic;
            letter-spacing: 2px;
        }
    </style>
</head>

<body class="bg-[#FFF5F7] py-12 px-6">

<div class="max-w-5xl mx-auto">

    <!-- HEADER -->
    <div class="bg-white p-10 rounded-[2rem] shadow-sm border border-pink-100 text-center mb-10">
        <h1 class="text-3xl font-bold text-pink-500 mb-4">About HTS</h1>

        <p class="text-gray-600 leading-relaxed mb-4">
            HTS (Health & Time Sync) membantu mahasiswa menjaga keseimbangan antara kesehatan mental dan produktivitas akademik.
        </p>

        <p class="text-gray-500 text-sm italic">
            Tetap fokus, sehat, dan terhindar dari burnout 💖
        </p>
    </div>

    <!-- TEAM -->
    <div class="text-center mb-12">
        <h2 class="brand-aesthetic text-4xl text-pink-600 font-bold mb-3">The Creators</h2>
        <p class="text-gray-500 italic text-sm">Tim pengembang HTS</p>
    </div>

    <!-- TEAM GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- UI UX -->
        <div class="bg-white p-6 rounded-2xl text-center border border-pink-100 shadow-sm hover:shadow-md transition">
            <img src="{{ asset('images/team/uiux.jpg') }}" class="w-20 h-20 mx-auto rounded-full object-cover mb-4">
            <h4 class="font-bold text-gray-800">Nama Anggota</h4>
            <p class="text-pink-500 text-xs font-bold mt-1">UI/UX Designer</p>
            <p class="text-gray-500 text-xs mt-3 leading-relaxed">
                Mendesain tampilan aplikasi yang intuitif dan nyaman digunakan oleh pengguna.
            </p>
        </div>

        <!-- FRONTEND -->
        <div class="bg-white p-6 rounded-2xl text-center border border-pink-100 shadow-sm hover:shadow-md transition">
            <img src="{{ asset('images/team/frontend.jpg') }}" class="w-20 h-20 mx-auto rounded-full object-cover mb-4">
            <h4 class="font-bold text-gray-800">Nama Anggota</h4>
            <p class="text-pink-500 text-xs font-bold mt-1">Front-End Developer</p>
            <p class="text-gray-500 text-xs mt-3 leading-relaxed">
                Mengubah desain menjadi tampilan web interaktif dan responsif.
            </p>
        </div>

        <!-- BACKEND -->
        <div class="bg-white p-6 rounded-2xl text-center border border-pink-100 shadow-sm hover:shadow-md transition">
            <img src="{{ asset('images/team/backend.jpg') }}" class="w-20 h-20 mx-auto rounded-full object-cover mb-4">
            <h4 class="font-bold text-gray-800">Nama Anggota</h4>
            <p class="text-pink-500 text-xs font-bold mt-1">Back-End Developer</p>
            <p class="text-gray-500 text-xs mt-3 leading-relaxed">
                Mengelola sistem, database, dan logika aplikasi agar berjalan stabil.
            </p>
        </div>

        <!-- MANAGER -->
        <div class="bg-white p-6 rounded-2xl text-center border border-pink-100 shadow-sm hover:shadow-md transition">
            <img src="{{ asset('images/team/manager.jpg') }}" class="w-20 h-20 mx-auto rounded-full object-cover mb-4">
            <h4 class="font-bold text-gray-800">Nama Anggota</h4>
            <p class="text-pink-500 text-xs font-bold mt-1">Project Manager</p>
            <p class="text-gray-500 text-xs mt-3 leading-relaxed">
                Mengatur jalannya proyek dan memastikan semua berjalan sesuai rencana.
            </p>
        </div>

    </div>

    <!-- BACK BUTTON -->
    <div class="text-center mt-12">
        <a href="/dashboard"
           class="inline-block px-6 py-3 bg-pink-500 text-white rounded-xl shadow hover:bg-pink-600 transition">
            ← Kembali ke Dashboard
        </a>
    </div>

</div>

</body>
</html>