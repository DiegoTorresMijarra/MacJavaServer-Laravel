<?php

namespace App\Http\Controllers;

use App\Http\Requests\LineaPedidoRequest;
use App\Http\Resources\LineaPedidoResource;
use App\Models\LineaPedido;

class LineaPedidoController extends Controller
{
    public function index()
    {
        return LineaPedidoResource::collection(LineaPedido::all());
    }

    public function store(LineaPedidoRequest $request)
    {
        return new LineaPedidoResource(LineaPedido::create($request->validated()));
    }

    public function show(LineaPedido $lineaPedido)
    {
        return new LineaPedidoResource($lineaPedido);
    }

    public function update(LineaPedidoRequest $request, LineaPedido $lineaPedido)
    {
        $lineaPedido->update($request->validated());

        return new LineaPedidoResource($lineaPedido);
    }

    public function destroy(LineaPedido $lineaPedido)
    {
        $lineaPedido->delete();

        return response()->json();
    }
}
