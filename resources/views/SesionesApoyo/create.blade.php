@extends('layouts.windmill')

@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Crear Nueva Sesión de Apoyo
        </h2>
    </div>

    <div class="container mx-auto p-4">
        <form action="{{ route('sesiones.save') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="motivo" class="block text-sm font-medium text-gray-700">Motivo</label>
                <input type="text" name="motivo" id="motivo" class="mt-1 p-2 w-full border rounded-md">
                @error('motivo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="mt-1 p-2 w-full border rounded-md">
                @error('fecha')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="hora" class="block text-sm font-medium text-gray-700">Hora</label>
                <input type="time" name="hora" id="hora" class="mt-1 p-2 w-full border rounded-md">
                @error('hora')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="estudiante_id" class="block text-sm font-medium text-gray-700">Estudiante</label>
                <select name="estudiante_id" id="estudiante_id" class="mt-1 p-2 w-full border rounded-md">
                    @foreach ($estudiantes as $estudiante)
                        <option value="{{ $estudiante->id }}">{{ $estudiante->nombre }}</option>
                    @endforeach
                </select>
                @error('estudiante_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Crear Sesión de Apoyo
                </button>
            </div>
        </form>
    </div>
@endsection
