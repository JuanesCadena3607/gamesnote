@extends('layouts.admin')

@section('content')
    <div class="p-4 mt-5">
        <div class="bg-white p-4 rounded">
            <div class="table-responsive">
                <h2 class="text-center mb-4" style="color: #000;">LISTA DE USUARIOS</h2>
               <div class="d-flex align-items-center justify-content-lg-between">
                <form action="{{ route('admin.users.index') }}" method="GET" class="mb-3 d-flex" >
                    <div class="form-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por nombre" value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
               </div>
                <table class="table table-bordered mx-auto">
                    <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Correo Electrónico</th>
                        <th class="text-center">Rol</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center">{{ $user->role === 1 ? 'Administrador' : 'Usuario' }}</td>
                            <td class="text-center">
                                <!-- Botón de eliminar usuario -->
                                <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST" style="display: inline;" title="Eliminar usuario" data-toggle="tooltip" data-placement="top">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                                <!-- Botón de ver perfil -->
                                <a href="{{ route('profile.show', ['id' => $user->id]) }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Ver perfil">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Botón de cambiar rol -->
                                <form action="{{ route('admin.users.updateRole', ['user' => $user->id]) }}" method="POST" style="display: inline;" title="{{ $user->role == 1 ? 'Quitar admin' : 'Volver admin' }}" data-toggle="tooltip" data-placement="top">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn {{ $user->role == 1 ? 'btn-warning' : 'btn-success' }}" onclick="return confirm('¿Estás seguro de cambiar el rol de este usuario?');">
                                        <i class="fas {{ $user->role == 1 ? 'fa-user' : 'fa-user-shield' }}"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="text-center">
        <p class="text-black">{{ $users->links() }}</p>
    </div>
@endsection
