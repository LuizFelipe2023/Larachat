@extends('layouts.app')
@section('title', 'Feedbacks Públicos')
<script defer src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script defer src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<script defer src="{{ asset('js/publicFeedbacksTable.js') }}"></script>

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-12 mb-5 mt-5">
            <div class="card rounded-3 shadow-sm border-1">
                <div class="card-header bg-dark text-white">
                    <h2 class="fw-bold text-center">Lista de Feedbacks com Melhorias</h2>
                </div>
                <div class="card-body">
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
                        <div class="col-md-4">
                            <label for="filter-situacao" class="fw-bold">Tipo de Situação</label>
                            <select name="filter-situacao" id="filter-situacao" class="form-select pointer">
                                <option value="">Selecione um Tipo</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->nome }}">{{ $tipo->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered mt-4 mb-4" id="publicFeedbacksTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center fw-bold">Nome do Cliente</th>
                                    <th scope="col" class="text-center fw-bold">Nivel de Satisfação</th>
                                    <th scope="col" class="text-center fw-bold">Descrição</th>
                                    <th scope="col" class="text-center fw-bold">Situação</th>
                                    <th scope="col" class="text-center fw-bold">Ações de Melhorias</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feedbacks as $feedback)
                                    <tr>
                                        <td class="text-center">{{ $feedback->nome_cliente ?? '-' }}</td>
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
                                        <td class="text-center">{!! $feedback->descricao !!}</td>
                                        <td class="text-center">{{ $feedback->situacao->nome ?? '-' }}</td>
                                        <td class="text-center">
                                            @if($feedback->melhorias && $feedback->melhorias->count() > 0)
                                                @foreach($feedback->melhorias as $melhoria)
                                                    <div>{!! $melhoria->acao !!}</div>
                                                @endforeach
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                    </tr>
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
