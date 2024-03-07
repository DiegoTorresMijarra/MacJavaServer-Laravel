@extends('main')

{{-- Ponemos el título --}}
@section('title', 'Forbidden')

@section('content')
    <div class="text-center">
        <h1>No puedes pasar</h1>

        @if (!empty($causa))
            @yield('causa')
            <div class="text-center row">
                <p class="mx-auto d-block col-4 p-0 bg-white"> {{ $causa }}</p>
            </div>
        @endif

        <div class="row">
            <img class="mx-auto d-block col-4 p-0" src="{{ asset('images/403.png')}}" alt="forbidden" height="400px">
        </div>
        <div class="row">
            <a class="btn btn-primary mx-auto d-block col-4" href="{{ route('productos.index') }}">Volver</a>
        </div>
    </div>
@endsection
