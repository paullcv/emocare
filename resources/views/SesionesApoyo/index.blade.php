@extends('layouts.windmill')

@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Sesiones de Apoyo
        </h2>
    </div>

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('sesiones.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            Crear Sesión de Apoyo
        </a>
    </div>

    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Listado de Sesiones de Apoyo</h2>

        @if ($sesiones->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 divide-y divide-gray-300 rounded-lg overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Motivo</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Hora</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Estudiante</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Observación</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Recomendación</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($sesiones as $sesion)
                            <tr>
                                <td class="px-6 py-4 whitespace-wrap break-words max-h-20">
                                    {{ $sesion->motivo }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $sesion->fecha }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $sesion->hora }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $sesion->estudiante->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $sesion->observacion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $sesion->recomendacion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <!-- Acciones -->
                                    <a href="{{ route('sesiones.edit', $sesion->id) }}" class="text-blue-500 hover:underline">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('sesiones.delete', $sesion->id) }}" method="POST" class="inline">
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
                <p class="text-lg font-semibold">No hay sesiones de apoyo registradas por el momento.</p>
            </div>
        @endif
    </div>
@endsection
