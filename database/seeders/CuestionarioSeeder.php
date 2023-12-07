<?php

namespace Database\Seeders;

use App\Models\Cuestionario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CuestionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cuestionarios = [
            'Inventario de Depresión Infantil (CDI)' => 'Mide síntomas de depresión.',
            'Inventario de Ansiedad Infantil (CAI)' => 'Evalúa niveles de ansiedad.',
            'Cuestionario de Madurez Psicológica Infantil' => 'Determina el desarrollo emocional.',
            'Escala de Desesperanza para Niños' => 'Identifica sentimientos negativos sobre el futuro.',
            'Inventario de Expresión de Ira Estado/Rasgo en Niños (STAXI)' => 'Mide enojo y expresión de ira interna/externa.',
            'Escala de Resiliencia para niños y adolescentes' => 'Capacidad de sobreponerse a la adversidad.',
            'Escala de Comportamiento Infantil CBCL' => 'Problemas socioemocionales y comportamentales.',
            'Batería Psicosocial' => 'Clima familiar, autoestima, relaciones sociales.',
            'Escala de Satisfacción con la Vida para niños' => 'Bienestar subjetivo infantil percibido.',
            'ADD-H Comprehensive Teacher Rating Scale (ACTeRS)' => 'Sintomatología TDAH',
        ];

        foreach ($cuestionarios as $titulo => $descripcion) {
            Cuestionario::create([
                'titulo' => $titulo,
                'descripcion' => $descripcion,
            ]);
        }
    }
}
