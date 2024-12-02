<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Facades\Hash;

class StoreUserRequest extends FormRequest
{
    use PasswordValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes()
    {
        return [
            'name' => 'Nombre',
            'surname' => 'Apellido',
            'id_role' => 'Rol',
            'email' => 'Correo electrónico',
            'phone' => 'Teléfono',
            'password' => 'Contraseña',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:3,50',
            'surname' => 'required|string|between:3,50',
            'id_role' => 'required|exists:roles,id',
            'email' => ['required','email', 'max:255', Rule::unique('users'),],
            'phone' => 'required|string|max:255',
            'password' => $this->passwordRules(),
        ];
    }

    protected function passedValidation(): void
    {
        $validatedData = $this->validated();

        $this->merge([
            'password' => Hash::make($validatedData['password']),
            'is_active' => true,
        ]);
    }
}
