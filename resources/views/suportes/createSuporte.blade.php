@extends('layouts.app')
@section('title', 'Envio de Mensagem para o Suporte')
<script defer src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script defer src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<script defer src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/createSuporte.css') }}">
<script defer src="{{ asset('js/suporteForm.js') }}"></script>
@section('content')
<div class="container vh-100 d-flex align-items-center justify-content-center mt-5 mb-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-12 mt-5 mb-5">
            <div class="card rounded-2 shadow-sm border-1">
                <div class="card-header">
                    <h3 class="text-center fw-bold mt-3 mb-3">Formulário de Mensagem para o Suporte</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('suportes.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <label for="nome_cliente" class="fw-bold">Nome:</label>
                                <input type="text" id="nome_cliente" name="nome_cliente" required value="{{ old('nome_cliente') }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefone_cliente" class="fw-bold">Telefone:</label>
                                <input type="text" id="telefone_cliente" name="telefone_cliente" required value="{{ old('telefone_cliente') }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                 <label for="cpf" class="fw-bold">CPF:</label>
                                 <input type="text" name="cpf" id="cpf" class="form-control" required value="{{ old('cpf') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email_cliente" class="fw-bold">Email:</label>
                                <input type="email" id="email_cliente" name="email_cliente" required value="{{ old('email_cliente') }}" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="tipo_duvida" class="fw-bold">Tipo de Dúvida:</label>
                                <select id="tipo_duvida" name="tipo_duvida" class="form-select" required>
                                    <option value="">Selecione um Tipo</option>
                                    <option value="Técnica" @if(old('tipo_duvida')=='Técnica' ) selected @endif>Técnica</option>
                                    <option value="Comercial" @if(old('tipo_duvida')=='Comercial' ) selected @endif>Comercial</option>
                                    <option value="Outro" @if(old('tipo_duvida')=='Outro' ) selected @endif>Outro</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="descricao" class="fw-bold">Descrição:</label>
                                <textarea id="descricao" name="descricao" required class="form-control" rows="5">{{ old('descricao') }}</textarea>
                            </div>
                            <input type="hidden" name="status_id" id="status_id" value="1">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-md btn-primary ">Enviar
                                    Mensagem</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection