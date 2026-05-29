<?php

namespace App\Http\Requests;

use App\Models\Movilidad;
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
            'movilidad_id' => [
                'required',
                Rule::exists('movilidades', 'id')->where(fn ($query) => $query->where('activo', true)),
            ],
            'cliente_nombre' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'cliente_documento' => 'required|string|size:8|regex:/^[0-9]+$/',
            'cliente_whatsapp' => 'required|string|size:9|regex:/^9[0-9]{8}$/',
            'ruta_viaje' => 'required|string|max:500',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'modalidad' => 'required|string|exists:modalidades,slug',
            'adultos' => 'required|integer|min:1|max:50',
            'ninos' => 'nullable|integer|min:0|max:20',
            'pasajeros_resumen' => 'nullable|string|max:255',
            'detalles' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'movilidad_id.required' => 'Debe seleccionar una movilidad',
            'movilidad_id.exists' => 'La movilidad seleccionada no está disponible',
            'cliente_nombre.required' => 'El nombre completo es obligatorio',
            'cliente_nombre.regex' => 'El nombre solo puede contener letras y espacios',
            'cliente_documento.required' => 'El DNI es obligatorio',
            'cliente_documento.size' => 'El DNI debe tener exactamente 8 dígitos',
            'cliente_documento.regex' => 'El DNI solo puede contener números',
            'cliente_whatsapp.required' => 'El número de WhatsApp es obligatorio',
            'cliente_whatsapp.size' => 'El WhatsApp debe tener 9 dígitos',
            'cliente_whatsapp.regex' => 'El WhatsApp debe ser un número peruano válido (empezar con 9)',
            'ruta_viaje.required' => 'La ruta del viaje es obligatoria',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio no puede ser anterior a hoy',
            'fecha_fin.required' => 'La fecha de fin es obligatoria',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
            'modalidad.required' => 'Debe seleccionar una modalidad',
            'modalidad.in' => 'La modalidad seleccionada no es válida',
            'adultos.required' => 'Debe indicar la cantidad de adultos',
            'adultos.min' => 'Debe haber al menos 1 adulto',
            'adultos.max' => 'La cantidad máxima de adultos es 50',
            'ninos.min' => 'La cantidad de niños no puede ser negativa',
            'ninos.max' => 'La cantidad máxima de niños es 20',
            'pasajeros_resumen.max' => 'El resumen de pasajeros no puede superar los 255 caracteres',
            'detalles.max' => 'Los detalles no pueden superar los 1000 caracteres',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $movilidadId = (int) $this->input('movilidad_id');
            $modalidad = (string) $this->input('modalidad');

            if (!$movilidadId || !$modalidad) {
                return;
            }

            $movilidad = Movilidad::query()
                ->select(['id', 'activo'])
                ->find($movilidadId);

            if (!$movilidad || !$movilidad->activo) {
                return;
            }

            $tieneModalidad = $movilidad->modalidades()
                ->where('slug', $modalidad)
                ->exists();

            if (!$tieneModalidad) {
                $validator->errors()->add('modalidad', 'La modalidad seleccionada no está disponible para esta movilidad.');
            }
        });
    }
}
