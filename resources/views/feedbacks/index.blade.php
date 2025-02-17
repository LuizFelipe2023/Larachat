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
                    <div class="card-header bg-dark text-white">
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
                                        <th scope="col" class="text-center"><i class="fas fa-user"></i> Nome do Cliente</th>
                                        <th scope="col" class="text-center"><i class="fas fa-id-card"></i> CPF do Cliente</th>
                                        <th scope="col" class="text-center"><i class="fas fa-smile"></i> Nível de Satisfação</th>
                                        <th scope="col" class="text-center"><i class="fas fa-comment"></i> Descrição</th>
                                        <th scope="col" class="text-center"><i class="fas fa-cogs"></i>Ações</th>
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
