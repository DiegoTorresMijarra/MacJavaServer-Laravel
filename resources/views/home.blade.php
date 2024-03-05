<?php
    use App\Models\DireccionPersonal;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Relations\HasMany;
?>

@extends('main')
@section('title','Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Pedidos') }}</div>

                <div class="card-body">
                    {{ __('pedidos...') }}
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Direcciones') }}</div>

                <div class="card-body">
                    <div class="row">
                        @if( $direcciones && count($direcciones) > 0 )
                            @foreach($direcciones as $direccion)
                                <div class="card mt-4 col-md-4 mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col direccionPersonalLabel">
                                                <h5 class="card-title mb-0">{{ $direccion->nombre }}</h5>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center align-items-center">
                                            <a href="{{ route('direccion-personal.show', $direccion->id) }}" class="col-4 btn btn-secondary">Detalles</a>
                                            <a href="{{ route('direccion-personal.edit', $direccion->id) }}" class="col-4 btn btn-primary">Editar</a>
                                            <form action="{{ route('direccion-personal.destroy', $direccion->id) }}" method="POST" class="col-4 d-flex justify-content-center align-items-center m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('¿Estás seguro de que deseas borrar esta direccion?')">Borrar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <div class="alert alert-info" role="alert">
                                    No se encontraron direcciones
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="pagination-container">
                                {{ $direcciones->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-right">
                                <a class="btn btn-primary" href="{{route('direccion-personal.create')}}">Nueva Dirección</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
