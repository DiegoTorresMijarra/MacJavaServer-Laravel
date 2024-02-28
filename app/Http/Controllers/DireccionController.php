<?php

namespace App\Http\Controllers;

use App\Http\Requests\DireccionRequest;
use App\Http\Resources\DireccionResource;
use App\Models\Direccion;

class DireccionController extends Controller
{
    public function index()
    {
        return DireccionResource::collection(Direccion::all());
    }

    public function store(DireccionRequest $request)
    {
        return new DireccionResource(Direccion::create($request->validated()));
    }

    public function show(Direccion $direccion)
    {
        return new DireccionResource($direccion);
    }

    public function update(DireccionRequest $request, Direccion $direccion)
    {
        $direccion->update($request->validated());

        return new DireccionResource($direccion);
    }

    public function destroy(Direccion $direccion)
    {
        $direccion->delete();

        return response()->json();
    }
}
