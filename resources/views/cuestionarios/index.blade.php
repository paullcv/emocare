@extends('layouts.windmill')
@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Cuestionarios
        </h2>
    </div>

    <div class="flex justify-between items-center mb-6">
        <a href="{{route('cuestionarios.create')}}" class="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Crear Cuestionario
        </a>
    </div>

    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Listado de Cuestionarios</h2>

        @if ($cuestionarios->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($cuestionarios as $cuestionario)
                    <div class="bg-white p-4 rounded-md shadow-md">
                        <h3 class="text-lg font-semibold mb-2">{{ $cuestionario->titulo }}</h3>
                        <p class="text-gray-600">{{ $cuestionario->descripcion }}</p>
                        <a href="{{ route('cuestionarios.edit', $cuestionario->id) }}"
                            class="text-blue-500 mt-2 inline-block">Editar</a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white p-4 rounded-md shadow-md">
                <p class="text-lg font-semibold">No hay cuestionarios creados por el momento.</p>
            </div>
        @endif
    </div>
@endsection
