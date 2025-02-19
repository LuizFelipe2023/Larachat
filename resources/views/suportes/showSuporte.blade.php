@extends('layouts.guest')
@section('title', 'Lista de Suportes por CPF')
<script defer src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script defer src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<script defer src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/createSuporte.css') }}">
<script defer>
document.addEventListener("DOMContentLoaded", function () {
    let ckeditorConfig = {
        extraPlugins: 'wordcount',
        wordcount: {
            showCharCount: true,
            maxCharCount: 10000,
            charCountMsg: 'Caracteres restantes: {0}',
            maxCharCountMsg: 'Você atingiu o limite máximo de caracteres permitidos.'
        }
    };

    if (document.getElementById('descricao')) {
        CKEDITOR.replace('descricao', ckeditorConfig);
    }
    
});
</script>
@section('content')
    <div class="container vh-100 d-flex align-items-center justify-content-center mt-5 mb-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-12 mt-5 mb-5">
                @if ($suportes->isEmpty())
                    <div class="alert alert-warning text-center">
                        Nenhum suporte encontrado para este CPF.
                    </div>
                @else
                    @foreach ($suportes as $suporte)
                        <div class="card rounded-2 shadow-sm border-1 mb-3">
                            <div class="card-header">
                                <h5 class="fw-bold mt-2 mb-2">Suporte {{ $suporte->id }} do Cliente {{ $suporte->nome_cliente }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">Nome:</label>
                                        <input type="text" value="{{ $suporte->nome_cliente }}" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">Telefone:</label>
                                        <input type="text" value="{{ $suporte->telefone_cliente }}" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">CPF:</label>
                                        <input type="text" value="{{ $suporte->cpf }}" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">Email:</label>
                                        <input type="email" value="{{ $suporte->email_cliente }}" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold">Tipo de Dúvida:</label>
                                        <input type="text" value="{{ $suporte->tipo_duvida }}" class="form-control" disabled>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="fw-bold">Descrição:</label>
                                        <textarea class="form-control" id="descricao" rows="5" disabled>{{ $suporte->descricao }}</textarea>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                         <button type="button" class="btn btn-md btn-secondary" data-bs-toggle = "modal" data-bs-target= "#inserirAvaliacao{{ $suporte->id }}">Avaliar</button>
                                    </div>
                                    <div class="modal fade" id="inserirAvaliacao{{ $suporte->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $suporte->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel{{ $suporte->id }}">Inserir Avaliação</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                </div>
                                                <form action="{{ route('suportes.inserirAvaliacao', $suporte->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="avaliacao_id" class="form-label">Selecione a Avaliação:</label>
                                                            <select class="form-control" id="avaliacao_id" name="avaliacao_id" required>
                                                                <option value="" disabled selected>Escolha uma opção</option>
                                                                @foreach ($tiposAvaliacoes as $tipoAvaliacao )
                                                                <option value="{{ $tipoAvaliacao->id }}">{{ $tipoAvaliacao->nome }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-primary">Salvar Avaliação</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
