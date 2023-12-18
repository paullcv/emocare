@extends('layouts.windmill')
@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Reportes
        </h2>
    </div>
    @livewire('respuestas-chart')
    @livewire('sesionesapoyo-chart')

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stop

