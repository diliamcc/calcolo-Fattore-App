<?php

namespace App\Http\Controllers;

use App\Http\Requests\KXPORequest;
class KXPOController extends Controller
{
    public function calculateKXPO(KXPORequest $request)
    {
        // Validare i dati ricevuti
        $request->validate([
            'length' => 'required|numeric|min:0',
            't_sc' => 'required|numeric|min:0',
            'vertical_shift' => 'required|numeric',
        ]);

        // Estrarre i dati convalidati
        $length = $request->input('length');
        $t_sc = $request->input('t_sc');
        $vertical_shift = $request->input('vertical_shift');

        // Agregar logs de depuración
        \Log::info("Datos recibidos: length = $length, t_sc = $t_sc, vertical_shift = $vertical_shift");

        // Realizzare il calcolo Fattore KXPO
        return $this->performKXPOCalculation($length, $t_sc, $vertical_shift);
    }

    public function performKXPOCalculation($length, $t_sc, $vertical_shift)
    {
        // Definire le costanti
        $g = 9.81;  // Accelerazione gravitazionale in m/s²
        $pitch_angle = deg2rad(7.5);  // Converti 7,5 gradi in radianti
        $angular_acceleration_pitch = 0.105;  // Accelerazione angolare del pitch in rad/s²

        // Calcolare l'altezza del baricentro (CG_h) in base alla lunghezza della nave
        $cg_h = ($length > 200) ? 15 : 10;

        // Applicare la formula per calcolare il Fattore KXPO
        $kxpo = $g * (0.5) + $pitch_angle * $g + $angular_acceleration_pitch * ($vertical_shift + $cg_h - $t_sc);

        // Agregar logs para verificar el resultado del cálculo
        \Log::info("Resultado KXPO calculado: $kxpo");

        // Restituisce il risultato in formato JSON, incluso CG_h
        return response()->json([
            'kxpo' => $kxpo,
            'cg_h' => $cg_h, // Restituiamo il valore calcolato per CG_h
            'length' => $length // Restituiamo la lunghezza da utilizzare nella logica della vista
        ]);
    }
}
