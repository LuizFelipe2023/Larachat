@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-header text-center py-4">
                    <h3>{{ __('Verifique Seu Endereço de E-mail') }}</h3>
                </div>

                <div class="card-body p-5">
                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success mb-4" role="alert">
                            {{ __('Um novo link de verificação foi enviado para o endereço de e-mail fornecido durante o registro.') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        {{ __('Obrigado por se inscrever! Antes de começar, por favor, verifique seu endereço de e-mail clicando no link que enviamos para você. Se você não recebeu o e-mail, podemos enviar outro.') }}
                    </div>

                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="form-group text-center mb-4">
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                {{ __('Reenviar E-mail de Verificação') }}
                            </button>
                        </div>
                    </form>

                    <div class="form-group text-center">
                        <a class="btn btn-link" href="{{ route('login') }}">
                            {{ __('Voltar para Login') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
