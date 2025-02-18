@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-start min-vh-100 mt-4 mb-4">
        <div class="card border-0 rounded-4 shadow-lg p-4 w-100" style="max-width: 800px;">
            <div class="card-header bg-light text-center border-0">
                <h2 class="fw-bold">{{ __('Perfil') }}</h2>
            </div>

            <div class="card-body bg-light rounded-3 p-4">
                <!-- Informações do Perfil -->
                <div class="mb-4 p-3 bg-light rounded">
                    <h5 class="fw-bold text-uppercase text-center">{{ __('Informações do Perfil') }}</h5>

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">{{ __('Nome') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">{{ __('E-mail') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div class="alert alert-warning mt-2 p-1 small">
                                    {{ __('Seu endereço de e-mail ainda não foi verificado.') }}
                                    <button form="send-verification" class="btn btn-link text-decoration-none p-0 text-primary">
                                        {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                                    </button>

                                    @if (session('status') === 'verification-link-sent')
                                        <div class="alert alert-success mt-2 p-1 small">
                                            {{ __('Um novo link de verificação foi enviado para seu e-mail.') }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-dark w-100">{{ __('Salvar') }}</button>

                        @if (session('status') === 'profile-updated')
                            <div class="text-center mt-3 text-success">{{ __('Salvo.') }}</div>
                        @endif
                    </form>
                </div>

                <hr class="my-4 border-dark">

                <!-- Atualizar Senha -->
                <div class="mb-4 p-3 bg-light rounded">
                    <h3 class="fw-bold text-center">{{ __('Atualizar Senha') }}</h3>
                    <p class="text-muted text-center mb-3">{{ __('Certifique-se de usar uma senha longa e segura.') }}</p>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-bold">{{ __('Senha Atual') }}</label>
                            <input id="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password" required autocomplete="current-password">
                            @error('current_password', 'updatePassword')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">{{ __('Nova Senha') }}</label>
                            <input id="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password', 'updatePassword')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-bold">{{ __('Confirmar Nova Senha') }}</label>
                            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" name="password_confirmation" required>
                            @error('password_confirmation', 'updatePassword')
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">{{ __('Salvar') }}</button>

                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success mt-3 text-center">
                                {{ __('Senha atualizada com sucesso!') }}
                            </div>
                        @endif
                    </form>
                </div>

                <hr class="my-4 border-dark">

                <!-- Excluir Conta -->
                <div class="p-3 bg-light rounded">
                    <h3 class="fw-bold text-danger text-center">{{ __('Excluir Conta') }}</h3>
                    <p class="text-muted text-center mb-3">{{ __('Uma vez excluída, todos os seus dados serão permanentemente removidos. Baixe qualquer informação importante antes de prosseguir.') }}</p>

                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">{{ __('Excluir Conta') }}</button>

                    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title fw-bold" id="deleteAccountModalLabel">{{ __('Tem certeza que deseja excluir sua conta?') }}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-muted text-center">{{ __('Todos os seus dados serão permanentemente excluídos. Digite sua senha para confirmar.') }}</p>
                                    <form id="deleteAccountForm" method="post" action="{{ route('profile.destroy') }}">
                                        @csrf
                                        @method('delete')

                                        <div class="mb-3">
                                            <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" name="password" placeholder="{{ __('Digite sua senha') }}" required>
                                            @error('password', 'userDeletion')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                                    <button type="submit" class="btn btn-danger" form="deleteAccountForm">{{ __('Excluir Conta') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
