@extends('layouts.app')
@section('title', 'Mensagens do Suporte')
<script defer src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script defer src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script defer src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<script defer src="{{ asset('js/suporteTable.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12 mt-5">
                <div class="card rounded-3 shadow-sm border-1">
                    <div class="card-header bg-dark text-white">
                        <h3 class="text-center fw-bold mt-3 mb-3">Lista de Mensagens do Suporte</h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 mb-4">
                            <div class="col-md-4 mt-4 mb-4">
                                <label for="filter-tipo">Filtro por Tipo</label>
                                <select name="filter-tipo" id="filter-tipo" class="form-select pointer">
                                    <option value="">Escolha um Tipo:</option>
                                    <option value="Técnica">Técnica</option>
                                    <option value="Comercial">Comercial</option>
                                    <option value="Outro">Outro</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered mt-4 mb-4" id="suporteTable">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th class="text-center"><i class="fas fa-user"></i> Nome do Cliente</th>
                                        <th class="text-center"><i class="fas fa-phone"></i> Telefone do Cliente</th>
                                        <th class="text-center"><i class="fas fa-envelope"></i> Email do Cliente</th>
                                        <th class="text-center"><i class="fas fa-question-circle"></i> Tipo de Dúvida</th>
                                        <th class="text-center"><i class="fas fa-comment-alt"></i> Descrição</th>
                                        <th class="text-center"><i class="fas fa-cogs"></i> Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suportes as $suporte)
                                        <tr>
                                            <td class="text-center">{{ $suporte->nome_cliente ?? '-' }}</td>
                                            <td class="text-center">{{ $suporte->telefone_cliente ?? '-' }}</td>
                                            <td class="text-center">{{ $suporte->email_cliente ?? '-' }}</td>
                                            <td class="text-center">{{ $suporte->tipo_duvida }}</td>
                                            <td class="text-center">{!!$suporte->descricao  !!}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown">
                                                        Ações
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#editModal{{ $suporte->id }}">Editar</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#deleteModal{{ $suporte->id }}">Deletar</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editModal{{ $suporte->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $suporte->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $suporte->id }}">Editar
                                                            Mensagem</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('suportes.update', $suporte->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="nome_cliente" class="fw-bold">Nome do
                                                                    Cliente</label>
                                                                <input type="text" name="nome_cliente" id="nome_cliente"
                                                                    value="{{ old('nome_cliente', $suporte->nome_cliente) }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="telefone_cliente" class="fw-bold">Telefone do
                                                                    Cliente</label>
                                                                <input type="text" name="telefone_cliente" id="telefone_cliente"
                                                                    value="{{ old('telefone_cliente', $suporte->telefone_cliente) }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email_cliente" class="fw-bold">Email do
                                                                    Cliente</label>
                                                                <input type="text" name="email_cliente" id="email_cliente"
                                                                    value="{{ old('email_cliente', $suporte->email_cliente) }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tipo_duvida" class="fw-bold">Tipo de
                                                                    Dúvida</label>
                                                                <select class="form-select" id="tipo_duvida" name="tipo_duvida">
                                                                    <option value="Técnica" {{ $suporte->tipo_duvida == 'Técnica' ? 'selected' : '' }}>Técnica</option>
                                                                    <option value="Comercial" {{ $suporte->tipo_duvida == 'Comercial' ? 'selected' : '' }}>
                                                                        Comercial</option>
                                                                    <option value="Outro" {{ $suporte->tipo_duvida == 'Outro' ? 'selected' : '' }}>Outro</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="descricao" class="fw-bold">Descrição</label>
                                                                <textarea class="form-control" id="descricao" name="descricao"
                                                                    rows="3">{{ $suporte->descricao }}</textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary">Salvar
                                                                    Alterações</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="deleteModal{{ $suporte->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $suporte->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $suporte->id }}">
                                                            Confirmar Deleção</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Tem certeza de que deseja excluir esta mensagem de suporte?</p>
                                                        <p><strong>{{ $suporte->nome_cliente }}</strong></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('suportes.delete', $suporte->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Deletar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-4 mb-4">
                            <button class="btn btn-primary">
                                <i class="fas fa-download"></i> Exportar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection