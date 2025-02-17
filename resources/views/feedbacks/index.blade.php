@extends('layouts.app')
@section('title', 'Feedbacks')
<script defer src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script defer src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script defer src="{{ asset('js/feedbackTable.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12 mt-5">
                <div class="card rounded-3 shadow-sm border-1">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center fw-bold mt-3 mb-3">Lista de Feedbacks</h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="nivel_satisfacao" class="fw-bold">Nível de Satisfação:</label>
                                <select name="filter-nivel" id="filter-nivel" class="form-select pointer">
                                    <option value="">Selecione um Nível</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered mt-4 mb-4" id="feedbackTable">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th scope="col" class="text-center"><i class="bi bi-person"></i> Nome do Cliente</th>
                                        <th scope="col" class="text-center"><i class="bi bi-card-checklist"></i> CPF do Cliente</th>
                                        <th scope="col" class="text-center"><i class="bi bi-emoji-smile"></i> Nível de Satisfação</th>
                                        <th scope="col" class="text-center"><i class="bi bi-chat-left-dots"></i> Descrição</th>
                                        <th scope="col" class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($feedbacks as $feedback)
                                        <tr>
                                            <td class="text-center">{{ $feedback->nome_cliente ?? "-" }}</td>
                                            <td class="text-center">{{ $feedback->cpf_cliente ?? "-" }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-success">{{ $feedback->nivel_satisfacao }}</span>
                                            </td>
                                            <td class="text-center">{{ $feedback->descricao }}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Ações
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editModal{{ $feedback->id }}">Editar</a></li>
                                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $feedback->id }}">Deletar</a></li>
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
                                                        <form method="POST" action="{{ route('feedbacks.update', $feedback->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="nome_cliente" class="form-label">Nome do Cliente</label>
                                                                <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" value="{{ $feedback->nome_cliente }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="cpf_cliente" class="form-label">CPF do Cliente</label>
                                                                <input type="text" class="form-control" id="cpf_cliente" name="cpf_cliente" value="{{ $feedback->cpf_cliente }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="nivel_satisfacao" class="form-label">Nível de Satisfação</label>
                                                                <select class="form-select" id="nivel_satisfacao" name="nivel_satisfacao">
                                                                    <option value="1" @if($feedback->nivel_satisfacao == 1) selected @endif>1</option>
                                                                    <option value="2" @if($feedback->nivel_satisfacao == 2) selected @endif>2</option>
                                                                    <option value="3" @if($feedback->nivel_satisfacao == 3) selected @endif>3</option>
                                                                    <option value="4" @if($feedback->nivel_satisfacao == 4) selected @endif>4</option>
                                                                    <option value="5" @if($feedback->nivel_satisfacao == 5) selected @endif>5</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="descricao" class="form-label">Descrição</label>
                                                                <textarea class="form-control" id="descricao" name="descricao">{{ $feedback->descricao }}</textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="deleteModal{{ $feedback->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $feedback->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $feedback->id }}">Deletar Feedback</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Tem certeza que deseja deletar este feedback?</p>
                                                        <form method="POST" action="{{ route('feedbacks.delete', $feedback->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Deletar</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
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
                                <i class="bi bi-download"></i> Exportar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
