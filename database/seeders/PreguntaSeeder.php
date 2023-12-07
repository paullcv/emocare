<?php

namespace Database\Seeders;

use App\Models\Cuestionario;
use App\Models\Pregunta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $preguntasPorCuestionario = [
            'Inventario de Depresión Infantil (CDI)' => [
                '¿Me siento solo todo el tiempo?',
                '¿Siento ganas de llorar todos los días?',
                '¿Las cosas me molestan todo el tiempo?',
            ],
            'Inventario de Ansiedad Infantil (CAI)' => [
                '¿Me pongo nervioso/a cuando la profesora me hace preguntas?',
                '¿Me da miedo estar con otros niños?',
                '¿Me preocupa hacer las cosas mal?',
            ],
            'Cuestionario de Madurez Psicológica Infantil' => [
                '¿Puedo tomar decisiones por mí mismo?',
                '¿Reconozco cuando cometo errores?',
                '¿Soy responsable con mis tareas?',
            ],
            'Escala de Desesperanza para Niños' => [
                '¿Es probable que me vaya mal en el futuro?',
                '¿No creo cumplir mis metas?',
                '¿No le veo sentido a esforzarme?',
            ],
            'Inventario de Expresión de Ira Estado/Rasgo en Niños (STAXI)' => [
                '¿Me enojo fácilmente por cualquier cosa?',
                '¿Grito o insulto cuando pierdo el control?',
                '¿Golpeo cosas cuando estoy bravo?',
            ],
            'Escala de Resiliencia para niños y adolescentes' => [
                '¿Puedo superar situaciones difíciles?',
                '¿Sigo adelante a pesar de decepciones?',
                '¿Me recupero rápido frente a problemas?',
            ],
            'Escala de Comportamiento Infantil CBCL' => [
                '¿Peleo frecuentemente con mis compañeros?',
                '¿Me distraigo con facilidad en clase?',
                '¿Hablo en exceso o fuera de lugar?',
            ],
            'Batería Psicosocial' => [
                '¿Me siento querido por mi familia?',
                '¿Siento que valgo como persona?',
                '¿Hago amigos con facilidad?',
            ],
            'Escala de Satisfacción con la Vida para niños' => [
                '¿Generalmente estoy satisfecho con mi vida?',
                '¿La mayoría de las cosas de mi vida son buenas?',
                '¿Me gusta cómo es mi vida?',
            ],
            'ADD-H Comprehensive Teacher Rating Scale' => [
                '¿Tengo dificultades para mantener la atención en tareas?',
                '¿Interrumpo actividades o conversaciones frecuentemente?',
                '¿Actúo como si estuviera impulsado por un motor?',
            ],
        ];

        foreach ($preguntasPorCuestionario as $titulo => $preguntas) {
            $cuestionario = Cuestionario::where('titulo', $titulo)->first();

            if ($cuestionario) {
                foreach ($preguntas as $pregunta) {
                    Pregunta::create([
                        'pregunta' => $pregunta,
                        'cuestionario_id' => $cuestionario->id,
                    ]);
                }
            }
        }
    }
}
