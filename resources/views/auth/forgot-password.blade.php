@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-header text-center py-4">
                    <h3>{{ __('Pedido para Resetar Senha') }}</h3>
                </div>

                <div class="card-body p-5">
                    @if (session('status'))
                        <div class="alert alert-success mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mb-4 mt-4">
                        {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar o seu endereço de e-mail e enviaremos um link para redefinir sua senha, permitindo que você escolha uma nova.') }}
                    </div>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group mb-4 mt-4">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group text-center mb-4 mt-4">
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                {{ __('Enviar Link para Resetar Senha') }}
                            </button>
                        </div>

                        <div class="form-group text-center mt-4 mb-4">
                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ __('Voltar para Login') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
