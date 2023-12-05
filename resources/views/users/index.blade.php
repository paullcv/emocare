{{-- @extends('layouts.panel', ['title' => 'Listado de Usuarios']) --}}

{{-- @extends('layouts.windmill')


@section('contenido')
    <div class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Listado de Usuarios</h3>
                    </div>

                    <div class="card-body">
                        <div class="user-section">
                            <!-- Usuarios Directores -->
                            <div class="mb-4">
                                <h4>Directores</h4>
                                @include('users.user_table', ['users' => $directores])
                            </div>

                            <!-- Usuarios Consejeros -->
                            <div class="mb-4">
                                <h4>Consejeros</h4>
                                @include('users.user_table', ['users' => $consejeros])
                            </div>

                            <!-- Usuarios Estudiantes -->
                            <div>
                                <h4>Estudiantes</h4>
                                @include('users.user_table', ['users' => $estudiantes])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}



@extends('layouts.windmill')

@section('contenido')
    <div class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Listado de Usuarios</h3>
                    </div>

                    <div class="card-body">
                        <div class="user-section">
                            <!-- Usuarios Directores -->
                            <div class="mb-4">
                                <h4>Directores</h4>
                                @include('users.user_table', ['users' => $directores])
                            </div>

                            <!-- Usuarios Consejeros -->
                            <div class="mb-4">
                                <h4>Consejeros</h4>
                                @include('users.user_table', ['users' => $consejeros])
                            </div>

                            <!-- Usuarios Estudiantes -->
                            <div>
                                <h4>Estudiantes</h4>
                                @include('users.user_table', ['users' => $estudiantes])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


