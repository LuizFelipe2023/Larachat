@extends('layouts.app')
@section('title', 'Feedbacks')
<script defer src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script defer src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script defer src="{{ asset('js/feedbackTable.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
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
                            <table class="table table-striped table-hover table-bordered" id="feedbackTable">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th scope="col" class="text-center"><i class="bi bi-person"></i> Nome do Cliente</th>
                                        <th scope="col" class="text-center"><i class="bi bi-card-checklist"></i> CPF do Cliente</th>
                                        <th scope="col" class="text-center"><i class="bi bi-emoji-smile"></i> Nível de Satisfação</th>
                                        <th scope="col" class="text-center"><i class="bi bi-chat-left-dots"></i> Descrição</th>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
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
