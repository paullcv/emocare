<?php

namespace App\Http\Livewire;

use App\Models\Respuesta;
use App\Models\Estudiante;
use App\Models\User;
use Livewire\Component;

class RespuestasChart extends Component
{
    public $start_date;
    public $end_date;
    public $edad;
    public $sexo;
    public $edadOptions;
    public $sexoOptions;

    public function mount()
    {
        $fechaMinima = Respuesta::min('created_at');
        $fechaMaxima = Respuesta::max('created_at');

        $this->start_date = $fechaMinima ?? now()->startOfYear();
        $this->end_date = $fechaMaxima ?? now()->endOfYear();
        $this->edadOptions = $this->getEdadOptions();
        $this->sexoOptions = $this->getSexoOptions();
    }

    public function render()
    {
        $query = Respuesta::selectRaw('COUNT(*) as total_respuestas')
            ->selectRaw('SUM(CASE WHEN sentimiento = "positivo" THEN 1 ELSE 0 END) as respuestas_positivas')
            ->selectRaw('SUM(CASE WHEN sentimiento = "negativo" THEN 1 ELSE 0 END) as respuestas_negativas')
            ->selectRaw('SUM(CASE WHEN sentimiento = "neutral" THEN 1 ELSE 0 END) as respuestas_neutrales')
            ->whereBetween('respuestas.created_at', [$this->start_date, $this->end_date]);

        if ($this->edad) {
            $query->whereHas('estudiante', function ($subQuery) {
                $subQuery->whereHas('user', function ($userQuery) {
                    $userQuery->where('edad', $this->edad);
                });
            });
        }

        if ($this->sexo) {
            $query->whereHas('estudiante', function ($subQuery) {
                $subQuery->whereHas('user', function ($userQuery) {
                    $userQuery->where('sexo', $this->sexo);
                });
            });
        }

        $results = $query->first();

        if ($results) {
            // Accede a las propiedades y crea el array de datos.
            $data = [
                'labels' => ['Positivo', 'Negativo', 'Neutral'],
                'data' => [
                    $results->respuestas_positivas ?? 0,
                    $results->respuestas_negativas ?? 0,
                    $results->respuestas_neutrales ?? 0,
                ],
            ];
        } else {
            // Define un valor predeterminado en caso de que $results sea nulo.
            $data = [
                'labels' => ['Positivo', 'Negativo', 'Neutral'],
                'data' => [0, 0, 0],
            ];
        }

        // Obtener el total de respuestas
        $totalRespuestas = $results->total_respuestas ?? 0;

        // Obtener la cantidad de respuestas positivas, negativas y neutrales
        $cantidadRespuestasPositivas = $results->respuestas_positivas ?? 0;
        $cantidadRespuestasNegativas = $results->respuestas_negativas ?? 0;
        $cantidadRespuestasNeutrales = $results->respuestas_neutrales ?? 0;

        // Calcular el porcentaje de respuestas positivas, negativas y neutrales
        $porcentajeRespuestasPositivas = $totalRespuestas > 0 ? round(($cantidadRespuestasPositivas * 100) / $totalRespuestas, 2) : 0;
        $porcentajeRespuestasNegativas = $totalRespuestas > 0 ? round(($cantidadRespuestasNegativas * 100) / $totalRespuestas, 2) : 0;
        $porcentajeRespuestasNeutrales = $totalRespuestas > 0 ? round(($cantidadRespuestasNeutrales * 100) / $totalRespuestas, 2) : 0;


        $this->emitDraw($data);

        return view('livewire.respuestas-chart', compact('data', 'totalRespuestas', 'porcentajeRespuestasPositivas', 'porcentajeRespuestasNegativas', 'porcentajeRespuestasNeutrales'));
    }

    public function updatedStart_date()
    {
        $this->edadOptions = $this->getEdadOptions();
        $this->sexoOptions = $this->getSexoOptions();
    }

    public function updatedEnd_date()
    {
        $this->edadOptions = $this->getEdadOptions();
        $this->sexoOptions = $this->getSexoOptions();
    }

    protected function getEdadOptions()
    {
        return Respuesta::join('estudiante', 'respuestas.estudiante_id', '=', 'estudiante.user_id')
            ->join('users', 'estudiante.user_id', '=', 'users.id')
            ->whereBetween('respuestas.created_at', [$this->start_date, $this->end_date])
            ->orderBy('users.edad')
            ->pluck('users.edad')
            ->unique()
            ->values()
            ->toArray();
    }

    protected function getSexoOptions()
    {
        return Respuesta::join('estudiante', 'respuestas.estudiante_id', '=', 'estudiante.user_id')
            ->join('users', 'estudiante.user_id', '=', 'users.id')
            ->whereBetween('respuestas.created_at', [$this->start_date, $this->end_date])
            ->orderBy('users.sexo')
            ->pluck('users.sexo')
            ->unique()
            ->values()
            ->toArray();
    }

    public function clearDateFilters()
    {
        // Lógica para limpiar los filtros de fecha y establecer las fechas iniciales
        $fechaMinima = Respuesta::min('created_at');
        $fechaMaxima = Respuesta::max('created_at');

        $this->start_date = $fechaMinima ?? now()->startOfYear();
        $this->end_date = $fechaMaxima ?? now()->endOfYear();

        $this->emit('clearDateFilters');
    }


    public function emitDraw($data)
    {
        $this->emit('draw', $data);
    }
}
