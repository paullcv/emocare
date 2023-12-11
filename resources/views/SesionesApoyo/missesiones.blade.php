@extends('layouts.windmill')

@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Mis Sesiones de Apoyo
        </h2>
    </div>

    <div class="container mx-auto p-4">
        @if ($sesiones->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($sesiones as $sesion)
                    <div class="bg-white p-6 rounded-md shadow-md hover:shadow-lg transition duration-300">
                        <h3 class="text-lg font-semibold mb-4">{{ $sesion->motivo }}</h3>
                        <p class="text-gray-600 mb-2">Fecha: {{ $sesion->fecha }}</p>
                        <p class="text-gray-600 mb-2">Hora: {{ $sesion->hora }}</p>
                        <!-- Agrega más detalles según tus necesidades -->
                        
                        <div class="mt-4">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Recomendación
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white p-6 rounded-md shadow-md">
                <p class="text-lg font-semibold">No tienes sesiones de apoyo programadas.</p>
            </div>
        @endif
    </div>
@endsection
