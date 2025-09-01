@extends('layouts.pembeli')

@section('content')
    <div class="container-fluid p-0">
        <!-- Header dengan headline dan carousel sepatu yang interaktif -->
        <section class="hero-section position-relative overflow-hidden">
            <div class="hero-bg-shapes">
                <div class="shape-1"></div>
                <div class="shape-2"></div>
                <div class="shape-3"></div>
            </div>

            <div class="container position-relative">
                <div class="row align-items-center min-vh-100">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="hero-content">
                            <span class="hero-badge animate__animated animate__fadeInDown">
                                <i class="fas fa-fire"></i> Trending Now
                            </span>
                            <h1 class="hero-title animate__animated animate__fadeInUp">
                                Premium <span class="text-gradient">Fashion</span> Collection
                            </h1>
                            <p class="hero-description animate__animated animate__fadeInUp animate__delay-1s">
                                Temukan koleksi eksklusif yang menggabungkan style, kualitas, dan kenyamanan untuk
                                penampilan yang sempurna setiap hari.
                            </p>

                            <!-- Statistics -->
                            <div class="hero-stats d-flex gap-4 mb-4 animate__animated animate__fadeInUp animate__delay-2s">
                                <div class="stat-item">
                                    <div class="stat-number">500+</div>
                                    <div class="stat-label">Products</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">50k+</div>
                                    <div class="stat-label">Happy Customers</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number">4.9</div>
                                    <div class="stat-label">Rating</div>
                                </div>
                            </div>

                            <div class="hero-buttons d-flex gap-3 animate__animated animate__fadeInUp animate__delay-3s">
                                @auth
                                    <a href="#product-section" class="btn-primary-custom">
                                        <span>Shop Now</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn-primary-custom">
                                        <span>Login</span>
                                        <i class="fas fa-sign-in-alt"></i>
                                    </a>
                                    <a href="#product-section" class="btn-outline-custom">
                                        <span>Explore</span>
                                        <i class="fas fa-search"></i>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <!-- Interactive Shoe Carousel -->
                        <div class="shoe-showcase position-relative animate__animated animate__fadeInRight">
                            <div class="showcase-container">
                                <!-- Main Product Display -->
                                <div class="main-product-display">
                                    <div class="product-carousel">
                                        <div class="product-slide active" data-product="1">
                                            <img src="https://cdn.easyfrontend.com/pictures/ecommerce/product16.png"
                                                alt="Product 1" class="product-image">
                                            <div class="product-info">
                                                <h3>Premium T-Shirt</h3>
                                                <p>Rp 299.000</p>
                                            </div>
                                        </div>
                                        <div class="product-slide" data-product="2">
                                            <img src="https://cdn.easyfrontend.com/pictures/ecommerce/product10.png"
                                                alt="Product 2" class="product-image">
                                            <div class="product-info">
                                                <h3>Body Care Set</h3>
                                                <p>Rp 199.000</p>
                                            </div>
                                        </div>
                                        <div class="product-slide" data-product="3">
                                            <img src="https://cdn.easyfrontend.com/pictures/ecommerce/product24.png"
                                                alt="Product 3" class="product-image">
                                            <div class="product-info">
                                                <h3>Water Bottle</h3>
                                                <p>Rp 150.000</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Floating Elements -->
                                    <div class="floating-elements">
                                        <div class="floating-badge sale-badge">
                                            <span>50% OFF</span>
                                        </div>
                                        <div class="floating-badge new-badge">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Product Navigation -->
                                <div class="product-navigation">
                                    <div class="nav-dots">
                                        <button class="nav-dot active" data-slide="1"></button>
                                        <button class="nav-dot" data-slide="2"></button>
                                        <button class="nav-dot" data-slide="3"></button>
                                    </div>
                                    <div class="nav-arrows">
                                        <button class="nav-arrow prev-arrow">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button class="nav-arrow next-arrow">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kategori Section dengan design yang lebih modern -->
        <section class="categories-section py-5">
            <div class="container">
                <div class="section-header text-center mb-5">
                    <span class="section-badge">Our Collection</span>
                    <h2 class="section-title">Shop by Category</h2>
                    <p class="section-description">Discover our curated selection of premium products</p>
                </div>

                <div class="categories-grid">
                    <div class="category-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="category-image">
                            <img src="https://cdn.easyfrontend.com/pictures/ecommerce/product16.png" alt="T-Shirts">
                            <div class="category-overlay">
                                <button class="category-btn">
                                    <span>View Collection</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="category-content">
                            <h3>T-Shirts</h3>
                            <p>Premium Cotton Collection</p>
                            <span class="product-count">25+ Products</span>
                        </div>
                    </div>

                    <div class="category-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="category-image">
                            <img src="https://cdn.easyfrontend.com/pictures/ecommerce/product10.png" alt="Body Care">
                            <div class="category-overlay">
                                <button class="category-btn">
                                    <span>View Collection</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="category-content">
                            <h3>Body Care</h3>
                            <p>Natural & Organic</p>
                            <span class="product-count">15+ Products</span>
                        </div>
                    </div>

                    <div class="category-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="category-image">
                            <img src="https://cdn.easyfrontend.com/pictures/ecommerce/product24.png" alt="Accessories">
                            <div class="category-overlay">
                                <button class="category-btn">
                                    <span>View Collection</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="category-content">
                            <h3>Accessories</h3>
                            <p>Daily Essentials</p>
                            <span class="product-count">30+ Products</span>
                        </div>
                    </div>

                    <div class="category-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="category-image">
                            <img src="https://cdn.easyfrontend.com/pictures/ecommerce/product6.png" alt="Eyewear">
                            <div class="category-overlay">
                                <button class="category-btn">
                                    <span>View Collection</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="category-content">
                            <h3>Eyewear</h3>
                            <p>Fashion & Sport</p>
                            <span class="product-count">20+ Products</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Section dengan enhanced design -->
        <section class="products-section py-5" id="product-section">
            <div class="container">
                <div class="section-header text-center mb-5">
                    <span class="section-badge">Best Sellers</span>
                    <h2 class="section-title">Featured Products</h2>
                    <p class="section-description">Hand-picked products that our customers love most</p>
                </div>

                <!-- Filter Tabs -->
                <div class="filter-tabs mb-5">
                    <div class="tab-buttons">
                        <button class="tab-btn active" data-filter="all">All Products</button>
                        <button class="tab-btn" data-filter="featured">Featured</button>
                        <button class="tab-btn" data-filter="sale">On Sale</button>
                        <button class="tab-btn" data-filter="new">New Arrivals</button>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="products-grid" id="products-container">
                    @if (count($produks) > 0)
                        @foreach ($produks as $index => $produk)
                            <div class="product-card" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
                                <div class="product-image-container">
                                    <img src="{{ asset('/' . basename($produk->gambar)) }}" alt="{{ $produk->nama }}"
                                        class="product-image">

                                    <!-- Product Badges -->
                                    <div class="product-badges">
                                        <span class="badge sale-badge">Sale</span>
                                        @if ($index < 3)
                                            <span class="badge new-badge">New</span>
                                        @endif
                                    </div>

                                    <!-- Quick Actions -->
                                    <div class="quick-actions">
                                        @auth
                                            <button class="action-btn" data-bs-toggle="tooltip" title="Add to Cart"
                                                onclick="addToCart({{ $produk->id }})">
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                        @else
                                            <a href="{{ route('login') }}" class="action-btn" data-bs-toggle="tooltip"
                                                title="Login to Add">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        @endauth
                                        <button class="action-btn" data-bs-toggle="tooltip" title="Add to Wishlist">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <button class="action-btn" data-bs-toggle="tooltip" title="Quick View"
                                            onclick="quickView({{ $produk->id }})">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>

                                    <!-- Quick Add Button -->
                                    <div class="quick-add">
                                        @auth
                                            <button class="quick-add-btn" onclick="addToCart({{ $produk->id }})">
                                                <span>Add to Cart</span>
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        @else
                                            <a href="{{ route('login') }}" class="quick-add-btn">
                                                <span>Login to Buy</span>
                                                <i class="fas fa-sign-in-alt"></i>
                                            </a>
                                        @endauth
                                    </div>
                                </div>

                                <div class="product-content">
                                    <div class="product-meta">
                                        <div class="product-rating">
                                            <div class="stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= 4 ? 'filled' : '' }}"></i>
                                                @endfor
                                            </div>
                                            <span class="rating-count">({{ rand(10, 100) }})</span>
                                        </div>
                                        <div class="product-status">
                                            <span class="status-badge available">In Stock</span>
                                        </div>
                                    </div>

                                    <h3 class="product-title">{{ $produk->nama }}</h3>
                                    <div class="product-price">
                                        <span class="current-price">Rp
                                            {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                        <span class="original-price">Rp
                                            {{ number_format($produk->harga * 1.3, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <h3>No Products Found</h3>
                            <p>Products will be added soon. Please check back later.</p>
                        </div>
                    @endif
                </div>

                <div class="load-more-section text-center mt-5">
                    <button class="btn-primary-custom load-more-btn">
                        <span>Load More Products</span>
                        <i class="fas fa-arrow-down"></i>
                    </button>
                </div>
            </div>
        </section>

        <!-- CTA Section dengan design yang lebih menarik -->
        <section class="cta-section position-relative overflow-hidden">
            <div class="cta-bg-shapes">
                <div class="cta-shape-1"></div>
                <div class="cta-shape-2"></div>
            </div>

            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-4 mb-lg-0">
                        <div class="cta-content">
                            <span class="cta-badge">Special Offer</span>
                            <h2 class="cta-title">Get 25% Off Your First Order</h2>
                            <p class="cta-description">
                                Join our community and enjoy exclusive discounts, early access to new products, and special
                                member benefits.
                            </p>
                            <div class="cta-features">
                                <div class="feature">
                                    <i class="fas fa-check"></i>
                                    <span>Free shipping on orders over $100</span>
                                </div>
                                <div class="feature">
                                    <i class="fas fa-check"></i>
                                    <span>30-day money back guarantee</span>
                                </div>
                                <div class="feature">
                                    <i class="fas fa-check"></i>
                                    <span>24/7 customer support</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="cta-actions">
                            <div class="discount-code">
                                <span class="code-label">Use Code:</span>
                                <div class="code-box">
                                    <span class="code-text">WELCOME25</span>
                                    <button class="copy-btn" onclick="copyCode()">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                            <a href="#product-section" class="btn-primary-custom cta-button">
                                <span>Shop Now & Save</span>
                                <i class="fas fa-shopping-bag"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Enhanced CSS Styles -->
    <style>
        :root {
            --primary-color: #0d6efd;
            --primary-dark: #023888;
            --secondary-color: #6294df;
            --accent-color: #10b981;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f9fafb;
            --border-color: #e5e7eb;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            --gradient-secondary: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-color) 100%);
        }

        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #023888 0%, #0d6efd 100%);
            color: white;
            position: relative;
        }

        .hero-bg-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .hero-bg-shapes .shape-1,
        .hero-bg-shapes .shape-2,
        .hero-bg-shapes .shape-3 {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .hero-bg-shapes .shape-1 {
            width: 200px;
            height: 200px;
            top: 10%;
            right: 10%;
            animation: float 6s ease-in-out infinite;
        }

        .hero-bg-shapes .shape-2 {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 30%;
            animation: float 8s ease-in-out infinite reverse;
        }

        .hero-bg-shapes .shape-3 {
            width: 100px;
            height: 100px;
            top: 30%;
            right: 60%;
            animation: float 10s ease-in-out infinite;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 24px;
            backdrop-filter: blur(10px);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 24px;
        }

        .text-gradient {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 1.125rem;
            margin-bottom: 32px;
            opacity: 0.9;
            max-width: 500px;
        }

        .hero-stats {
            margin-bottom: 32px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #fbbf24;
        }

        .stat-label {
            font-size: 0.875rem;
            opacity: 0.8;
        }

        /* Buttons */
        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gradient-primary);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
            color: white;
        }

        .btn-outline-custom {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: white;
            padding: 12px 24px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .btn-outline-custom:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
        }

        /* Product Showcase */
        .shoe-showcase {
            position: relative;
            z-index: 2;
        }

        .showcase-container {
            position: relative;
            max-width: 500px;
            margin: 0 auto;
        }

        .main-product-display {
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 30px;
            padding: 40px;
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow-xl);
        }

        .product-carousel {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .product-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transform: translateX(100px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .product-slide.active {
            opacity: 1;
            transform: translateX(0);
        }

        .product-image {
            max-width: 200px;
            max-height: 200px;
            object-fit: contain;
            transition: transform 0.3s ease;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.2));
        }

        .product-slide:hover .product-image {
            transform: scale(1.05) rotate(-5deg);
        }

        .product-info {
            margin-top: 20px;
        }

        .product-info h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .product-info p {
            font-size: 1.125rem;
            font-weight: 700;
            color: #fbbf24;
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .floating-badge {
            position: absolute;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            animation: float 4s ease-in-out infinite;
        }

        .sale-badge {
            background: #ef4444;
            color: white;
            top: 20px;
            right: 20px;
        }

        .new-badge {
            background: #10b981;
            color: white;
            top: 20px;
            left: 20px;
            animation-delay: -2s;
        }

        .product-navigation {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-dots {
            display: flex;
            gap: 12px;
        }

        .nav-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.5);
            background: transparent;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .nav-dot.active {
            background: white;
            border-color: white;
        }

        .nav-arrows {
            display: flex;
            gap: 12px;
        }

        .nav-arrow {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .nav-arrow:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
        }

        /* Section Headers */
        .section-header {
            margin-bottom: 60px;
        }

        .section-badge {
            display: inline-block;
            background: var(--gradient-primary);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .section-description {
            font-size: 1.125rem;
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Categories Section */
        .categories-section {
            background: var(--bg-light);
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .category-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .category-image {
            position: relative;
            height: 200px;
            background: var(--bg-light);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .category-image img {
            max-height: 160px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .category-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .category-card:hover .category-overlay {
            opacity: 1;
        }

        .category-card:hover .category-image img {
            transform: scale(1.1);
        }

        .category-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            color: var(--text-dark);
            padding: 10px 20px;
            border-radius: 25px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .category-btn:hover {
            background: var(--primary-color);
            color: white;
        }

        .category-content {
            padding: 24px;
            text-align: center;
        }

        .category-content h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .category-content p {
            color: var(--text-light);
            margin-bottom: 12px;
        }

        .product-count {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Filter Tabs */
        .filter-tabs {
            display: flex;
            justify-content: center;
        }

        .tab-buttons {
            display: flex;
            background: var(--bg-light);
            padding: 6px;
            border-radius: 50px;
            gap: 4px;
        }

        .tab-btn {
            padding: 10px 24px;
            border: none;
            background: transparent;
            color: var(--text-light);
            border-radius: 25px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            background: var(--primary-color);
            color: white;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .product-image-container {
            position: relative;
            height: 250px;
            background: var(--bg-light);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image {
            max-height: 200px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-badges {
            position: absolute;
            top: 15px;
            left: 15px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 2;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            color: white;
        }

        .badge.sale-badge {
            background: #ef4444;
        }

        .badge.new-badge {
            background: #10b981;
        }

        .quick-actions {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s ease;
        }

        .product-card:hover .quick-actions {
            opacity: 1;
            transform: translateX(0);
        }

        .action-btn {
            width: 36px;
            height: 36px;
            background: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            box-shadow: var(--shadow-md);
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .action-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        .quick-add {
            position: absolute;
            bottom: 15px;
            left: 15px;
            right: 15px;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .product-card:hover .quick-add {
            opacity: 1;
            transform: translateY(0);
        }

        .quick-add-btn {
            width: 100%;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 10px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .quick-add-btn:hover {
            background: var(--primary-dark);
            transform: scale(1.02);
            color: white;
        }

        .product-content {
            padding: 20px;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stars {
            display: flex;
            gap: 2px;
        }

        .stars i {
            font-size: 12px;
            color: #d1d5db;
        }

        .stars i.filled {
            color: #fbbf24;
        }

        .rating-count {
            font-size: 12px;
            color: var(--text-light);
        }

        .status-badge {
            padding: 2px 8px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 600;
        }

        .status-badge.available {
            background: #dcfce7;
            color: #166534;
        }

        .product-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 12px;
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .current-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .original-price {
            font-size: 1rem;
            color: var(--text-light);
            text-decoration: line-through;
        }

        /* CTA Section */
        .cta-section {
            background: var(--gradient-primary);
            color: white;
            padding: 80px 0;
        }

        .cta-bg-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .cta-shape-1,
        .cta-shape-2 {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .cta-shape-1 {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        .cta-shape-2 {
            width: 200px;
            height: 200px;
            bottom: -50px;
            left: -50px;
            animation: float 10s ease-in-out infinite reverse;
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        .cta-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
            backdrop-filter: blur(10px);
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .cta-description {
            font-size: 1.125rem;
            opacity: 0.9;
            margin-bottom: 24px;
        }

        .cta-features {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .feature i {
            color: #10b981;
            font-size: 14px;
        }

        .cta-actions {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .discount-code {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
            backdrop-filter: blur(10px);
        }

        .code-label {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            opacity: 0.8;
        }

        .code-box {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 12px;
            padding: 12px 16px;
            gap: 12px;
        }

        .code-text {
            flex: 1;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
            letter-spacing: 2px;
        }

        .copy-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .copy-btn:hover {
            background: var(--primary-dark);
        }

        /* Animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .load-more-section {
            margin-top: 60px;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
        }

        .empty-icon {
            font-size: 4rem;
            color: var(--text-light);
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 12px;
        }

        .empty-state p {
            color: var(--text-light);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .categories-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 20px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-stats {
                flex-wrap: wrap;
                justify-content: center;
            }

            .section-title {
                font-size: 1.75rem;
            }

            .tab-buttons {
                flex-wrap: wrap;
                justify-content: center;
            }

            .cta-title {
                font-size: 2rem;
            }

            .cta-features {
                margin-bottom: 30px;
            }
        }

        @media (max-width: 640px) {
            .hero-section {
                padding: 60px 0;
            }

            .hero-title {
                font-size: 1.75rem;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .categories-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 15px;
            }

            .product-image-container {
                height: 200px;
            }

            .main-product-display {
                padding: 20px;
                margin: 0 20px;
            }

            .product-carousel {
                height: 250px;
            }

            .cta-title {
                font-size: 1.5rem;
            }

            // ...existing code...
            /* Notification Styles */
            .notification {
                position: fixed;
                top: 20px;
                right: 20px;
                background: white;
                border-radius: 10px;
                padding: 16px;
                box-shadow: var(--shadow-lg);
                transform: translateX(400px);
                transition: transform 0.3s ease;
                z-index: 9999;
                min-width: 300px;
            }

            .notification.show {
                transform: translateX(0);
            }

            .notification-success {
                border-left: 4px solid #10b981;
            }

            .notification-error {
                border-left: 4px solid #ef4444;
            }

            .notification-content {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .notification-success .notification-content i {
                color: #10b981;
            }

            .notification-error .notification-content i {
                color: #ef4444;
            }

            .notification-content span {
                font-weight: 500;
                color: var(--text-dark);
            }

        }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100
            });

            // Product Carousel
            let currentSlide = 1;
            const totalSlides = 3;

            function showSlide(slideNumber) {
                document.querySelectorAll('.product-slide').forEach(slide => {
                    slide.classList.remove('active');
                });
                document.querySelectorAll('.nav-dot').forEach(dot => {
                    dot.classList.remove('active');
                });

                document.querySelector(`[data-product="${slideNumber}"]`).classList.add('active');
                document.querySelector(`[data-slide="${slideNumber}"]`).classList.add('active');
                currentSlide = slideNumber;
            }

            // Auto-advance carousel
            setInterval(() => {
                currentSlide = currentSlide >= totalSlides ? 1 : currentSlide + 1;
                showSlide(currentSlide);
            }, 4000);

            // Navigation dots
            document.querySelectorAll('.nav-dot').forEach(dot => {
                dot.addEventListener('click', function() {
                    const slideNumber = parseInt(this.getAttribute('data-slide'));
                    showSlide(slideNumber);
                });
            });

            // Navigation arrows
            document.querySelector('.next-arrow').addEventListener('click', function() {
                currentSlide = currentSlide >= totalSlides ? 1 : currentSlide + 1;
                showSlide(currentSlide);
            });

            document.querySelector('.prev-arrow').addEventListener('click', function() {
                currentSlide = currentSlide <= 1 ? totalSlides : currentSlide - 1;
                showSlide(currentSlide);
            });

            // Filter tabs
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove(
                        'active'));
                    this.classList.add('active');

                    const filter = this.getAttribute('data-filter');
                    // Add your filtering logic here
                    console.log('Filter:', filter);
                });
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Smooth scroll
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

            // Copy discount code
            window.copyCode = function() {
                const codeText = document.querySelector('.code-text').textContent;
                navigator.clipboard.writeText(codeText).then(function() {
                    const copyBtn = document.querySelector('.copy-btn');
                    const originalIcon = copyBtn.innerHTML;
                    copyBtn.innerHTML = '<i class="fas fa-check"></i>';
                    copyBtn.style.background = '#10b981';

                    setTimeout(() => {
                        copyBtn.innerHTML = originalIcon;
                        copyBtn.style.background = '';
                    }, 2000);
                });
            };

            // Add to cart functionality
            // ...existing code...
            // Add to cart functionality
            window.addToCart = function(productId) {
                const btn = event.target.closest('.quick-add-btn, .action-btn');
                const originalContent = btn.innerHTML;

                // Show loading state
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
                btn.disabled = true;

                // Make AJAX request to add product to cart
                fetch(`/tambah-keranjang/${productId}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        }
                        throw new Error('Network response was not ok');
                    })
                    .then(data => {
                        // Show success message
                        btn.innerHTML = '<i class="fas fa-check"></i> Added!';
                        btn.style.background = '#10b981';

                        // Show success notification (optional)
                        showNotification('Product added to cart successfully!', 'success');

                        // Reset button after 2 seconds
                        setTimeout(() => {
                            btn.innerHTML = originalContent;
                            btn.style.background = '';
                            btn.disabled = false;
                        }, 2000);
                    })
                    .catch(error => {
                        console.error('Error:', error);

                        // Show error message
                        btn.innerHTML = '<i class="fas fa-times"></i> Error!';
                        btn.style.background = '#ef4444';

                        // Show error notification
                        showNotification('Failed to add product to cart. Please try again.', 'error');

                        // Reset button after 2 seconds
                        setTimeout(() => {
                            btn.innerHTML = originalContent;
                            btn.style.background = '';
                            btn.disabled = false;
                        }, 2000);
                    });
            };

            // Notification function (optional)
            function showNotification(message, type) {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = `notification notification-${type}`;
                notification.innerHTML = `
        <div class="notification-content">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
        </div>
    `;

                // Add to body
                document.body.appendChild(notification);

                // Show notification
                setTimeout(() => {
                    notification.classList.add('show');
                }, 100);

                // Remove notification after 3 seconds
                setTimeout(() => {
                    notification.classList.remove('show');
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 3000);
            }
            // ...existing code...
        });
    </script>

    <!-- Add AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Add AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endsection
