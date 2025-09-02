{{-- File: resources/views/layouts/auth.blade.php --}}
<!doctype html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#6366f1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Animate.css for enhanced animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <title>{{ $title ?? 'FadStore - Your Style, Your Choice' }}</title>

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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background-color: var(--bg-light);
        }

        /* Auth Header - Minimal & Clean */
        .auth-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(99, 102, 241, 0.1);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .auth-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .auth-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 800;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .auth-brand:hover {
            color: var(--primary-dark);
        }

        .auth-brand img {
            height: 40px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
            transition: all 0.3s ease;
        }

        .auth-brand:hover img {
            transform: scale(1.05);
        }

        .auth-nav-links {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .auth-nav-link {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 8px;
        }

        .auth-nav-link:hover {
            color: var(--primary-color);
            background: rgba(99, 102, 241, 0.1);
        }

        .back-to-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 25px;
            border: 2px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .back-to-home:hover {
            color: var(--white);
            background: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Auth Main Content */
        .auth-main {
            min-height: 100vh;
            padding-top: 80px;
            /* Space for fixed header */
        }

        /* Auth Footer - Minimal */
        .auth-footer {
            background: var(--white);
            border-top: 1px solid var(--border-color);
            padding: 2rem 0;
            margin-top: auto;
        }

        .auth-footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            text-align: center;
        }

        .auth-footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .auth-footer-links a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .auth-footer-links a:hover {
            color: var(--primary-color);
        }

        .auth-footer-text {
            color: var(--text-light);
            font-size: 0.875rem;
        }

        .auth-footer-text strong {
            color: var(--text-dark);
        }

        /* Language Selector */
        .language-selector {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 0.875rem;
        }

        .language-selector select {
            border: none;
            background: transparent;
            color: var(--text-light);
            font-size: 0.875rem;
            cursor: pointer;
        }

        .language-selector select:focus {
            outline: none;
        }

        /* Security Badge */
        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(5, 150, 105, 0.1);
            color: var(--success-color);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .auth-nav {
                padding: 0 1rem;
            }

            .auth-nav-links {
                gap: 0.5rem;
            }

            .back-to-home {
                padding: 8px 16px;
                font-size: 0.875rem;
            }

            .auth-footer-links {
                flex-direction: column;
                gap: 1rem;
            }

            .auth-main {
                padding-top: 70px;
            }
        }

        @media (max-width: 480px) {
            .auth-brand {
                font-size: 1.25rem;
            }

            .auth-brand img {
                height: 35px;
            }

            .auth-nav-links {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
                background: none;
                border: none;
                color: var(--text-dark);
                font-size: 1.25rem;
                cursor: pointer;
            }
        }

        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid var(--border-color);
            border-radius: 50%;
            border-top-color: var(--primary-color);
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
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-light);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* Focus States for Accessibility */
        .auth-brand:focus,
        .auth-nav-link:focus,
        .back-to-home:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }
    </style>
</head>

