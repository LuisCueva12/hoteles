<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovilidadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $movilidadId = $this->route('movilidad')?->id;

        return [
            'nombre' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'tipo_vehiculo' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'precio_base' => 'required|numeric|min:0',
            'capacidad_pasajeros' => 'required|integer|min:1|max:50',
            'caracteristicas' => 'nullable|array',
            'caracteristicas.*' => 'integer|exists:caracteristicas,id',
            'foto' => $movilidadId 
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la movilidad es obligatorio',
            'marca.required' => 'La marca es obligatoria',
            'tipo_vehiculo.required' => 'El tipo de vehículo es obligatorio',
            'categoria.required' => 'La categoría es obligatoria',
            'ubicacion.required' => 'La ubicación es obligatoria',
            'precio_base.required' => 'El precio base es obligatorio',
            'precio_base.numeric' => 'El precio debe ser un número válido',
            'precio_base.min' => 'El precio no puede ser negativo',
            'capacidad_pasajeros.required' => 'La capacidad de pasajeros es obligatoria',
            'capacidad_pasajeros.integer' => 'La capacidad debe ser un número entero',
            'capacidad_pasajeros.min' => 'La capacidad mínima es 1 pasajero',
            'capacidad_pasajeros.max' => 'La capacidad máxima es 50 pasajeros',
            'foto.required' => 'La foto de la movilidad es obligatoria',
            'foto.image' => 'El archivo debe ser una imagen',
            'foto.mimes' => 'La imagen debe ser jpg, jpeg, png o webp',
            'foto.max' => 'La imagen no puede superar los 2MB',
        ];
    }
}
