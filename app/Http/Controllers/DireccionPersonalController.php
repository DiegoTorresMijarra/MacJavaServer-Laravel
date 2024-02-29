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
        if($id&&uuid_is_valid($id))
        {
            $res = DireccionPersonal::find($id);

            if($res&&$res->user_id==Auth::id())
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
        //view o modal
    }
    public function store(DireccionPersonalRequest $request)
    {
        try {
            $request->validated();
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }
        $guardado=DireccionPersonal::create();

        //index, view or same page
    }

    public function show($id)
    {
        $res=$this->getById($id);

        //view mostrar direccion
    }

    public function edit($id)
    {
        $direccion=$this->getById($id);
        //view o modal editar direccion
    }

    public function update(DireccionPersonalRequest $request, $id)
    {
        $original = $this->getById($id);

        try {
            $request->validated();
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }

        try {
            $original->update($request->all());

            flash('Direccion actualizada correctamente')->success()->important();

            return redirect()->route('funkos.index');
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
