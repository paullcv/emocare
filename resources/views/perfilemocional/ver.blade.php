<!-- resources/views/perfilemocional/ver.blade.php -->

@extends('layouts.windmill')

@section('contenido')
    <div class="max-w-3xl mx-auto mt-8 p-6 bg-white rounded-md shadow-md">
        <h1 class="text-4xl font-bold text-center mb-8 text-green-600">Respuestas del Estudiante</h1>

        <div class="mb-4">
            <p class="font-semibold">Estudiante: {{ $estudiante->name }}</p>
            <p class="font-semibold">Email: {{ $estudiante->email }}</p>
        </div>

        @if ($respuestas)
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr>
                        <th class="border bg-gray-200 px-4 py-2">Pregunta</th>
                        <th class="border bg-gray-200 px-4 py-2">Respuesta</th>
                        <th class="border bg-gray-200 px-4 py-2">Sentimiento</th>
                        <th class="border bg-gray-200 px-4 py-2">Fecha de Respuesta</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($respuestas as $respuesta)
                        <tr>
                            <td class="border px-4 py-2">{{ $respuesta->pregunta->pregunta }}</td>
                            <td class="border px-4 py-2">{{ $respuesta->respuesta }}</td>
                            <td class="border px-4 py-2">{{ $respuesta->sentimiento }}</td>
                            <td class="border px-4 py-2">{{ $respuesta->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2" colspan="3">No hay respuestas disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @else
            <p>No hay respuestas disponibles.</p>
        @endif
    </div>
@endsection
