<div class="card shadow-lg border-0 rounded-4 p-3">
    <div class="card-header bg-light text-center border-bottom-0">
        <h3 class="fw-bold text-danger">{{ __('Excluir Conta') }}</h3>
    </div>

    <div class="card-body">
        <p class="text-muted text-center mb-3">
            {{ __('Uma vez excluída, todos os seus dados serão permanentemente removidos. Baixe qualquer informação importante antes de prosseguir.') }}
        </p>

        <div class="d-grid">
            <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                {{ __('Excluir Conta') }}
            </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="deleteAccountModalLabel">
                    {{ __('Tem certeza que deseja excluir sua conta?') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted text-center mb-3">
                    {{ __('Todos os seus dados serão permanentemente excluídos. Digite sua senha para confirmar.') }}
                </p>

                <form id="deleteAccountForm" method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="mb-3">
                        <input type="password" class="form-control form-control-lg @error('password', 'userDeletion') is-invalid @enderror" name="password" placeholder="{{ __('Digite sua senha') }}" required>

                        @error('password', 'userDeletion')
                            <div class="alert alert-danger mt-2 p-2">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">
                    {{ __('Cancelar') }}
                </button>
                <button type="submit" class="btn btn-danger btn-md" form="deleteAccountForm">
                    {{ __('Excluir Conta') }}
                </button>
            </div>
        </div>
    </div>
</div>