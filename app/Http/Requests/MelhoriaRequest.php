<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MelhoriaRequest extends FormRequest
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
            'feedback_id' => 'required|exists:feedbacks,id',
            'acao' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'feedback_id.required' => 'O ID do feedback é obrigatório.',
            'feedback_id.exists' => 'O ID do feedback não existe.',
            'acao.required' => 'A ação é obrigatória.',
            'acao.string' => 'A ação deve ser um texto válido.'
        ];
    }

}
