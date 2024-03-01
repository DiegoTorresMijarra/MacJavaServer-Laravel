<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

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
                    'ADMIN' => $this->adminHome($user),
                    'EMPLEADO' => $this->empleadoHome($user),
                    default => $this->userHome($user),
            };
    }

    private function userHome(User $user)
    {
        $pedidos = $user->pedidos();

        $direcciones = $user->direcciones();

        //mostrar sus pedidos, dividirlos en entregados/activos

        return view('home');
    }

    private function empleadoHome(User $user)
    {
        $empleo = $user->empleado();
        // y cambio de contraseña

        return view('home');
    }

    private function adminHome(User $user)
    {
        // crud trabajadores y usuarios, asi como modif sus datos

        return view('home');
    }
}
