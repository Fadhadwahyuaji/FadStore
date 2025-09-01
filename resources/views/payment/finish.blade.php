@extends('layouts.pembeli')

@section('content')
    <section class="payment-status py-5">
        <div class="container text-center">
            @if ($status == 'success')
                <div class="icon-success mb-4">
                    <i class="fas fa-check-circle fa-5x text-success"></i>
                </div>
                <h1 class="mb-3">Pembayaran Berhasil!</h1>
                <p class="lead mb-4">Terima kasih telah melakukan pembayaran. Pesanan Anda sedang diproses.</p>
            @else
                <div class="icon-error mb-4">
                    <i class="fas fa-times-circle fa-5x text-danger"></i>
                </div>
                <h1 class="mb-3">Pembayaran Gagal</h1>
                <p class="lead mb-4">Silakan coba lagi atau hubungi customer service kami.</p>
            @endif

            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-home me-2"></i>Kembali ke Beranda
            </a>
        </div>
    </section>
@endsection
