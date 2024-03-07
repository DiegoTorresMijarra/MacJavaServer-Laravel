<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\DireccionPersonalResource;
use App\Http\Resources\PedidoResource;
use App\Models\DireccionPersonal;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return $this->redirectHome();
    }

    private function redirectHome()
    {
        $user = Auth::user(); //deberia haberlo siempre, porq se pasa el middleware antes

        return
            match ($user->rol) {  //usa el comparador '===' switch el '=='
                    'ADMIN', 'EMPLEADO' => $this->empleadoHome($user),
                    default => $this->userHome($user),
            };
    }

    private function userHome(User $user)
    {

        $pedidos = PedidoResource::collection($user->pedidos()->paginate(6)); //->activos()->paginate(3);

        //devolver historicos en otro paginate?

        $direcciones = DireccionPersonalResource::collection($user->direcciones()->paginate(6));

        //mostrar sus pedidos, dividirlos en entregados/activos

        //editar datos, avatar

        return view('home')->with('direcciones', $direcciones)->with('pedidos',$pedidos);
    }


    private function empleadoHome(User $user)
    {
        // y cambio de contraseña y datos empleado
        // crud trabajadores y usuarios, asi como modif sus datos

        return view('homeAdmin');
    }

    public function edit($id) // todos: contraseña ; el user puede editar su imagen
    {
        $user = $this->getSameUser($id);
    }

    public function update(UserRequest $request, $id)
    {
        $user = $this->getSameUser($id);

        try{
            $request->validarYTransformar();
            $this->updateImage($request, $user);

            $user->update($request->all());
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }
    }

    public function destroy($id)
    {
        $user = $this->getSameUser($id);

        if($user->rol!=='USER')
        {
            throw new AuthorizationException('No puedes eliminar un usuario con rol distinto a USER');
        }
        $user->destroyImage();

        $user->delete();
    }

    private function getSameUser($id)
    {
        $user = Auth::user();
        if ($user->id!==$id)
        {
            throw new AuthorizationException('No puedes editar un usuario distinto al tuyo');
        }
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

    /**
     * Llamar despues de la validacion, actualiza el request con el nombre de la imagen apropiado y almacena esta en el storage.
     * No la actualiza sola, es parte del update
     * @param UserRequest $request
     * @param User $user
     * @return void
     */
    private function updateImage(UserRequest $request, User $user)
    {
        $imagen = $request->file('avatar');


        if ($imagen&&$user->rol==='USER')//solo se pueden cambiar las imagenes de los usuarios
        {
            try {
                $user->destroyImage();

                $extension = $imagen->getClientOriginalExtension();
                $fileToSave = $request->email.  '.' . $extension;
                $imagen->storeAs('avatar', $fileToSave, 'public');

                $request->merge(['avatar' =>$imagen]);

            } catch (Exception $e) {

                throw new ValidationException('Error al actualizar la imagen' . $e->getMessage());
            }
        }
    }
}
