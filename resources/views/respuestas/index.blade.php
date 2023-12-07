@extends('layouts.windmill')

@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Cuestionarios Asignados
        </h2>
    </div>

    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Listado de Cuestionarios</h2>

        @if ($cuestionarios->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 divide-y divide-gray-300 rounded-lg overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Título</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Descripción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($cuestionarios as $cuestionario)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $cuestionario->titulo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('respuesta.responder', $cuestionario->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                        Responder
                                    </a>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white p-4 rounded-md shadow-md">
                <p class="text-lg font-semibold">No hay cuestionarios asignados por el momento.</p>
            </div>
        @endif
    </div>
@endsection
