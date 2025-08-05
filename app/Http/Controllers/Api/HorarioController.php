<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Horario;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function crearHorario(Request $request)
    {
        $request->validate([
            'id_empleado' => 'required|exists:empleado,id_empleado',
            'hor_lun_horario' => 'nullable|string|max:11|regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/',
            'hor_mar_horario' => 'nullable|string|max:11|regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/',
            'hor_mie_horario' => 'nullable|string|max:11|regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/',
            'hor_jue_horario' => 'nullable|string|max:11|regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/',
            'hor_vie_horario' => 'nullable|string|max:11|regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/',
            'hor_sab_horario' => 'nullable|string|max:11|regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/',
            'hor_dom_horario' => 'nullable|string|max:11|regex:/^\d{2}:\d{2}-\d{2}:\d{2}$/',
        ]);

        if (Horario::where('id_empleado', $request->id_empleado)->exists()) {
            return ResponseHelper::conflict("Este empleado ya tiene un horario registrado.");
        }

        $dias = [
            'hor_lun_horario', 'hor_mar_horario', 'hor_mie_horario',
            'hor_jue_horario', 'hor_vie_horario', 'hor_sab_horario', 'hor_dom_horario',
        ];

        try {
            [$horasSemanales, $diasTrabajados] = $this->calcularHorasYDias($request, $dias);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        $horario = Horario::create([
            'id_empleado' => $request->id_empleado,
            'hor_lun_horario' => $request->hor_lun_horario,
            'hor_mar_horario' => $request->hor_mar_horario,
            'hor_mie_horario' => $request->hor_mie_horario,
            'hor_jue_horario' => $request->hor_jue_horario,
            'hor_vie_horario' => $request->hor_vie_horario,
            'hor_sab_horario' => $request->hor_sab_horario,
            'hor_dom_horario' => $request->hor_dom_horario,
            'hor_sem_horario' => $horasSemanales, // cantidad de horas semanales
            'dia_sem_horario' => $diasTrabajados, // cantidad de dias semanales de trabajo (que no son campos vacios)
        ]);

        return ResponseHelper::success($horario, 'Horario creado');
    }

    private function validarRangoHoras($dia, $horario)
    {
        $partes = explode('-', $horario);

        if (count($partes) !== 2 || strlen($partes[0]) !== 5 || strlen($partes[1]) !== 5) {
            throw new \Exception("Formato inválido en el día $dia. Usa el formato HH:MM-HH:MM.");
        }

        list($hIni, $mIni) = explode(':', $partes[0]);
        list($hFin, $mFin) = explode(':', $partes[1]);

        if (
            !ctype_digit($hIni) || !ctype_digit($mIni) || !ctype_digit($hFin) || !ctype_digit($mFin) ||
            (int)$hIni < 0 || (int)$hIni > 23 || (int)$mIni < 0 || (int)$mIni > 59 ||
            (int)$hFin < 0 || (int)$hFin > 23 || (int)$mFin < 0 || (int)$mFin > 59
        ) {
            throw new \Exception("Horario inválido en el día $dia: las horas deben estar entre 00-23 y los minutos entre 00-59.");
        }

        $inicio = Carbon::createFromFormat('H:i', $partes[0]);
        $fin = Carbon::createFromFormat('H:i', $partes[1]);

        if (!$fin->greaterThan($inicio)) {
            throw new \Exception("El horario de $dia es inválido: la hora de inicio debe ser menor que la hora de fin.");
        }

        return [$inicio, $fin];
    }

    private function calcularHorasYDias($request, $dias)
    {
        $horasSemanales = 0;
        $diasTrabajados = 0;

        foreach ($dias as $dia) {
            $horario = $request->$dia;

            if (!empty($horario)) {
                try {
                    [$inicio, $fin] = $this->validarRangoHoras($dia, $horario);
                    $horas = $inicio->diffInMinutes($fin) / 60;
                    $horasSemanales += $horas;
                    $diasTrabajados++;
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
            }
        }

        return [$horasSemanales, $diasTrabajados];
    }


}
