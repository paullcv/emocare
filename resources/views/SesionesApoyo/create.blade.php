@extends('layouts.windmill')

@section('contenido')
    <div class="bg-white rounded p-4 mb-6 mt-2 text-center">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
            Crear Nueva Sesión de Apoyo
        </h2>
    </div>

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('sesiones.index') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
           Ver Sesiones de Apoyo
        </a>
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
                <label for="curso_id" class="block text-sm font-medium text-gray-700">Curso</label>
                <select name="curso_id" id="curso_id" class="mt-1 p-2 w-full border rounded-md">
                    @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                    @endforeach
                </select>
                @error('curso_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            

            <div class="mb-4">
                <label for="estudiante_id" class="block text-sm font-medium text-gray-700">Estudiante</label>
                <select name="estudiante_id" id="estudiante_id" class="mt-1 p-2 w-full border rounded-md">
                    <!-- Estudiantes se cargarán dinámicamente con JavaScript -->
                </select>
                @error('estudiante_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="observacion" class="block text-sm font-medium text-gray-700">Observación</label>
                <textarea name="observacion" id="observacion" class="mt-1 p-2 w-full border rounded-md"></textarea>
                @error('observacion')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="recomendacion" class="block text-sm font-medium text-gray-700">Recomendación</label>
                <textarea name="recomendacion" id="recomendacion" class="mt-1 p-2 w-full border rounded-md"></textarea>
                @error('recomendacion')
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

    @push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cursoSelect = document.getElementById('curso_id');
            const estudianteSelect = document.getElementById('estudiante_id');
    
            cursoSelect.addEventListener('change', function () {
                const selectedCursoId = cursoSelect.value;
                console.log('Curso seleccionado:', selectedCursoId);

                estudianteSelect.innerHTML = '';
    
                const estudiantes = @json($estudiantes);
    
                console.log('Lista de todos los estudiantes:', estudiantes);
    
                const estudiantesCurso = estudiantes.filter(estudiante => estudiante.curso_id == selectedCursoId);
    
                console.log('Estudiantes asociados al curso seleccionado:', estudiantesCurso);
    
                estudiantesCurso.forEach(estudiante => {
                    const option = document.createElement('option');
                    option.value = estudiante.id;
                    option.textContent = estudiante.user.name;
                    estudianteSelect.appendChild(option);
                });
            });
        });
    </script>
    
    
    @endpush
    

@endsection
