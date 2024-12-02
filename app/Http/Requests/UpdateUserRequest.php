<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
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
            'is_active' => 'Activo'
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
            'email' => ['required','email', 'max:255', Rule::unique('users')->ignore($this->route('user')->id),],
            'phone' => 'required|string|max:255',
            'is_active' => 'required|boolean'
        ];
    }
}
