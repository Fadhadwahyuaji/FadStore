@extends('layouts.pembeli')

@section('content')
<div class="container mt-5">
    <!-- Header dengan headline dan gambar/infografis -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="jumbotron text-left">
                    <h1 class="display-4">E-commerce T-Shirt</h1>
                    <p class="lead">Temukan koleksi terbaik kami untuk gaya Anda!</p>
                    <p>Manfaatkan berbagai promo dan penawaran eksklusif kami. Belanja sekarang!</p>
                    @auth
                    <a id="btnBeliSekarang1" class="btn btn-primary btn-lg" href="#" role="button">Beli Sekarang</a>
                    @else
                    <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Beli Sekarang</a>
                    @endauth
                </div>
            </div>
            <div class="col-md-6">
                <!-- Ganti path gambar dengan path yang sesuai -->
                <img src="Bucket-Hats.png" class="img-fluid" alt="Infografis E-commerce">
            </div>

            {{-- <div id="slideshow" class="carousel slide col-md-6" data-ride="carousel" data-interval="2000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="Bucket-Hats.png" class="d-block w-100" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                        <img src="tshirt.jpeg" class="d-block w-100" alt="Slide 2">
                    </div>
                    <div class="carousel-item">
                        <img src="caps.png" class="d-block w-100" alt="Slide 3">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#slideshow" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#slideshow" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div> --}}
        </div>
    </div>
    

    <hr class="my-4">
    <!-- Daftar Produk -->
    <div class="row" id="produk">
        <h1 class="display-6">Produk</h1>
        @if(count($produks) > 0)
        @foreach ($produks as $produk)
            <div class="col-md-4 product-card mb-4">
                <div class="card">
                    <img src="{{ asset('storage/Foto_Produk/' . basename($produk->gambar)) }}" class="card-img-top" alt="Product 1" style="height: 350px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $produk->nama }}</h5>
                        <p class="card-text description-limit">{{ Str::limit($produk->deskripsi, 500) }}</p>
                        <p class="card-text">Tersedia: {{ $produk->jumlah }}</p>
                        <p class="card-text">Harga: {{ $produk->harga }}</p>
                        @auth
                        <a href="{{ route('tambah.keranjang', ['produk' => $produk->id]) }}" class="btn btn-primary">Beli</a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Beli</a>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
        @else
        <div class="col-12 text-center">
            <p>Belum ada produk.</p>
        </div>
    @endif
    </div>
</div>
<script>
    document.getElementById('btnBeliSekarang1').addEventListener('click', function() {
        var targetElement = document.getElementById('produk');
        targetElement.scrollIntoView({ behavior: 'smooth' });
    });
</script>
@endsection