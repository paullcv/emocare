<?php

namespace App\Http\Livewire;

use App\Models\SesionApoyo;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SesionesApoyoChart extends Component
{
    public $start_date_sesiones;
    public $end_date_sesiones;
    public $curso_sesiones;
    public $sexo_sesiones;
    public $edad_sesiones;
    public $filtro_sesiones;
    public $edadOptions_sesiones;
    public $cursoOptions_sesiones;

    public function mount()
    {
        $fechaMinima = SesionApoyo::min('fecha');
        $fechaMaxima = SesionApoyo::max('fecha');

        $this->start_date_sesiones = $fechaMinima ?? now()->startOfMonth();
        $this->end_date_sesiones = $fechaMaxima ?? now()->endOfMonth();
        $this->cursoOptions_sesiones = $this->getCursoOptions();
        $this->edadOptions_sesiones = $this->getEdadOptions();
        $this->selectedChartType = 'cursos'; // Establecer el valor predeterminado a 'cursos'
    }



    public function render()
    {
        $results = [];
        $data = [];

        switch ($this->filtro_sesiones) {
            case 'curso':
                $results = $this->getSesionesPorCurso();
                break;

            case 'edad':
                $results = $this->getSesionesPorEdad();
                break;

            case 'sexo':
                $results = $this->getSesionesPorSexo();
                break;
        }

        $collection = new Collection($results); // Convierte el array a una colección
        $data = [
            'labels' => $collection->pluck('label')->toArray(),
            'data' => $collection->pluck('total_sesiones')->toArray(),
        ];

        $this->emitDraw($data);

        return view('livewire.sesionesapoyo-chart', compact('data'));
    }

    protected function getSesionesPorCurso()
    {
        $query = SesionApoyo::query()
            ->selectRaw('COUNT(*) as total_sesiones, curso.nombre as label')
            ->join('estudiante', 'sesion_apoyos.estudiante_id', '=', 'estudiante.id')
            ->join('curso', 'estudiante.curso_id', '=', 'curso.id')
            ->whereBetween('sesion_apoyos.fecha', [$this->start_date_sesiones, $this->end_date_sesiones]);

        if ($this->curso_sesiones) {
            $query->whereHas('estudiante.curso', function ($cursoQuery) {
                $cursoQuery->where('nombre', $this->curso_sesiones);
            });
        }

        return $query->groupBy('curso.nombre')->get();
    }

    protected function getSesionesPorEdad()
    {
        $query = SesionApoyo::query()
            ->selectRaw('COUNT(*) as total_sesiones, users.edad as label')
            ->join('estudiante', 'sesion_apoyos.estudiante_id', '=', 'estudiante.id')
            ->join('users', 'estudiante.user_id', '=', 'users.id')
            ->whereBetween('sesion_apoyos.fecha', [$this->start_date_sesiones, $this->end_date_sesiones]);

        if ($this->edad_sesiones) {
            $query->whereHas('estudiante.user', function ($userQuery) {
                $userQuery->where('edad', $this->edad_sesiones);
            });
        }

        return $query->groupBy('users.edad')->get();
    }

    protected function getSesionesPorSexo()
    {
        $query = SesionApoyo::query()
            ->selectRaw('COUNT(*) as total_sesiones, users.sexo as label')
            ->join('estudiante', 'sesion_apoyos.estudiante_id', '=', 'estudiante.id')
            ->join('users', 'estudiante.user_id', '=', 'users.id')
            ->whereBetween('sesion_apoyos.fecha', [$this->start_date_sesiones, $this->end_date_sesiones]);

        if ($this->sexo_sesiones) {
            $query->whereHas('estudiante.user', function ($userQuery) {
                $userQuery->where('sexo', $this->sexo_sesiones);
            });
        }

        return $query->groupBy('users.sexo')->get();
    }

    protected function getCursoOptions()
    {
        return Curso::pluck('nombre')
            ->unique()
            ->values()
            ->toArray();
    }

    protected function getEdadOptions()
    {
        // Obtén las opciones de edades desde tu base de datos
        // Asume que las edades se encuentran en la tabla 'users'
        return \DB::table('users')->pluck('edad')
            ->unique()
            ->values()
            ->toArray();
    }

    public function emitDraw($data)
    {
        $this->emit('draw_sesiones', $data);
    }
}
