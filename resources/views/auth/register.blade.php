@extends('layouts.auth', ['title' => 'Daftar Akun Baru - FadStore'])

@section('content')
    <!-- Enhanced Register Page -->
    <div class="register-container">
        <div class="container-fluid">
            <div class="row min-vh-100">
                <!-- Left Side - Hero Section -->
                <div class="col-lg-6 d-none d-lg-block p-0">
                    <div class="register-hero">
                        <div class="hero-overlay"></div>
                        <div class="hero-content">
                            <div class="hero-text animate__animated animate__fadeInLeft">
                                <h1 class="hero-title">
                                    Bergabung dengan
                                    <span class="highlight">FadStore</span>
                                    Sekarang!
                                </h1>
                                <p class="hero-description">
                                    Dapatkan akses ke ribuan produk berkualitas, penawaran eksklusif, dan pengalaman belanja
                                    yang tak terlupakan. Mulai perjalanan belanja Anda hari ini!
                                </p>

                                <!-- Benefits List -->
                                <div class="hero-benefits">
                                    <div class="benefit-item">
                                        <div class="benefit-icon">
                                            <i class="fas fa-gift"></i>
                                        </div>
                                        <div class="benefit-text">
                                            <h5>Bonus Member Baru</h5>
                                            <p>Dapatkan voucher diskon 25% untuk pembelian pertama</p>
                                        </div>
                                    </div>
                                    <div class="benefit-item">
                                        <div class="benefit-icon">
                                            <i class="fas fa-crown"></i>
                                        </div>
                                        <div class="benefit-text">
                                            <h5>Program Loyalitas</h5>
                                            <p>Kumpulkan poin setiap pembelian dan tukar dengan hadiah</p>
                                        </div>
                                    </div>
                                    <div class="benefit-item">
                                        <div class="benefit-icon">
                                            <i class="fas fa-bell"></i>
                                        </div>
                                        <div class="benefit-text">
                                            <h5>Notifikasi Eksklusif</h5>
                                            <p>Jadilah yang pertama tahu tentang produk baru dan promo</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Trust Indicators -->
                                <div class="trust-indicators">
                                    <div class="trust-item">
                                        <i class="fas fa-shield-check"></i>
                                        <span>Transaksi Aman</span>
                                    </div>
                                    <div class="trust-item">
                                        <i class="fas fa-user-check"></i>
                                        <span>Data Terlindungi</span>
                                    </div>
                                    <div class="trust-item">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span>Terpercaya</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Elements -->
                        <div class="floating-elements">
                            <div class="floating-item item-1">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="floating-item item-2">
                                <i class="fas fa-percent"></i>
                            </div>
                            <div class="floating-item item-3">
                                <i class="fas fa-gem"></i>
                            </div>
                            <div class="floating-item item-4">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <div class="floating-item item-5">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Register Form -->
                <div class="col-lg-6 d-flex align-items-center justify-content-center p-4">
                    <div class="register-form-container animate__animated animate__fadeInUp">
                        <!-- Brand Logo -->
                        <div class="register-brand text-center mb-4">
                            <img src="{{ asset('assets/images/fadstore.png') }}" alt="FadStore" class="brand-logo">
                            <h2 class="brand-title mt-3">Daftar Akun Baru</h2>
                            <p class="brand-subtitle">Isi form di bawah untuk membuat akun FadStore Anda</p>
                        </div>

                        <!-- Register Form Card -->
                        <div class="register-card">
                            <div class="card-body p-4">
                                <!-- Progress Indicator -->
                                <div class="progress-indicator mb-4">
                                    <div class="progress-step active" data-step="1">
                                        <div class="step-number">1</div>
                                        <div class="step-label">Info Dasar</div>
                                    </div>
                                    <div class="progress-line"></div>
                                    <div class="progress-step" data-step="2">
                                        <div class="step-number">2</div>
                                        <div class="step-label">Keamanan</div>
                                    </div>
                                    <div class="progress-line"></div>
                                    <div class="progress-step" data-step="3">
                                        <div class="step-number">3</div>
                                        <div class="step-label">Selesai</div>
                                    </div>
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
                                            <div class="alert-title">Pendaftaran Gagal</div>
                                            <div class="alert-message">
                                                @foreach ($errors->all() as $error)
                                                    {{ $error }}<br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Register Form -->
                                <form method="POST" action="{{ route('register') }}" class="register-form"
                                    id="registerForm">
                                    @csrf

                                    <!-- Step 1: Basic Info -->
                                    <div class="form-step active" data-step="1">
                                        <!-- Name Field -->
                                        <div class="form-group">
                                            <label for="name" class="form-label">
                                                <i class="fas fa-user me-2"></i>Nama Lengkap
                                            </label>
                                            <div class="input-wrapper">
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                                    placeholder="Masukkan nama lengkap Anda">
                                                <div class="input-icon">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        <i class="fas fa-exclamation-circle me-1"></i>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Email Field -->
                                        <div class="form-group">
                                            <label for="email" class="form-label">
                                                <i class="fas fa-envelope me-2"></i>Email Address
                                            </label>
                                            <div class="input-wrapper">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" placeholder="Masukkan alamat email Anda">
                                                <div class="input-icon">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        <i class="fas fa-exclamation-circle me-1"></i>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="input-help">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Kami akan mengirim verifikasi ke email ini
                                            </div>
                                        </div>

                                        <!-- Phone Field (Optional) -->
                                        <div class="form-group">
                                            <label for="phone" class="form-label">
                                                <i class="fas fa-phone me-2"></i>Nomor Telepon
                                                <span class="optional">(Opsional)</span>
                                            </label>
                                            <div class="input-wrapper">
                                                <input id="phone" type="tel" class="form-control" name="phone"
                                                    value="{{ old('phone') }}" autocomplete="tel"
                                                    placeholder="Contoh: 08123456789">
                                                <div class="input-icon">
                                                    <i class="fas fa-phone"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Next Button -->
                                        <button type="button" class="next-btn" onclick="nextStep(1)">
                                            <span>Selanjutnya</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </div>

                                    <!-- Step 2: Security -->
                                    <div class="form-step" data-step="2">
                                        <!-- Password Field -->
                                        <div class="form-group">
                                            <label for="password" class="form-label">
                                                <i class="fas fa-lock me-2"></i>Password
                                            </label>
                                            <div class="input-wrapper">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password"
                                                    placeholder="Buat password yang kuat">
                                                <div class="input-icon password-toggle"
                                                    onclick="togglePassword('password')">
                                                    <i class="fas fa-eye" id="passwordToggleIcon"></i>
                                                </div>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        <i class="fas fa-exclamation-circle me-1"></i>
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <!-- Password Strength Indicator -->
                                            <div class="password-strength" id="passwordStrength">
                                                <div class="strength-bar">
                                                    <div class="strength-fill" id="strengthFill"></div>
                                                </div>
                                                <div class="strength-text" id="strengthText">Masukkan password</div>
                                            </div>
                                        </div>

                                        <!-- Confirm Password Field -->
                                        <div class="form-group">
                                            <label for="password_confirmation" class="form-label">
                                                <i class="fas fa-lock me-2"></i>Konfirmasi Password
                                            </label>
                                            <div class="input-wrapper">
                                                <input id="password_confirmation" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password"
                                                    placeholder="Ulangi password Anda">
                                                <div class="input-icon password-toggle"
                                                    onclick="togglePassword('password_confirmation')">
                                                    <i class="fas fa-eye" id="passwordConfirmToggleIcon"></i>
                                                </div>
                                            </div>
                                            <div class="password-match" id="passwordMatch"></div>
                                        </div>

                                        <!-- Hidden Role Field -->
                                        <input type="hidden" name="role" value="customer">

                                        <!-- Terms & Conditions -->
                                        <div class="form-group">
                                            <div class="form-check custom-checkbox">
                                                <input class="form-check-input" type="checkbox" id="terms"
                                                    name="terms" required>
                                                <label class="form-check-label" for="terms">
                                                    Saya menyetujui
                                                    <a href="#" class="terms-link">Syarat & Ketentuan</a>
                                                    dan
                                                    <a href="#" class="terms-link">Kebijakan Privasi</a>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Marketing Consent -->
                                        <div class="form-group">
                                            <div class="form-check custom-checkbox">
                                                <input class="form-check-input" type="checkbox" id="marketing"
                                                    name="marketing">
                                                <label class="form-check-label" for="marketing">
                                                    Saya ingin menerima email tentang penawaran dan produk baru
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Navigation Buttons -->
                                        <div class="form-navigation">
                                            <button type="button" class="prev-btn" onclick="prevStep(2)">
                                                <i class="fas fa-arrow-left"></i>
                                                <span>Kembali</span>
                                            </button>
                                            <button type="submit" class="register-btn" id="registerBtn">
                                                <span class="btn-text">
                                                    <i class="fas fa-user-plus me-2"></i>
                                                    Daftar Sekarang
                                                </span>
                                                <span class="btn-loading d-none">
                                                    <i class="fas fa-spinner fa-spin me-2"></i>
                                                    Memproses...
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <!-- Login Link -->
                                <div class="login-link text-center mt-4">
                                    <p class="mb-0">
                                        Sudah punya akun?
                                        <a href="{{ route('login') }}" class="login-btn-link">
                                            Masuk Sekarang
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Success Message -->
                        <div class="success-info mt-4 d-none" id="successInfo">
                            <div class="success-content">
                                <div class="success-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="success-text">
                                    <h5>Pendaftaran Berhasil!</h5>
                                    <p>Silakan cek email Anda untuk verifikasi akun</p>
                                </div>
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

        /* Main Register Container */
        .register-container {
            min-height: 100vh;
            background: var(--bg-light);
            position: relative;
            overflow: hidden;
        }

        .register-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(99, 102, 241, 0.03) 0%, rgba(236, 72, 153, 0.03) 100%);
            pointer-events: none;
        }

        /* Register Form Container */
        .register-form-container {
            width: 100%;
            max-width: 520px;
            position: relative;
            z-index: 2;
        }

        /* Brand Section */
        .register-brand {
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

        /* Register Card */
        .register-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            overflow: hidden;
            position: relative;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        /* Progress Indicator */
        .progress-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--border-color);
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
        }

        .progress-step.active .step-number {
            background: var(--gradient-primary);
            color: white;
        }

        .step-label {
            font-size: 0.75rem;
            color: var(--text-light);
            font-weight: 500;
        }

        .progress-step.active .step-label {
            color: var(--primary-color);
        }

        .progress-line {
            width: 60px;
            height: 2px;
            background: var(--border-color);
            margin: 0 1rem;
            margin-bottom: 1.5rem;
        }

        /* Form Steps */
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
            animation: fadeInUp 0.5s ease;
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

        .optional {
            color: var(--text-light);
            font-weight: 400;
            font-size: 0.75rem;
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

        .form-control.is-valid {
            border-color: var(--success-color);
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

        /* Input Help Text */
        .input-help {
            font-size: 0.75rem;
            color: var(--text-light);
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
        }

        /* Invalid Feedback */
        .invalid-feedback {
            display: block;
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        /* Password Strength Indicator */
        .password-strength {
            margin-top: 0.5rem;
        }

        .strength-bar {
            height: 4px;
            background: var(--border-color);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 0.25rem;
        }

        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-text {
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* Password Match Indicator */
        .password-match {
            font-size: 0.75rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        .password-match.match {
            color: var(--success-color);
        }

        .password-match.no-match {
            color: var(--danger-color);
        }

        /* Custom Checkbox */
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
            line-height: 1.4;
        }

        .terms-link {
            color: var(--primary-color);
            text-decoration: none;
        }

        .terms-link:hover {
            text-decoration: underline;
        }

        /* Navigation Buttons */
        .form-navigation {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 2rem;
        }

        .next-btn,
        .prev-btn,
        .register-btn {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .next-btn {
            background: var(--gradient-primary);
            color: white;
            width: 100%;
            justify-content: center;
        }

        .prev-btn {
            background: var(--border-color);
            color: var(--text-dark);
            flex: 0 0 auto;
        }

        .register-btn {
            background: var(--gradient-primary);
            color: white;
            flex: 1;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .next-btn:hover,
        .register-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .prev-btn:hover {
            background: var(--text-light);
            color: white;
        }

        .register-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .register-btn::before {
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

        .register-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-text,
        .btn-loading {
            position: relative;
            z-index: 1;
        }

        /* Login Link */
        .login-link {
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .login-btn-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .login-btn-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Success Info */
        .success-info {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .success-content {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
        }

        .success-icon {
            color: var(--success-color);
            font-size: 2rem;
        }

        .success-text h5 {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .success-text p {
            color: var(--text-light);
            margin-bottom: 0;
            font-size: 0.875rem;
        }

        /* Hero Section */
        .register-hero {
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
            text-align: left;
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

        /* Hero Benefits */
        .hero-benefits {
            margin-bottom: 2rem;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .benefit-icon {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 12px;
            color: #fbbf24;
            font-size: 1.25rem;
            flex: 0 0 auto;
        }

        .benefit-text h5 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .benefit-text p {
            font-size: 0.875rem;
            opacity: 0.8;
            margin-bottom: 0;
            line-height: 1.4;
        }

        /* Trust Indicators */
        .trust-indicators {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .trust-item i {
            color: #fbbf24;
            font-size: 1.125rem;
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
            top: 15%;
            left: 10%;
            animation-delay: 0s;
        }

        .item-2 {
            top: 25%;
            right: 15%;
            animation-delay: 1s;
        }

        .item-3 {
            bottom: 35%;
            left: 15%;
            animation-delay: 2s;
        }

        .item-4 {
            top: 50%;
            right: 10%;
            animation-delay: 3s;
        }

        .item-5 {
            bottom: 20%;
            right: 25%;
            animation-delay: 4s;
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

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .benefit-item {
                margin-bottom: 1rem;
            }

            .trust-indicators {
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .register-form-container {
                max-width: 100%;
                padding: 1rem;
            }

            .brand-title {
                font-size: 1.75rem;
            }

            .progress-indicator {
                margin-bottom: 1.5rem;
            }

            .step-number {
                width: 35px;
                height: 35px;
            }

            .progress-line {
                width: 40px;
            }

            .form-navigation {
                flex-direction: column;
            }

            .prev-btn {
                flex: 1;
                justify-content: center;
            }
        }

        @media (max-width: 640px) {
            .register-card {
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

            .benefit-item {
                flex-direction: column;
                text-align: center;
            }

            .trust-indicators {
                justify-content: center;
            }
        }

        /* Loading States */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Focus visible for accessibility */
        .form-control:focus-visible,
        .register-btn:focus-visible,
        .next-btn:focus-visible,
        .prev-btn:focus-visible {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        let currentStep = 1;

        document.addEventListener('DOMContentLoaded', function() {
            initializeFormInteractions();
            initializeValidation();
            initializeAnimations();

            // Auto-focus first input on desktop
            if (window.innerWidth > 768) {
                setTimeout(() => {
                    document.getElementById('name').focus();
                }, 500);
            }
        });

        // Step Navigation
        function nextStep(step) {
            if (validateStep(step)) {
                currentStep = step + 1;
                showStep(currentStep);
                updateProgressIndicator();
            }
        }

        function prevStep(step) {
            currentStep = step - 1;
            showStep(currentStep);
            updateProgressIndicator();
        }

        function showStep(step) {
            document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
            document.querySelector(`[data-step="${step}"]`).classList.add('active');
        }

        function updateProgressIndicator() {
            document.querySelectorAll('.progress-step').forEach((step, index) => {
                if (index + 1 <= currentStep) {
                    step.classList.add('active');
                } else {
                    step.classList.remove('active');
                }
            });
        }

        // Step Validation
        function validateStep(step) {
            const currentStepElement = document.querySelector(`[data-step="${step}"]`);
            const inputs = currentStepElement.querySelectorAll('input[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    showFieldError(input, 'Field ini wajib diisi');
                    isValid = false;
                } else if (input.type === 'email' && !validateEmail(input.value)) {
                    showFieldError(input, 'Format email tidak valid');
                    isValid = false;
                } else {
                    clearFieldError(input);
                }
            });

            return isValid;
        }

        // Form interactions
        function initializeFormInteractions() {
            const form = document.getElementById('registerForm');
            const registerBtn = document.getElementById('registerBtn');

            // Enhanced form validation
            form.addEventListener('submit', function(e) {
                if (!document.getElementById('terms').checked) {
                    e.preventDefault();
                    showNotification('error', 'Anda harus menyetujui syarat dan ketentuan');
                    return;
                }

                // Show loading state
                const btnText = registerBtn.querySelector('.btn-text');
                const btnLoading = registerBtn.querySelector('.btn-loading');

                btnText.classList.add('d-none');
                btnLoading.classList.remove('d-none');
                registerBtn.disabled = true;

                // Add form loading class
                form.classList.add('loading');
            });

            // Input animations and validation
            document.querySelectorAll('.form-control').forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.input-wrapper').style.transform = 'translateY(-2px)';
                    this.closest('.form-group').style.transform = 'scale(1.02)';
                });

                input.addEventListener('blur', function() {
                    this.closest('.input-wrapper').style.transform = 'translateY(0)';
                    this.closest('.form-group').style.transform = 'scale(1)';
                    validateInput(this);
                });

                input.addEventListener('input', function() {
                    if (this.id === 'password') {
                        checkPasswordStrength(this.value);
                        checkPasswordMatch();
                    } else if (this.id === 'password_confirmation') {
                        checkPasswordMatch();
                    } else {
                        validateInput(this);
                    }
                });
            });
        }

        // Initialize validation
        function initializeValidation() {
            // Password strength checker
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');

            passwordInput.addEventListener('input', function() {
                checkPasswordStrength(this.value);
                if (confirmPasswordInput.value) {
                    checkPasswordMatch();
                }
            });

            confirmPasswordInput.addEventListener('input', function() {
                checkPasswordMatch();
            });
        }

        // Toggle password visibility
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(inputId === 'password' ? 'passwordToggleIcon' :
                'passwordConfirmToggleIcon');

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

        // Check password strength
        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');

            let strength = 0;
            let feedback = '';

            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            const strengthLevels = [{
                    text: 'Sangat Lemah',
                    color: '#ef4444',
                    width: '20%'
                },
                {
                    text: 'Lemah',
                    color: '#f59e0b',
                    width: '40%'
                },
                {
                    text: 'Sedang',
                    color: '#eab308',
                    width: '60%'
                },
                {
                    text: 'Kuat',
                    color: '#22c55e',
                    width: '80%'
                },
                {
                    text: 'Sangat Kuat',
                    color: '#059669',
                    width: '100%'
                }
            ];

            if (password.length === 0) {
                strengthBar.style.width = '0%';
                strengthText.textContent = 'Masukkan password';
                strengthText.style.color = 'var(--text-light)';
            } else {
                const level = strengthLevels[strength - 1] || strengthLevels[0];
                strengthBar.style.width = level.width;
                strengthBar.style.backgroundColor = level.color;
                strengthText.textContent = level.text;
                strengthText.style.color = level.color;
            }
        }

        // Check password match
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchIndicator = document.getElementById('passwordMatch');

            if (confirmPassword.length === 0) {
                matchIndicator.textContent = '';
                matchIndicator.className = 'password-match';
            } else if (password === confirmPassword) {
                matchIndicator.innerHTML = '<i class="fas fa-check-circle me-1"></i>Password cocok';
                matchIndicator.className = 'password-match match';
            } else {
                matchIndicator.innerHTML = '<i class="fas fa-times-circle me-1"></i>Password tidak cocok';
                matchIndicator.className = 'password-match no-match';
            }
        }

        // Input validation
        function validateInput(input) {
            const value = input.value.trim();

            // Remove existing validation classes
            input.classList.remove('is-valid', 'is-invalid');
            clearFieldError(input);

            if (input.type === 'email') {
                if (value && validateEmail(value)) {
                    input.classList.add('is-valid');
                } else if (value) {
                    input.classList.add('is-invalid');
                    showFieldError(input, 'Format email tidak valid');
                }
            } else if (input.type === 'text' || input.type === 'tel') {
                if (input.required && value.length === 0) {
                    input.classList.add('is-invalid');
                    showFieldError(input, 'Field ini wajib diisi');
                } else if (value.length > 0) {
                    if (input.id === 'name' && value.length < 2) {
                        input.classList.add('is-invalid');
                        showFieldError(input, 'Nama minimal 2 karakter');
                    } else {
                        input.classList.add('is-valid');
                    }
                }
            }
        }

        // Email validation
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Show field error
        function showFieldError(input, message) {
            clearFieldError(input);

            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback';
            errorDiv.innerHTML = `<i class="fas fa-exclamation-circle me-1"></i>${message}`;

            input.closest('.input-wrapper').appendChild(errorDiv);
            input.classList.add('is-invalid');
        }

        // Clear field error
        function clearFieldError(input) {
            const errorDiv = input.closest('.input-wrapper').querySelector('.invalid-feedback');
            if (errorDiv) {
                errorDiv.remove();
            }
            input.classList.remove('is-invalid');
        }

        // Initialize animations
        function initializeAnimations() {
            // Parallax effect for floating elements
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const floatingItems = document.querySelectorAll('.floating-item');

                floatingItems.forEach((item, index) => {
                    const speed = (index + 1) * 0.3;
                    item.style.transform = `translateY(${scrolled * speed}px)`;
                });
            });

            // Enhanced intersection observer
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
            document.querySelectorAll('.register-form-container, .hero-content').forEach(el => {
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
    `;
        document.head.appendChild(style);
    </script>
@endsection
