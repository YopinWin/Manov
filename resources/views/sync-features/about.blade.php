<div class="space-y-10 animate-fadeIn">

    <!-- HEADER -->
    <div>
        <h3 class="font-black text-gray-800 text-3xl tracking-tighter italic">
            About <span class="text-pink-500">HTS</span>
        </h3>
        <p class="text-[11px] text-gray-400 mt-1 font-medium italic">
            Health & Time Sync Overview
        </p>
    </div>

    <!-- MAIN CARD -->
    <div
        class="bg-gradient-to-br from-pink-500 via-rose-500 to-pink-600 rounded-[3.5rem] p-10 text-white shadow-2xl relative overflow-hidden">

        <div class="relative z-10">

            <span class="bg-white/20 text-[10px] font-black px-4 py-1 rounded-full uppercase">
                About System
            </span>

            <h2 class="text-4xl font-black italic mt-4 mb-4">
                Smart Balance for Student Life
            </h2>

            <p class="text-sm text-white/80 max-w-md">
                HTS membantu mahasiswa menjaga keseimbangan antara kesehatan mental dan produktivitas akademik.
            </p>

        </div>
    </div>

    <!-- TEAM -->
    <div class="space-y-6">
        <h3 class="text-lg font-bold text-gray-700">The Creators</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

            <!-- CARD -->
            <div class="bg-white p-5 rounded-2xl border border-pink-100 text-center hover:shadow-lg transition">

                <img id="preview1" src="{{ asset('images/team/uiux.jpg') }}"
                    class="w-20 h-20 mx-auto rounded-full object-cover mb-3 cursor-pointer hover:scale-105 transition"
                    onclick="uploadImage(1)">

                <input type="file" id="file1" class="hidden" accept="image/*" onchange="previewImage(event, 1)">

                <p class="font-semibold">Radiska Rizki</p>
                <p class="text-xs text-pink-500 font-bold">UI/UX Designer</p>

                <p class="text-[11px] text-gray-500 mt-2">
                    Mendesain tampilan aplikasi agar user friendly dan menarik.
                </p>
            </div>

            <!-- CARD -->
            <div class="bg-white p-5 rounded-2xl border border-pink-100 text-center hover:shadow-lg transition">

                <img id="preview2" src="{{ asset('images/team/frontend.jpg') }}"
                    class="w-20 h-20 mx-auto rounded-full object-cover mb-3 cursor-pointer hover:scale-105 transition"
                    onclick="uploadImage(2)">

                <input type="file" id="file2" class="hidden" accept="image/*" onchange="previewImage(event, 2)">

                <p class="font-semibold">Reva Aliya</p>
                <p class="text-xs text-indigo-500 font-bold">Front-End Developer</p>

                <p class="text-[11px] text-gray-500 mt-2">
                    Mengembangkan tampilan web interaktif dan responsif.
                </p>
            </div>

            <!-- CARD -->
            <div class="bg-white p-5 rounded-2xl border border-pink-100 text-center hover:shadow-lg transition">

                <img id="preview3" src="{{ asset('images/team/backend.jpg') }}"
                    class="w-20 h-20 mx-auto rounded-full object-cover mb-3 cursor-pointer hover:scale-105 transition"
                    onclick="uploadImage(3)">

                <input type="file" id="file3" class="hidden" accept="image/*" onchange="previewImage(event, 3)">

                <p class="font-semibold">Yopin Winda</p>
                <p class="text-xs text-purple-500 font-bold">Back-End Developer</p>

                <p class="text-[11px] text-gray-500 mt-2">
                    Mengelola sistem dan database agar aplikasi berjalan optimal.
                </p>
            </div>

            <!-- CARD -->
            <div class="bg-white p-5 rounded-2xl border border-pink-100 text-center hover:shadow-lg transition">

                <img id="preview4" src="{{ asset('images/team/manager.jpg') }}"
                    class="w-20 h-20 mx-auto rounded-full object-cover mb-3 cursor-pointer hover:scale-105 transition"
                    onclick="uploadImage(4)">

                <input type="file" id="file4" class="hidden" accept="image/*" onchange="previewImage(event, 4)">

                <p class="font-semibold">Ratu Amelia</p>
                <p class="text-xs text-yellow-500 font-bold">Project Manager</p>

                <p class="text-[11px] text-gray-500 mt-2">
                    Mengatur jalannya proyek dan koordinasi tim.
                </p>
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
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('preview' + id).src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
