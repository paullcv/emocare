{{-- @extends('layouts.panel', ['title' => 'Editar Estudiante'])
 --}}
 
@extends('layouts.windmill')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Editar Estudiante</h3>
                    </div>

                    <div class="card-body">
                        <!-- Formulario de edición -->
                        <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}">
                            @csrf
                            @method('PUT') <!-- Método para enviar la solicitud como PUT -->

                            <!-- Campos del formulario -->
                            <div class="form-group">
                                <labels for="name">Nombre:</labels>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Correo Electrónico:</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>

                            <!-- Mostrar el rol actual -->
                            <div class="form-group">
                                <label for="current_role">Rol actual:</label>
                                <input type="text" name="current_role" class="form-control"
                                    value="{{ $user->roles->first()->name }}" readonly>
                            </div>

                            <!-- Seleccionar un nuevo rol -->
                            <div class="form-group">
                                <label for="new_role">Seleccionar nuevo rol:</label>
                                <div class="input-group">
                                    <select name="new_role" class="form-control">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <!-- Botón para restablecer el rol -->
                                        <button type="button" class="btn btn-warning" id="resetRol">Restablecer
                                            Rol</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Script para restablecer el rol al valor actual -->
                            <script>
                                document.getElementById('resetRol').addEventListener('click', function() {
                                    // Obtener el valor actual del rol y seleccionarlo en el ComboBox
                                    var currentRolName = "{{ $user->roles->first()->name }}";
                                    var rolSelect = document.querySelector('select[name="new_role"]');
                                    rolSelect.value = currentRolName;
                                });
                            </script>



                            <!-- Mostrar el curso actual -->
                            <div class="form-group">
                                <label for="curso_id">Curso actual:</label>
                                <input type="text" name="current_curso" class="form-control"
                                    value="{{ $user->userable->curso->nombre }}" readonly>
                            </div>

                            <!-- Seleccionar un nuevo curso -->
                            <div class="form-group">
                                <label for="curso_id">Seleccionar nuevo curso:</label>
                                <div class="input-group">
                                    <select name="curso_id" class="form-control">
                                        @foreach ($cursos as $curso)
                                            <option value="{{ $curso->id }}"
                                                {{ $user->userable->curso->id == $curso->id ? 'selected' : '' }}>
                                                {{ $curso->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <!-- Botón para restablecer el curso -->
                                        <button type="button" class="btn btn-warning" id="resetCurso">Restablecer
                                            Curso</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Script para restablecer el curso al valor actual -->
                            <script>
                                document.getElementById('resetCurso').addEventListener('click', function() {
                                    // Obtener el valor actual del curso y seleccionarlo en el ComboBox
                                    var currentCursoId = "{{ $user->userable->curso->id }}";
                                    var cursoSelect = document.querySelector('select[name="curso_id"]');
                                    cursoSelect.value = currentCursoId;
                                });
                            </script>

                            <!-- Otros campos del formulario para editar el estudiante -->

                            <!-- Botón de enviar formulario -->
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>

                            <!-- Botón para volver atrás -->
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver Atrás</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
