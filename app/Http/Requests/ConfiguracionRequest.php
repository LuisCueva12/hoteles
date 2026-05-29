<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfiguracionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'telefono_whatsapp' => 'required|string|regex:/^51[0-9]{9}$/|max:15',
            'enlace_facebook' => 'nullable|url|max:255',
            'enlace_instagram' => 'nullable|url|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'telefono_whatsapp.required' => 'El número de WhatsApp es obligatorio',
            'telefono_whatsapp.regex' => 'El número debe tener el formato: 51 seguido de 9 dígitos (ej: 51987654321)',
            'enlace_facebook.url' => 'El enlace de Facebook debe ser una URL válida',
            'enlace_instagram.url' => 'El enlace de Instagram debe ser una URL válida',
        ];
    }
}
