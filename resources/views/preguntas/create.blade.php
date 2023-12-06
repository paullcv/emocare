@extends('layouts.windmill')
@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Crear Pregunta
        </h2>
    </div>

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('preguntas.index') }}" class="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Ver Preguntas
        </a>
    </div>

    <div class="container mx-auto p-4">
        <form action="{{ route('preguntas.save') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="pregunta" class="block text-sm font-medium text-gray-700">Pregunta:</label>
                <input type="text" name="pregunta" id="pregunta" class="mt-1 p-2 w-full border rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="cuestionario_id" class="block text-sm font-medium text-gray-700">Cuestionario:</label>
                <select name="cuestionario_id" id="cuestionario_id" class="mt-1 p-2 w-full border rounded-md" required>
                    @foreach ($cuestionarios as $cuestionario)
                        <option value="{{ $cuestionario->id }}">{{ $cuestionario->titulo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end mt-8">
                <button type="submit" class="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Crear Pregunta
                </button>
            </div>
        </form>
    </div>
@endsection
