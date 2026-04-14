<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - H&T Sync</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            /* Pakai background pink soft yang kamu minta */
            background-color: #FFF5F7;
            background-image: radial-gradient(#FFD1DC 0.5px, #FFF5F7 0.5px);
            background-size: 20px 20px;
        }

        .login-container {
            background: white;
            padding: 50px 40px;
            border-radius: 40px; /* Lebih bulat biar estetik */
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 50px rgba(255, 182, 193, 0.3);
            text-align: center;
            animation: fadeIn 0.8s ease-out;
            border: 1px solid #FFE4E9;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px);}
            to { opacity: 1; transform: translateY(0);}
        }

        .logo-area {
            width: 70px;
            height: 70px;
            background: #ec4899; /* Pink Dominan */
            margin: 0 auto 20px;
            border-radius: 22px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 10px 20px rgba(236, 72, 153, 0.3);
            color: white;
            font-size: 30px;
        }

        /* TEMPAT GANTI LOGO: Ganti <i> dengan <img> kalau sudah ada file logo */
        .logo-area i {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .login-container h2 {
            margin-bottom: 5px;
            color: #333;
            font-weight: 800;
            letter-spacing: -1px;
            font-size: 24px;
        }

        .login-container p.subtitle {
            color: #aaa;
            font-size: 12px;
            margin-bottom: 30px;
            font-style: italic;
        }

        .login-container input {
            width: 100%;
            padding: 15px 20px;
            margin: 10px 0;
            border-radius: 15px;
            border: 1px solid #FEE2E7;
            background: #FFF9FA;
            outline: none;
            transition: 0.3s;
            font-size: 14px;
        }

        .login-container input:focus {
            border-color: #ec4899;
            background: white;
            box-shadow: 0 0 10px rgba(236, 72, 153, 0.1);
        }

        .login-container button {
            width: 100%;
            padding: 15px;
            background: #ec4899;
            border: none;
            color: white;
            border-radius: 15px;
            margin-top: 20px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(236, 72, 153, 0.3);
        }

        .login-container button:hover {
            background: #db2777;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(236, 72, 153, 0.4);
        }

        .login-container button:active {
            transform: translateY(0);
        }

        .footer-text {
            margin-top: 25px;
            font-size: 12px;
            color: #888;
        }

        .footer-text a {
            color: #ec4899;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">

    <div class="logo-area">
        <i class="fa-solid fa-sync-alt"></i>
    </div>

    <h2>HTS</h2>
    <p class="subtitle">Log in to sync your life</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input type="email" name="email" placeholder="Email Mahasiswa" required autofocus>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Masuk Dashboard</button>
    </form>

    <p class="footer-text">Belum punya akun? <a href="{{ route('register') }}">Daftar Disini</a></p>

</div>

</body>
</html>