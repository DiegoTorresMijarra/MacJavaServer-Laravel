<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::search($request->search)->orderBy('id', 'asc')->paginate(5);
        CategoriaResource::collection($categorias);
        return view('categorias.index')->with('categorias', $categorias);
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);
        $categoria = new CategoriaResource($categoria);
        return view('categorias.show')->with('categoria', $categoria);
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(CategoriaRequest $request)
    {
        try {
            $request->validated();
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }

        try {
            $categoria = new Categoria($request->all());
            $categoria->save();
            flash('Categoria creada con éxito.')->success()->important();
            return redirect()->route('categorias.index');
        } catch (Exception $e) {
            flash('Error al crear la categoria' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('categorias.edit')->with('categoria', $categoria);
    }

    public function update(CategoriaRequest $request, $id)
    {
        try {
            $request->validated();
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }

        try {
            $categoria = Categoria::find($id);
            $categoria->update($request->all());
            $categoria->save();
            flash('Categoria actualizada con éxito.')->warning()->important();
            return redirect()->route('categorias.index');
        } catch (Exception $e) {
            flash('Error al actualizar la categoria' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $categoria = Categoria::find($id);
            $categoria->delete();
            flash('Categoria eliminada con éxito.')->error()->important();
            return redirect()->route('categorias.index');
        } catch (Exception $e) {
            flash('Error al eliminar la categoria' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }
}
