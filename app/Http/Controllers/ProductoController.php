<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Http\Resources\ProductoResource;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        return ProductoResource::collection(Producto::all());
    }

    public function store(ProductoRequest $request)
    {
        return new ProductoResource(Producto::create($request->validated()));
    }

    public function show(Producto $producto)
    {
        return new ProductoResource($producto);
    }

    public function update(ProductoRequest $request, Producto $producto)
    {
        $producto->update($request->validated());

        return new ProductoResource($producto);
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return response()->json();
    }
}
