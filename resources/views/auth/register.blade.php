<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - HTS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0; padding: 0; box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #FFF5F7;
            background-image: radial-gradient(#FFD1DC 0.5px, #FFF5F7 0.5px);
            background-size: 20px 20px;
        }

        .register-container {
            background: white;
            padding: 40px;
            border-radius: 40px; 
            width: 100%;
            max-width: 420px;
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
            width: 65px;
            height: 65px;
            background: #ec4899; 
            margin: 0 auto 15px;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 10px 20px rgba(236, 72, 153, 0.3);
            color: white;
            font-size: 28px;
        }

        .register-container h2 {
            margin-bottom: 5px;
            color: #333;
            font-weight: 800;
            letter-spacing: -1px;
            font-size: 24px;
        }

        .subtitle {
            color: #aaa;
            font-size: 11px;
            margin-bottom: 25px;
            font-style: italic;
        }

        /* Error Box Style */
        .error-box {
            background: #FFF0F3;
            color: #e11d48;
            padding: 12px;
            border-radius: 15px;
            margin-bottom: 20px;
            text-align: left;
            font-size: 11px;
            border: 1px solid #FFCCD5;
        }

        .register-container input {
            width: 100%;
            padding: 14px 20px;
            margin: 8px 0;
            border-radius: 15px;
            border: 1px solid #FEE2E7;
            background: #FFF9FA;
            outline: none;
            transition: 0.3s;
            font-size: 13px;
        }

        .register-container input:focus {
            border-color: #ec4899;
            background: white;
            box-shadow: 0 0 10px rgba(236, 72, 153, 0.1);
        }

        .register-container button {
            width: 100%;
            padding: 15px;
            background: #ec4899;
            border: none;
            color: white;
            border-radius: 15px;
            margin-top: 20px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
            box-shadow: 0 8px 15px rgba(236, 72, 153, 0.2);
        }

        .register-container button:hover {
            background: #db2777;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(236, 72, 153, 0.3);
        }

        .footer-text {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }

        .footer-text a {
            color: #ec4899;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="register-container">

    <div class="logo-area">
        <i class="fa-solid fa-user-plus"></i>
    </div>

    <h2>Create Account</h2>
    <p class="subtitle">Join the synchronization journey</p>

    @if ($errors->any())
        <div class="error-box">
            <ul style="padding-left:15px; list-style-type: square;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required>
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Mahasiswa" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

        <button type="submit">Daftar Sekarang</button>
    </form>

    <p class="footer-text">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>

</div>

</body>
</html>