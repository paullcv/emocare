<!-- resources/views/users/show.blade.php -->

@extends('layouts.windmill')

@section('content')
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Detalles de Usuario</h3>
                    </div>

                    <div class="card-body">
                        <h4>Información General</h4>
                        <p><strong>ID:</strong> {{ $user->userable->id }}</p>
                        <p><strong>Nombre:</strong> {{ $user->name }}</p>
                        <p><strong>Correo Electrónico:</strong> {{ $user->email }}</p>

                        @if ($user->userable_type === 'App\Models\Director')
                            <h4>Detalles de Director</h4>
                            <p><strong>Cargo:</strong> {{ $user->userable->cargo }}</p>
                        @elseif ($user->userable_type === 'App\Models\Consejero')
                            <h4>Detalles de Consejero</h4>
                            <p><strong>Especialidad:</strong> {{ $user->userable->especialidad }}</p>
                        @elseif ($user->userable_type === 'App\Models\Estudiante')
                            <h4>Detalles de Estudiante</h4>
                            <p><strong>Observación:</strong> {{ $user->userable->observacion }}</p>
                        @endif

                        <!-- Back button -->
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver Atrás</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
