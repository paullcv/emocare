@extends('layouts.windmill')

@section('contenido')
    <div class="max-w-3xl mx-auto mt-8 p-6 bg-white rounded-md shadow-md">
        <h1 class="text-4xl font-bold text-center mb-8 text-green-600">Responder Cuestionario</h1>

        <form action="{{ route('respuestas.guardar', $cuestionario->id) }}" method="POST" class="space-y-6 w-full mx-auto">
            @csrf

            @foreach ($preguntas as $pregunta)
                <div class="bg-gray-100 p-6 rounded-md mb-4">
                    <h2 class="text-lg font-semibold mb-2">{{ $pregunta->pregunta }}</h2>
                    <textarea name="respuestas[{{ $pregunta->id }}]" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:border-green-500"></textarea>
                </div>
            @endforeach

            <button type="submit" class="bg-green-500 text-white p-4 rounded-md hover:bg-green-600 transition duration-300 w-full">Enviar Respuestas</button>
        </form>
    </div>
@endsection
