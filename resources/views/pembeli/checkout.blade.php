@extends('layouts.theme-pesanan')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Informasi Tagihan/Alamat -->
                <div class="card-header"><h3>Detail Tagihan/Alamat</h3></div>
                <div class="card">
                    
                    <div class="card-body">
                        <form id="donation-form">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" value="{{ $user->name }}" disabled name="nama" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Alamat Email</label>
                                <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled name="email" required>
                            </div>

                            <div class="form-group">
                                <label for="nomor_hp">Nomor HP</label>
                                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required>
                            </div>

                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <input type="text" class="form-control" id="provinsi" name="provinsi" required>
                            </div>

                            <div class="form-group">
                                <label for="kota">Kabupaten/Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota" required>
                            </div>

                            <!-- Form input untuk kota, kecamatan, dll -->
                            <!-- ... -->

                            <div class="form-group">
                                <label for="alamat">Nama Jalan/Detail alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Detail Pesanan -->
                <div class="card-header"><h3>Detail Pesanan</h3></div>
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Quantity</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Isi tabel dengan data produk -->
                                <tr>
                                    <td>Produk 1</td>
                                    <td>2</td>
                                    <td>{{ $total }}</td>
                                    <td>$100</td>
                                </tr>
                                <!-- Tambahkan baris produk sesuai kebutuhan -->
                                <!-- ... -->
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-6">
                                <p>Subtotal: $100</p>
                            </div>
                            <div class="col-md-6">
                                <p>Total: $100</p>
                            </div>
                        </div>

                        <div class="text-right">
                            <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $('#pay-button').click(function (event) {
            event.preventDefault();
            
            $.post("{{ route('pesanan.bayar') }}", {
                _method: 'POST',
                _token: '{{ csrf_token() }}',
                name: $('#name').val(),
                email: $('#email').val(),
                // amount: $('#amount').val(),
            },
            function (data, status) {
                snap.pay(data.snap_token, {
                    onSuccess: function (result) {
                        location.reload();
                    },
            
                    onPending: function (result) {
                        location.reload();
                    },
            
                    onError: function (result) {
                        location.reload();
                    }
                    
                });
                return false;
            });
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>    
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
        
    </div>
@endsection
