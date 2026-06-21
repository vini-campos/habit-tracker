<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class RegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // users,email diz que e a tabela users e coluna email
        return [
            'nome' => 'required|max:255|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:60|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O nome deve ter no máximo :max caracteres.',
            'nome.string' => 'O nome só deve conter letras.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'O e-mail informado já está em uso.',

            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.max' => 'A senha deve ter no máximo :max caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
        ];
    }
}
