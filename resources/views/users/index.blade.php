@php use App\Models\User; @endphp

@extends('main')

@section('title', 'Usuarios CRUD')

@section('content')
    <div class="row">
        <div class="col-3 d-flex justify-content-center align-items-center">
            <form action="{{ route('users.index') }}" class="mb-3" method="get">
                @csrf
                <div class="group">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                        <g>
                            <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                        </g>
                    </svg>
                    <input type="email" class="inputSearch" name="search" id="search" placeholder="Email...">
                </div>
            </form>
        </div>
        <div class="col-7"></div>
        <div class="col-2 d-flex justify-content-center align-items-center">
            <a class="btn btn-success" href="{{ route('users.create') }}">Nuevo Usuario</a>
        </div>
    </div>

    @if (count($usuarios) > 0)
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($usuarios as $usuario)
                <tr class="tr-hover">
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->rol }}</td>
                    <td>
                        <a href="{{ route('users.show', $usuario->id) }}" class="btn btn-sm btn-primary">Detalles</a>
                        <a href="{{ route('users.edit', $usuario->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('users.destroy', $usuario->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas borrar este usuario?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p class="lead"><em>No se encontraron usuarios.</em></p>
    @endif

    <div class="pagination-container">
        {{ $usuarios->links('pagination::bootstrap-4') }}
    </div>
@endsection
