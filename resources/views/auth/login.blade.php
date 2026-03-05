<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Sistem Data Tanah & Bangunan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #8B0000 0%, #B22222 30%, #DC143C 60%, #DAA520 100%);
            position: relative;
            overflow-x: hidden;
            overflow-y: auto;
            padding: 20px 15px;
        }

        /* Logo Logistik Background - Blur & Opacity */
        .logo-background {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 550px;
            height: 550px;
            background-image: url('{{ asset('images/logo-logistik.png') }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.12;
            filter: blur(2px) brightness(1.1);
            z-index: 1;
            pointer-events: none;
            animation: breathe-center 8s ease-in-out infinite;
        }

        @keyframes breathe-center {
            0%, 100% { 
                transform: translate(-50%, -50%) scale(1) rotate(0deg);
                opacity: 0.12;
                filter: blur(2px) brightness(1.1);
            }
            50% { 
                transform: translate(-50%, -50%) scale(1.05) rotate(2deg);
                opacity: 0.18;
                filter: blur(1.5px) brightness(1.15);
            }
        }

        /* Animated particles */
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0.25;
            animation: float-particle 20s infinite ease-in-out;
            z-index: 2;
        }

        @keyframes float-particle {
            0%, 100% { 
                transform: translate(0, 0) scale(1);
                opacity: 0.15;
            }
            25% { 
                transform: translate(80px, -80px) scale(1.1);
                opacity: 0.25;
            }
            50% { 
                transform: translate(-40px, 80px) scale(0.95);
                opacity: 0.12;
            }
            75% { 
                transform: translate(120px, 40px) scale(1.05);
                opacity: 0.2;
            }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 40px 35px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.15);
            width: 100%;
            max-width: 380px;
            position: relative;
            z-index: 10;
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 35px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo-section h1 {
            color: white;
            font-size: 24px;
            margin-bottom: 8px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .logo-section p {
            color: rgba(255, 255, 255, 0.95);
            font-size: 14px;
            font-weight: 500;
            text-shadow: 0 1px 5px rgba(0,0,0,0.2);
        }

        .form-group {
            margin-bottom: 22px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: white;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.3px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .form-group input {
            width: 100%;
            padding: 13px 18px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-size: 14px;
            color: white;
            transition: all 0.3s;
            backdrop-filter: blur(10px);
            font-weight: 500;
        }

        /* Password input with icon */
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper input {
            padding-right: 48px;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            opacity: 0.7;
        }

        .toggle-password:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
            fill: white;
            filter: drop-shadow(0 1px 3px rgba(0,0,0,0.3));
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.55);
        }

        .form-group input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.18);
            border-color: rgba(218, 165, 32, 0.5);
            box-shadow: 0 0 0 3px rgba(218, 165, 32, 0.12);
        }

        .error-message {
            background: rgba(139, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            color: white;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            border: 1px solid rgba(220, 20, 60, 0.5);
            animation: shake 0.5s;
            font-weight: 500;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .success-message {
            background: rgba(218, 165, 32, 0.35);
            backdrop-filter: blur(10px);
            color: white;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            border: 1px solid rgba(218, 165, 32, 0.5);
            font-weight: 500;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #B22222 0%, #8B0000 100%);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #DC143C 0%, #B22222 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .remember-section {
            display: flex;
            align-items: center;
            margin-bottom: 22px;
        }

        .remember-section input[type="checkbox"] {
            margin-right: 10px;
            width: 17px;
            height: 17px;
            cursor: pointer;
            accent-color: #B22222;
        }

        .remember-section label {
            color: rgba(255, 255, 255, 0.95);
            font-size: 13px;
            cursor: pointer;
            font-weight: 500;
            text-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .corner-decor {
            position: absolute;
            width: 60px;
            height: 60px;
            border: 2px solid rgba(218, 165, 32, 0.3);
        }

        .corner-decor.top-left {
            top: 15px;
            left: 15px;
            border-right: none;
            border-bottom: none;
            border-radius: 8px 0 0 0;
        }

        .corner-decor.bottom-right {
            bottom: 15px;
            right: 15px;
            border-left: none;
            border-top: none;
            border-radius: 0 0 8px 0;
        }

        @media (max-width: 768px) {
            .logo-background {
                width: 400px;
                height: 400px;
            }
            
            body {
                padding: 15px 10px;
            }
            
            .login-container {
                padding: 30px 25px;
                max-width: 100%;
                margin: auto;
            }
            
            .logo-section h1 {
                font-size: 22px;
            }
            
            .logo-section p {
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .logo-background {
                width: 280px;
                height: 280px;
            }
            
            body {
                padding: 10px;
                align-items: flex-start;
                padding-top: 30px;
            }
            
            .login-container {
                padding: 25px 20px;
                margin: 0;
            }
            
            .logo-section {
                margin-bottom: 25px;
                padding-bottom: 15px;
            }
            
            .logo-section h1 {
                font-size: 20px;
            }
            
            .logo-section p {
                font-size: 12px;
            }
            
            .form-group {
                margin-bottom: 18px;
            }
            
            .form-group input {
                padding: 12px 15px;
                font-size: 16px; /* Prevents auto-zoom on iOS */
            }
            
            .password-wrapper input {
                padding-right: 45px;
            }
            
            .toggle-password {
                right: 12px;
                padding: 8px;
            }
            
            .toggle-password svg {
                width: 22px;
                height: 22px;
            }
            
            .btn-login {
                padding: 13px;
                font-size: 14px;
                margin-top: 5px;
            }
            
            .remember-section {
                margin-bottom: 18px;
            }
            
            .remember-section input[type="checkbox"] {
                width: 18px;
                height: 18px;
            }
            
            .corner-decor {
                width: 45px;
                height: 45px;
            }
            
            .corner-decor.top-left {
                top: 10px;
                left: 10px;
            }
            
            .corner-decor.bottom-right {
                bottom: 10px;
                right: 10px;
            }
        }
        
        @media (max-width: 360px) {
            .logo-background {
                width: 240px;
                height: 240px;
            }
            
            body {
                padding: 10px 5px;
                padding-top: 20px;
            }
            
            .login-container {
                padding: 20px 15px;
            }
            
            .logo-section h1 {
                font-size: 18px;
            }
        }
        
        /* Touch-friendly improvements */
        @media (hover: none) and (pointer: coarse) {
            .btn-login {
                padding: 15px;
            }
            
            .toggle-password {
                padding: 10px;
            }
            
            .remember-section label {
                padding: 5px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Logo Logistik Background - Center -->
    <div class="logo-background"></div>

    <!-- Animated particles container -->
    <div id="particles-container"></div>

    <div class="login-container">
        <div class="corner-decor top-left"></div>
        <div class="corner-decor bottom-right"></div>
        
        <div class="logo-section">
            <h1>POLRES PANGANDARAN</h1>
            <p>Sistem Data Tanah & Bangunan</p>
        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" 
                       placeholder="Masukkan username" 
                       value="{{ old('username') }}" 
                       required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" 
                           placeholder="Masukkan password" required>
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <!-- Eye Icon (hidden) -->
                        <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="display: none;">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                        </svg>
                        <!-- Eye Slash Icon (visible) -->
                        <svg id="eye-slash-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="remember-section">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">LOGIN</button>
        </form>
    </div>

    <script>
        // Password Toggle Function
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeSlashIcon = document.getElementById('eye-slash-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.style.display = 'block';
                eyeSlashIcon.style.display = 'none';
            } else {
                passwordInput.type = 'password';
                eyeIcon.style.display = 'none';
                eyeSlashIcon.style.display = 'block';
            }
        }

        // Particles Animation
        function createParticles() {
            const container = document.getElementById('particles-container');
            const particleCount = 15;
            const colors = ['rgba(218, 165, 32, 0.3)', 'rgba(255, 255, 255, 0.2)', 'rgba(139, 0, 0, 0.2)'];
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.width = Math.random() * 80 + 40 + 'px';
                particle.style.height = particle.style.width;
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.animationDelay = Math.random() * 20 + 's';
                particle.style.animationDuration = Math.random() * 10 + 15 + 's';
                container.appendChild(particle);
            }
        }

        // Initialize particles on page load
        window.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>
</html>