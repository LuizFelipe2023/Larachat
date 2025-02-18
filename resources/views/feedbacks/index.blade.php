@extends('layouts.app')
@section('title', 'Feedbacks')
<script defer src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script defer src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script defer src="{{ asset('js/feedbackTable.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script defer src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script defer src="{{ asset('js/indexFeedbacks.js') }}"></script>
@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-12 mt-5">
            <div class="card rounded-3 shadow-sm border-1">
                <div class="card-header bg-dark text-white">
                    <h3 class="text-center fw-bold mt-3 mb-3">Lista de Feedbacks</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="filter-nivel" class="fw-bold">Nível de Satisfação:</label>
                            <select name="filter-nivel" id="filter-nivel" class="form-select pointer">
                                <option value="">Selecione um Nível</option>
                                <option value="Muito Insatisfeito">Muito Insatisfeito</option>
                                <option value="Insatisfeito">Insatisfeito</option>
                                <option value="Neutro">Neutro</option>
                                <option value="Satisfeito">Satisfeito</option>
                                <option value="Excelente">Excelente</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered mt-4 mb-4" id="feedbackTable">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th scope="col" class="text-center"><i class="fas fa-user"></i> Nome do Cliente</th>
                                    <th scope="col" class="text-center"><i class="fas fa-id-card"></i> CPF do Cliente</th>
                                    <th scope="col" class="text-center"><i class="fas fa-smile"></i> Nível de Satisfação</th>
                                    <th class="text-center">
                                        <i class="fas fa-info-circle" style="color: #6c757d;" title="Situação do Feedback"></i> Situação
                                    </th>
                                    <th scope="col" class="text-center"><i class="fas fa-comment"></i> Descrição</th>
                                    <th scope="col" class="text-center"><i class="fas fa-cogs"></i> Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feedbacks as $feedback)
                                <tr>
                                    <td class="text-center">{{ $feedback->nome_cliente ?? "-" }}</td>
                                    <td class="text-center">{{ $feedback->cpf_cliente ?? "-" }}</td>
                                    <td class="text-center">
                                        @switch($feedback->nivel_satisfacao)
                                        @case(1)
                                        <span class="badge" style="background-color: #dc3545; color: white;">Muito Insatisfeito</span>
                                        @break
                                        @case(2)
                                        <span class="badge" style="background-color: #ffc107; color: black;">Insatisfeito</span>
                                        @break
                                        @case(3)
                                        <span class="badge" style="background-color: #6c757d; color: white;">Neutro</span>
                                        @break
                                        @case(4)
                                        <span class="badge" style="background-color: #007bff; color: white;">Satisfeito</span>
                                        @break
                                        @default
                                        <span class="badge" style="background-color: #28a745; color: white;">Excelente</span>
                                        @endswitch
                                    </td>
                                    <td class="text-center">{{ $feedback->situacao->nome ?? "-"}}</td>
                                    <td class="text-center">{!! $feedback->descricao !!}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Ações
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $feedback->id }}">Editar</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $feedback->id }}">Deletar</a></li>
                                                <li><a class="dropdown-item" href="#" data-bs-target="#alterarSituacao{{ $feedback->id }}" data-bs-toggle="modal">Alterar a Situação</a></li>
                                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#inserirMelhoria{{ $feedback->id }}" href="#">Inserir Melhoria</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editModal{{ $feedback->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $feedback->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $feedback->id }}">Editar Feedback</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('feedbacks.update', $feedback->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="nome_cliente" class="form-label">Nome do Cliente</label>
                                                        <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" value="{{ $feedback->nome_cliente }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="cpf_cliente" class="form-label">CPF do Cliente</label>
                                                        <input type="text" class="form-control" id="cpf_cliente" name="cpf_cliente" value="{{ $feedback->cpf_cliente }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="descricao" class="form-label">Descrição</label>
                                                        <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ old('descricao', $feedback->descricao) }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nivel_satisfacao" class="form-label">Nível de Satisfação</label>
                                                        <select class="form-select" id="nivel_satisfacao" name="nivel_satisfacao">
                                                            <option value="1" {{ $feedback->nivel_satisfacao == 1 ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ $feedback->nivel_satisfacao == 2 ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ $feedback->nivel_satisfacao == 3 ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ $feedback->nivel_satisfacao == 4 ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ $feedback->nivel_satisfacao == 5 ? 'selected' : '' }}>5</option>
                                                        </select>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="deleteModal{{ $feedback->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $feedback->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $feedback->id }}">Confirmar Deleção</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Tem certeza de que deseja excluir este feedback?</p>
                                                <p><strong>{{ $feedback->nome_cliente }}</strong></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form action="{{ route('feedbacks.delete', $feedback->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Deletar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="alterarSituacao{{ $feedback->id }}" tabindex="-1" aria-labelledby="alterarSituacaoLabel{{ $feedback->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="alterarSituacaoLabel{{ $feedback->id }}">Alterar Situação do Feedback</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('feedbacks.alterarSituacao', $feedback->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label for="situacao" class="form-label">Selecione a Situação:</label>
                                                        <select name="situacao_fk" id="situacao_fk" class="form-select">
                                                            @foreach ($situacoes as $situacao)
                                                            <option value="{{ $situacao->id }}" {{ $situacao->id == $feedback->situacao_fk ? 'selected' : '' }}>
                                                                {{ $situacao->nome }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Alterar Situação</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="inserirMelhoria{{ $feedback->id }}" tabindex="-1" aria-labelledby="inserirMelhoriaLabel{{ $feedback->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inserirMelhoriaLabel{{ $feedback->id }}">Inserir Melhoria para: {{ $feedback->titulo }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('melhorias.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="feedback_id" value="{{ $feedback->id }}">
                                                    <div class="mb-3">
                                                        <label for="acao" class="form-label">Ação de Melhoria</label>
                                                        <textarea class="form-control" id="acao" name="acao" rows="3" required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Salvar Melhoria</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection