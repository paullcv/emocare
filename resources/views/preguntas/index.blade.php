@extends('layouts.windmill')
@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Preguntas
        </h2>
    </div>

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('preguntas.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            Crear Pregunta
        </a>
    </div>

    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Listado de Preguntas</h2>

        @if ($preguntas->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 divide-y divide-gray-300 rounded-lg overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Pregunta</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Cuestionario</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($preguntas as $pregunta)
                            <tr>
                                <td class="px-6 py-4 whitespace-wrap break-words max-h-20">
                                    {{ $pregunta->pregunta }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $pregunta->cuestionario->titulo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('preguntas.edit', $pregunta->id) }}" class="text-blue-500 hover:underline">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('preguntas.delete', $pregunta->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 ml-2 hover:underline">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white p-4 rounded-md shadow-md">
                <p class="text-lg font-semibold">No hay preguntas creadas por el momento.</p>
            </div>
        @endif
    </div>
@endsection
