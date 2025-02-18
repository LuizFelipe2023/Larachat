<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SituacaoRequest extends FormRequest
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
            'situacao_fk' => 'required|exists:situacoes_feedback,id'
        ];
    }

    public function messages()
    {
           return [
             'situacao_fk.required' => "É obrigatório escolher umas das opções",
             'situacao_fk.exists' => "Por favor selecione uma opção válida"
           ];
    }
}
