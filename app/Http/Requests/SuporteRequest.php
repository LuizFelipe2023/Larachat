<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuporteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome_cliente' => 'required|string|min:2|max:500',
            'telefone_cliente' => 'required|string|min:8|max:50',
            'email_cliente' => 'required|email',
            'tipo_duvida' => 'required|string|max:255',
            'descricao' => 'required|string',
            'status_id' => 'nullable|exists:situacoes_suporte,id',
            'cpf' => 'required|min:11|max:14|string',
            'avaliacao_id' => 'nullable|exists:avaliacoes,id',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'nome_cliente.required' => 'O nome do cliente é obrigatório.',
            'nome_cliente.string' => 'O nome do cliente deve ser uma string válida.',
            'nome_cliente.min' => 'O nome do cliente deve ter pelo menos 2 caracteres.',
            'nome_cliente.max' => 'O nome do cliente pode ter no máximo 500 caracteres.',
            
            'telefone_cliente.required' => 'O telefone do cliente é obrigatório.',
            'telefone_cliente.string' => 'O telefone deve ser uma string válida.',
            'telefone_cliente.min' => 'O telefone deve ter pelo menos 8 caracteres.',
            'telefone_cliente.max' => 'O telefone pode ter no máximo 50 caracteres.',
            
            'email_cliente.required' => 'O email do cliente é obrigatório.',
            'email_cliente.email' => 'Por favor, insira um email válido.',
            
            'tipo_duvida.required' => 'O tipo de dúvida é obrigatório.',
            'tipo_duvida.string' => 'O tipo de dúvida deve ser uma string válida.',
            'tipo_duvida.max' => 'O tipo de dúvida pode ter no máximo 255 caracteres.',
            
            'descricao.required' => 'A descrição é obrigatória.',
            'descricao.string' => 'A descrição deve ser uma string válida.',

            'status_id.exists' => "Selecione um status que exista",

            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.string' => 'O CPF deve ser um texto valido.',
            'cpf.min' => 'O CPF deve ter pelo menos 11 caracteres.',
            'cpf.max' => 'O CPF pode ter no máximo 14 caracteres.',

            'avaliacao_id.exists' => 'Por favor selecione um valor válido'
        ];
    }
}
