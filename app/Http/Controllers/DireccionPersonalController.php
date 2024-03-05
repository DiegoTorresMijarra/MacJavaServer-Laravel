<?php

namespace App\Http\Controllers;

use App\Http\Requests\DireccionPersonalRequest;
use App\Http\Resources\DireccionPersonalResource;
use App\Models\DireccionPersonal;
use Auth;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DireccionPersonalController extends Controller
{
    /* no desarrolladas, no se van a usar:

        index()
    */

    private function getById($id)
    {
        if( $id && uuid_is_valid($id))
        {
            $res = DireccionPersonal::find($id);

            if($res && $res->user_id==Auth::id()
            )
            {
                //  throw new AuthorizationException('No puedes acceder a direcciones que no te pertenecen') //damos menos info al atacante si no le decimos q existe
                    return $res;
            }
            throw new NotFoundHttpException('Direccion Personal no encontrada');
        }
        throw new BadRequestException('El id no es valido');
    }

    public function create()
    {
        return view('direccionesPersonales.create');
    }
    public function store(DireccionPersonalRequest $request)
    {
        try {
            $request->merge(['user_id' => Auth::user()->id]);

            $request->validated();

            $guardado = DireccionPersonal::create($request->all());

            flash('Direccion Creada correctamenre')->success()->important();
            return redirect()->route('home');

        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }
    }

    public function show($id)
    {
        $res=$this->getById($id);

        return view('direccionesPersonales.show')->with('direccion',new DireccionPersonalResource($res));
    }

    public function edit($id)
    {
        $direccion = $this->getById($id);

        return view('direccionesPersonales.edit', compact('direccion'));
    }

    public function update(DireccionPersonalRequest $request, $id)
    {
        $original = $this->getById($id);

        try {
            $request->validated();
            $original->update($request->all());

            flash('Direccion actualizada correctamente')->success()->important();
            return redirect()->route('home');

        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);

        }catch (Exception $e) {
            throw new BadRequestException($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $original = $this->getById($id);
        if( false
        //    $original->pedidos()->count()>=1
        )
        {
           $original->delete(); //prevenimos que se borren los q tienen pedidos, pero eliminamos los q no
        }

        $original->forceDelete();

        return response('',204);
    }
}
