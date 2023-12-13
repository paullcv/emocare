<?php

namespace App\Http\Livewire;

use App\Models\Respuesta;
use Livewire\Component;

class RespuestasChart extends Component
{
    public $start_date;
    public $end_date;

    public function mount()
    {
        $this->start_date = now()->startOfMonth();
        $this->end_date = now()->endOfMonth();
    }

    public function render()
    {
        // Verifica las fechas
        // dd($this->start_date, $this->end_date);

        $results = Respuesta::selectRaw('COUNT(*) as total_respuestas')
            ->selectRaw('SUM(CASE WHEN sentimiento = "positivo" THEN 1 ELSE 0 END) as respuestas_positivas')
            ->selectRaw('SUM(CASE WHEN sentimiento = "negativo" THEN 1 ELSE 0 END) as respuestas_negativas')
            ->selectRaw('SUM(CASE WHEN sentimiento = "neutral" THEN 1 ELSE 0 END) as respuestas_neutrales')
            ->whereBetween('created_at', [$this->start_date, $this->end_date])
            ->first();

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

        // dd($data); // Puedes descomentar esto para verificar si las etiquetas se están generando correctamente.

        $this->emitDraw($data);

        return view('livewire.respuestas-chart', compact('data'));
    }

    public function emitDraw($data)
    {
        $this->emit('draw', $data);
    }
}
