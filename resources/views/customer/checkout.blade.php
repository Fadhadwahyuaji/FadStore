@extends('layouts.pembeli')

@section('content')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
<section class="checkout-section py-4 py-md-5" id="checkout">
    <div class="container">
        <div class="row g-4">
            <!-- Kolom Kiri: Informasi Pengiriman & Daftar Produk -->
            <div class="col-lg-8">
                <!-- Progress Steps -->
                <div class="checkout-progress mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="progress-step active">
                            <div class="step-number">1</div>
                            <div class="step-label d-none d-sm-block">Keranjang</div>
                        </div>
                        <div class="progress-connector active"></div>
                        <div class="progress-step active">
                            <div class="step-number">2</div>
                            <div class="step-label d-none d-sm-block">Pemesanan</div>
                        </div>
                        <div class="progress-connector"></div>
                        <div class="progress-step">
                            <div class="step-number">3</div>
                            <div class="step-label d-none d-sm-block">Pembayaran</div>
                        </div>
                        <div class="progress-connector"></div>
                        <div class="progress-step">
                            <div class="step-number">4</div>
                            <div class="step-label d-none d-sm-block">Selesai</div>
                        </div>
                    </div>
                </div>

                <!-- Card: Shipping Information -->
                <!-- Card: Shipping Information -->
                <div class="card mb-4 shadow-sm border-0 rounded-3 hover-lift">
                    <div class="card-header bg-white p-4 border-0">
                        <div class="d-flex align-items-center">
                            <div class="checkout-icon me-3">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                            </div>
                            <h5 class="mb-0">Informasi Alamat</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="address-block p-3 mb-3 bg-light rounded-3">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <p class="mb-1 fw-bold">{{ auth()->user()->name }}</p>
                                    @if ($alamat = auth()->user()->alamat->where('is_default', true)->first())
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="badge bg-primary me-2">{{ ucfirst($alamat->label) }}</span>
                                            <span class="badge bg-secondary">Alamat Utama</span>
                                        </div>
                                        <small class="text-muted d-block mb-1">
                                            <i class="fas fa-user me-1"></i> {{ $alamat->nama_penerima }}
                                            ({{ $alamat->no_hp }})
                                        </small>
                                        <small class="text-muted d-block">
                                            <i class="fas fa-home me-1"></i> {{ $alamat->alamat_lengkap }},
                                            {{ $alamat->kota }}, {{ $alamat->provinsi }} {{ $alamat->kode_pos }}
                                            @if ($alamat->tambahan)
                                                <span class="text-primary d-block mt-1">
                                                    <i class="fas fa-info-circle me-1"></i> {{ $alamat->tambahan }}
                                                </span>
                                            @endif
                                        </small>
                                    @else
                                        <div class="alert alert-warning mb-0 py-2 mt-2">
                                            <small><i class="fas fa-exclamation-circle me-1"></i> Silakan tambahkan
                                                alamat pengiriman</small>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                    <button class="btn btn-sm btn-outline-primary mb-2 mb-md-0" data-bs-toggle="modal"
                                        data-bs-target="#addressModal">
                                        <i class="fas fa-plus me-1"></i> Tambah Alamat
                                    </button>
                                    <button class="btn btn-sm btn-link text-decoration-none" data-bs-toggle="modal"
                                        data-bs-target="#selectAddressModal">
                                        <i class="fas fa-exchange-alt me-1"></i> Ubah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Tambah Alamat -->
                <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="addressModalLabel">
                                    <i class="fas fa-plus-circle me-2"></i>Tambah Alamat Baru
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="addressForm" method="POST" action="{{ route('customer.alamat.store') }}">
                                @csrf
                                <div class="modal-body">
                                    <!-- Baris untuk Nama Penerima dan No HP -->
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-user me-1 text-primary"></i>Nama Penerima
                                            </label>
                                            <input type="text" class="form-control" name="nama_penerima" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-phone me-1 text-primary"></i>No HP
                                            </label>
                                            <input type="text" class="form-control" name="no_hp" required>
                                        </div>
                                    </div>

                                    <!-- Baris untuk Provinsi dan Kota -->
                                    <div class="row g-3 mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-map me-1 text-primary"></i>Provinsi
                                            </label>
                                            <input type="text" class="form-control" name="provinsi" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-city me-1 text-primary"></i>Kota/Kabupaten
                                            </label>
                                            <input type="text" class="form-control" name="kota" required>
                                        </div>
                                    </div>

                                    <!-- Field Umum -->
                                    <div class="row g-3 mt-2">
                                        <div class="col-12">
                                            <label class="form-label">
                                                <i class="fas fa-map-marker-alt me-1 text-primary"></i>Alamat Lengkap
                                            </label>
                                            <textarea class="form-control" name="alamat_lengkap" rows="3" required></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">
                                                <i class="fas fa-mail-bulk me-1 text-primary"></i>Kode Pos
                                            </label>
                                            <input type="text" class="form-control" name="kode_pos" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">
                                                <i class="fas fa-tag me-1 text-primary"></i>Label Alamat
                                            </label>
                                            <select class="form-select" name="label" required>
                                                <option value="">Pilih Label</option>
                                                <option value="rumah">Rumah</option>
                                                <option value="kantor">Kantor</option>
                                                <option value="kos">Kos</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">
                                                <i class="fas fa-info-circle me-1 text-primary"></i>Tambahan
                                            </label>
                                            <input type="text" class="form-control" name="tambahan"
                                                placeholder="Catatan tambahan">
                                        </div>
                                    </div>

                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" name="is_default"
                                            id="isDefault" value="1">
                                        <label class="form-check-label" for="isDefault">
                                            <i class="fas fa-star me-1 text-warning"></i>Jadikan sebagai alamat utama
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                        <i class="fas fa-times me-1"></i>Tutup
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Simpan Alamat
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Pilih Alamat -->
                <div class="modal fade" id="selectAddressModal" tabindex="-1"
                    aria-labelledby="selectAddressModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title" id="selectAddressModalLabel">
                                    <i class="fas fa-map-marked-alt me-2"></i>Pilih Alamat Pengiriman
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#addressModal" data-bs-dismiss="modal">
                                        <i class="fas fa-plus-circle me-1"></i>Tambah Alamat Baru
                                    </button>
                                </div>

                                <form id="selectAddressForm" method="POST"
                                    action="{{ route('customer.alamat.set-default') }}">
                                    @csrf
                                    <div class="address-list">
                                        @forelse(auth()->user()->alamat as $alamatItem)
                                            <div
                                                class="address-item p-3 mb-3 border rounded-3 {{ $alamatItem->is_default ? 'border-primary' : '' }}">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="form-check me-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="alamat_id" id="alamat{{ $alamatItem->id }}"
                                                                    value="{{ $alamatItem->id }}"
                                                                    {{ $alamatItem->is_default ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="alamat{{ $alamatItem->id }}">
                                                                    <span
                                                                        class="fw-bold">{{ $alamatItem->nama_penerima }}</span>
                                                                </label>
                                                            </div>
                                                            <span
                                                                class="badge bg-primary me-1">{{ ucfirst($alamatItem->label) }}</span>
                                                            @if ($alamatItem->is_default)
                                                                <span class="badge bg-success">
                                                                    <i class="fas fa-check me-1"></i>Alamat Utama
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <p class="mb-1 text-muted small">
                                                            <i class="fas fa-phone me-1"></i>{{ $alamatItem->no_hp }}
                                                        </p>
                                                        <p class="mb-1 small">
                                                            <i
                                                                class="fas fa-map-marker-alt me-1"></i>{{ $alamatItem->alamat_lengkap }},
                                                            {{ $alamatItem->kota }}, {{ $alamatItem->provinsi }}
                                                            {{ $alamatItem->kode_pos }}
                                                        </p>
                                                        @if ($alamatItem->tambahan)
                                                            <p class="mb-0 small text-primary">
                                                                <i
                                                                    class="fas fa-info-circle me-1"></i>{{ $alamatItem->tambahan }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div
                                                        class="col-md-4 text-md-end d-flex flex-column justify-content-between">
                                                        <div class="mb-2 mt-2 mt-md-0">
                                                            <a href="{{ route('customer.alamat.edit', $alamatItem->id) }}"
                                                                class="btn btn-sm btn-outline-primary me-1">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-danger"
                                                                onclick="confirmDelete({{ $alamatItem->id }})">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                        @if (!$alamatItem->is_default)
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-success mt-auto"
                                                                onclick="document.getElementById('alamat{{ $alamatItem->id }}').checked = true; setAsDefault({{ $alamatItem->id }})">
                                                                <i class="far fa-star me-1"></i>Jadikan Utama
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="alert alert-warning">
                                                <i class="fas fa-exclamation-triangle me-1"></i>Anda belum memiliki
                                                alamat tersimpan.
                                            </div>
                                        @endforelse
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-1"></i>Tutup
                                </button>
                                <button type="button" class="btn btn-primary" id="btnSelectAddress">
                                    <i class="fas fa-check me-1"></i>Pilih Alamat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Card: Shipping Method -->
                <div class="card mb-4 shadow-sm border-0 rounded-3 hover-lift">
                    <div class="card-header bg-white p-4 border-0">
                        <div class="d-flex align-items-center">
                            <div class="checkout-icon me-3">
                                <i class="fas fa-truck text-primary"></i>
                            </div>
                            <h5 class="mb-0">Metode Pengiriman</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if ($alamat && ($alamat->city_id || $alamat->kota_manual))
                            <!-- Dynamic shipping options -->
                        @else
                            <div class="alert alert-warning">
                                <small>
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    Sistem perhitungan ongkir otomatis tidak tersedia.
                                </small>
                            </div>
                            <div class="shipping-options">
                                <div class="shipping-option p-3 rounded-3 border mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="shipping-radio me-3">
                                                <input type="radio" name="shipping_method" value="jne" checked>
                                                <label></label>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-medium">JNE Regular</p>
                                                <small class="text-muted">Estimasi: 2-3 hari</small>
                                            </div>
                                        </div>
                                        <div class="shipping-price fw-medium">Rp 20.000</div>
                                    </div>
                                </div>
                                <div class="shipping-option p-3 rounded-3 border mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="shipping-radio me-3">
                                                <input type="radio" name="shipping_method" value="jnt">
                                                <label></label>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-medium">J&T Express</p>
                                                <small class="text-muted">Estimasi: 1-2 hari</small>
                                            </div>
                                        </div>
                                        <div class="shipping-price fw-medium">Rp 20.000</div>
                                    </div>
                                </div>
                                <div class="shipping-option p-3 rounded-3 border">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="shipping-radio me-3">
                                                <input type="radio" name="shipping_method" value="tiki">
                                                <label></label>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-medium">TIKI Regular</p>
                                                <small class="text-muted">Estimasi: 3-5 hari</small>
                                            </div>
                                        </div>
                                        <div class="shipping-price fw-medium">Rp 20.000</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Card: Order Review / Produk -->
                <div class="card shadow-sm border-0 rounded-3 hover-lift">
                    <div class="card-header bg-white p-4 border-0">
                        <div class="d-flex align-items-center">
                            <div class="checkout-icon me-3">
                                <i class="fas fa-shopping-bag text-primary"></i>
                            </div>
                            <h5 class="mb-0">Order Review</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @foreach ($cartItems as $item)
                            <div
                                class="product-item d-flex flex-column flex-sm-row align-items-center mb-4 pb-4 @if (!$loop->last) border-bottom @endif">
                                <div class="product-image me-sm-4 mb-3 mb-sm-0">
                                    <img src="{{ asset('/' . basename($item->produk->gambar)) }}"
                                        alt="{{ $item->produk->nama }}" class="img-fluid rounded shadow-sm"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                                <div class="product-info flex-grow-1">
                                    <h6 class="product-title mb-1">{{ $item->produk->nama }}</h6>
                                    <div class="product-meta d-flex flex-wrap align-items-center mb-2">
                                        <span class="badge bg-light text-dark me-2 mb-1">Qty:
                                            {{ $item->jumlah }}</span>
                                        @if ($item->produk->kategori)
                                            <span
                                                class="badge bg-light text-dark mb-1">{{ $item->produk->kategori }}</span>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="fw-bold mb-0">Rp {{ number_format($item->sub_total, 0, ',', '.') }}
                                        </p>
                                        <button class="btn btn-sm btn-outline-danger remove-item" type="button">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Payment Method & Order Summary -->
            <div class="col-lg-4">
                <div class="sticky-top checkout-summary" style="top: 20px; z-index: 99;">
                    <!-- Payment Method Card -->
                    <div class="card mb-4 shadow-sm border-0 rounded-3 hover-lift">
                        <div class="card-header bg-white p-4 border-0">
                            <div class="d-flex align-items-center">
                                <div class="checkout-icon me-3">
                                    <i class="fas fa-credit-card text-primary"></i>
                                </div>
                                <h5 class="mb-0">Metode Pembayaran</h5>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="alert alert-info mb-3">
                                <small><i class="fas fa-info-circle me-1"></i> You'll be redirected to Midtrans to
                                    complete payment</small>
                            </div>

                            <div class="midtrans-methods mb-3">
                                <p class="fw-medium mb-2">Pilih Metode Pembayaran:</p>

                                <!-- Credit Card Option -->
                                <div
                                    class="payment-method-option p-3 rounded-3 border mb-2 d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="far fa-credit-card text-primary me-2"></i>
                                        <span>Kartu Kredit</span>
                                    </div>
                                    <div class="payment-logos">
                                        <i class="fab fa-cc-visa me-1"></i>
                                        <i class="fab fa-cc-mastercard me-1"></i>
                                        <i class="fab fa-cc-jcb"></i>
                                    </div>
                                </div>

                                <!-- Virtual Account Option -->
                                <div
                                    class="payment-method-option p-3 rounded-3 border mb-2 d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-university text-primary me-2"></i>
                                        <span>Virtual Account</span>
                                    </div>
                                    <small class="text-muted">BCA, BNI, Mandiri</small>
                                </div>

                                <!-- E-Wallet Option -->
                                <div
                                    class="payment-method-option p-3 rounded-3 border mb-2 d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-wallet text-primary me-2"></i>
                                        <span>E-Wallet</span>
                                    </div>
                                    <small class="text-muted">GoPay, OVO, DANA</small>
                                </div>

                                <!-- Retail Outlets Option -->
                                <div
                                    class="payment-method-option p-3 rounded-3 border d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-store text-primary me-2"></i>
                                        <span>Retail Outlets</span>
                                    </div>
                                    <small class="text-muted">Alfamart, Indomaret</small>
                                </div>
                            </div>

                            <div class="mt-3 text-center">
                                <img src="https://storage.googleapis.com/midtrans-production/web/main-logo/midtrans-logo.png"
                                    alt="Midtrans" height="30" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Card -->
                    <div class="card shadow-sm border-0 rounded-3 hover-lift">
                        <div class="card-header bg-white p-4 border-0">
                            <div class="d-flex align-items-center">
                                <div class="checkout-icon me-3">
                                    <i class="fas fa-file-invoice-dollar text-primary"></i>
                                </div>
                                <h5 class="mb-0">Ringkasan Pesanan</h5>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <!-- Promo Code -->
                            <div class="mb-4">
                                <label for="promo-code" class="form-label fw-medium">Kode Promo</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="promo-code"
                                        placeholder="Masukan Kode" value="{{ $voucher ? $voucher->kode : '' }}">
                                    <button class="btn btn-primary" type="button">Gunakan</button>
                                </div>
                                @if ($voucher)
                                    <div class="mt-2">
                                        <span class="badge bg-success"><i class="fas fa-check me-1"></i>
                                            {{ $voucher->kode }} Digunakan</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Summary Details -->
                            <div class="summary-details p-3 bg-light rounded-3">
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Subtotal</span>
                                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>

                                @if ($voucher)
                                    <div class="d-flex justify-content-between mb-3 text-success">
                                        <span><i class="fas fa-tag me-1"></i> Diskon</span>
                                        <span>-Rp {{ number_format($discount, 0, ',', '.') }}</span>
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between mb-3">
                                    <span>Ongkos Kirim</span>
                                    <span id="shipping-cost">
                                        Rp 20.000
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <strong>Total</strong>
                                    <strong class="text-primary fs-5" id="total-amount">
                                        Rp {{ number_format($total + 20000, 0, ',', '.') }}
                                    </strong>
                                </div>
                            </div>

                            <!-- Place Order Button -->
                            <button class="btn btn-primary w-100 py-3 mt-4 fw-medium" id="pay-button">
                                <i class="fas fa-lock me-2"></i> Bayar & Buat Pesanan
                            </button>

                            <!-- Security Note -->
                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-shield-alt me-1"></i> Secure checkout powered by Midtrans
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Di bagian header atau sebelum script custom -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('#pay-button').click(function(e) {
            e.preventDefault();

            // Validasi alamat terlebih dahulu
            const alamatId = {{ auth()->user()->alamat()->where('is_default', true)->first()?->id ?? 'null' }};
            if (!alamatId) {
                Swal.fire('Error!', 'Silakan pilih alamat pengiriman terlebih dahulu', 'error');
                return;
            }

            const data = {
                alamat_id: alamatId,
                shipping_method: $('input[name="shipping_method"]:checked').val(),
                shipping_cost: 20000,
                total: {{ $total }},
                discount: {{ $discount }},
                voucher_id: {{ $voucher->id ?? 'null' }},
                cart_items: @json($cartItemsArray)
            };

            // Tampilkan loading state
            const $btn = $(this);
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i> Memproses...');

            $.post("{{ route('customer.payment.process') }}", data)
                .done(function(res) {
                    if (res.error) {
                        throw new Error(res.error);
                    }

                    // Pastikan Snap tersedia
                    if (typeof snap === 'undefined') {
                        throw new Error('Midtrans SDK tidak terload');
                    }

                    snap.pay(res.snap_token, {
                        onSuccess: function(result) {
                            window.location.href = "{{ route('customer.payment.finish') }}";
                        },
                        onPending: function(result) {
                            window.location.href = "{{ route('customer.payment.finish') }}";
                        },
                        onError: function(result) {
                            window.location.href =
                                "{{ route('customer.payment.finish') }}?error=1";
                        }
                    });
                })
                .fail(function(err) {
                    console.error('Error:', err);
                    let message = 'Gagal memproses pembayaran';
                    if (err.responseJSON && err.responseJSON.error) {
                        message = err.responseJSON.error;
                    }
                    Swal.fire('Error!', message, 'error');
                })
                .always(function() {
                    $btn.prop('disabled', false).html('<i class="fas fa-lock me-2"></i> Bayar & Buat Pesanan');
                });
        });

        $(document).ready(function() {
            // Form tambah alamat
            $('#addressForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#addressModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Alamat berhasil disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan. Silakan coba lagi.'
                        });
                    }
                });
            });

            // Perbaikan untuk tombol pilih alamat
            $('#btnSelectAddress').off('click').on('click', function() {
                const selectedAddressId = $('input[name="alamat_id"]:checked').val();

                if (!selectedAddressId) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Silakan pilih alamat terlebih dahulu'
                    });
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: '{{ route('customer.alamat.set-default') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        alamat_id: selectedAddressId
                    },
                    success: function(response) {
                        $('#selectAddressModal').modal('hide');
                        location.reload(); // Langsung reload tanpa konfirmasi
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        Swal.fire('Error!', 'Gagal menyimpan perubahan', 'error');
                    }
                });
            });
        });

        // Fungsi hapus alamat langsung
        function deleteAddress(alamatId) {
            $.ajax({
                type: 'DELETE',
                url: `/alamat/${alamatId}`,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    location.reload(); // Langsung reload setelah hapus
                },
                error: function(xhr) {
                    console.error(xhr);
                    Swal.fire('Error!', 'Gagal menghapus alamat', 'error');
                }
            });
        }

        // Fungsi set as default
        function setAsDefault(alamatId) {
            $.ajax({
                type: 'POST',
                url: '{{ route('customer.alamat.set-default') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    alamat_id: alamatId
                },
                success: function() {
                    location.reload(); // Langsung reload setelah update
                },
                error: function(xhr) {
                    console.error(xhr);
                    Swal.fire('Error!', 'Gagal menyetel alamat utama', 'error');
                }
            });
        }
    </script>
