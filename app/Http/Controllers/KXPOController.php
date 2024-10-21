<?php

namespace App\Http\Controllers;

use App\Http\Requests\KXPORequest; 

class KXPOController extends Controller
{

    const GRAVITY = 9.81;  // Gravitational acceleration in m/s²
    const PITCH_ANGLE = 7.5;  // Grades
    const ASU = 0.5;  // Constant acceleration
    const ANGULAR_ACCELERATION_PITCH = 0.105;  // Pitch angular acceleration in rad/s²

    public function calculateKXPO(KXPORequest $request)
    {
        // Get validated data
        $validatedData = $request->validated();

        // Logic to calculate the Fattore KXPO
        $length = $validatedData['length'];
        $vertical_shift = $validatedData['vertical_shift'];
        $t_sc = $validatedData['t_sc'];

        // Perform the Fattore KXPO calculation
        return $this->performKXPOCalculation($length, $t_sc, $vertical_shift);
    }

    public function performKXPOCalculation($length, $t_sc, $vertical_shift)
    {

        // Calculate CG_h based on the length of the ship
        $cg_h = ($length > 200) ? 15 : 10;

        //decompose formula into several parts for better readability
        // Parte 1: (aSU)^2
        $parte1 = pow(self::ASU, 2);

        // Parte 2: PitchAngle * g
        $parte2 = deg2rad(self::PITCH_ANGLE) * self::GRAVITY;

        // Parte 3: AngularAccelerationPitch * (VerticalShift + CG_h - T_sc)
        $parte3 = self::ANGULAR_ACCELERATION_PITCH * ($vertical_shift + $cg_h - $t_sc);

        // Parte 4: Suma de parte2 y parte3
        $parte4 = pow($parte2 + $parte3, 2);

        // Parte 5: Suma de parte1 y parte4, calculate the square root
        $parte5 = sqrt($parte1 + $parte4);

        // divide part5 by g
        $kxpo = $parte5 / self::GRAVITY;

        // Return the result in JSON format, including CG_h
        return response()->json([
            'success' => true,
            'kxpo' => $kxpo,
            'cg_h' => $cg_h, 
        ]);
    }
}
