<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrabajadorRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\TrabajadorResource;
use App\Models\Trabajador;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class TrabajadorController extends Controller
{
    public function index(Request $request)
    {
        $trabajadores = Trabajador::search($request->search)->orderBy('id', 'asc')->paginate(5);
        TrabajadorResource::collection($trabajadores);
        return view('trabajadores.index')->with('trabajadores', $trabajadores);
    }

    public function show($id)
    {
        $trabajador = Trabajador::find($id);
        $trabajador = new TrabajadorResource($trabajador);
        return view('trabajadores.show')->with('trabajador', $trabajador);
    }

    public function create()
    {
        return view('trabajadores.create')->with('trabajador');
    }

    public function store(TrabajadorRequest $request)
    {

        try {
            $request->validated();
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }

        try {

            $nombreUsuario = str_replace(["\r", "\n", "\t", ' '],'', strtolower(substr($request['nombre'], 0, 1) . explode(" ", $request['apellidos'])[0]));

            $userReq = new UserRequest([
                'name'=> $nombreUsuario,
                'email'=>$nombreUsuario.'@macjava.com',
                'password'=> Str::random(10),//tb podria poner su dni
                'rol'=> 'EMPLEADO',
                'avatar'=> $request->file('avatar')
            ]);

            $userReq->validarYTransformar();

            $this->updateImage($userReq);

            $user = User::create($userReq->all());


            $empleado = new Trabajador();
            $empleado->nombre = $request->nombre;
            $empleado->apellidos = $request->apellidos;
            $empleado->nomina = $request->nomina;
            $empleado->puesto = $request->puesto;
            $empleado->user_id = $user->id;
            $empleado->save();

            flash('Empleado con nombre '. $empleado->nombre .' creado con usuario '. $user->name)->success()->important();
            return redirect()->route('trabajadores.index');
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }
    }

    public function edit($id)
    {
        $trabajador = Trabajador::find($id);
        return view('trabajadores.edit')
            ->with('trabajador', $trabajador);
    }

    public function update(TrabajadorRequest $request, $id)
    {
        try {
            $request->validated();
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }

        try {
            $trabajador = Trabajador::find($id);
            $trabajador->update($request->all());
            $trabajador->save();
            flash('Trabajador actualizado con éxito.')->warning()->important();
            return redirect()->route('trabajadores.index');
        } catch (Exception $e) {
            flash('Error al actualizar el trabajador' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $trabajador = Trabajador::find($id);
            User::destroy($trabajador->user_id);
            $trabajador->delete();
            flash('Trabajador eliminado con éxito.')->error()->important();
            return redirect()->route('trabajadores.index');
        } catch (Exception $e) {
            flash('Error al eliminar el trabajador' . $e->getMessage())->error()->important();
            return redirect()->back();
        }
    }

    private function updateImage(UserRequest $request, ?User $user = null)
    {
        $imagen = $request->file('avatar');

        if($imagen) {
            try {

                $user?->destroyImage();

                $extension = $imagen->getClientOriginalExtension();
                $fileToSave = $request->email . '.' . $extension;
                $imagen->storeAs('avatar', $fileToSave, 'public');

                $request->merge(['avatar' => $imagen]);

            } catch (Exception $e) {

                throw new ValidationException('Error al actualizar la imagen' . $e->getMessage());
            }
        }
    }
}
