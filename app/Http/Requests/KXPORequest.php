<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KXPORequest extends FormRequest
{
    public function authorize()
    {
        return true; // Permitir que todos los usuarios accedan a esta solicitud
    }

    public function rules()
    {
        return [
            'length' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'], // Número positivo con máximo 2 decimales
            't_sc' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],   // Número positivo con máximo 2 decimales
            'vertical_shift' => ['required', 'numeric', 'regex:/^-?\d+(\.\d{1,4})?$/'] // Permitir valores negativos con máximo 4 decimales
        ];
    }

    public function messages()
    {
        return [
            'length.required' => 'La longitud de la nave es obligatoria.',
            'length.numeric' => 'La longitud debe ser un número.',
            'length.min' => 'La longitud debe ser un valor positivo.',
            'length.regex' => 'La longitud debe tener como máximo 2 decimales.',

            't_sc.required' => 'El valor de T_sc es obligatorio.',
            't_sc.numeric' => 'El valor de T_sc debe ser un número.',
            't_sc.min' => 'El valor de T_sc debe ser un valor positivo.',
            't_sc.regex' => 'El valor de T_sc debe tener como máximo 2 decimales.',

            'vertical_shift.required' => 'La posición vertical es obligatoria.',
            'vertical_shift.numeric' => 'La posición vertical debe ser un número.',
            'vertical_shift.regex' => 'La posición vertical debe tener como máximo 4 decimales y puede ser negativa.'
        ];
    }
}
