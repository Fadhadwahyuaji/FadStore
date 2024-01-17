<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('/assets/images/sislab_logo.png') }}">

    <!-- Libs CSS -->
    <link href="{{ url('/assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ url('/assets/libs/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    <link href="{{ url('/assets/libs/@mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ url('/assets/libs/prismjs/themes/prism-okaidia.css') }}" rel="stylesheet">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ url('/assets/css/theme.min.css') }}">
    <title>FadStore</title>
</head>

<body class="bg-light">
    <div id="db-wrapper">
        <!-- navbar vertical -->
        <!-- Sidebar -->
        <nav class="navbar-vertical navbar">
            <div class="nav-scroller">
                <!-- Brand logo -->
                <a class="navbar-brand" href="#">
                    <h2 style="color: cornflowerblue">FADSTORE</h2>
                    {{-- <img src="./assets/images/brand/logo/logo.svg" alt="" /> --}}
                </a>
                <!-- Navbar nav -->
                <ul class="navbar-nav flex-column" id="sideNavbar">
                    <li class="nav-item">
                        <a class="nav-link has-arrow active " href="#">
                            <i data-feather="home" class="nav-icon icon-xs me-2"></i> Dashboard
                        </a>

                    </li>
                </ul>
            </div>
        </nav>
        <!-- Page content -->
        <div id="page-content">
            <div class="header @@classList">
                <!-- navbar -->
                <nav class="navbar-classic navbar navbar-expand-lg">
                    <a id="nav-toggle" href="#"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
                    <!--Navbar nav -->
                    <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
                        <!-- List -->
                        <li class="dropdown ms-2">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                        </li>
                    </ul>
                </nav>
            </div>

            @yield('content')

            <!-- Scripts -->
            <!-- Libs JS -->
            <script src="{{ url('/assets/libs/jquery/dist/jquery.min.js') }}"></script>
            <script src="{{ url('/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ url('/assets/libs/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
            <script src="{{ url('/assets/libs/feather-icons/dist/feather.min.js') }}"></script>
            <script src="{{ url('/assets/libs/prismjs/prism.js') }}"></script>
            <script src="{{ url('/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
            <script src="{{ url('/assets/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
            <script src="{{ url('/assets/libs/prismjs/plugins/toolbar/prism-toolbar.min.js') }}"></script>
            <script src="{{ url('/assets/libs/prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js') }}"></script>

            <!-- Theme JS -->
            <script src="{{ url('/assets/js/theme.min.js') }}"></script>



</body>

</html>
