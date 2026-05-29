<?php

namespace App\Http\Requests;

use App\Models\Hotel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ReservaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hotel_id' => [
                'required',
                Rule::exists('hoteles', 'id')->where(fn ($query) => $query->where('activo', true)),
            ],
            'cliente_nombre' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'cliente_documento' => 'required|string|max:15|regex:/^[0-9]+$/',
            'cliente_whatsapp' => 'required|string|max:15|regex:/^[0-9]+$/',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'adultos' => 'required|integer|min:1|max:50',
            'ninos' => 'nullable|integer|min:0|max:20',
            'pasajeros_resumen' => 'nullable|string|max:255',
            'detalles' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'hotel_id.required' => 'Debe seleccionar un hotel',
            'hotel_id.exists' => 'El hotel seleccionado no está disponible',
            'cliente_nombre.required' => 'El nombre completo es obligatorio',
            'cliente_nombre.regex' => 'El nombre solo puede contener letras y espacios',
            'cliente_documento.required' => 'El documento es obligatorio',
            'cliente_documento.regex' => 'El documento solo puede contener números',
            'cliente_whatsapp.required' => 'El número de WhatsApp es obligatorio',
            'cliente_whatsapp.regex' => 'El WhatsApp solo puede contener números',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio no puede ser anterior a hoy',
            'fecha_fin.required' => 'La fecha de fin es obligatoria',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
            'adultos.required' => 'Debe indicar la cantidad de adultos',
            'adultos.min' => 'Debe haber al menos 1 adulto',
            'adultos.max' => 'La cantidad máxima de adultos es 50',
            'ninos.min' => 'La cantidad de niños no puede ser negativa',
            'ninos.max' => 'La cantidad máxima de niños es 20',
            'pasajeros_resumen.max' => 'El resumen de huéspedes no puede superar los 255 caracteres',
            'detalles.max' => 'Los detalles no pueden superar los 1000 caracteres',
        ];
    }
}
