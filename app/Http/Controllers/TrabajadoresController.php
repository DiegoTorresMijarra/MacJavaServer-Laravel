<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrabajadoresRequest;
use App\Http\Resources\TrabajadoresResources;
use App\Models\Trabajadores;
use Exception;
use http\Client\Request;
use Illuminate\Support\Facades\Storage;

class TrabajadoresController extends Controller
{
    public function index(Request $request)
    {
        $trabajadores = Trabajadores::search($request->search)->orderBy('id', 'asc')->paginate(4);
        return view('trabajadores.index')->with('Trabajador', $trabajadores);
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'min:4|max:120|required',
            'apellidos' => 'min:2|max:120|required',
            'nomina' => 'min:4|max:120|required',
            'puesto' => 'required',

        ]);
        try {
            $trabajadores = new Trabajadores($request->all());
            $trabajadores->save();
            flash('Trabajador con el puesto de ' . $trabajadores->puesto . '  creado con éxito.')->success()->important();
            return redirect()->route('trabajadores.index');
        } catch (Exception $e) {
            flash('Error al dar de alta el trabajador' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $trabajadores = Trabajadores::find($id);
        return view('trabajadores.show')->with('trabajadores', $trabajadores);
    }

    public function create()
    {
        $trabajadores = Trabajadores::all();
        return view('trabajadores.create')->with('trabajadores', $trabajadores);
    }

    public function edit($id)
    {
        $trabajadores = Trabajadores::find($id);
        return view('trabajadores.edit')
            ->with('trabajadores', $trabajadores);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'min:4|max:120|required',
            'apellidos' => 'min:2|max:120|required',
            'nomina' => 'min:4|max:120|required',
            'puesto' => 'required',
        ]);
        try {
            $trabajadores = Trabajadores::find($id);
            $trabajadores->nombre = $request->nombre;
            $trabajadores->apellidos = $request->apellidos;
            $trabajadores->nomina = $request->nomina;
            $trabajadores->puesto = $request->puesto;
            $trabajadores->save();
            flash('Trabajador ' . $trabajadores->nombre . '  modificado con éxito.')->success()->important();
            return redirect()->route('trabajadores.index');
        } catch (Exception $e) {
            flash('Error al modificar el trabajador' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }
    public function destroy($id)
    {
        try {
            $trabajadores = Trabajadores::find($id);
            if ($trabajadores->imagen != Trabajadores::$IMAGE_DEFAULT && Storage::exists($trabajadores->imagen)) {
                Storage::delete($trabajadores->imagen);
            }
            $trabajadores->delete();
            flash('Trabajador' . $trabajadores->nombre . '  eliminado con éxito.')->error()->important();
            return redirect()->route('trabajadores.index');
        } catch (Exception $e) {
            flash('Error al dar de baja al trabajador' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
}
    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        try {
            $trabajadores = Trabajadores::find($id);
            if ($trabajadores->imagen != Trabajadores::$IMAGE_DEFAULT && Storage::exists($trabajadores->imagen)) {
                Storage::delete($trabajadores->imagen);
            }
            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $fileToSave =$trabajadores->uuid . '.' . $extension;
            $trabajadores->imagen = $imagen->storeAs('productos', $fileToSave, 'public');
            $trabajadores->save();
            flash('Trabajador ' . $trabajadores->nombre . '  actualizado con éxito.')->warning()->important();
            return redirect()->route('productos.index');
        } catch (Exception $e) {
            flash('Error al actualizar la imagen ' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

}
