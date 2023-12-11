@extends('layouts.windmill')

@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Recomendación para la Sesión de Apoyo
        </h2>
    </div>

    <div class="container mx-auto p-4">
        @if ($recomendacion)
            <div class="bg-white p-6 rounded-md shadow-md">
                <h3 class="text-xl font-semibold mb-4">Motivo de la Sesión</h3>
                <p class="text-gray-700 mb-2">{{ $sesionapoyo->motivo }}</p>

                <hr class="my-4">

                <h3 class="text-xl font-semibold mb-4">Recomendación</h3>
                <p class="text-gray-700 mb-2">{{ $recomendacion }}</p>
            </div>
        @else
            <div class="bg-white p-6 rounded-md shadow-md">
                <p class="text-lg font-semibold">No hay recomendación disponible para esta sesión de apoyo.</p>
            </div>
        @endif
    </div>
@endsection
