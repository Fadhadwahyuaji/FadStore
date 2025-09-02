@extends('layouts.auth', ['title' => 'Masuk ke Akun Anda - FadStore'])

@section('content')
    <!-- Enhanced Login Page -->
    <div class="login-container">
        <div class="container-fluid">
            <div class="row min-vh-100">
                <!-- Left Side - Login Form -->
                <div class="col-lg-6 d-flex align-items-center justify-content-center p-4">
                    <div class="login-form-container animate__animated animate__fadeInUp">
                        <!-- Brand Logo -->
                        <div class="login-brand text-center mb-4">
                            <img src="{{ asset('assets/images/fadstore.png') }}" alt="FadStore" class="brand-logo">
                            <h2 class="brand-title mt-3">Selamat Datang Kembali</h2>
                            <p class="brand-subtitle">Masuk ke akun FadStore Anda dan nikmati pengalaman belanja terbaik</p>
                        </div>

                        <!-- Login Form Card -->
                        <div class="login-card">
                            <div class="card-body p-4">
                                <!-- Social Login Options -->
                                <div class="social-login mb-4">
                                    <button type="button" class="social-btn google-btn">
                                        <i class="fab fa-google"></i>
                                        <span>Masuk dengan Google</span>
                                    </button>
                                    <button type="button" class="social-btn facebook-btn">
                                        <i class="fab fa-facebook-f"></i>
                                        <span>Masuk dengan Facebook</span>
                                    </button>
                                </div>

                                <!-- Divider -->
                                <div class="divider">
                                    <span>atau masuk dengan email</span>
                                </div>

                                <!-- Alert Messages -->
                                @if (session('status'))
                                    <div class="custom-alert alert-info animate__animated animate__fadeInDown">
                                        <i class="fas fa-info-circle"></i>
                                        <div class="alert-content">
                                            <div class="alert-title">Informasi</div>
                                            <div class="alert-message">{{ session('status') }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="custom-alert alert-danger animate__animated animate__shakeX">
                                        <i class="fas fa-exclamation-circle"></i>
                                        <div class="alert-content">
                                            <div class="alert-title">Login Gagal</div>
                                            <div class="alert-message">
                                                @foreach ($errors->all() as $error)
                                                    {{ $error }}<br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Login Form -->
                                <form method="POST" action="{{ route('login') }}" class="login-form" id="loginForm">
                                    @csrf

                                    <!-- Email Field -->
                                    <div class="form-group">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope me-2"></i>Email Address
                                        </label>
                                        <div class="input-wrapper">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus
                                                placeholder="Masukkan email Anda">
                                            <div class="input-icon">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password Field -->
                                    <div class="form-group">
                                        <label for="password" class="form-label">
                                            <i class="fas fa-lock me-2"></i>Password
                                        </label>
                                        <div class="input-wrapper">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password"
                                                placeholder="Masukkan password Anda">
                                            <div class="input-icon password-toggle" onclick="togglePassword()">
                                                <i class="fas fa-eye" id="passwordToggleIcon"></i>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Remember Me & Forgot Password -->
                                    <div class="form-options">
                                        <div class="form-check custom-checkbox">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                Ingat saya
                                            </label>
                                        </div>

                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="forgot-password">
                                                Lupa password?
                                            </a>
                                        @endif
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="login-btn" id="loginBtn">
                                        <span class="btn-text">
                                            <i class="fas fa-sign-in-alt me-2"></i>
                                            Masuk Sekarang
                                        </span>
                                        <span class="btn-loading d-none">
                                            <i class="fas fa-spinner fa-spin me-2"></i>
                                            Memproses...
                                        </span>
                                    </button>
                                </form>

                                <!-- Register Link -->
                                <div class="register-link text-center mt-4">
                                    <p class="mb-0">
                                        Belum punya akun?
                                        <a href="{{ route('register') }}" class="register-btn">
                                            Daftar Sekarang
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Security Info -->
                        <div class="security-info mt-4">
                            <div class="security-features">
                                <div class="feature-item">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Keamanan SSL</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-lock"></i>
                                    <span>Data Terenkripsi</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-user-shield"></i>
                                    <span>Privasi Terjaga</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Hero Section -->
                <div class="col-lg-6 d-none d-lg-block p-0">
                    <div class="login-hero">
                        <div class="hero-overlay"></div>
                        <div class="hero-content">
                            <div class="hero-text animate__animated animate__fadeInRight">
                                <h1 class="hero-title">
                                    Temukan Produk
                                    <span class="highlight">Terbaik</span>
                                    untuk Anda
                                </h1>
                                <p class="hero-description">
                                    Bergabunglah dengan ribuan pelanggan yang telah merasakan pengalaman belanja terbaik di
                                    FadStore. Dapatkan akses ke koleksi produk eksklusif dan penawaran menarik.
                                </p>

                                <!-- Features List -->
                                <div class="hero-features">
                                    <div class="feature-row">
                                        <div class="feature">
                                            <i class="fas fa-shipping-fast"></i>
                                            <span>Gratis Ongkir</span>
                                        </div>
                                        <div class="feature">
                                            <i class="fas fa-medal"></i>
                                            <span>Kualitas Premium</span>
                                        </div>
                                    </div>
                                    <div class="feature-row">
                                        <div class="feature">
                                            <i class="fas fa-undo-alt"></i>
                                            <span>7 Hari Retur</span>
                                        </div>
                                        <div class="feature">
                                            <i class="fas fa-headset"></i>
                                            <span>Support 24/7</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="hero-stats">
                                    <div class="stat-item">
                                        <div class="stat-number" data-count="10000">0</div>
                                        <div class="stat-label">Pelanggan</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number" data-count="5000">0</div>
                                        <div class="stat-label">Produk</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number" data-count="98">0</div>
                                        <div class="stat-label">% Kepuasan</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Elements -->
                        <div class="floating-elements">
                            <div class="floating-item item-1">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="floating-item item-2">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="floating-item item-3">
                                <i class="fas fa-gift"></i>
                            </div>
                            <div class="floating-item item-4">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Styles -->
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #ec4899;
            --accent-color: #10b981;
            --success-color: #059669;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f9fafb;
            --border-color: #e5e7eb;
            --white: #ffffff;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            --gradient-hero: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* Main Login Container */
        .login-container {
            min-height: 100vh;
            background: var(--bg-light);
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(99, 102, 241, 0.03) 0%, rgba(236, 72, 153, 0.03) 100%);
            pointer-events: none;
        }

        /* Login Form Container */
        .login-form-container {
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 2;
        }

        /* Brand Section */
        .login-brand {
            margin-bottom: 2rem;
        }

        .brand-logo {
            height: 60px;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
        }

        .brand-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .brand-subtitle {
            color: var(--text-light);
            font-size: 1rem;
            line-height: 1.5;
            margin-bottom: 0;
        }

        /* Login Card */
        .login-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            overflow: hidden;
            position: relative;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        /* Social Login */
        .social-login {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 12px 20px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            background: var(--white);
            color: var(--text-dark);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            cursor: pointer;
        }

        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: var(--text-dark);
        }

        .google-btn:hover {
            border-color: #ea4335;
            color: #ea4335;
        }

        .facebook-btn:hover {
            border-color: #1877f2;
            color: #1877f2;
        }

        .social-btn i {
            font-size: 1.25rem;
        }

        /* Divider */
        .divider {
            position: relative;
            text-align: center;
            margin: 2rem 0;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--border-color);
        }

        .divider span {
            background: var(--white);
            padding: 0 1rem;
            color: var(--text-light);
            font-size: 0.875rem;
        }

        /* Custom Alerts */
        .custom-alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border: none;
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            color: #1e40af;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        .custom-alert i {
            font-size: 1.25rem;
            margin-top: 2px;
        }

        .alert-content .alert-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .alert-message {
            font-size: 0.875rem;
            line-height: 1.4;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        /* Input Wrapper */
        .input-wrapper {
            position: relative;
        }

        .form-control {
            padding: 12px 16px;
            padding-right: 45px;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--bg-light);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .form-control.is-invalid {
            border-color: var(--danger-color);
        }

        .form-control.is-invalid:focus {
            border-color: var(--danger-color);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        /* Input Icons */
        .input-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .input-icon:hover {
            color: var(--primary-color);
            background: rgba(99, 102, 241, 0.1);
        }

        .password-toggle {
            user-select: none;
        }

        /* Invalid Feedback */
        .invalid-feedback {
            display: block;
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        /* Form Options */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .custom-checkbox .form-check-input {
            border-radius: 6px;
            border: 2px solid var(--border-color);
            width: 18px;
            height: 18px;
        }

        .custom-checkbox .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-label {
            color: var(--text-dark);
            font-weight: 500;
            cursor: pointer;
        }

        .forgot-password {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .forgot-password:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Login Button */
        .login-btn {
            width: 100%;
            padding: 14px 20px;
            background: var(--gradient-primary);
            border: none;
            border-radius: 12px;
            color: var(--white);
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .login-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .login-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-text,
        .btn-loading {
            position: relative;
            z-index: 1;
        }

        /* Register Link */
        .register-link {
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .register-btn {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .register-btn:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Security Info */
        .security-info {
            text-align: center;
        }

        .security-features {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.875rem;
        }

        .feature-item i {
            color: var(--primary-color);
            font-size: 1.25rem;
        }

        /* Hero Section */
        .login-hero {
            height: 100vh;
            background: var(--gradient-hero);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
            padding: 2rem;
            max-width: 600px;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .highlight {
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 1.125rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        /* Hero Features */
        .hero-features {
            margin-bottom: 3rem;
        }

        .feature-row {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 1rem;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .feature i {
            color: #fbbf24;
            font-size: 1.25rem;
        }

        /* Hero Stats */
        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #fbbf24;
            display: block;
        }

        .stat-label {
            font-size: 0.875rem;
            opacity: 0.8;
            margin-top: 0.25rem;
        }

        /* Floating Elements */
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 1;
        }

        .floating-item {
            position: absolute;
            color: rgba(255, 255, 255, 0.1);
            font-size: 2rem;
            animation: float 6s ease-in-out infinite;
        }

        .item-1 {
            top: 20%;
            left: 15%;
            animation-delay: 0s;
        }

        .item-2 {
            top: 60%;
            right: 20%;
            animation-delay: 2s;
        }

        .item-3 {
            bottom: 30%;
            left: 10%;
            animation-delay: 4s;
        }

        .item-4 {
            top: 40%;
            right: 10%;
            animation-delay: 1s;
        }

        /* Animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-20px) rotate(120deg);
            }

            66% {
                transform: translateY(20px) rotate(240deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .feature-row {
                flex-direction: column;
                gap: 1rem;
                align-items: center;
            }

            .hero-stats {
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .login-form-container {
                max-width: 100%;
                padding: 1rem;
            }

            .brand-title {
                font-size: 1.75rem;
            }

            .social-login {
                flex-direction: column;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .security-features {
                gap: 1rem;
            }

            .hero-stats {
                gap: 1.5rem;
            }

            .stat-number {
                font-size: 2rem;
            }
        }

        @media (max-width: 640px) {
            .login-card {
                margin: 1rem;
                border-radius: 16px;
            }

            .brand-subtitle {
                font-size: 0.875rem;
            }

            .form-control {
                padding: 10px 14px;
                padding-right: 40px;
            }

            .hero-content {
                padding: 1rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-description {
                font-size: 1rem;
            }
        }

        /* Loading States */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Focus visible for accessibility */
        .form-control:focus-visible,
        .login-btn:focus-visible,
        .social-btn:focus-visible {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize animations and interactions
            initializeFormInteractions();
            initializeCounters();
            initializeAnimations();

            // Auto-focus first input on desktop
            if (window.innerWidth > 768) {
                setTimeout(() => {
                    document.getElementById('email').focus();
                }, 500);
            }
        });

        // Form interactions
        function initializeFormInteractions() {
            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const loginBtn = document.getElementById('loginBtn');

            // Enhanced form validation
            form.addEventListener('submit', function(e) {
                // Show loading state
                const btnText = loginBtn.querySelector('.btn-text');
                const btnLoading = loginBtn.querySelector('.btn-loading');

                btnText.classList.add('d-none');
                btnLoading.classList.remove('d-none');
                loginBtn.disabled = true;

                // Add form loading class
                form.classList.add('loading');
            });

            // Input animations
            [emailInput, passwordInput].forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.input-wrapper').style.transform = 'translateY(-2px)';
                    this.closest('.form-group').style.transform = 'scale(1.02)';
                });

                input.addEventListener('blur', function() {
                    this.closest('.input-wrapper').style.transform = 'translateY(0)';
                    this.closest('.form-group').style.transform = 'scale(1)';
                });

                // Real-time validation feedback
                input.addEventListener('input', function() {
                    validateInput(this);
                });
            });

            // Social login buttons
            document.querySelectorAll('.social-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    this.style.transform = 'translateY(-2px)';
                    setTimeout(() => {
                        this.style.transform = 'translateY(0)';
                        showNotification('info', 'Fitur login sosial akan segera tersedia!');
                    }, 150);
                });
            });
        }

        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('passwordToggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'fas fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'fas fa-eye';
            }

            // Add feedback animation
            toggleIcon.style.transform = 'scale(1.2)';
            setTimeout(() => {
                toggleIcon.style.transform = 'scale(1)';
            }, 150);
        }

        // Input validation
        function validateInput(input) {
            const value = input.value.trim();
            const inputWrapper = input.closest('.input-wrapper');

            // Remove existing validation classes
            input.classList.remove('is-valid', 'is-invalid');

            if (input.type === 'email') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (value && emailRegex.test(value)) {
                    input.classList.add('is-valid');
                    inputWrapper.style.borderColor = 'var(--success-color)';
                } else if (value) {
                    input.classList.add('is-invalid');
                    inputWrapper.style.borderColor = 'var(--danger-color)';
                }
            } else if (input.type === 'password' || input.type === 'text') {
                if (value && value.length >= 6) {
                    input.classList.add('is-valid');
                    inputWrapper.style.borderColor = 'var(--success-color)';
                } else if (value) {
                    input.classList.add('is-invalid');
                    inputWrapper.style.borderColor = 'var(--danger-color)';
                }
            }

            if (!value) {
                inputWrapper.style.borderColor = '';
            }
        }

        // Initialize counter animations
        function initializeCounters() {
            const counters = document.querySelectorAll('.stat-number');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            });

            counters.forEach(counter => {
                observer.observe(counter);
            });
        }

        // Animate counter
        function animateCounter(element) {
            const target = parseInt(element.dataset.count);
            const duration = 2000;
            const start = performance.now();

            const animate = (currentTime) => {
                const elapsed = currentTime - start;
                const progress = Math.min(elapsed / duration, 1);

                // Easing function
                const easeOut = 1 - Math.pow(1 - progress, 3);
                const current = Math.floor(easeOut * target);

                element.textContent = current.toLocaleString();

                if (progress < 1) {
                    requestAnimationFrame(animate);
                } else {
                    element.textContent = target.toLocaleString();
                }
            };

            requestAnimationFrame(animate);
        }

        // Initialize scroll and intersection animations
        function initializeAnimations() {
            // Parallax effect for floating elements
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const floatingItems = document.querySelectorAll('.floating-item');

                floatingItems.forEach((item, index) => {
                    const speed = (index + 1) * 0.5;
                    item.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });

            // Enhanced intersection observer for elements
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe elements
            document.querySelectorAll('.login-form-container, .hero-content').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'all 0.8s ease-out';
                observer.observe(el);
            });
        }

        // Show notification
        function showNotification(type, message) {
            const notification = document.createElement('div');
            const iconMap = {
                'success': 'fas fa-check-circle',
                'error': 'fas fa-exclamation-circle',
                'warning': 'fas fa-exclamation-triangle',
                'info': 'fas fa-info-circle'
            };

            const colorMap = {
                'success': '#059669',
                'error': '#dc2626',
                'warning': '#d97706',
                'info': '#2563eb'
            };

            notification.innerHTML = `
            <div style="display: flex; align-items: center; gap: 12px; padding: 16px 20px; background: white; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-left: 4px solid ${colorMap[type]}; min-width: 300px; max-width: 500px;">
                <i class="${iconMap[type]}" style="color: ${colorMap[type]}; font-size: 1.25rem;"></i>
                <span style="flex: 1; color: var(--text-dark); font-weight: 500;">${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" style="background: none; border: none; color: var(--text-light); cursor: pointer; padding: 4px;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

            notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            animation: slideInRight 0.3s ease;
        `;

            document.body.appendChild(notification);

            // Auto remove
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    notification.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => {
                        if (document.body.contains(notification)) {
                            document.body.removeChild(notification);
                        }
                    }, 300);
                }
            }, 5000);
        }

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
        .is-valid {
            border-color: var(--success-color) !important;
        }
        .is-invalid {
            border-color: var(--danger-color) !important;
        }
    `;
        document.head.appendChild(style);
    </script>
@endsection
