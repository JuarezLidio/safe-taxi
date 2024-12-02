<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreEmergencyContactRequest extends FormRequest
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
            'alias' => 'Alias',
            'description' => 'Descripción',
            'email' => 'Correo electrónico',
            'phone' => 'Teléfono',
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
            'alias' => 'required|string|between:3,50',
            'description' => 'required|string|between:3,50',
            'email' => ['required','email', 'max:255'],
            'phone' => 'required|string|max:255',
        ];
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'is_active' => true,
            'id_user' => Auth::id(),
        ]);
    }
}
