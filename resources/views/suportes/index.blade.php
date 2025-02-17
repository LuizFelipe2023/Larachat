@extends('layouts.app')
@section('title', 'Mensagens do Suporte')
<script defer src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script defer src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script defer src="{{ asset('js/feedbackTable.js') }}"></script>
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
                <div class="card-header bg-secondary text-white">
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
                                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                    Ações
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $suporte->id }}">Editar</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $suporte->id }}">Deletar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
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
