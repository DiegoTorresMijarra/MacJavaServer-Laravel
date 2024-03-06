<?php

namespace App\Http\Controllers;

use App\Http\Requests\LineaPedidoProvisionalRequest;
use App\Models\Producto;
use http\Env\Request;
use Illuminate\Validation\ValidationException;
use Redirect;
use Session;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CarritoController extends Controller
{
    public static function singletonPedido()
    {
        $carrito = Session::get('carrito');

        if (!$carrito)
        {
            Session::put('carrito',[]);
        }
        return $carrito;
    }

    public function addLinea(LineaPedidoProvisionalRequest $request)
    {
        $carrito = CarritoController::singletonPedido();

        $lineaConIndex = $this->getLineaProducto($request->producto_id);
        if($lineaConIndex)
        {
            $carrito[$lineaConIndex['index']]['stock'] += $request->stock;

            flash('Cantidad del Pedido Actualizada')->success()->important();
        }else{
            $carrito[] = [
                'precio' => $request->precio,
                'stock' => $request->stock,
                'producto_id' => $request->producto_id
            ];
            flash('Producto Añadido al carrito correctamente')->success()->important();
        }
        Session::put('carrito', $carrito);

        return Redirect::back();
    }

    public static function getLineaProducto($producto_id)
    {
        $carrito = CarritoController::singletonPedido();

        if(!empty($carrito)){
            foreach ($carrito as $index => $linea) {
                if ($linea['producto_id'] == $producto_id) {
                    return ['index'=>$index, 'linea'=>$linea];
                }
            }
        }

        return null;
    }

    public static function getStockSession($producto_id)
    {
        $linea = CarritoController::getLineaProducto($producto_id);

        if($linea){
            return $linea['linea']['stock'];
        }
        return 0;
    }

    public function getCarritoSession()
    {
        $carritoSession = CarritoController::singletonPedido();

        $lineas = [];
        $total = 0;

        if(!empty($carritoSession))
        {
            foreach ($carritoSession as $linea)
            {
                $producto = Producto::findOrFail($linea['producto_id']);
                $subtotal = $linea['precio']*$linea['stock'];

                $total += $subtotal;
                $lineas[] = [
                    'producto' => $producto,
                    'precio' => $linea['precio'],
                    'stock' => $linea['stock'],
                    'subtotal'=> $subtotal,
                ];
            }
        }

        return view('carrito')->with('carrito',['total'=>$total, 'lineas'=>$lineas]);
    }
}
