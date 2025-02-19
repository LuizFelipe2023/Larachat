<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body style="background: url('{{ asset('img/25097.jpg') }}') no-repeat center center fixed; background-size: cover;">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm"
            style="z-index: 1050; width: 100%;">
            <div class="container-md">
                <a class="navbar-brand text-white" href="#">Sistema de Coleta de Feedback</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="authDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Ações
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="authDropdown">
                                <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                <li><a class ="dropdown-item" href = "{{ route('home') }}">Home</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="d-flex justify-content-center align-items-center vh-100">
            <main class=" col-md-12 py-4">
                @yield('content')
            </main>
        </div>
        <footer class="bg-dark text-white text-center py-3 mt-auto fixed-bottom" style="width: 100%;">
            <div class="container">
                <span>&copy; 2024 - Sistema de Coleta de Feedback. Todos os direitos reservados.</span>
            </div>
        </footer>
    </div>
</body>
</html> 