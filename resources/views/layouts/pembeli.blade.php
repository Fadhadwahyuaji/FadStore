<!doctype html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0d6efd">
    <link rel="manifest" href="./manifest.json">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <title>FadStore - Your Style, Your Choice</title>

    <style>
        :root {
            --primary-color: #0d6efd;
            --primary-dark: #0b5ed7;
            --primary-light: #6ea8fe;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #0dcaf0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --white: #ffffff;
            --gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            --shadow: 0 2px 15px rgba(13, 110, 253, 0.1);
            --shadow-lg: 0 10px 30px rgba(13, 110, 253, 0.15);
            --border-radius: 10px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
            background-color: #fafbfc;
        }

        /* Enhanced Navbar Styles */
        .navbar {
            background: var(--white) !important;
            border-bottom: 1px solid rgba(13, 110, 253, 0.1);
            padding: 1rem 0;
            transition: var(--transition);
            backdrop-filter: blur(10px);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .navbar-brand img {
            transition: var(--transition);
        }

        .navbar-brand:hover img {
            transform: scale(1.05);
        }

        /* Enhanced Search Container */
        .search-container {
            max-width: 500px;
            width: 100%;
        }

        .search-input {
            border: 2px solid var(--light-color);
            border-radius: 25px;
            padding: 12px 50px 12px 20px;
            font-size: 0.95rem;
            transition: var(--transition);
            background: var(--light-color);
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            background: var(--white);
            outline: none;
        }

        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: var(--gradient);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .search-btn:hover {
            transform: translateY(-50%) scale(1.05);
            box-shadow: var(--shadow);
        }

        /* Enhanced Nav Icons */
        .nav-icon {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: var(--light-color);
            border-radius: 50%;
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .nav-icon:hover {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .nav-icon .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger-color);
            color: var(--white);
            font-size: 0.7rem;
            padding: 2px 6px;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Enhanced User Dropdown */
        .dropdown-toggle::after {
            display: none;
        }

        .user-info {
            padding: 8px 15px;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .user-info:hover {
            background: var(--light-color);
        }

        .user-avatar {
            background: var(--gradient) !important;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .dropdown-menu {
            border: none;
            box-shadow: var(--shadow-lg);
            border-radius: var(--border-radius);
            padding: 10px 0;
            margin-top: 10px;
            min-width: 220px;
        }

        .dropdown-item {
            padding: 12px 20px;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .dropdown-item:hover {
            background: var(--light-color);
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .dropdown-item i {
            width: 20px;
        }

        /* Enhanced Buttons */
        .btn-primary {
            background: var(--gradient);
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            background: var(--primary-dark);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* Mobile Menu Enhancements */
        .navbar-toggler {
            border: none;
            padding: 8px;
            border-radius: var(--border-radius);
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        /* Enhanced Footer */
        .modern-footer {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .modern-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.05"/></pattern></defs><rect width="100%" height="100%" fill="url(%23dots)"/></svg>');
        }

        .modern-footer .container {
            position: relative;
            z-index: 1;
            padding: 60px 15px 30px;
        }

        .footer-section {
            margin-bottom: 40px;
        }

        .footer-logo {
            margin-bottom: 25px;
        }

        .footer-logo img {
            filter: brightness(0) invert(1);
            transition: var(--transition);
        }

        .footer-logo:hover img {
            transform: scale(1.05);
        }

        .footer-heading {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--white);
            position: relative;
            padding-bottom: 10px;
        }

        .footer-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 2px;
            background: var(--primary-color);
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
        }

        .footer-links a:hover {
            color: var(--primary-light);
            transform: translateX(5px);
        }

        /* Enhanced Social Links */
        .social-links {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-radius: 50%;
            text-decoration: none;
            transition: var(--transition);
            backdrop-filter: blur(10px);
        }

        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(13, 110, 253, 0.3);
        }

        /* Newsletter Section */
        .newsletter-section {
            background: rgba(13, 110, 253, 0.1);
            border-radius: var(--border-radius);
            padding: 30px;
            margin-bottom: 40px;
            backdrop-filter: blur(10px);
        }

        .newsletter-form {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .newsletter-form input {
            flex: 1;
            padding: 12px 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            backdrop-filter: blur(10px);
        }

        .newsletter-form input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .newsletter-form input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .newsletter-form button {
            background: var(--gradient);
            border: none;
            border-radius: 25px;
            padding: 12px 25px;
            color: var(--white);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .newsletter-form button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* Enhanced Footer Bottom */
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 25px 0;
            margin-top: 50px;
        }

        .copyright {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .footer-bottom-links {
            display: flex;
            gap: 25px;
        }

        .footer-bottom-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .footer-bottom-links a:hover {
            color: var(--primary-light);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .search-container {
                order: 3;
                width: 100%;
                margin-top: 15px;
            }

            .navbar-nav {
                text-align: center;
            }

            .nav-item {
                margin: 5px 0;
            }

            .footer-bottom-links {
                justify-content: center;
                margin-top: 15px;
            }

            .newsletter-form {
                flex-direction: column;
            }

            .newsletter-form button {
                align-self: center;
                padding: 12px 30px;
            }
        }

        /* Loading Animation */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid var(--white);
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-color);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
    </style>
</head>

<body>
    <!-- Enhanced Modern Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" id="mainNavbar">
        <div class="container">
            <!-- Enhanced Logo -->
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/images/fadstore.png') }}" alt="FadStore" style="height: 40px;">
                {{-- <span class="d-none d-md-inline">FadStore</span> --}}
            </a>

            <!-- Mobile Icons -->
            <div class="d-flex align-items-center d-lg-none">
                <!-- Cart Icon for Mobile -->
                @auth
                    <a href="{{ route('customer.keranjang.index') }}" class="nav-icon me-2">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge rounded-pill">3</span>
                    </a>
                @else
                    <a href="{{ route('customer.keranjang.index') }}" class="nav-icon me-2">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                @endauth

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Enhanced Search Bar -->
                <div class="search-container mx-lg-auto my-3 my-lg-0">
                    <form class="position-relative" action="#" method="GET">
                        <input type="text" class="form-control search-input"
                            placeholder="Cari produk yang Anda inginkan..." name="search">
                        <button class="search-btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Enhanced Right Side -->
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <!-- Enhanced Notification Icon -->
                        <li class="nav-item mx-1">
                            <a class="nav-icon" href="#" data-bs-toggle="tooltip" title="Pesan">
                                <i class="fas fa-bell"></i>
                                <span class="badge rounded-pill">2</span>
                            </a>
                        </li>

                        <!-- Enhanced Cart Icon -->
                        <li class="nav-item mx-1 d-none d-lg-block">
                            <a class="nav-icon" href="{{ route('customer.keranjang.index') }}" data-bs-toggle="tooltip"
                                title="Keranjang">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="badge rounded-pill">3</span>
                            </a>
                        </li>

                        <!-- Enhanced Wishlist Icon -->
                        <li class="nav-item mx-1 d-none d-lg-block">
                            <a class="nav-icon" href="#" data-bs-toggle="tooltip" title="Wishlist">
                                <i class="fas fa-heart"></i>
                                <span class="badge rounded-pill">1</span>
                            </a>
                        </li>

                        <!-- Divider -->
                        <li class="nav-item mx-2 d-none d-lg-block">
                            <div class="vr" style="height: 30px; opacity: 0.3;"></div>
                        </li>

                        <!-- Enhanced User Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center user-info" href="#"
                                id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="me-2 d-none d-lg-block text-start">
                                    <div class="fw-bold text-dark">{{ Auth::user()->name }}</div>
                                    <div class="small text-muted">Selamat datang kembali</div>
                                </div>
                                <div class="rounded-circle user-avatar d-flex align-items-center justify-content-center text-white"
                                    style="width: 40px; height: 40px; font-weight: bold;">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user me-2 text-primary"></i>
                                        <span>Profil Saya</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-box me-2 text-primary"></i>
                                        <span>Pesanan Saya</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-heart me-2 text-primary"></i>
                                        <span>Wishlist</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-credit-card me-2 text-primary"></i>
                                        <span>Metode Pembayaran</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cog me-2 text-primary"></i>
                                        <span>Pengaturan</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">
                                            <i class="fas fa-sign-out-alt me-2"></i>
                                            <span>Keluar</span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Enhanced Cart Icon for Guest -->
                        <li class="nav-item mx-1 d-none d-lg-block">
                            <a class="nav-icon" href="{{ route('customer.keranjang.index') }}" data-bs-toggle="tooltip"
                                title="Keranjang">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </li>

                        <!-- Divider -->
                        <li class="nav-item mx-2 d-none d-lg-block">
                            <div class="vr" style="height: 30px; opacity: 0.3;"></div>
                        </li>

                        <!-- Enhanced Auth Buttons -->
                        <li class="nav-item d-flex flex-column flex-lg-row mt-3 mt-lg-0">
                            <a href="{{ route('login') }}" class="btn btn-primary me-lg-2 mb-2 mb-lg-0">
                                <i class="fas fa-sign-in-alt me-1"></i> Masuk
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                <i class="fas fa-user-plus me-1"></i> Daftar
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Enhanced Modern Footer -->
    <footer class="modern-footer mt-5">
        <div class="container">
            <!-- Newsletter Section -->
            <div class="row">
                <div class="col-12">
                    <div class="newsletter-section text-center">
                        <h4 class="mb-3">
                            <i class="fas fa-envelope me-2"></i>
                            Dapatkan Penawaran Eksklusif
                        </h4>
                        <p class="mb-0">Berlangganan newsletter kami dan dapatkan diskon hingga 50% untuk produk
                            pilihan</p>
                        <form class="newsletter-form">
                            <input type="email" placeholder="Masukkan alamat email Anda" required>
                            <button type="submit">
                                <i class="fas fa-paper-plane me-1"></i> Berlangganan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <!-- Enhanced Brand Column -->
                <div class="col-lg-4 footer-section">
                    <div class="footer-logo">
                        <img src="{{ asset('assets/images/fadstore.png') }}" alt="FadStore" style="height: 50px;">
                        <h4 class="text-white mt-3 mb-3">FadStore</h4>
                    </div>
                    <p class="mb-4" style="color: rgba(255, 255, 255, 0.8); line-height: 1.7;">
                        Platform belanja online terpercaya dengan jutaan produk berkualitas, pengalaman belanja yang
                        aman,
                        dan layanan pelanggan terbaik untuk memenuhi semua kebutuhan Anda.
                    </p>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-phone text-primary me-2"></i>
                        <span>(021) 1234-5678</span>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-envelope text-primary me-2"></i>
                        <span>support@fadstore.com</span>
                    </div>
                    <h5 class="footer-heading">Ikuti Kami</h5>
                    <div class="social-links">
                        <a href="#" data-bs-toggle="tooltip" title="Facebook"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" data-bs-toggle="tooltip" title="Twitter"><i
                                class="fab fa-twitter"></i></a>
                        <a href="#" data-bs-toggle="tooltip" title="Instagram"><i
                                class="fab fa-instagram"></i></a>
                        <a href="#" data-bs-toggle="tooltip" title="LinkedIn"><i
                                class="fab fa-linkedin-in"></i></a>
                        <a href="#" data-bs-toggle="tooltip" title="YouTube"><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Enhanced Links Columns -->
                <div class="col-md-6 col-lg-2 footer-section">
                    <h5 class="footer-heading">
                        <i class="fas fa-list me-2"></i>Kategori
                    </h5>
                    <ul class="footer-links list-unstyled">
                        <li><a href="#">Fashion Pria</a></li>
                        <li><a href="#">Fashion Wanita</a></li>
                        <li><a href="#">Elektronik</a></li>
                        <li><a href="#">Kesehatan & Kecantikan</a></li>
                        <li><a href="#">Olahraga & Outdoor</a></li>
                        <li><a href="#">Rumah & Living</a></li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-2 footer-section">
                    <h5 class="footer-heading">
                        <i class="fas fa-concierge-bell me-2"></i>Layanan
                    </h5>
                    <ul class="footer-links list-unstyled">
                        <li><a href="#">Cara Berbelanja</a></li>
                        <li><a href="#">Metode Pembayaran</a></li>
                        <li><a href="#">Pengiriman & Ongkos Kirim</a></li>
                        <li><a href="#">Pengembalian Barang</a></li>
                        <li><a href="#">Garansi & Warranty</a></li>
                        <li><a href="#">Cicilan 0%</a></li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-2 footer-section">
                    <h5 class="footer-heading">
                        <i class="fas fa-info-circle me-2"></i>Perusahaan
                    </h5>
                    <ul class="footer-links list-unstyled">
                        <li><a href="#">Tentang FadStore</a></li>
                        <li><a href="#">Karir & Lowongan</a></li>
                        <li><a href="#">Blog & News</a></li>
                        <li><a href="#">Program Afiliasi</a></li>
                        <li><a href="#">Kemitraan</a></li>
                        <li><a href="#">Investor Relations</a></li>
                    </ul>
                </div>

                <div class="col-md-6 col-lg-2 footer-section">
                    <h5 class="footer-heading">
                        <i class="fas fa-headset me-2"></i>Bantuan
                    </h5>
                    <ul class="footer-links list-unstyled">
                        <li><a href="#">Pusat Bantuan</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Live Chat</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                        <li><a href="#">Lacak Pesanan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>

            <!-- Enhanced Footer Bottom -->
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="copyright mb-md-0">
                            © 2025 <strong>FadStore</strong>. Hak Cipta Dilindungi.
                            <span class="d-block d-md-inline">Dibuat dengan <i class="fas fa-heart text-danger"></i>
                                di Indonesia</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-bottom-links">
                            <a href="#">Kebijakan Privasi</a>
                            <a href="#">Syarat & Ketentuan</a>
                            <a href="#">Keamanan</a>
                            <a href="#">Sitemap</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="btn btn-primary rounded-circle position-fixed" id="backToTop"
        style="bottom: 30px; right: 30px; width: 50px; height: 50px; display: none; z-index: 1000;">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced navbar scroll effect
            const navbar = document.getElementById('mainNavbar');
            let lastScrollTop = 0;

            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }

                // Hide/show navbar on scroll
                if (scrollTop > lastScrollTop && scrollTop > 200) {
                    navbar.style.transform = 'translateY(-100%)';
                } else {
                    navbar.style.transform = 'translateY(0)';
                }
                lastScrollTop = scrollTop;
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Enhanced search functionality
            const searchForm = document.querySelector('.search-container form');
            const searchInput = document.querySelector('.search-input');

            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const searchTerm = searchInput.value.trim();
                if (searchTerm) {
                    // Add loading state
                    const searchBtn = document.querySelector('.search-btn');
                    const originalHTML = searchBtn.innerHTML;
                    searchBtn.innerHTML = '<div class="loading-spinner"></div>';

                    // Simulate search (replace with actual search logic)
                    setTimeout(() => {
                        searchBtn.innerHTML = originalHTML;
                        alert(`Mencari: ${searchTerm}`);
                        // Redirect to search results or handle search
                    }, 1000);
                }
            });

            // Newsletter subscription
            const newsletterForm = document.querySelector('.newsletter-form');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const email = this.querySelector('input[type="email"]').value;
                    const button = this.querySelector('button');
                    const originalHTML = button.innerHTML;

                    if (email) {
                        button.innerHTML = '<div class="loading-spinner"></div> Berlangganan...';
                        button.disabled = true;

                        // Simulate API call
                        setTimeout(() => {
                            button.innerHTML = '<i class="fas fa-check me-1"></i> Berhasil!';
                            button.style.background = 'var(--success-color)';

                            setTimeout(() => {
                                button.innerHTML = originalHTML;
                                button.disabled = false;
                                button.style.background = '';
                                this.reset();
                            }, 2000);
                        }, 1500);
                    }
                });
            }

            // Back to top button
            const backToTopBtn = document.getElementById('backToTop');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopBtn.style.display = 'block';
                } else {
                    backToTopBtn.style.display = 'none';
                }
            });

            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const target = document.querySelector(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Enhanced dropdown animations
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                const menu = dropdown.querySelector('.dropdown-menu');

                dropdown.addEventListener('show.bs.dropdown', function() {
                    menu.style.opacity = '0';
                    menu.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        menu.style.transition = 'all 0.3s ease';
                        menu.style.opacity = '1';
                        menu.style.transform = 'translateY(0)';
                    }, 10);
                });
            });

            // Cart count animation
            const cartBadges = document.querySelectorAll('.nav-icon .badge');
            cartBadges.forEach(badge => {
                badge.addEventListener('animationend', function() {
                    this.classList.remove('pulse');
                });
            });

            // Add loading states to navigation
            const navLinks = document.querySelectorAll('.nav-link, .dropdown-item');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute('href') && this.getAttribute('href') !== '#') {
                        const icon = this.querySelector('i');
                        if (icon && !this.classList.contains('dropdown-toggle')) {
                            const originalClass = icon.className;
                            icon.className = 'fas fa-spinner fa-spin';
                            setTimeout(() => {
                                icon.className = originalClass;
                            }, 1000);
                        }
                    }
                });
            });

            // Button Events
            document.getElementById('btnBeliSekarang')?.addEventListener('click', function() {
                const targetElement = document.getElementById('produk');
                targetElement?.scrollIntoView({
                    behavior: 'smooth'
                });
            });

            // Add intersection observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe footer sections
            document.querySelectorAll('.footer-section').forEach(section => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(30px)';
                section.style.transition = 'all 0.6s ease';
                observer.observe(section);
            });
        });
    </script>
</body>

</html>
