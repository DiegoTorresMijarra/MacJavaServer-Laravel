@php use App\Models\Trabajador; @endphp

@extends('main')

@section('title', 'Trabajadores CRUD')

@section('content')
    <div class="row">
        <div class="col-3 d-flex justify-content-center align-items-center">
            <form action="{{ route('trabajadores.index') }}" class="mb-3" method="get">
                @csrf
                <div class="group">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                    <input type="search" class="inputSearch" name="search" id="search" placeholder="Buscar...">
                </div>
            </form>
        </div>
        <div class="col-7">

        </div>
        <div class="col-2 d-flex justify-content-center align-items-center">
            <a class="btn btn-success" href={{ route('trabajadores.create') }}>Nuevo Trabajador</a>
        </div>
    </div>

    @if (count($trabajadores) > 0)
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Nomina</th>
                <th>Puesto</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($trabajadores as $trabajador)
                <tr class="tr-hover">
                    <td style="padding-top: 20px">{{ $trabajador->id }}</td>
                    <td style="padding-top: 20px">{{ $trabajador->nombre }}</td>
                    <td style="padding-top: 20px">{{ $trabajador->apellidos }}</td>
                    <td style="padding-top: 20px">{{ $trabajador->nomina }}</td>
                    <td style="padding-top: 20px">{{ $trabajador->puesto }}</td>
                    <td style="padding-top: 20px">{{ $trabajador->user->name }}</td>
                    <td style="padding-top: 20px">
                        <a class="btn btn-sm"
                           href="{{ route('trabajadores.show', $trabajador->id) }}" style="background: #413f3d; color: white; margin-right: 10px">Detalles</a>
                        <a class="btn btn-sm"
                           href="{{ route('trabajadores.edit', $trabajador->id) }}" style="background: coral; color: white; margin-right: 10px">Editar</a>
                        <form action="{{ route('trabajadores.destroy', $trabajador->id) }}" method="POST"
                              style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style=" margin-right: 10px"
                                    onclick="return confirm('¿Estás seguro de que deseas borrar este trabajador?')">Borrar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @else
        <p class='lead'><em>No se ha encontrado datos de trabajadores.</em></p>
    @endif

    <div class="pagination-container">
        {{ $trabajadores->links('pagination::bootstrap-4') }}
    </div>

@endsection

