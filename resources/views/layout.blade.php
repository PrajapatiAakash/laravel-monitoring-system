<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/laravel-monitoring-system/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laravel-monitoring-system/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laravel-monitoring-system/css/daterangepicker.css') }}">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('vendor/laravel-monitoring-system/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laravel-monitoring-system/css/main.css') }}">
</head>

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ route('monitoring-system.dashboard') }}">Monitoring System</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            @include('laravel-monitoring-system::navbar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ asset('vendor/laravel-monitoring-system/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/laravel-monitoring-system/js/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/laravel-monitoring-system/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/laravel-monitoring-system/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/laravel-monitoring-system/js/daterangepicker.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>
    {{-- <script src="{{ asset('vendor/laravel-monitoring-system/js/dashboard.js') }}"></script> --}}
    <script src="{{ asset('vendor/laravel-monitoring-system/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
