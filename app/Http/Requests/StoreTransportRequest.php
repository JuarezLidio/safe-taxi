<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'is_actived' => $this->input('is_actived', true),
        ]);
    }
    public function attributes()
    {
        return [
            'model' => 'Modelo',
            'sub_model' => 'Sub_modelo',
            'car_plate' => 'Matrícula',
            'brand' => 'Marca',
            'sub_brand' => 'Sub_marca',
            'economic_number' => 'Número Economico',
            'is_actived' => 'Estado'
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
            'model' => 'required|string|max:255',
            'sub_model' => 'required|string|max:255',
            'car_plate' => ['required', 'string', 'max:255', 'regex:/^[A-Z]-\d{2}-[A-Z]{3}$/', 'unique:transports,car_plate'],
            'brand' => 'required|string|max:255',
            'sub_brand' => 'required|string|max:255',
            'economic_number' => 'required|string|digits_between:1,4|unique:transports,economic_number',
            'is_actived' => 'boolean'
        ];
    }
    public function messages()
    {
        return [
            'model.required' => 'El :attribute es obligatorio.',
            'model.string' => 'El :attribute debe ser una cadena de texto.',
            'model.max' => 'El :attribute no puede tener más de :max caracteres.',
            'sub_model.required' => 'El :attribute es obligatorio.',
            'sub_model.string' => 'El :attribute debe ser una cadena de texto.',
            'sub_model.max' => 'El :attribute no puede tener más de :max caracteres.',
            'car_plate.regex' => 'La matrícula debe seguir el formato A-12-ABC.',
            'car_plate.unique' => 'Esta matrícula ya está registrada.',
            'car_plate.max' => 'La :attribute no puede tener más de :max caracteres.',
            'brand.required' => 'La :attribute es obligatoria.',
            'brand.string' => 'La :attribute debe ser una cadena de texto.',
            'brand.max' => 'La :attribute no puede tener más de :max caracteres.',
            'sub_brand.required' => 'La :attribute es obligatoria.',
            'sub_brand.string' => 'La :attribute debe ser una cadena de texto.',
            'sub_brand.max' => 'La :attribute no puede tener más de :max caracteres.',
            'economic_number.required' => 'El :attribute es obligatorio.',
            'economic_number.string' => 'El :attribute debe ser una cadena de texto.',
            'economic_number.digits_between' => 'El :attribute debe tener entre :min y :max dígitos.',
            'economic_number.unique' => 'El :attribute ya ha sido registrado.',
            'is_actived.boolean' => 'El :attribute debe ser verdadero o falso.'
        ];
    }
}
