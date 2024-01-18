<!doctype html>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <h2 style="color: cornflowerblue">FADSTORE</h2>
            </a>

            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a id="btnBeliSekarang" class="nav-link" href="#">Produk</a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Link
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> --}}
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        @auth
                            <a class="nav-link" href="{{ route('keranjang') }}"><i class="bi bi-cart"></i></a>
                        @else
                            <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-cart"></i></a>
                        @endauth
                    </li>

                    <li class="dropdown ms-2">
                        @auth
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @else
                            <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-person"></i></a>
                        @endauth

                    </li>
                </ul>

            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="bg-dark text-light text-center py-3">
        <div class="container">
            <p>&copy; 2024 Fadhad Wahyu Aji</p>
        </div>
    </footer>

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

</html>