@extends('layouts.windmill')
@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Crear Cuestionario
        </h2>
    </div>

    <div class="flex justify-between items-center mb-6">
        <a href="{{route('cuestionarios.index')}}" class="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Ver Cuestionarios
        </a>
    </div>

    <div class="container mx-auto p-4">
        <form action="{{ route('cuestionarios.save') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título:</label>
                <input type="text" name="titulo" id="titulo" class="mt-1 p-2 w-full border rounded-md">
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                <textarea name="descripcion" id="descripcion" class="mt-1 p-2 w-full border rounded-md"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Crear Cuestionario
                </button>
            </div>
        </form>
    </div>
@endsection
