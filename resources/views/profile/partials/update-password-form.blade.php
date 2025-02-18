<div class="card shadow-lg border-0 rounded-4 p-3">
    <div class="card-header bg-light text-center border-bottom-0">
        <h3 class="fw-bold">{{ __('Atualizar Senha') }}</h3>
    </div>
    <div class="card-body">
        <p class="text-muted text-center mb-3">
            {{ __('Certifique-se de usar uma senha longa e segura.') }}
        </p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="current_password" class="form-label fw-bold">{{ __('Senha Atual') }}</label>
                <input id="current_password" type="password" class="form-control form-control-lg @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password" required autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <span class="invalid-feedback d-block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-bold">{{ __('Nova Senha') }}</label>
                <input id="password" type="password" class="form-control form-control-lg @error('password', 'updatePassword') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password', 'updatePassword')
                    <span class="invalid-feedback d-block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-bold">{{ __('Confirmar Nova Senha') }}</label>
                <input id="password_confirmation" type="password" class="form-control form-control-lg @error('password_confirmation', 'updatePassword') is-invalid @enderror" name="password_confirmation" required>
                @error('password_confirmation', 'updatePassword')
                    <span class="invalid-feedback d-block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-md">
                    {{ __('Salvar') }}
                </button>
            </div>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success mt-3 text-center fade-out">
                    {{ __('Senha atualizada com sucesso!') }}
                </div>
            @endif
        </form>
    </div>
</div>