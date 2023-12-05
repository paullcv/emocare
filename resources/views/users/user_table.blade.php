{{-- @if($users->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered align-items-center">
            <thead>
                <tr>
                    <th scope="col" style="width: 5%;">ID</th>
                    <th scope="col" style="width: 30%;">Nombre</th>
                    <th scope="col" style="width: 30%;">Correo Electrónico</th>
                    <th scope="col" style="width: 15%;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->userable->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>No hay usuarios registrados.</p>
@endif


  --}}



 


  @if($users->count() > 0)
    <div class="table-responsive">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th scope="col" class="py-2 px-4 border-b bg-indigo-500 text-white">ID</th>
                    <th scope="col" class="py-2 px-4 border-b bg-indigo-500 text-white">Nombre</th>
                    <th scope="col" class="py-2 px-4 border-b bg-indigo-500 text-white">Correo Electrónico</th>
                    <th scope="col" class="py-2 px-4 border-b bg-indigo-500 text-white">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="py-2 px-4 border-b text-gray-800">{{ $user->userable->id }}</td>
                        <td class="py-2 px-4 border-b text-gray-800">{{ $user->name }}</td>
                        <td class="py-2 px-4 border-b text-gray-800">{{ $user->email }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('users.show', $user->id) }}" class="text-green-500 hover:underline">Ver</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-500 hover:underline ml-2">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-2 px-4 border-b text-red-500">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@else
    <p class="text-red-500">No hay usuarios registrados.</p>
@endif
