<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'id_parent' => 'Menú padre',
            'destination_url' => 'URL destino'
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
            'name' => 'required|string|between:3,30',
            'id_parent' => 'required|exists:menus,id',
            'destination_url' => 'nullable|string|between:3,50'
        ];
    }
}
