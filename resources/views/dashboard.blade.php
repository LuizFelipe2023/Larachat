@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center">
                    <h4>Bem-vindo, {{ Auth::user()->name }}! 🎉</h4>
                </div>
                <div class="card-body text-center">
                    <p class="fs-5">Olá, <strong>{{ Auth::user()->name }}</strong>! Seja bem-vindo ao <em>Sistema de Coleta de Feedback</em>. </p>
                    <p class="text-muted">Esperamos que tenha uma ótima experiência. 🚀</p>
                    <a href="{{ route('feedbacks.index') }}" class="btn btn-primary mt-3">
                        <i class="bi bi-chat-dots"></i> Ver Feedbacks
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
