<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BIOGAMI</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- 🔥 TAMBAHAN WAJIB -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

<style>

/* ===== GLOBAL FONT ===== */
* {
    font-family: 'DM Sans', sans-serif;
}

/* ===== JUDUL BESAR ===== */
h1 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 28px;
    letter-spacing: 0.5px;
}

/* ===== JUDUL SECTION ===== */
h2 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 22px;
    margin-bottom: 15px;
}

/* ===== SUB TITLE ===== */
h3 {
    font-weight: 600;
    font-size: 16px;
}

/* ===== PARAGRAF ===== */
p {
    font-size: 14px;
    line-height: 1.6;
}

/* ===== LABEL KHUSUS ===== */
.section-title {
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 10px;
}

/* ===== DASHBOARD TITLE ===== */
.dashboard-title {
    font-weight: 700;
    font-size: 18px;
}

/* ===== BASE ===== */
body{
    margin:0;
    background:linear-gradient(135deg,#f5f7fa,#e4efe9);
    color:#333;
    transition:0.3s;
}

/* ===== DARK MODE ===== */
html.dark,
body.dark{
    background:#121212 !important;
    color:#e0e0e0 !important;
}

body.dark *{
    color:#e0e0e0 !important;
}

body.dark .content{
    background:#1e1e1e !important;
}

body.dark .sidebar{
    background:#0d3b12 !important;
}

body.dark .topbar{
    background:#1b5e20 !important;
}

body.dark .footer{
    background:#0d3b12 !important;
}

/* ===== SIDEBAR ===== */
.sidebar{
    position:fixed;
    width:250px;
    height:100vh;
    background:#1b5e20;
    color:white;
    padding:20px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

.sidebar.hide{
    left:-250px;
}

.sidebar a{
    display:block;
    padding:10px;
    margin:6px 0;
    color:white;
    text-decoration:none;
    border-radius:10px;
    transition:0.2s;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.2);
    transform:translateX(5px);
}

/* ===== PROFILE ===== */
.profile-box{
    display:flex;
    align-items:center;
    gap:10px;
    background:rgba(255,255,255,0.1);
    padding:10px;
    border-radius:12px;
}

.avatar{
    width:45px;
    height:45px;
    border-radius:50%;
}

.logout-btn{
    background:#e53935;
    border:none;
    color:white;
    padding:5px 10px;
    border-radius:8px;
    cursor:pointer;
}

/* ===== TOPBAR ===== */
.topbar{
    height:60px;
    background:linear-gradient(90deg,#1b5e20,#4caf50);
    color:white;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 20px;
}

.menu-btn{
    cursor:pointer;
    font-size:22px;
}

.dark-btn{
    cursor:pointer;
    background:white;
    color:black;
    padding:5px 10px;
    border-radius:10px;
    font-size:12px;
}

/* ===== MAIN ===== */
.main{
    margin-left:250px;
    transition:0.3s;
}

.main.full{
    margin-left:0;
}

/* ===== CONTENT ===== */
.content{
    padding:30px;
    margin:20px;
    background:rgba(255,255,255,0.9);
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

/* ===== FOOTER ===== */
.footer{
    width: calc(100% - 40px);
    margin: 0 20px 20px 20px;
    padding: 20px;
    text-align: center;
    background: linear-gradient(90deg,#1b5e20,#43a047);
    color: white;
    border-radius: 20px;
}

/* ===== FLIPBOOK (TAMBAHAN DOANG) ===== */
.flipbook-box{
    width:100%;
    height:400px;
    background:#eee;
    border-radius:20px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#777;
    font-size:16px;
}

body.dark .flipbook-box{
    background:#2a2a2a;
    color:#aaa;
}

</style>
</head>

<body>

<!-- SIDEBAR -->
<div id="sidebar" class="sidebar">
<div>
<h3>Menu</h3>
<a href="/dashboard">🏠 Dashboard</a>
<a href="/leaderboard">🏆 Leaderboard</a>
<a href="/grafik">📊 Grafik</a>

<h3>Materi</h3>
<a href="/materi">📚 Materi</a>
<a href="/flipbook">📖 Flipbook</a> <!-- 🔥 TAMBAHAN -->

<h3>Info</h3>
<a href="/team">👨‍💻 Tim Pengembang</a>
</div>

<div>
@auth
<div class="profile-box">
<img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" class="avatar">
<div>
<p>{{ auth()->user()->name }}</p>
<form method="POST" action="/logout">@csrf
<button class="logout-btn">Logout</button>
</form>
</div>
</div>
@endauth

@guest
<a href="/login">Login</a>
<a href="/register">Register</a>
@endguest
</div>
</div>

<!-- MAIN -->
<div id="main" class="main">

<div class="topbar">
<span class="menu-btn" onclick="toggleSidebar()">☰</span>
<span>BIOGAMI</span>
<span class="dark-btn" onclick="toggleDark()">🌙</span>
</div>

<div class="content">
@yield('content')

</div>

<div class="footer">
🌱 BIOGAMI © 2026 <br>
Belajar bukan hanya untuk dihafal, tetapi untuk dipahami dan diterapkan 
agar menjadi bekal nyata menuju masa depan yang lebih baik.
</div>

</div>

<!-- SCRIPT ASLI KAMU (TIDAK DIUBAH) -->
<script>
document.addEventListener("DOMContentLoaded", function(){

    const body = document.body;
    const html = document.documentElement;

    if(localStorage.getItem("dark") === "on"){
        body.classList.add("dark");
        html.classList.add("dark");
    }

    window.toggleSidebar = function(){
        let sidebar = document.getElementById("sidebar");
        let main = document.getElementById("main");

        sidebar.classList.toggle("hide");
        main.classList.toggle("full");
    }

    window.toggleDark = function(){
        body.classList.toggle("dark");
        html.classList.toggle("dark");

        if(body.classList.contains("dark")){
            localStorage.setItem("dark","on");
        }else{
            localStorage.setItem("dark","off");
        }
    }

});
</script>

<!-- AI SCRIPT (AMAN) -->
<script>
function kirimPertanyaan() {

    let input = document.getElementById("inputAI");
    let chatBox = document.getElementById("chatBox");

    let question = input.value;

    if (!question) return;

    chatBox.innerHTML += `<div class="user-message">${question}</div>`;

    fetch('/ai-ask', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ question: question })
    })
    .then(response => response.json())
    .then(data => {

        let jawaban = data.jawaban;

        jawaban = jawaban.replace(/\n|\r/g, ' ');
        jawaban = jawaban.replace(/\s+/g, ' ').trim();

        if (jawaban.includes('.')) {
            jawaban = jawaban.split('. ')[0] + '.';
        }

        chatBox.innerHTML += `<div class="ai-message">${jawaban}</div>`;
        chatBox.scrollTop = chatBox.scrollHeight;
    });

    input.value = "";
}
</script>

<script>
document.addEventListener("keypress", function(e){
    if(e.key === "Enter"){
        kirimPertanyaan();
    }
});
</script>

</body>
</html>