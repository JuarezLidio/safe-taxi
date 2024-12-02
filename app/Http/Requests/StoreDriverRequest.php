<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class StoreDriverRequest extends FormRequest
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
            'full_name' => 'Nombre',
            'surnames' => 'Apellidos',
            'photo' => 'Foto'
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
            'full_name' => 'required|string|max:255',
            'surnames' => 'required|string|max:255',
            'originalPhoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

    }

    protected function passedValidation(): void
    {
        $validatedData = $this->validated();

        if ($this->hasFile('originalPhoto')) {
            $path = $this->file('originalPhoto')->store('photos', 'public');
            $validatedData['originalPhoto'] = Storage::url($path);
        }

        $this->merge([
            'is_actived' => true,
            'photo' => $validatedData['originalPhoto'] ?? null,
        ]);

    }
}
