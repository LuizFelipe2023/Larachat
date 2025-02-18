<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>@yield('title', 'Sistema de Coleta de Feedback')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>
<body style="background: url('{{ asset('img/25097.jpg') }}') no-repeat center center fixed; background-size: cover;">
    <div class="d-flex">
        <div class="sidebar shadow-lg"
            style="width: 250px; height: 100vh; position: fixed; top: 0; left: 0; padding: 40px 20px; z-index: 1000; background-color: #191C24;">
            <div class="text-center mb-5">
                <i class="bi bi-house-door text-white fs-3"></i>
                <h5 class="text-white fw-bold mt-2">Painel Administrativo</h5>
            </div>

            @if(Auth::check())
                <hr class="border-white mx-2">
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('feedbacks.index') }}" class="nav-link text-white py-2 d-flex align-items-center">
                            <i class="bi bi-card-text me-2"></i> Feedbacks
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('suportes.index') }}" class="nav-link text-white py-2 d-flex align-items-center">
                            <i class="bi bi-person-circle me-2"></i> Suporte
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('graficos.index') }}" class="nav-link text-white py-2 d-flex align-items-center">
                            <i class="bi bi-bar-chart me-2"></i> Gráficos
                        </a>
                    </li>
                </ul>
            @endif
            <hr class="border-white mx-2">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link text-white py-2 d-flex align-items-center">
                        <i class="bi bi-house-door me-2"></i> Home
                    </a>
                </li>
            </ul>
        </div>
        <div class="content" style="margin-left: 250px; padding: 80px 20px; flex-grow: 1;">
            <nav class="navbar navbar-expand-lg fixed-top shadow-sm px-3"
                style="z-index: 1050; width: calc(100% - 250px); margin-left: 250px; background-color: #191C24;">
                <div class="container-fluid">
                    <span class="navbar-text text-white fs-5 fw-semibold">@yield('title')</span>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    @if(Auth::check())
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Sair
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </nav>
            <div class="container mt-4">
                @yield('content')
            </div>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>
</html>
