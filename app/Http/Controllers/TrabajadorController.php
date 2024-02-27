<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrabajadorRequest;
use App\Http\Resources\TrabajadorResource;
use App\Models\Trabajador;

class TrabajadorController extends Controller
{
    public function index()
    {
        return TrabajadorResource::collection(Trabajador::all());
    }

    public function store(TrabajadorRequest $request)
    {
        return new TrabajadorResource(Trabajador::create($request->validated()));
    }

    public function show(Trabajador $trabajador)
    {
        return new TrabajadorResource($trabajador);
    }

    public function update(TrabajadorRequest $request, Trabajador $trabajador)
    {
        $trabajador->update($request->validated());

        return new TrabajadorResource($trabajador);
    }

    public function destroy(Trabajador $trabajador)
    {
        $trabajador->delete();

        return response()->json();
    }
}
