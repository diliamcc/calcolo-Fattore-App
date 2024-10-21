<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KXPORequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Validation rules for input fields.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'length' => 'required|numeric|min:1',
            'vertical_shift' => 'required|numeric',
            't_sc' => 'required|numeric|min:0',
        ];
    }

    /**
     * Custom error messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'length.required' => 'Please enter the length of the ship.',
            'length.numeric' => 'Ship length must be a valid number.',
            'length.min' => 'Ship length must be greater than 0.',

            'vertical_shift.required' => 'Please enter the vertical position.',
            'vertical_shift.numeric' => 'The vertical position must be a valid number.',

            't_sc.required' => 'The value of T_sc is required.',
            't_sc.numeric' => 'The value of T_sc must be numeric.',
            't_sc.min' => 'The value of T_sc cannot be negative.',
        ];
    }

    /**
     * Personalización de los nombres de los atributos en los mensajes de error.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'length' => 'ship length',
            'vertical_shift' => 'vertical position',
            't_sc' => 'T_sc (Pescaggio a Pieno Carico)',
        ];
    }
}
