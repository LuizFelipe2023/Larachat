@extends('layouts.app')

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center py-3 rounded-top">
                    <h4 class="fw-bold mb-0">Bem-vindo, {{ Auth::user()->name }}! 🎉</h4>
                </div>
                <div class="card-body text-center bg-light p-4 rounded-bottom">
                    <p class="fs-5">Olá, <strong>{{ Auth::user()->name }}</strong>! Seja bem-vindo ao <em>Sistema de Coleta de Feedback</em>.</p>
                    <p class="text-muted">Esperamos que tenha uma ótima experiência. 🚀</p>
                    <a href="{{ route('feedbacks.index') }}" class="btn btn-primary mt-3 px-4 py-2">
                        <i class="bi bi-chat-dots me-1"></i> Ver Feedbacks
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
