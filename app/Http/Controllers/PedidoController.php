<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoRequest;
use App\Http\Resources\PedidoResource;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        return PedidoResource::collection(Pedido::all());
    }

    public function store(PedidoRequest $request)
    {
        return new PedidoResource(Pedido::create($request->validated()));
    }

    public function show(Pedido $pedido)
    {
        return new PedidoResource($pedido);
    }

    public function update(PedidoRequest $request, Pedido $pedido)
    {
        $pedido->update($request->validated());

        return new PedidoResource($pedido);
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return response()->json();
    }
}
