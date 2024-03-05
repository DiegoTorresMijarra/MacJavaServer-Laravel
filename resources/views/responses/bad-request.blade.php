@extends('main')

{{-- Ponemos el título --}}
@section('title', 'Bad Request')

@section('content')
    <div class="text-center">
        <h2>Algo fue mal!?</h2>

        @yield('causa')
        <div class="text-center row">
            <p class="mx-auto d-block col-4 p-0 bg-white"> {{ $causa }}</p>
        </div>
        <div class="row">
            <img class="mx-auto d-block col-4 p-0" src="{{asset('images/400.jpg')}}" alt="forbidden">
        </div>
        <div class="row">
            <a class="btn btn-primary mx-auto d-block col-4" href="{{ route('productos.index') }}">Volver</a>
        </div>
    </div>
@endsection
