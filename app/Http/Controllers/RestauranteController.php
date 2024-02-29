<?php

namespace App\Http\Controllers;

use App\Http\Resources\RestauranteResource;
use App\Models\Direccion;
use Exception;
use Illuminate\Http\Request;
use App\Models\Restaurante;

class RestauranteController extends Controller
{
    public function index(Request $request)
    {
        $restaurantes = Restaurante::search($request->search)->orderBy('id', 'asc')->paginate(4);
        return view('restaurantes.index')->with('restaurantes', $restaurantes);
    }

    public function show($id)
    {
        $restaurante = Restaurante::find($id);

        if (!$restaurante) {
            abort(404);
        }

        return view('restaurantes.show')->with('restaurante', $restaurante);
    }

    public function create()
    {
        $direcciones = Direccion::all();
        return view('restaurantes.create')->with('direcciones', $direcciones);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'min:3|max:25|required',
            'capacidad' => 'required|integer',
            'direccion' => 'required|exists:direcciones,id', // Asegúrate de que la columna 'id' sea la correcta en value del formulario (autovalida que exista en la tabla categorias)
        ]);
        try {
            // Creamos el producto
            $restaurante = new Restaurante($request->all());
            // Asignamos la categoría
            $restaurante->direccion_id = $request->direccion;
            // salvamos el producto
            $restaurante->save();
            // Devolvemos el producto creado
            return redirect()->route('restaurantes.index'); // Volvemos a la vista de productos
        } catch (Exception $e) {
            dd($e);
            return redirect()->back(); // volvemos a la anterior
        }
    }

    public function edit($id)
    {
        // Buscamos el producto por su id
        $restaurante = Restaurante::find($id);
        if (!$restaurante) {
            abort(404);
        }
        // Buscamos las categorias
        $direcciones = Direccion::all();
        // Devolvemos el producto
        return view('restaurantes.edit')
            ->with('restaurante', $restaurante)
            ->with('direcciones', $direcciones);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'nombre' => 'min:3|max:25|required',
            'capacidad' => 'required|integer',
        ]);
        try {
            // Buscamos el producto por su id
            $restaurante = Restaurante::find($id);
            if (!$restaurante) {
                abort(404);
            }
            $restaurante->update($request->all());
            $restaurante->direccion_id = $request->direccion;
            $restaurante->save();
            return redirect()->route('restaurantes.index');
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        try {
            $restaurante = Restaurante::find($id);

            if (!$restaurante) {
                abort(404);
            }
            $restaurante->delete();

            return redirect()->route('restaurantes.index');
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}
