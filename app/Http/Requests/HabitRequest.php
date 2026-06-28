<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class HabitRequest extends FormRequest
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
        return [
            'name' => 'required|max:255|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo é obrigatório',
            'name.max' => 'O nome deve ter até 255 caracteres',
            'name.string' => 'O nome não deve conter números ou simbolos',
        ];
    }
}
