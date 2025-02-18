<div class="card border-0 shadow-sm p-4 bg-white">
    <div class="card-header bg-white border-bottom pb-2">
        <h5 class="fw-bold text-uppercase text-dark text-center">{{ __('Informações do Perfil') }}</h5>
    </div>

    <div class="card-body">
        <form id="send-verification" class="d-none" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-4">
                <label for="name" class="form-label text-dark fw-bold">{{ __('Nome') }}</label>
                <input id="name" type="text"
                    class="form-control border border-dark rounded-2 bg-white text-dark shadow-sm @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">

                @error('name')
                    <div class="invalid-feedback d-block text-danger mt-1">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="form-label text-dark fw-bold">{{ __('E-mail') }}</label>
                <input id="email" type="email"
                    class="form-control border border-dark rounded-2 bg-white text-dark shadow-sm @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                @error('email')
                    <div class="invalid-feedback d-block text-danger mt-1">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="alert alert-warning mt-3 p-2 small">
                        {{ __('Seu endereço de e-mail ainda não foi verificado.') }}
                        <button form="send-verification" class="btn btn-link text-decoration-none p-0 text-primary">
                            {{ __('Clique aqui para reenviar o e-mail de verificação.') }}
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <div class="alert alert-success mt-2 p-2 small">
                                {{ __('Um novo link de verificação foi enviado para seu e-mail.') }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <div class="d-flex align-items-center">
                <button type="submit" class="btn btn-dark rounded-2 px-4 py-2 text-uppercase fw-bold shadow-sm w-100">
                    {{ __('Salvar') }}
                </button>
            </div>
            <div class="d-flex justify-content-center align-items-center mt-4 mb-4">
                @if (session('status') === 'profile-updated')
                    <span class="ms-3 text-success fade-out">{{ __('Salvo.') }}</span>
                @endif
            </div>
        </form>
    </div>
</div>