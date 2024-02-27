<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestauranteRequest;
use App\Http\Resources\RestauranteResource;
use App\Models\Restaurante;

class RestauranteController extends Controller
{
    public function index()
    {
        return RestauranteResource::collection(Restaurante::all());
    }

    public function store(RestauranteRequest $request)
    {
        return new RestauranteResource(Restaurante::create($request->validated()));
    }

    public function show(Restaurante $restaurante)
    {
        return new RestauranteResource($restaurante);
    }

    public function update(RestauranteRequest $request, Restaurante $restaurante)
    {
        $restaurante->update($request->validated());

        return new RestauranteResource($restaurante);
    }

    public function destroy(Restaurante $restaurante)
    {
        $restaurante->delete();

        return response()->json();
    }
}
