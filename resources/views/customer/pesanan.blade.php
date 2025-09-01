{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        FadStore Pebayaran
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <main class="py-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 col-12">
                    <h2 class="fs-5 py-4 text-center">
                        Detail Pesanan
                    </h2>
                    <div class="card border rounded shadow">
                        <div class="card-body">
                            <form>
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-2">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" id="name" name="name" value="{{ $user->name }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Your Name" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" value="{{ $user->email }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Your Email">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input type="number" id="amount" name="amount" value="{{ $total }}"
                                            class="form-control @error('amount') is-invalid @enderror" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="note" class="form-label">Note</label>
                                        <textarea name="note" id="note" cols="30" rows="5"
                                            class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit" id="payButton">Pay</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script type="text/javascript">
        $.post("{{ route('pesanan.bayar') }}", {
                _method: 'POST',
                _token: '{{ csrf_token() }}',
                name: $('#name').val(),
                email: $('#email').val(),
                amount: $('#amount').val(),
                note: $('#note').val()
            },
            function(data, status) {
                // Periksa status response
                if (data.status === 'success') {
                    // Buka pop-up pembayaran dengan Snap.js
                    snap.pay(data.snap_token.snap_token, {
                        onSuccess: function(result) {
                            location.reload();
                        },

                        onPending: function(result) {
                            location.reload();
                        },

                        onError: function(result) {
                            location.reload();
                        }
                    });
                } else {
                    // Tampilkan pesan kesalahan jika diperlukan
                    console.error('Error in payment request:', data.message);
                }
            });
    </script>
</body>

</html> --}}

@extends('layouts.theme-pesanan')

@section('content')
    <main class="py-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 col-12">
                    <h2 class="fs-5 py-4 text-center">
                        Detail Pesanan
                    </h2>
                    <div class="card border rounded shadow">
                        <div class="card-body">
                            <form id="donation-form">
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-2">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input type="number" id="amount" name="amount" value="{{ $total }}" class="form-control @error('amount') is-invalid @enderror" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="note" class="form-label">Note</label>
                                        <textarea name="note" id="note" cols="30" rows="5" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" id="pay-button">Pay</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card border rounded shadow">
                        <div class="card-body">
                            <form id="donation-form">
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-2">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email">
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input type="number" id="amount" name="amount" value="{{ $total }}" class="form-control @error('amount') is-invalid @enderror" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="note" class="form-label">Note</label>
                                        <textarea name="note" id="note" cols="30" rows="5" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" id="pay-button">Pay</button>
                                </div>
                            </form>
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
                amount: $('#amount').val(),
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
        

{{-- <script>
    $(document).ready(function () {
    $('#btnPay').click(function () {
        $.ajax({
            type: 'POST',  // Ensure it's a POST request
            url: '/pesanan/bayar',
            dataType: 'json',
            success: function (response) {
                window.location.href = 'https://app.midtrans.com/snap/v1/' + response.snap_token;
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
});
</script> --}}


{{-- <script type="text/javascript">
            $('#pay-button').click(function(event) {
                event.preventDefault();

                $.post("{{ route('pesanan.bayar') }}", {
                        _method: 'POST',
                        _token: '{{ csrf_token() }}',
                        nama: $('#nama').val(),
                        email: $('#email').val(),
                        total: $('#total').val(),
                        // note: $('#note').val()
                    },
                    function(data, status) {
                        if (status === 'success') {
                            snap.pay(data.snap_token, {
                                onSuccess: function(result) {
                                    location.reload();
                                },
                                onPending: function(result) {
                                    location.reload();
                                },
                                onError: function(result) {
                                    alert('Error during payment: ' + result.status_message);
                                }
                            });
                        } else {
                            alert('Error: ' + data.message);
                        }
                    });
            });
        </script> --}}
</main>
@endsection