</section>


// <!-- CSS Tambahan -->
<style>
    .shipping-radio input[type="radio"] {
        display: none;
    }

    .shipping-radio label {
        display: block;
        width: 20px;
        height: 20px;
        border: 2px solid #dee2e6;
        border-radius: 50%;
        cursor: pointer;
        position: relative;
    }

    .shipping-radio input[type="radio"]:checked+label {
        border-color: #0d6efd;
    }

    .shipping-radio input[type="radio"]:checked+label:after {
        content: '';
        position: absolute;
        top: 3px;
        left: 3px;
        width: 10px;
        height: 10px;
        background: #0d6efd;
        border-radius: 50%;
    }

    .shipping-option {
        transition: all 0.2s ease;
    }

    .shipping-option:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
    }

    #loadingShipping {
        min-height: 150px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .checkout-icon {
        width: 40px;
        height: 40px;
        background-color: rgba(13, 110, 253, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .checkout-icon i {
        font-size: 1.2rem;
    }

    .checkout-progress {
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .progress-step {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 1;
    }

    .step-number {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #e9ecef;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .progress-step.active .step-number {
        background: #0d6efd;
        color: white;
    }

    .progress-connector {
        height: 3px;
        background-color: #e9ecef;
        flex-grow: 1;
        margin: 15px 5px 0;
        position: relative;
        z-index: 0;
    }

    .progress-connector.active {
        background-color: #0d6efd;
    }

    .shipping-radio input[type="radio"],
    .payment-radio input[type="radio"] {
        display: none;
    }

    .shipping-radio label,
    .payment-radio label {
        display: block;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid #dee2e6;
        position: relative;
        cursor: pointer;
    }

    .shipping-radio input[type="radio"]:checked+label,
    .payment-radio input[type="radio"]:checked+label {
        border-color: #0d6efd;
    }

    .shipping-radio input[type="radio"]:checked+label:after,
    .payment-radio input[type="radio"]:checked+label:after {
        content: '';
        position: absolute;
        top: 3px;
        left: 3px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #0d6efd;
    }

    .shipping-option,
    .payment-option,
    .payment-method-option {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .shipping-option.selected,
    .payment-option.selected {
        border: 1px solid #0d6efd !important;
    }

    .payment-method-option:hover {
        border-color: #0d6efd !important;
        background-color: rgba(13, 110, 253, 0.05);
    }

    @media (max-width: 767.98px) {
        .product-item {
            text-align: center;
        }

        .checkout-progress {
            padding: 15px 10px;
        }

        .step-number {
            width: 25px;
            height: 25px;
            font-size: 0.8rem;
        }

        .progress-connector {
            margin: 12px 2px 0;
        }

        .shipping-price {
            margin-top: 10px;
        }

        .shipping-option .d-flex,
        .payment-method-option {
            flex-direction: column;
            text-align: center;
        }

        .shipping-option .shipping-price {
            margin-left: auto;
            margin-right: auto;
        }

        .payment-method-option .payment-logos {
            margin-top: 5px;
        }
    }
</style>

@endsection
