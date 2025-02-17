@extends('layouts.app')
@section('title', 'Envio de Mensagem para o Suporte')
<script defer src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script defer src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<script defer src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    }

    .form-control:focus {
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
    }

    .btn-primary {
        background-color: #6f42c1;
        border: none;
        padding: 0.75em 1.5em;
        font-size: 1.1em;
        border-radius: 10px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #007bff;
    }
</style>
@section('content')
     <div class="container-md mt-5">
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
                                                       <input type="text" id="nome_cliente" name="nome_cliente" required
                                                             value="{{ old('nome_cliente') }}" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                       <label for="telefone_cliente" class="fw-bold">Telefone:</label>
                                                       <input type="text" id="telefone_cliente" name="telefone_cliente" required
                                                             value="{{ old('telefone_cliente') }}" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                       <label for="email_cliente" class="fw-bold">Email:</label>
                                                       <input type="email" id="email_cliente" name="email_cliente" required
                                                             value="{{ old('email_cliente') }}" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                       <label for="tipo_duvida" class="fw-bold">Tipo de Dúvida:</label>
                                                       <select id="tipo_duvida" name="tipo_duvida" class="form-select" required>
                                                             <option value="">Selecione um Tipo</option>
                                                             <option value="Técnica" @if(old('tipo_duvida') == 'Técnica') selected
                                                                           @endif>Técnica</option>
                                                             <option value="Comercial" @if(old('tipo_duvida') == 'Comercial')
                                                                           selected @endif>Comercial</option>
                                                             <option value="Outro" @if(old('tipo_duvida') == 'Outro') selected
                                                                           @endif>Outro</option>
                                                       </select>
                                                </div>
                                                <div class="col-12 mb-3">
                                                       <label for="descricao" class="fw-bold">Descrição:</label>
                                                       <textarea id="descricao" name="descricao" required class="form-control"
                                                             rows="5">{{ old('descricao') }}</textarea>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                       <button type="submit" class="btn btn-md btn-primary ">Enviar Mensagem</button>
                                                </div>
                                          </div>
                                    </form>
                              </div>
                       </div>
                 </div>
           </div>
     </div>
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
@endsection
