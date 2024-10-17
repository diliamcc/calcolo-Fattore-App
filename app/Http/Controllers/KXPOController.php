<?php

namespace App\Http\Controllers;

use App\Http\Requests\KXPORequest; // Usar el Form Request
use Illuminate\Http\Request;

class KXPOController extends Controller
{
    public function calculateKXPO(KXPORequest $request)
    {
        // Los datos ya han sido validados en KXPORequest
        $length = $request->input('length');
        $t_sc = $request->input('t_sc');
        $vertical_shift = $request->input('vertical_shift');

        // Realizar el cálculo del Fattore KXPO
        return $this->performKXPOCalculation($length, $t_sc, $vertical_shift);
    }

    public function performKXPOCalculation($length, $t_sc, $vertical_shift)
    {
        // Definir las constantes
        $g = 9.81;  // Aceleración gravitacional en m/s²
        $pitch_angle = deg2rad(7.5);  // Convertir 7.5 grados a radianes
        $asu = 0.5;  // Aceleracion constante
        $angular_acceleration_pitch = 0.105;  // Aceleración angular del pitch en rad/s²

        // Calcular la altura del centro de gravedad (CG_h) basada en la longitud de la nave
        $cg_h = ($length > 200) ? 15 : 10;

        // Aplicar la fórmula para calcular el Fattore KXPO
        $kxpo = sqrt((pow($asu, 2))  + pow(($pitch_angle * $g) + ($angular_acceleration_pitch * ($vertical_shift + $cg_h - $t_sc)), 2)) /$g  ;

        // Retornar el resultado en formato JSON, incluyendo CG_h
        return response()->json([
            'kxpo' => $kxpo,
            'cg_h' => $cg_h, // Retornamos el valor calculado para CG_h
        ]);
    }
}
