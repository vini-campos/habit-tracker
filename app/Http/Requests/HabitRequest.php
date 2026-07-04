<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $uniqueRule = Rule::unique('habits')->where('user_id', Auth::id());

        // se for update, ignora o registro
        if ($this->habit)
        {
            $uniqueRule = $uniqueRule->ignore($this->habit->id);                
        }

        return [
            'name' => [
                'required',
                'max:255',
                $uniqueRule,
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo é obrigatório',
            'name.max' => 'O nome deve ter até 255 caracteres',
            'name.unique' => 'O nome não deve ser igual ao de outro hábito',
        ];
    }
}
