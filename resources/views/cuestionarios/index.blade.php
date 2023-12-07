@extends('layouts.windmill')
@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Cuestionarios
        </h2>
    </div>

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('cuestionarios.create') }}"
            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            Crear Cuestionario
        </a>
    </div>

    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Listado de Cuestionarios</h2>

        @if ($cuestionarios->count() > 0)
            <div class="overflow-x-auto">
                <table
                    class="min-w-full bg-white border border-gray-300 divide-y divide-gray-300 rounded-lg overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                                Título</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                                Descripción</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($cuestionarios as $cuestionario)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $cuestionario->titulo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $cuestionario->descripcion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('cuestionarios.edit', $cuestionario->id) }}"
                                        class="text-blue-500 hover:underline">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('cuestionarios.delete', $cuestionario->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 ml-2 hover:underline">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                    <a href="{{ route('cuestionarios.enviar', $cuestionario->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                        Enviar a Estudiantes
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white p-4 rounded-md shadow-md">
                <p class="text-lg font-semibold">No hay cuestionarios creados por el momento.</p>
            </div>
        @endif

        @if (session()->has('notificacion'))
            <div class="mt-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md relative">
                <span class="block sm:inline">{{ session('notificacion') }}</span>
                <button wire:click="clearNotification" class="absolute top-0 right-0 p-2">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        @endif
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Obtener la notificación
                var notification = document.querySelector('.bg-green-100');
        
                // Cerrar la notificación automáticamente después de 3 segundos (3000 milisegundos)
                setTimeout(function () {
                    if (notification) {
                        notification.style.display = 'none';
                        console.log('Notificación cerrada automáticamente');
                    }
                }, 3000); // 3000 milisegundos = 3 segundos
            });
        </script>
        
    </div>

@endsection
