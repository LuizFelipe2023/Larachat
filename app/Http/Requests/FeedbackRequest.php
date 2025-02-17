<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'nivel_satisfacao' => 'required|integer|min:1|max:5',
            'descricao' => 'required|string|min:3|max:1000',
            'nome_cliente' => 'nullable|string|min:2|max:500',
            'cpf_cliente' => 'nullable|string|min:11|max:14'
        ];
    }

    public function messages()
    {
        return [
            'nivel_satisfacao.required' => 'É obrigatório selecionar um valor de 1 a 5.',
            'nivel_satisfacao.integer' => 'O valor deve ser um número.',
            'nivel_satisfacao.min' => 'O valor mínimo deve ser 1.',
            'nivel_satisfacao.max' => 'O valor máximo deve ser 5.',

            'descricao.required' => 'A descrição é obrigatória.',
            'descricao.string' => 'A descrição deve ser um texto.',
            'descricao.min' => 'A descrição deve ter pelo menos 3 caracteres.',
            'descricao.max' => 'A descrição não pode ter mais de 1000 caracteres.',

            'nome_cliente.string' => 'O nome do cliente deve ser um texto.',
            'nome_cliente.min' => 'O nome do cliente deve ter pelo menos 2 caracteres.',
            'nome_cliente.max' => 'O nome do cliente não pode ter mais de 500 caracteres.',

            'cpf_cliente.string' => 'O CPF deve ser um texto.',
            'cpf_cliente.min' => 'O CPF deve ter pelo menos 11 caracteres.',
            'cpf_cliente.max' => 'O CPF não pode ter mais de 14 caracteres.'
        ];
    }

}
