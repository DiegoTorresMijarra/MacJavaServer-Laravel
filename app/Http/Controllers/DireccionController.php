<?php

namespace App\Http\Controllers;

use App\Http\Requests\DireccionRequest;
use App\Http\Resources\DireccionResource;
use App\Models\Direccion;
use App\Models\Restaurante;
use Exception;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    public function index(Request $request)
    {
        $direcciones = Direccion::search($request->search)->orderBy('id', 'asc')->paginate(4);
        return view('direcciones.index')->with('direcciones', $direcciones);
    }

    public function show($id)
    {
        $direccion = Direccion::find($id);

        if (!$direccion) {
            abort(404);
        }

        return view('direcciones.show')->with('direccion', $direccion);
    }

    public function create()
    {
        return view('direcciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pais' => ['required', 'string', 'max:250'],
            'provincia' => ['required', 'string', 'max:250'],
            'municipio' => ['required', 'string', 'max:250'],
            'codigoPostal' => ['required', 'string', 'max:250'],
            'calle' => ['required', 'string', 'max:250'],
            'numero' => ['required', 'string', 'max:250'],
            'portal' => ['nullable', 'string', 'max:250'],
            'infoAdicional' => ['nullable', 'string', 'max:250'],
            'piso' => ['nullable', 'string', 'max:250'],
        ]);
        try {
            $direccion = new Direccion($request->all());
            $direccion->save();
            return redirect()->route('direcciones.index');
        } catch (Exception $e) {
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $direccion = Direccion::find($id);
        if (!$direccion) {
            abort(404);
        }
        return view('direcciones.edit')
            ->with('direccion', $direccion);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'pais' => ['required', 'string', 'max:250'],
            'provincia' => ['required', 'string', 'max:250'],
            'municipio' => ['required', 'string', 'max:250'],
            'codigoPostal' => ['required', 'string', 'max:250'],
            'calle' => ['required', 'string', 'max:250'],
            'numero' => ['required', 'string', 'max:250'],
            'portal' => ['nullable', 'string', 'max:250'],
            'infoAdicional' => ['nullable', 'string', 'max:250'],
            'piso' => ['nullable', 'string', 'max:250'],
        ]);
        try {
            $direccion = Direccion::find($id);
            if (!$direccion) {
                abort(404);
            }
            $direccion->update($request->all());
            $direccion->save();
            return redirect()->route('direcciones.index');
        } catch (Exception $e) {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $direccion = Direccion::find($id);

            if (!$direccion) {
                abort(404);
            }
            $direccion->delete();

            return redirect()->route('direcciones.index');
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}