<body>
    <!-- Minimal Auth Header -->
    <header class="auth-header">
        <nav class="auth-nav">
            <!-- Brand Logo -->
            <a href="{{ route('beranda') }}" class="auth-brand">
                <img src="{{ asset('assets/images/fadstore.png') }}" alt="FadStore">
                {{-- <span class="d-none d-md-inline">FadStore</span> --}}
            </a>

            <!-- Navigation Links -->
            <div class="auth-nav-links">
                <!-- Language Selector -->
                <div class="language-selector d-none d-md-flex">
                    <i class="fas fa-globe me-2"></i>
                    <select>
                        <option value="id">Indonesia</option>
                        <option value="en">English</option>
                    </select>
                </div>

                <!-- Back to Home -->
                <a href="{{ route('beranda') }}" class="back-to-home">
                    <i class="fas fa-arrow-left"></i>
                    <span class="d-none d-sm-inline">Kembali ke Beranda</span>
                    <span class="d-sm-none">Beranda</span>
                </a>
            </div>

            <!-- Mobile Menu Toggle (if needed) -->
            <button class="mobile-menu-toggle d-md-none" style="display: none;">
                <i class="fas fa-bars"></i>
            </button>
        </nav>
    </header>

    <!-- Main Auth Content -->
    <main class="auth-main">
        <!-- Security Badge -->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="security-badge">
                        <i class="fas fa-shield-check"></i>
                        <span>Koneksi Aman & Terenkripsi</span>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
    </main>

    <!-- Minimal Auth Footer -->
    <footer class="auth-footer">
        <div class="auth-footer-content">
            <!-- Footer Links -->
            <div class="auth-footer-links">
                <a href="#">Bantuan</a>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">Keamanan</a>
                <a href="#">Hubungi Kami</a>
            </div>

            <!-- Copyright -->
            <p class="auth-footer-text mb-0">
                © {{ date('Y') }} <strong>FadStore</strong>. Hak Cipta Dilindungi.
                <span class="d-block d-md-inline mt-1 mt-md-0">
                    Dibuat dengan <i class="fas fa-heart text-danger"></i> di Indonesia
                </span>
            </p>
        </div>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced header scroll effect
            const header = document.querySelector('.auth-header');
            let lastScrollTop = 0;

            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 50) {
                    header.style.background = 'rgba(255, 255, 255, 0.98)';
                    header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
                } else {
                    header.style.background = 'rgba(255, 255, 255, 0.95)';
                    header.style.boxShadow = 'none';
                }
            });

            // Smooth transitions for auth brand
            const authBrand = document.querySelector('.auth-brand');
            authBrand.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });

            authBrand.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });

            // Loading states for navigation
            const navLinks = document.querySelectorAll('.auth-nav-link, .back-to-home');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.getAttribute('href') && this.getAttribute('href') !== '#') {
                        const icon = this.querySelector('i');
                        if (icon) {
                            const originalClass = icon.className;
                            icon.className = 'fas fa-spinner fa-spin';
                            setTimeout(() => {
                                icon.className = originalClass;
                            }, 1000);
                        }
                    }
                });
            });

            // Enhanced accessibility
            document.addEventListener('keydown', function(e) {
                // ESC key to go back to home
                if (e.key === 'Escape') {
                    const backToHome = document.querySelector('.back-to-home');
                    if (backToHome) {
                        backToHome.focus();
                    }
                }
            });

            // Progressive Web App prompt
            let deferredPrompt;
            window.addEventListener('beforeinstallprompt', (e) => {
                deferredPrompt = e;
                // Show install button if desired
            });

            // Add subtle entrance animation
            document.body.style.opacity = '0';
            setTimeout(() => {
                document.body.style.transition = 'opacity 0.5s ease';
                document.body.style.opacity = '1';
            }, 100);
        });

        // Enhanced notification system for auth pages
        function showAuthNotification(type, message, duration = 5000) {
            const notification = document.createElement('div');
            const iconMap = {
                'success': 'fas fa-check-circle',
                'error': 'fas fa-exclamation-circle',
                'warning': 'fas fa-exclamation-triangle',
                'info': 'fas fa-info-circle'
            };

            const colorMap = {
                'success': 'var(--success-color)',
                'error': 'var(--danger-color)',
                'warning': 'var(--warning-color)',
                'info': 'var(--primary-color)'
            };

            notification.innerHTML = `
                <div style="
                    position: fixed;
                    top: 100px;
                    right: 20px;
                    z-index: 9999;
                    background: var(--white);
                    color: var(--text-dark);
                    padding: 16px 20px;
                    border-radius: 12px;
                    box-shadow: var(--shadow-xl);
                    border-left: 4px solid ${colorMap[type]};
                    min-width: 300px;
                    max-width: 400px;
                    animation: slideInRight 0.3s ease;
                    display: flex;
                    align-items: center;
                    gap: 12px;
                ">
                    <i class="${iconMap[type]}" style="color: ${colorMap[type]}; font-size: 1.25rem;"></i>
                    <span style="flex: 1; font-weight: 500;">${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" style="
                        background: none;
                        border: none;
                        color: var(--text-light);
                        cursor: pointer;
                        padding: 4px;
                        border-radius: 4px;
                        transition: all 0.2s ease;
                    " onmouseover="this.style.background='var(--bg-light)'" onmouseout="this.style.background='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            document.body.appendChild(notification);

            // Auto remove
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    notification.firstElementChild.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => {
                        if (document.body.contains(notification)) {
                            document.body.removeChild(notification);
                        }
                    }, 300);
                }
            }, duration);
        }

        // Add CSS animations
        const authStyle = document.createElement('style');
        authStyle.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(authStyle);
    </script>

    @stack('scripts')
</body>

</html>
