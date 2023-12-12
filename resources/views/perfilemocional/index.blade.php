@extends('layouts.windmill')

@section('contenido')
    <div class="container mx-auto mt-8 p-6 bg-white rounded-md shadow-md">
        <h1 class="text-4xl font-bold text-center mb-8 text-green-600">Perfiles Emocionales de Estudiantes</h1>

        <table class="min-w-full border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Nombre</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Curso</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $estudiante)
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $estudiante->name }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $estudiante->email }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ optional($estudiante->userable)->curso->nombre }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <a href="{{ route('perfilemocional.ver', $estudiante->id) }}" class="text-blue-500 hover:underline">Ver Sentimientos</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $estudiantes->links() }}
        </div>
        
    </div>
@endsection
