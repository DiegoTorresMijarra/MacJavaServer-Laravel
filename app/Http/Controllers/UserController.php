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
use Illuminate\Support\Facades\Redirect;
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

        if( $id && filter_var($id, FILTER_VALIDATE_INT))
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
    public function index(Request $request)
    {
        $res = User::email($request->email)->orderBy('id','asc')->paginate(10); //paginar resource etc, search por role? o divnav con user/t/a

        return view('users.index')->with('usuarios', $res);
    }

    public function create()
    {
        // es para añadir trabajadores y usuarios a la vez?!!

        return view('users.create');
    }

    public function store(Request $request)
    {
        $empleadoReq = TrabajadorRequest::createFrom($request);

        $user=null;
        $empleado=null;

        try {
            $empleadoReq->validar();

            $nombreUsuario=str_replace(["\r", "\n", "\t", ' '],'', ucwords($empleadoReq['nombre'].' '.$empleadoReq['apellidos'].substr($empleadoReq['dni'],4)));

            $userReq = UserRequest::createFrom($request);



            $userReq->merge([
                'name'=> $nombreUsuario,
                'email'=>$nombreUsuario.'@macjava.com',
                'password'=> $empleadoReq->dni,//tb podria poner un string aleatorio
                'password_confirmation'=> $empleadoReq->dni,
            ]);

            $userReq->validarYTransformar();

            $user = User::create(array_merge($userReq->all(), ['rol' => 'EMPLEADO']));
            $user->avatar = $this->updateImage($request,$user);
            $user->save();

            $empleado = Trabajador::create(array_merge($empleadoReq->all(), ['user_id' => $user->id]));

            flash('Empleado con nombre '.$empleado->nombre.' creado con user '.$user->name.'  '.$empleadoReq->dni)->success()->important();
            return redirect()->route('users.show', $user->id);

        }catch (ValidationException $e) {
            throw $e; //la gestiona laravel
        }catch (Exception $e) {
            $user?->forceDelete();
            $empleado?->forceDelete();
            throw new BadRequestException('Algo ha salido mal: '.$e->getMessage());
        }
    }

    public function show($id)
    {
        $user = $this->getById($id);

        return view('users.show')->with('usuario', $user);
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

            $this->updateImage($userReq, $user);

            $guardado = $user->update($userReq->all());

            flash(`Usuario con id ${$guardado->id} actualizado correctamente`)->success()->important();

            //view
        }catch (ValidationException $e) {
            return Redirect::back()->with(['errors' => $e->errors()]);
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

        if(
            $user->pedidos || $user->empleado || $user->direcciones->count()>=1
        )
        {
            flash('Usuario con id '. $id.' eliminado logica y correctamente')->success()->important();
            $this->safeDestroy($user); //prevenimos que se borren los q tienen pedidos, pero eliminamos los q no
        }else{
            flash('Usuario con id '. $id.' eliminado dura y correctamente')->success()->important();

            User::find($user)->forceDelete();
        }

        return redirect(route('users.index'));
    }

    private function safeDestroy(User $user)
    {
        $pedidos = $user->pedidos;
        $empleado = $user->empleado();
        $direcciones = $user->direcciones;

        //$pedidos?->delete(); // no se si funciona pero hacer el borrado logico siempre
        if($pedidos && $pedidos->count()>=1)
        {
            foreach ($pedidos as $pedido)
            {
                $pedido->delete();
            }
        }

        if($direcciones) //es mejor el foreach, para validar si la direccion tiene pedidos
        {
            foreach ($direcciones as $direccion)
            {
                if($direccion->pedidos && $direccion->pedidos->count()>=1)
                {
                    $direccion->delete();
                }else{
                    $direccion->forceDelete();
                }
            }
        }

        $empleado?->delete();

        User::destroy($user->id);
    }

    public function editImage(Request $request, $id)
    {
        $user = $this->getById($id);

        $user->avatar = $this->updateImage($request,$user);
        $user->save();

        flash('Avatar cambiado correctamente')->success()->important();
        return redirect(route('home'));
        //return view('users.edit-image')->with('user', $user);
    }


    /**
     * Llamar despues de la validacion, actualiza el request con el nombre de la imagen apropiado y almacena esta en el storage
     * @param UserRequest $request
     * @param User|null $user
     */
    private function updateImage(Request $request, ?User $user = null)
    {
        $imagen = $request->file('avatar');

        if($imagen) {
            try {
                $user?->destroyImage();

                $extension = $imagen->getClientOriginalExtension();
                $fileToSave = Str::uuid().'.' . $extension;
                $path = $imagen->storeAs('avatar', $fileToSave, 'public');

                return $fileToSave;
                //$request->merge(['avatar' => $fileToSave]);
            } catch (Exception $e) {
                throw new ValidationException('Error al actualizar la imagen' . $e->getMessage());
            }
        }else{
            throw new Exception('update img '.$imagen);
        }
    }
}
