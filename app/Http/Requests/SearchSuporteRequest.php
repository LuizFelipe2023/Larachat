<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchSuporteRequest extends FormRequest
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
            'cpf' => 'required|min:11|max:14|exists:suportes,cpf'
        ];
    }

    public function messages(): array
    {
        return [
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.min' => 'O CPF deve ter no mínimo 11 caracteres.',
            'cpf.max' => 'O CPF pode ter no máximo 14 caracteres.',
            'cpf.exists' => 'Nenhum registro de mensagem para o suporte foi encontrado para este CPF.'
        ];
    }

}
