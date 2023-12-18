<?php

namespace App\Http\Livewire;

use App\Models\SesionApoyo;
use App\Models\Estudiante;
use App\Models\Curso;
use Livewire\Component;

class SesionesApoyoChart extends Component
{
    public $start_date_sesiones;
    public $end_date_sesiones;
    public $curso_sesiones;
    public $sexo_sesiones;
    public $edadOptions_sesiones;
    public $cursoOptions_sesiones;

    public function mount()
    {
        $fechaMinima = SesionApoyo::min('fecha');
        $fechaMaxima = SesionApoyo::max('fecha');

        $this->start_date_sesiones = $fechaMinima ?? now()->startOfMonth();
        $this->end_date_sesiones = $fechaMaxima ?? now()->endOfMonth();
        $this->cursoOptions_sesiones = $this->getCursoOptions();
    }

    public function render()
    {
        $query = SesionApoyo::query()
            ->selectRaw('COUNT(*) as total_sesiones')
            ->whereBetween('fecha', [$this->start_date_sesiones, $this->end_date_sesiones]);

        if ($this->curso_sesiones) {
            $query->whereHas('estudiante.curso', function ($cursoQuery) {
                $cursoQuery->where('nombre', $this->curso_sesiones);
            });
        }

        if ($this->sexo_sesiones) {
            $query->whereHas('estudiante.user', function ($userQuery) {
                $userQuery->where('sexo', $this->sexo_sesiones);
            });
        }

        $results = $query->first();

        $data = [
            'labels' => ['Total de Sesiones'],
            'data' => [
                $results->total_sesiones ?? 0,
            ],
        ];

        $this->emitDraw($data);

        return view('livewire.sesionesapoyo-chart', compact('data'));
    }

    protected function getCursoOptions()
    {
        return Curso::pluck('nombre')
            ->unique()
            ->values()
            ->toArray();
    }

    public function emitDraw($data)
    {
        $this->emit('draw_sesiones', $data);
    }
}
