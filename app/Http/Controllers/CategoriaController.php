<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        return CategoriaResource::collection(Categoria::all());
    }

    public function store(CategoriaRequest $request)
    {
        return new CategoriaResource(Categoria::create($request->validated()));
    }

    public function show(Categoria $categoria)
    {
        return new CategoriaResource($categoria);
    }

    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        $categoria->update($request->validated());

        return new CategoriaResource($categoria);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response()->json();
    }
}
