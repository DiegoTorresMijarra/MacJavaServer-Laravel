<?php

namespace App\Http\Controllers;

use App\Http\Requests\DireccionPersonalRequest;
use App\Http\Resources\DireccionPersonalResource;
use App\Models\DireccionPersonal;

class DireccionPersonalController extends Controller
{
    public function index()
    {
        return DireccionPersonalResource::collection(DireccionPersonal::all());
    }

    public function store(DireccionPersonalRequest $request)
    {
        return new DireccionPersonalResource(DireccionPersonal::create($request->validated()));
    }

    public function show(DireccionPersonal $direccionPersonal)
    {
        return new DireccionPersonalResource($direccionPersonal);
    }

    public function update(DireccionPersonalRequest $request, DireccionPersonal $direccionPersonal)
    {
        $direccionPersonal->update($request->validated());

        return new DireccionPersonalResource($direccionPersonal);
    }

    public function destroy(DireccionPersonal $direccionPersonal)
    {
        $direccionPersonal->delete();

        return response()->json();
    }
}
