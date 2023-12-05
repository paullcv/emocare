<!-- create.blade.php -->

@extends('layouts.windmill')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nuevo Usuario</div>

                    <div class="card-body">


                        <!-- Muestra errores de validación -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Formulario de carga de archivo -->
                        {{-- <form method="POST" action="{{ route('users.import') }}" enctype="multipart/form-data"> --}}

                        <!-- Formulario de carga de archivo -->
                        {{-- <form method="POST" action="{{ route('users.import') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="excel_file" class="form-label">Cargar Archivo Excel:</label>
                                <input type="file" name="excel_file" class="form-control" accept=".xlsx, .xls" required>
                            </div>

                            <!-- Botón de enviar formulario para cargar datos de Excel -->
                            <button type="submit" class="btn btn-success">Subir Datos Colegio</button>
                        </form> --}}


                        <!-- Formulario de carga de archivo -->
                        {{-- <form method="POST" action="{{ route('users.import') }}" enctype="multipart/form-data" class="mb-4">
                            @csrf

                            <div class="mb-3">
                                <h4 class="mb-3">Subir Datos del Colegio</h4>
                                <label for="excel_file" class="form-label">Seleccionar Archivo Excel:</label>
                                <div class="input-group">
                                    <input type="file" name="excel_file" class="form-control" accept=".xlsx, .xls"
                                        required>
                                    <button type="submit" class="btn btn-success">Subir</button>
                                </div>
                                <small class="text-muted">Formatos permitidos: .xlsx, .xls</small>
                            </div>
                        </form> --}}



                        <!-- Formulario de carga de archivo Excel -->
                        <form id="importForm" method="POST" action="{{ route('users.import') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="excel_file" class="form-label">Cargar Archivo Excel:</label>
                                <input type="file" name="excel_file" class="form-control-file" accept=".xlsx, .xls"
                                    required>
                            </div>

                            <!-- Botón de enviar formulario para cargar datos de Excel -->
                            <button type="submit" class="btn btn-success">Subir Datos Colegio</button>
                        </form>

                        <hr> <!-- Línea divisoria para separar los formularios -->

                        <!-- Formulario de creación de usuario -->
                        <form id="createUserForm" method="POST" action="{{ route('users.store') }}">
                            @csrf

                            <!-- Agregamos un campo oculto para indicar qué formulario se está enviando -->
                            <input type="hidden" name="form_type" value="createUserForm">

                            <!-- Campos del formulario -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre:</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico:</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo:</label>
                                <input type="number" name="tipo" class="form-control" value="{{ old('tipo') }}"
                                    required min="1" max="2">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <!-- Botón de enviar formulario -->
                            <button type="submit" class="btn btn-primary">Crear Usuario</button>
                        </form>

                    </div>


                    <script>
                        document.getElementById('importForm').addEventListener('submit', function() {
                            // Deshabilita el segundo formulario cuando el primero se envía
                            document.getElementById('createUserForm').classList.add('d-none');
                            // Deshabilita el campo oculto para evitar que se envíen sus datos
                            document.getElementById('createUserForm').querySelector('input[name="form_type"]').disabled = true;
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
@endsection
