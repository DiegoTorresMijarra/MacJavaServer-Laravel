@extends('main')

{{-- Ponemos el título --}}
@section('title', 'Forbidden')

@section('content')
    <div class="text-center">
        <h1>No puedes pasar</h1>

        <div class="row">
            <img class="mx-auto d-block col-4 p-0" src="{{ asset('images/403.jpg')}}" alt="forbidden" height="400px">
        </div>
        <div class="row">
            <a class="btn btn-primary mx-auto d-block col-4" href="{{ route('productos.index') }}">Volver</a>
        </div>
    </div>
@endsection
