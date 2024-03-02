<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrabajadorRequest;
use App\Http\Requests\UserRequest;
use App\Models\DireccionPersonal;
use App\Models\Trabajador;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Str;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//solo admin
class UserController extends Controller
{
    private function getById($id):User
    {
        if( $id && is_integer($id))
        {
            $res = User::find($id);

            if($res)
            {
                return $res;
            }
            throw new NotFoundHttpException('Usuario no encontrado');
        }
        throw new BadRequestException('El id no es valido');
    }
    public function index()
    {
        $res = User::all(); //paginar resource etc, search por role? o divnav con user/t/a
    }

    public function create()
    {
        // es para añadir trabajadores y usuarios a la vez?!!

    }

    public function store(Request $request)
    {
        $empleadoReq = TrabajadorRequest::createFrom($request);

        try {
            $empleadoReq->validated();

            $nombreUsuario=str_replace(["\r", "\n", "\t", ' '],'',ucwords($empleadoReq['nombre'].$empleadoReq['apellidos'].substr($empleadoReq['dni'],4)));

            $userReq = new UserRequest([
                'name'=> $nombreUsuario,
                'email'=>$nombreUsuario.'@macjava.com',
                'password'=> Str::random(10),//tb podria poner su dni
                'avatar'=> $request->file('avatar')
            ]);

            $userReq->validarYTransformar();

            $this->updateImage($userReq);

            $user = User::create($userReq->all());

            $empleado = Trabajador::create(array_merge($empleadoReq->all(), ['user_id' => $user->id]));

            flash(`Empleado con nombre ${$empleado->nombre} creado con user ${$user->name}`)->success()->important();

            //view
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }
    }

    public function show($id)
    {
        $user = $this->getById($id);

        //view
    }

    public function edit($id)
    {
        $user = $this->getById($id);
        //view
    }

    public function update(UserRequest $userReq, $id)
    {
        $user = $this->getById($id);

        try {
            $userReq->validarYTransformar();

            $this->updateImage($userReq,$user);

            $guardado = $user->update($userReq->all());

            flash(`Usuario con id ${$guardado->id} actualizado correctamente`)->success()->important();

            //view
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }
    }

    public function destroy($id)
    {
        $user = $this->getById($id);

        if($user->rol==='ADMIN')
        {
            throw new AuthorizationException('No se puede eliminar a un admin');
        }

        $user->destroyImage();

        if( false
            //    $user->pedidos()->count()>=1
            //    $user->empleado()
            //    $user->trabajadores()->count()>=1
        )
        {
            flash(`Usuario con id ${$user->id} eliminado logica y correctamente`)->success()->important();
            $this->safeDestroy($user); //prevenimos que se borren los q tienen pedidos, pero eliminamos los q no
        }else{
            $user->forceDelete();

            flash(`Usuario con id ${$user->id} eliminado dura y correctamente`)->success()->important();
        }

        return response('',204);
    }

    private function safeDestroy(User $user)
    {
        $pedidos = $user->pedidos();
        $empleado = $user->empleado();
        $direcciones = $user->direcciones();

        //$pedidos?->delete() no se si funciona pero hacer el borrado logico siempre
        if($pedidos)
        {
            foreach ($pedidos as $pedido)
            {
                //$pedido->delete()
            }
        }

        if($direcciones) //es mejor el foreach, para validar si la direccion tiene pedidos
        {
            foreach ($direcciones as $direccion)
            {
                if($direccion->pedidos()->count()>=1)
                {
                    $direccion->delete();
                }else{
                    $direccion->forceDelete();
                }
            }
        }

        $empleado?->delete();
    }

    /**
     * Llamar despues de la validacion, actualiza el request con el nombre de la imagen apropiado y almacena esta en el storage
     * @param UserRequest $request
     * @param User|null $user
     * @return void
     */
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
