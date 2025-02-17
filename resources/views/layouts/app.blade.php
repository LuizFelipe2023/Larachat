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
    <div class="sidebar bg-dark" style="width: 250px; height: 100vh; position: fixed; top: 0; left: 0; padding-top: 40px; padding-bottom: 40px; z-index: 1000;">
        <a href="{{ route('dashboard') }}" class="d-flex justify-content-center align-items-center mb-4 text-white text-decoration-none">
            <span class="fs-4 fw-bold">Dashboard</span>
        </a>
        <hr class="border-white mx-3">
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('feedbacks.index') }}" class="nav-link text-white {{ request()->is('feedbacks.index') ? 'active' : '' }} py-2 d-flex align-items-center">
                    <i class="bi bi-house-door me-2"></i> Feedbacks
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('suportes.index') }}" class="nav-link text-white py-2 d-flex align-items-center">
                    <i class="bi bi-person-circle me-2"></i> Mensagens do Suporte
                </a>
            </li>
        </ul>
        <hr class="border-white mx-3">
    </div>
    <div class="content" style="margin-left: 250px; padding: 20px; flex-grow: 1; padding-top: 80px;">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm" style="z-index: 1050; width: calc(100% - 250px); margin-left: 250px;">
            <div class="container-fluid">
                <span class="navbar-text text-white">@yield('title')</span>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log
                                        Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </div>
</div>
</body>

</html>