@extends('layouts.pembeli')

@section('content')
    <div class="container">
        <h1 class="mt-4 mb-4">Keranjang Belanja</h1>

        @if (count($keranjang) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Foto Produk</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keranjang as $cart)
                        <tr>
                            <td>
                                <input type="checkbox" class="product-checkbox" data-cart-id="{{ $cart->id }}" data-harga="{{ $cart->produk->harga }}" onchange="updateCheckoutTotal()">
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div>
                                        <div class="icon-shape icon-md border p-4 rounded-1">
                                            <img src="{{ asset('storage/Foto_Produk/' . basename($cart->produk->gambar)) }}"
                                                alt="" style="width: 60px; height: 60px;">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $cart->produk->nama }}</td>
                            <td>
                                <form action="{{ route('tambah.quantity', ['keranjang_id' => $cart->id]) }}" method="post"
                                    style="display: inline;">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="jumlah" id="jumlah_{{ $cart->id }}"
                                        value="{{ $cart->jumlah }}">
                                    <button type="button" class="btn btn-sm btn-secondary"
                                        onclick="updateQuantity('{{ $cart->id }}', -1)" {{ $cart->jumlah }}>-</button>
                                </form>

                                {{-- Tampilkan jumlah --}}
                                <span id="display_jumlah_{{ $cart->id }}">{{ $cart->jumlah }}</span>

                                <form action="{{ route('tambah.quantity', ['keranjang_id' => $cart->id]) }}" method="post"
                                    style="display: inline;">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="jumlah" id="jumlah_{{ $cart->id }}"
                                        value="{{ $cart->jumlah }}">
                                    <button type="button" class="btn btn-sm btn-primary"
                                        onclick="updateQuantity('{{ $cart->id }}', 1)">+</button>
                                </form>
                            </td>
                            <td>{{ $cart->produk->harga }}</td>
                            <td><span id="sub_total_{{ $cart->id }}">{{ $cart->sub_total }}</span></td>

                            <td>
                                <form action="{{ route('hapus.keranjang', ['id' => $cart->id]) }}" method="post"
                                    style="display: inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row mt-4 justify-content-end">
                <div class="col-md-6 text-md-end">
                    <strong>Total Harga:</strong> Rp <span id="total">0.00</span>
                </div>
            </div>

            <!-- Tombol Checkout -->
            <div class="row mt-4 justify-content-end">
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
                </div>
            </div>
        @else
            <p class="mt-4">Keranjang belanja Anda kosong.</p>
        @endif


        <script>
            function updateQuantity(cartId, increment) {
    var jumlahElement = document.getElementById('jumlah_' + cartId);
    var displayJumlahElement = document.getElementById('display_jumlah_' + cartId);
    var subTotalElement = document.getElementById('sub_total_' + cartId);

    var jumlah = parseInt(jumlahElement.value) + increment;

    if (jumlah >= 1) {
        jumlahElement.value = jumlah;
        displayJumlahElement.innerHTML = jumlah;

        // Retrieve product price dynamically from data attribute
        var harga = parseFloat(document.querySelector('.product-checkbox[data-cart-id="' + cartId + '"]').dataset.harga);
        var subTotal = jumlah * harga;
        subTotalElement.innerHTML = subTotal.toFixed(2);

        // Update nilai pada form sebelum submit
        document.getElementById('jumlah_' + cartId).value = jumlah;

        // Update total
        updateCheckoutTotal();
    }
}

function updateCheckoutTotal() {
    var checkboxes = document.querySelectorAll('.product-checkbox');
    var subtotal = 0;

    checkboxes.forEach(function (checkbox) {
        var cartId = checkbox.dataset.cartId;
        var jumlahElement = document.getElementById('jumlah_' + cartId);
        var subTotalElement = document.getElementById('sub_total_' + cartId);

        if (checkbox.checked) {
            var harga = parseFloat(checkbox.dataset.harga);
            var jumlah = parseInt(jumlahElement.value);
            var subTotal = jumlah * harga;
            subtotal += subTotal;

            subTotalElement.innerHTML = subTotal.toFixed(2);
        }
    });

    // Update subtotal and total in the DOM
    document.getElementById('total').innerHTML = subtotal.toFixed(2);
}

        </script>

    </div>
@endsection
