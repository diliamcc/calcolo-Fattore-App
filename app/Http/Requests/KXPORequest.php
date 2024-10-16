<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KXPORequest extends FormRequest
{
    public function authorize()
    {
        return true; // Permitir el acceso a esta solicitud
    }

    public function rules()
    {
        return [
            'length' => 'required|numeric|min:0.01', // Longitud: obligatoria, numérica, mayor que 0
            't_sc' => 'required|numeric|min:0.01',   // T_sc: obligatoria, numérica, mayor que 0
            'vertical_shift' => 'required|numeric',  // Posición vertical: obligatoria, numérica (puede ser negativa)
        ];
    }

    public function messages()
    {
        return [
            'length.required' => 'La longitud de la nave es obligatoria.',
            'length.numeric' => 'La longitud de la nave debe ser un número.',
            'length.min' => 'La longitud de la nave debe ser mayor que 0.',
            't_sc.required' => 'El Pescaggio a Pieno Carico (T_sc) es obligatorio.',
            't_sc.numeric' => 'El Pescaggio a Pieno Carico (T_sc) debe ser un número.',
            't_sc.min' => 'El Pescaggio a Pieno Carico (T_sc) debe ser mayor que 0.',
            'vertical_shift.required' => 'La posición vertical es obligatoria.',
            'vertical_shift.numeric' => 'La posición vertical debe ser un número.',
        ];
    }
}
