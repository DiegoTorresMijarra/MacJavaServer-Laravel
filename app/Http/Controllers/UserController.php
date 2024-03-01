<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrabajadorRequest;
use App\Http\Requests\UserRequest;
use App\Models\Trabajador;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Str;

class UserController extends Controller
{
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
            ]);

            $userReq->validated();
            $user = User::create($userReq->all());

            $empleado = Trabajador::create(array_merge($empleadoReq->all(), ['user_id' => $user->id]));

            flash(`Empleado con nombre ${$empleado->nombre} creado con user ${$user->name}`)->success()->important();

            //view
        }catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 400);
        }
    }

    public function show(User $user)
    {
    }

    public function edit(User $user)
    {
    }

    public function update(Request $request, User $user)
    {
    }

    public function destroy(User $user)
    {
    }
}
