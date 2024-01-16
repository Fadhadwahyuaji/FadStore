@extends('layouts.pembeli')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Keranjang Belanja</h1>

    @if(count($produks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Foto Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produks as $cart)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="icon-shape icon-md border p-4 rounded-1">
                                        <img src="{{ asset('storage/Foto_Produk/' . basename($cart->gambar)) }}" alt="" style="width: 60px; height: 60px;">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $cart->nama }}</td>
                        <td>{{ $cart->harga }}</td>
                        <td>{{ $cart->jumlah }}</td>
                        <td>{{ $cart->harga }}</td>
                        <td>
                            {{-- <a href="{{ route('cart.remove', ['id' => $cart->id]) }}">Hapus</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="mt-4">Keranjang belanja Anda kosong.</p>
    @endif
</div>
@endsection