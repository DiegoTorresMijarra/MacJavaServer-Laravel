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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenidx: {{ strtoupper(Auth::user()->name) }}</div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Datos Trabajador') }}</div>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
