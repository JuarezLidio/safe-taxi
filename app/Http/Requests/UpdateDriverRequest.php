<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class UpdateDriverRequest extends FormRequest
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
            'is_actived' => 'Estado',
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
            'changedPhoto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_actived' => 'required|boolean',
        ];
    }

    protected function passedValidation(): void
    {
        $validatedData = $this->validated();

        if ($this->hasFile('changedPhoto')) {
            if($this->route('driver')->photo !=null){
                $oldPhotoPath = str_replace('/storage', 'public', $this->route('driver')->photo);

                Storage::delete($oldPhotoPath);
            }

            $path = $this->file('changedPhoto')->store('photos', 'public');
            $validatedData['changedPhoto'] = Storage::url($path);

            $this->merge([
                'is_actived' => true,
                'photo' => $validatedData['changedPhoto'] ?? null,
            ]);
        }

    }
}
