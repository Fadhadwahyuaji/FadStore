@extends('layouts.pembeli')

@section('content')
    <div class="container-fluid px-3 py-4">
        <!-- Breadcrumb Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="breadcrumb-container animate__animated animate__fadeInDown">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h1 class="page-title mb-2">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Keranjang Belanja
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home') }}" class="breadcrumb-link">
                                            <i class="fas fa-home me-1"></i>Beranda
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Keranjang</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="cart-stats">
                            <div class="stat-card">
                                <div class="stat-number" id="total-items">{{ count($keranjang) }}</div>
                                <div class="stat-label">Items</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (count($keranjang) > 0)
            <div class="row g-4">
                <!-- Cart Items Section -->
                <div class="col-lg-8">
                    <div class="cart-card animate__animated animate__fadeInLeft">
                        <!-- Cart Header -->
                        <div class="cart-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="form-check custom-checkbox">
                                        <input class="form-check-input" type="checkbox" id="selectAll"
                                            onchange="toggleAllProducts()">
                                        <label class="form-check-label" for="selectAll">
                                            Pilih Semua
                                        </label>
                                    </div>
                                    <span class="selected-count ms-3" id="selectedCount">0 item dipilih</span>
                                </div>
                                <div class="cart-actions">
                                    <button class="action-btn delete-selected" onclick="deleteSelected()" disabled>
                                        <i class="fas fa-trash me-1"></i>
                                        Hapus Terpilih
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Cart Items -->
                        <div class="cart-items">
                            @foreach ($keranjang as $index => $cart)
                                <div class="cart-item animate__animated animate__fadeInUp"
                                    style="animation-delay: {{ $index * 0.1 }}s" data-cart-id="{{ $cart->id }}">
                                    <div class="item-content">
                                        <!-- Checkbox -->
                                        <div class="item-checkbox">
                                            <div class="form-check custom-checkbox">
                                                <input type="checkbox" class="form-check-input product-checkbox"
                                                    data-cart-id="{{ $cart->id }}"
                                                    data-harga="{{ $cart->produk->harga }}"
                                                    onchange="updateCheckoutTotal()">
                                            </div>
                                        </div>

                                        <!-- Product Info -->
                                        <div class="item-product">
                                            <div class="product-image">
                                                <img src="{{ asset('/' . basename($cart->produk->gambar)) }}"
                                                    alt="{{ $cart->produk->nama }}" class="img-fluid">
                                                <div class="image-overlay">
                                                    <button class="btn btn-sm btn-light quick-view" data-bs-toggle="modal"
                                                        data-bs-target="#productModal">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-details">
                                                <h3 class="product-name">{{ $cart->produk->nama }}</h3>
                                                <div class="product-meta">
                                                    <div class="product-price">
                                                        <span class="current-price">Rp
                                                            {{ number_format($cart->produk->harga, 0, ',', '.') }}</span>
                                                        <span class="original-price">Rp
                                                            {{ number_format($cart->produk->harga * 1.3, 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="product-rating">
                                                        <div class="stars">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i class="fas fa-star {{ $i <= 4 ? 'filled' : '' }}"></i>
                                                            @endfor
                                                        </div>
                                                        <span class="rating-count">({{ rand(10, 100) }})</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Quantity Control -->
                                        <div class="item-quantity">
                                            <div class="quantity-control">
                                                <button class="quantity-btn decrease"
                                                    onclick="updateQuantity('{{ $cart->id }}', -1)">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="text" class="quantity-input"
                                                    id="display_jumlah_{{ $cart->id }}" value="{{ $cart->jumlah }}"
                                                    readonly>
                                                <button class="quantity-btn increase"
                                                    onclick="updateQuantity('{{ $cart->id }}', 1)">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                                <input type="hidden" id="jumlah_{{ $cart->id }}"
                                                    name="jumlah_{{ $cart->id }}" value="{{ $cart->jumlah }}">
                                            </div>
                                            <div class="stock-info">
                                                <span class="stock-text">Stok: 50</span>
                                            </div>
                                        </div>

                                        <!-- Subtotal & Actions -->
                                        <div class="item-total">
                                            <div class="subtotal-amount">
                                                <span class="subtotal-label">Subtotal</span>
                                                <span class="subtotal-value">
                                                    Rp <span
                                                        id="sub_total_{{ $cart->id }}">{{ number_format($cart->sub_total, 0, ',', '.') }}</span>
                                                </span>
                                            </div>
                                            <div class="item-actions">
                                                <button class="action-btn favorite" data-bs-toggle="tooltip"
                                                    title="Tambah ke Wishlist">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                                <form action="{{ route('customer.keranjang.hapus', ['id' => $cart->id]) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="action-btn delete"
                                                        data-bs-toggle="tooltip" title="Hapus Item">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Recommended Products -->
                    <div class="recommended-section mt-4 animate__animated animate__fadeInUp">
                        <div class="section-header">
                            <h4 class="section-title">Produk Rekomendasi</h4>
                            <p class="section-subtitle">Mungkin Anda juga menyukai produk ini</p>
                        </div>
                        <div class="recommended-products">
                            @foreach ($produks as $index => $produk)
                                <div class="recommended-item">
                                    <div class="recommended-image">
                                        <img src="{{ asset('/' . basename($produk->gambar)) }}"
                                            alt="{{ $produk->nama }}" alt="Product {{ $produk->nama }}}">
                                        <div class="recommended-overlay">
                                            <button class="btn-add-to-cart" data-bs-toggle="tooltip" title="Add to Cart"
                                                onclick="addToCart({{ $produk->id }})">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="recommended-info">
                                        <h5>{{ $produk->nama }}</h5>
                                        <p>Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary Section -->
                <div class="col-lg-4">
                    <div class="summary-card animate__animated animate__fadeInRight">
                        <!-- Summary Header -->
                        <div class="summary-header">
                            <h3 class="summary-title">
                                <i class="fas fa-receipt me-2"></i>
                                Ringkasan Pesanan
                            </h3>
                        </div>

                        <!-- Summary Body -->
                        <div class="summary-body">
                            <!-- Items Counter -->
                            <div class="summary-row">
                                <span class="summary-label">Total Item</span>
                                <span class="summary-value" id="items_count">0</span>
                            </div>

                            <!-- Subtotal -->
                            <div class="summary-row">
                                <span class="summary-label">Subtotal</span>
                                <span class="summary-value">Rp <span id="subtotal_amount">0</span></span>
                            </div>

                            <!-- Voucher Section -->
                            <div class="voucher-section">
                                <label class="voucher-label">
                                    <i class="fas fa-ticket-alt me-2"></i>
                                    Kode Voucher
                                </label>
                                <div class="voucher-input-group">
                                    <input type="text" class="voucher-input" placeholder="Masukkan kode voucher"
                                        id="voucher_code" name="voucher_code">
                                    <button class="voucher-btn" type="button" id="btnApplyVoucher">
                                        <span class="btn-text">Gunakan</span>
                                        <span class="btn-loading d-none">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span>
                                    </button>
                                </div>
                                <div class="voucher-feedback" id="voucher_badge"></div>
                                <div class="voucher-suggestions">
                                    <div class="suggestion-item" onclick="applyVoucherCode('WELCOME25')">
                                        <div class="suggestion-content">
                                            <div class="suggestion-code">WELCOME25</div>
                                            <div class="suggestion-desc">Diskon 25% untuk pembelian pertama</div>
                                        </div>
                                        <div class="suggestion-action">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                    <div class="suggestion-item" onclick="applyVoucherCode('SAVE50K')">
                                        <div class="suggestion-content">
                                            <div class="suggestion-code">SAVE50K</div>
                                            <div class="suggestion-desc">Hemat Rp 50.000 min. belanja Rp 500.000</div>
                                        </div>
                                        <div class="suggestion-action">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="summary-divider"></div>

                            <!-- Discount -->
                            <div class="summary-row discount-row" id="discount_container" style="display: none;">
                                <span class="summary-label discount-label">
                                    <i class="fas fa-tag me-2"></i>Diskon
                                </span>
                                <span class="summary-value discount-value">-Rp <span id="discount_amount">0</span></span>
                            </div>

                            <!-- Shipping -->
                            <div class="summary-row">
                                <span class="summary-label">
                                    <i class="fas fa-truck me-2"></i>Ongkir
                                </span>
                                <span class="summary-value shipping-free">GRATIS</span>
                            </div>

                            <!-- Total -->
                            <div class="summary-total">
                                <div class="total-row">
                                    <span class="total-label">Total Pembayaran</span>
                                    <span class="total-value">Rp <span id="total_summary">0</span></span>
                                </div>
                                <div class="savings-info" id="savings_info" style="display: none;">
                                    <i class="fas fa-piggy-bank me-1"></i>
                                    Anda hemat Rp <span id="savings_amount">0</span>
                                </div>
                            </div>

                            <!-- Payment Methods -->
                            <div class="payment-methods">
                                <div class="payment-label">Metode Pembayaran:</div>
                                <div class="payment-icons">
                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/visa/visa-original.svg"
                                        alt="Visa">
                                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mastercard/mastercard-original.svg"
                                        alt="Mastercard">
                                    <span class="payment-icon">OVO</span>
                                    <span class="payment-icon">DANA</span>
                                </div>
                            </div>
                        </div>

                        <!-- Summary Footer -->
                        <div class="summary-footer">
                            <button type="button" class="checkout-btn" onclick="proceedToCheckout()">
                                <div class="btn-content">
                                    <span class="btn-text">Checkout Sekarang</span>
                                    <span class="btn-count">(<span id="buy_count">0</span> produk)</span>
                                </div>
                                <div class="btn-icon">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </button>
                            <div class="continue-shopping">
                                <a href="{{ route('home') }}" class="continue-link">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Lanjutkan Belanja
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Security Info -->
                    <div class="security-card mt-4 animate__animated animate__fadeInUp">
                        <div class="security-content">
                            <div class="security-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="security-text">
                                <h5>Pembayaran Aman</h5>
                                <p>Transaksi Anda dilindungi dengan enkripsi SSL 256-bit</p>
                            </div>
                        </div>
                        <div class="security-features">
                            <div class="feature-item">
                                <i class="fas fa-check-circle"></i>
                                <span>Garansi 100%</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-undo"></i>
                                <span>7 Hari Pengembalian</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-headset"></i>
                                <span>Support 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden Checkout Form -->
            <form id="checkoutForm" method="POST" action="{{ route('customer.checkout.index') }}">
                @csrf
                <input type="hidden" name="voucher_code" id="hidden_voucher_code">
                <div id="hidden_cart_inputs"></div>
            </form>
        @else
            <!-- Empty Cart -->
            <div class="empty-cart-section animate__animated animate__fadeInUp">
                <div class="empty-cart-content">
                    <div class="empty-cart-animation">
                        <div class="cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="empty-animation">
                            <div class="floating-items">
                                <div class="item item-1"><i class="fas fa-shirt"></i></div>
                                <div class="item item-2"><i class="fas fa-mobile-alt"></i></div>
                                <div class="item item-3"><i class="fas fa-book"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="empty-cart-text">
                        <h2>Keranjang Belanja Kosong</h2>
                        <p>Sepertinya Anda belum menambahkan produk apapun ke keranjang. Ayo mulai berbelanja dan temukan
                            produk menarik!</p>
                    </div>
                    <div class="empty-cart-actions">
                        <a href="/" class="btn-start-shopping">
                            <span class="btn-text">Mulai Berbelanja</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="#" class="btn-categories">
                            <i class="fas fa-th-large me-2"></i>
                            Lihat Kategori
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Enhanced Styles -->
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --secondary-color: #ec4899;
            --success-color: #10b981;
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

        /* Page Title & Breadcrumb */
        .breadcrumb-container {
            background: var(--white);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .breadcrumb {
            margin-bottom: 0;
        }

        .breadcrumb-link {
            color: var(--text-light);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .breadcrumb-link:hover {
            color: var(--primary-color);
        }

        .cart-stats {
            display: flex;
            gap: 16px;
        }

        .stat-card {
            background: var(--gradient-primary);
            color: white;
            padding: 16px 20px;
            border-radius: 12px;
            text-align: center;
            min-width: 80px;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .stat-label {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        /* Cart Card */
        .cart-card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .cart-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            background: var(--bg-light);
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

        .selected-count {
            color: var(--text-light);
            font-size: 0.875rem;
        }

        .action-btn {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-light);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .action-btn:hover:not(:disabled) {
            border-color: var(--danger-color);
            color: var(--danger-color);
        }

        .action-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Cart Items */
        .cart-items {
            max-height: 600px;
            overflow-y: auto;
        }

        .cart-item {
            padding: 24px;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            background: var(--bg-light);
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-content {
            display: grid;
            grid-template-columns: auto 1fr auto auto;
            gap: 20px;
            align-items: center;
        }

        .item-checkbox {
            display: flex;
            align-items: center;
        }

        .item-product {
            display: flex;
            gap: 16px;
            align-items: center;
            min-width: 0;
        }

        .product-image {
            position: relative;
            width: 80px;
            height: 80px;
            border-radius: 12px;
            overflow: hidden;
            background: var(--bg-light);
            flex-shrink: 0;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .product-image:hover .image-overlay {
            opacity: 1;
        }

        .product-image:hover img {
            transform: scale(1.05);
        }

        .product-details {
            min-width: 0;
        }

        .product-name {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .product-meta {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .product-price {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .current-price {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .original-price {
            font-size: 0.875rem;
            color: var(--text-light);
            text-decoration: line-through;
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

        /* Quantity Control */
        .item-quantity {
            text-align: center;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            background: var(--bg-light);
            border-radius: 12px;
            padding: 4px;
            margin-bottom: 8px;
        }

        .quantity-btn {
            width: 32px;
            height: 32px;
            border: none;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: var(--text-dark);
        }

        .quantity-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.05);
        }

        .quantity-input {
            width: 50px;
            border: none;
            background: transparent;
            text-align: center;
            font-weight: 600;
            color: var(--text-dark);
        }

        .stock-info {
            font-size: 0.75rem;
            color: var(--success-color);
        }

        /* Item Total */
        .item-total {
            text-align: right;
        }

        .subtotal-amount {
            margin-bottom: 12px;
        }

        .subtotal-label {
            display: block;
            font-size: 0.75rem;
            color: var(--text-light);
            margin-bottom: 4px;
        }

        .subtotal-value {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .item-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .item-actions .action-btn {
            width: 36px;
            height: 36px;
            padding: 0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-btn.favorite:hover {
            border-color: var(--secondary-color);
            color: var(--secondary-color);
        }

        .action-btn.delete:hover {
            border-color: var(--danger-color);
            color: var(--danger-color);
        }

        /* Recommended Section */
        .recommended-section {
            background: var(--white);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow-md);
        }

        .section-header {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .section-subtitle {
            color: var(--text-light);
            font-size: 0.875rem;
        }

        .recommended-products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 16px;
        }

        .recommended-item {
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .recommended-item:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .recommended-image {
            position: relative;
            height: 120px;
            background: var(--bg-light);
        }

        .recommended-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .recommended-overlay {
            position: absolute;
            top: 8px;
            right: 8px;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .recommended-item:hover .recommended-overlay {
            opacity: 1;
        }

        .btn-add-to-cart {
            width: 32px;
            height: 32px;
            background: white;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            box-shadow: var(--shadow-md);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-add-to-cart:hover {
            background: var(--primary-color);
            color: white;
        }

        .recommended-info {
            padding: 12px;
        }

        .recommended-info h5 {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 4px;
            color: var(--text-dark);
        }

        .recommended-info p {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0;
        }

        /* Summary Card */
        .summary-card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 20px;
        }

        .summary-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            background: var(--gradient-primary);
            color: white;
            border-radius: 16px 16px 0 0;
        }

        .summary-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0;
        }

        .summary-body {
            padding: 24px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .summary-label {
            color: var(--text-light);
            font-size: 0.875rem;
        }

        .summary-value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .discount-label {
            color: var(--success-color);
        }

        .discount-value {
            color: var(--success-color);
        }

        .shipping-free {
            color: var(--success-color);
            font-weight: 700;
        }

        .summary-divider {
            height: 1px;
            background: var(--border-color);
            margin: 20px 0;
        }

        /* Voucher Section */
        .voucher-section {
            background: var(--bg-light);
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
        }

        .voucher-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 12px;
            display: block;
        }

        .voucher-input-group {
            display: flex;
            gap: 8px;
            margin-bottom: 12px;
        }

        .voucher-input {
            flex: 1;
            padding: 12px 16px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .voucher-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .voucher-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .voucher-btn:hover {
            background: var(--primary-dark);
        }

        .voucher-feedback {
            min-height: 24px;
            margin-bottom: 12px;
        }

        .voucher-suggestions {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .suggestion-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .suggestion-item:hover {
            border-color: var(--primary-color);
            background: rgba(99, 102, 241, 0.05);
        }

        .suggestion-code {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 0.875rem;
        }

        .suggestion-desc {
            font-size: 0.75rem;
            color: var(--text-light);
        }

        .suggestion-action {
            width: 24px;
            height: 24px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        /* Summary Total */
        .summary-total {
            background: var(--bg-light);
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .total-label {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .total-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color);
        }

        .savings-info {
            font-size: 0.875rem;
            color: var(--success-color);
            text-align: center;
        }

        /* Payment Methods */
        .payment-methods {
            margin-top: 20px;
        }

        .payment-label {
            font-size: 0.875rem;
            color: var(--text-light);
            margin-bottom: 8px;
        }

        .payment-icons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .payment-icons img {
            height: 24px;
            opacity: 0.7;
        }

        .payment-icon {
            background: var(--bg-light);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-light);
        }

        /* Summary Footer */
        .summary-footer {
            padding: 0 24px 24px;
        }

        .checkout-btn {
            width: 100%;
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 16px;
            box-shadow: var(--shadow-md);
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-text {
            font-size: 1rem;
        }

        .btn-count {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        .btn-icon {
            font-size: 1.25rem;
        }

        .continue-shopping {
            text-align: center;
        }

        .continue-link {
            color: var(--text-light);
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .continue-link:hover {
            color: var(--primary-color);
        }

        /* Security Card */
        .security-card {
            background: var(--white);
            border-radius: 16px;
            padding: 20px;
            box-shadow: var(--shadow-md);
        }

        .security-content {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .security-icon {
            width: 48px;
            height: 48px;
            background: var(--gradient-primary);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .security-text h5 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .security-text p {
            font-size: 0.875rem;
            color: var(--text-light);
            margin-bottom: 0;
        }

        .security-features {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.875rem;
            color: var(--text-light);
        }

        .feature-item i {
            color: var(--success-color);
        }

        /* Empty Cart */
        .empty-cart-section {
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
        }

        .empty-cart-content {
            text-align: center;
            max-width: 500px;
        }

        .empty-cart-animation {
            position: relative;
            margin-bottom: 40px;
        }

        .cart-icon {
            font-size: 6rem;
            color: var(--text-light);
            opacity: 0.3;
            margin-bottom: 20px;
        }

        .floating-items {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 200px;
        }

        .item {
            position: absolute;
            font-size: 1.5rem;
            color: var(--primary-color);
            opacity: 0.6;
            animation: float 4s ease-in-out infinite;
        }

        .item-1 {
            top: 20%;
            left: 20%;
            animation-delay: 0s;
        }

        .item-2 {
            top: 20%;
            right: 20%;
            animation-delay: 1.3s;
        }

        .item-3 {
            bottom: 20%;
            left: 50%;
            transform: translateX(-50%);
            animation-delay: 2.6s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .empty-cart-text h2 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .empty-cart-text p {
            color: var(--text-light);
            font-size: 1.125rem;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .empty-cart-actions {
            display: flex;
            flex-direction: column;
            gap: 16px;
            align-items: center;
        }

        .btn-start-shopping {
            background: var(--gradient-primary);
            color: white;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-md);
        }

        .btn-start-shopping:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: white;
        }

        .btn-categories {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-categories:hover {
            color: var(--primary-color);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .item-content {
                grid-template-columns: auto 1fr;
                gap: 16px;
            }

            .item-quantity,
            .item-total {
                grid-column: 1 / -1;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 16px;
            }

            .recommended-products {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }

            .cart-stats {
                display: none;
            }

            .cart-item {
                padding: 16px;
            }

            .item-content {
                gap: 12px;
            }

            .product-image {
                width: 60px;
                height: 60px;
            }

            .summary-card {
                position: static;
                margin-top: 24px;
            }

            .voucher-suggestions {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .breadcrumb-container {
                padding: 16px;
            }

            .empty-cart-text h2 {
                font-size: 1.5rem;
            }

            .empty-cart-text p {
                font-size: 1rem;
            }

            .empty-cart-actions {
                flex-direction: column;
                gap: 12px;
            }
        }

        /* Smooth Scrolling */
        .cart-items::-webkit-scrollbar {
            width: 6px;
        }

        .cart-items::-webkit-scrollbar-track {
            background: var(--bg-light);
            border-radius: 3px;
        }

        .cart-items::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 3px;
        }

        .cart-items::-webkit-scrollbar-thumb:hover {
            background: var(--text-light);
        }
    </style>

    <script>
        // Global variables
        let appliedVoucher = null;

        document.addEventListener('DOMContentLoaded', function() {
            updateCheckoutTotal();
            initializeTooltips();
            initializeAnimations();
        });

        // Initialize tooltips
        function initializeTooltips() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        // Initialize animations
        function initializeAnimations() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            document.querySelectorAll('.cart-item, .recommended-item').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'all 0.6s ease';
                observer.observe(el);
            });
        }

        // Toggle all products
        function toggleAllProducts() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const productCheckboxes = document.querySelectorAll('.product-checkbox');

            productCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });

            updateCheckoutTotal();
            updateSelectedCount();
            updateDeleteButton();
        }

        // Update quantity
        function updateQuantity(cartId, increment) {
            const jumlahElement = document.getElementById('jumlah_' + cartId);
            const displayJumlahElement = document.getElementById('display_jumlah_' + cartId);
            const subTotalElement = document.getElementById('sub_total_' + cartId);
            let jumlah = parseInt(jumlahElement.value) + increment;

            if (jumlah >= 1) {
                jumlahElement.value = jumlah;
                displayJumlahElement.value = jumlah;

                const harga = parseFloat(document.querySelector('.product-checkbox[data-cart-id="' + cartId + '"]').dataset
                    .harga);
                const subTotal = jumlah * harga;
                subTotalElement.innerHTML = subTotal.toLocaleString('id-ID');

                // Add animation to quantity change
                const quantityControl = displayJumlahElement.closest('.quantity-control');
                quantityControl.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    quantityControl.style.transform = 'scale(1)';
                }, 150);

                updateCheckoutTotal();
            }
        }

        // Update checkout total
        function updateCheckoutTotal() {
            const checkboxes = document.querySelectorAll('.product-checkbox');
            let subtotal = 0;
            let count = 0;
            let itemCount = 0;

            checkboxes.forEach(function(checkbox) {
                const cartId = checkbox.dataset.cartId;
                const jumlahElement = document.getElementById('jumlah_' + cartId);
                const harga = parseFloat(checkbox.dataset.harga);

                if (checkbox.checked) {
                    const jumlah = parseInt(jumlahElement.value);
                    subtotal += jumlah * harga;
                    count++;
                    itemCount += jumlah;
                }
            });

            let discount = 0;
            let savings = 0;

            // Apply voucher discount
            if (appliedVoucher && subtotal >= appliedVoucher.min_belanja) {
                if (appliedVoucher.jenis === 'persen') {
                    discount = subtotal * (appliedVoucher.nilai / 100);
                    if (appliedVoucher.maks_diskon) {
                        discount = Math.min(discount, appliedVoucher.maks_diskon);
                    }
                } else {
                    discount = appliedVoucher.nilai;
                }
                savings = discount;

                showVoucherSuccess();
                showDiscountContainer(discount);
            } else if (appliedVoucher) {
                showVoucherWarning();
                hideDiscountContainer();
            } else {
                hideVoucherFeedback();
                hideDiscountContainer();
            }

            const totalAkhir = subtotal - discount;

            // Update display values with animation
            animateNumberChange('subtotal_amount', subtotal);
            animateNumberChange('total_summary', totalAkhir);
            animateNumberChange('buy_count', count);
            animateNumberChange('items_count', itemCount);

            if (savings > 0) {
                document.getElementById('savings_info').style.display = 'block';
                animateNumberChange('savings_amount', savings);
            } else {
                document.getElementById('savings_info').style.display = 'none';
            }

            updateSelectAllStatus();
            updateSelectedCount();
            updateDeleteButton();
        }

        // Animate number changes
        function animateNumberChange(elementId, newValue) {
            const element = document.getElementById(elementId);
            const currentValue = parseInt(element.textContent.replace(/[^\d]/g, '')) || 0;

            if (currentValue !== newValue) {
                element.style.transform = 'scale(1.1)';
                element.style.color = 'var(--primary-color)';

                setTimeout(() => {
                    element.textContent = newValue.toLocaleString('id-ID');
                    element.style.transform = 'scale(1)';
                    element.style.color = '';
                }, 100);
            }
        }

        // Update selected count
        function updateSelectedCount() {
            const checkedCheckboxes = document.querySelectorAll('.product-checkbox:checked');
            const selectedCountElement = document.getElementById('selectedCount');
            selectedCountElement.textContent = `${checkedCheckboxes.length} item dipilih`;
        }

        // Update delete button state
        function updateDeleteButton() {
            const checkedCheckboxes = document.querySelectorAll('.product-checkbox:checked');
            const deleteBtn = document.querySelector('.delete-selected');
            deleteBtn.disabled = checkedCheckboxes.length === 0;
        }

        // Update select all status
        function updateSelectAllStatus() {
            const allCheckboxes = document.querySelectorAll('.product-checkbox');
            const checkedCheckboxes = document.querySelectorAll('.product-checkbox:checked');
            const selectAllCheckbox = document.getElementById('selectAll');

            if (allCheckboxes.length === checkedCheckboxes.length && allCheckboxes.length > 0) {
                selectAllCheckbox.checked = true;
                selectAllCheckbox.indeterminate = false;
            } else if (checkedCheckboxes.length === 0) {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = false;
            } else {
                selectAllCheckbox.indeterminate = true;
            }
        }

        // Voucher functions
        function showVoucherSuccess() {
            document.getElementById('voucher_badge').innerHTML =
                `<div class="alert alert-success py-2 mb-0">
                    <i class="fas fa-check-circle me-1"></i>
                    Voucher ${appliedVoucher.kode} berhasil diterapkan
                </div>`;
        }

        function showVoucherWarning() {
            document.getElementById('voucher_badge').innerHTML =
                `<div class="alert alert-warning py-2 mb-0">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Minimum belanja Rp ${appliedVoucher.min_belanja.toLocaleString('id-ID')}
                </div>`;
        }

        function hideVoucherFeedback() {
            document.getElementById('voucher_badge').innerHTML = '';
        }

        function showDiscountContainer(discount) {
            const container = document.getElementById('discount_container');
            container.style.display = 'flex';
            document.getElementById('discount_amount').textContent = Math.round(discount).toLocaleString('id-ID');
        }

        function hideDiscountContainer() {
            document.getElementById('discount_container').style.display = 'none';
        }

        // Apply voucher code from suggestions
        function applyVoucherCode(code) {
            document.getElementById('voucher_code').value = code;
            document.getElementById('btnApplyVoucher').click();
        }

        // Apply voucher
        document.getElementById('btnApplyVoucher')?.addEventListener('click', function() {
            const kodeVoucher = document.getElementById('voucher_code').value.trim();
            const btnText = this.querySelector('.btn-text');
            const btnLoading = this.querySelector('.btn-loading');

            if (kodeVoucher === "") {
                appliedVoucher = null;
                hideVoucherFeedback();
                hideDiscountContainer();
                updateCheckoutTotal();
                return;
            }

            // Show loading state
            btnText.classList.add('d-none');
            btnLoading.classList.remove('d-none');
            this.disabled = true;

            fetch("{{ route('customer.voucher.cek') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        kode: kodeVoucher
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Reset button
                    btnText.classList.remove('d-none');
                    btnLoading.classList.add('d-none');
                    this.disabled = false;

                    if (data.error) {
                        document.getElementById('voucher_badge').innerHTML =
                            `<div class="alert alert-danger py-2 mb-0">
                            <i class="fas fa-times-circle me-1"></i>
                            ${data.error}
                        </div>`;
                        appliedVoucher = null;
                        hideDiscountContainer();
                    } else {
                        appliedVoucher = data;
                        showNotification('success', `Voucher ${data.kode} berhasil diterapkan!`);
                    }
                    updateCheckoutTotal();
                })
                .catch(error => {
                    console.error("Error:", error);
                    btnText.classList.remove('d-none');
                    btnLoading.classList.add('d-none');
                    this.disabled = false;
                    showNotification('error', 'Terjadi kesalahan, silakan coba lagi.');
                });
        });

        // Show notification
        function showNotification(type, message) {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} notification-toast`;
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                ${message}
            `;

            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                min-width: 300px;
                animation: slideInRight 0.3s ease;
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Delete selected items
        function deleteSelected() {
            const checkedCheckboxes = document.querySelectorAll('.product-checkbox:checked');
            if (checkedCheckboxes.length === 0) return;

            if (!confirm(`Apakah Anda yakin ingin menghapus ${checkedCheckboxes.length} item dari keranjang?`)) {
                return;
            }

            const ids = Array.from(checkedCheckboxes).map(cb => cb.dataset.cartId);
            const deleteBtn = document.querySelector('.delete-selected');
            deleteBtn.disabled = true;

            fetch("{{ route('customer.keranjang.hapus.selected') }}", {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        ids
                    })
                })
                .then(res => res.ok ? res.json() : Promise.reject(res))
                .then(data => {
                    if (data.success) {
                        (data.deleted_ids || []).forEach(id => {
                            const cartItem = document.querySelector(`.cart-item[data-cart-id="${id}"]`);
                            if (cartItem) {
                                cartItem.style.animation = 'fadeOutLeft 0.3s ease';
                                setTimeout(() => {
                                    cartItem.remove();
                                    updateCheckoutTotal();
                                }, 300);
                            }
                        });

                        const notFound = data.not_found_ids || [];
                        if (notFound.length > 0) {
                            showNotification('error', `${notFound.length} item tidak ditemukan/unauthorized.`);
                        }

                        showNotification('success', `${data.deleted_count} item berhasil dihapus.`);
                    } else {
                        showNotification('error', 'Gagal menghapus item.');
                    }
                })
                .catch(() => showNotification('error', 'Terjadi kesalahan saat menghapus item.'))
                .finally(() => {
                    deleteBtn.disabled = false;
                    updateCheckoutTotal();
                });
        }

        // Proceed to checkout
        function proceedToCheckout() {
            const checkboxes = document.querySelectorAll('.product-checkbox:checked');
            const hiddenCartInputs = document.getElementById('hidden_cart_inputs');

            if (checkboxes.length === 0) {
                showNotification('error', 'Pilih minimal satu produk untuk checkout.');
                return;
            }

            // Add loading state to checkout button
            const checkoutBtn = document.querySelector('.checkout-btn');
            const originalContent = checkoutBtn.innerHTML;
            checkoutBtn.innerHTML = `
                <div class="btn-content">
                    <i class="fas fa-spinner fa-spin me-2"></i>
                    <span>Memproses...</span>
                </div>
            `;
            checkoutBtn.disabled = true;

            hiddenCartInputs.innerHTML = '';

            checkboxes.forEach(function(checkbox) {
                const cartId = checkbox.dataset.cartId;

                const inputCartId = document.createElement("input");
                inputCartId.type = "hidden";
                inputCartId.name = "selected_cart_ids[]";
                inputCartId.value = cartId;
                hiddenCartInputs.appendChild(inputCartId);

                const jumlah = document.getElementById('jumlah_' + cartId).value;
                const inputJumlah = document.createElement("input");
                inputJumlah.type = "hidden";
                inputJumlah.name = "jumlah[" + cartId + "]";
                inputJumlah.value = jumlah;
                hiddenCartInputs.appendChild(inputJumlah);
            });

            document.getElementById('hidden_voucher_code').value = appliedVoucher ? appliedVoucher.kode : '';

            // Simulate processing time
            setTimeout(() => {
                document.getElementById('checkoutForm').submit();
            }, 1000);
        }

        // Add event listeners
        document.querySelectorAll('.product-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateCheckoutTotal();
            });
        });

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
            @keyframes fadeOutLeft {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(-100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    </script>
@endsection
